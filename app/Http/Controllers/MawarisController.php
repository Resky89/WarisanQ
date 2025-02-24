<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class MawarisController extends Controller
{
    public function index()
    {
        return view('layouts.app');
    }

    public function hukum()
    {
        return view('menu_hukum');
    }

    public function mawaris()
    {
        return view('menu_mawaris');
    }

    // Kalkulator - Informasi Umum
    public function kalkulatorInformasiUmum()
    {
        // Menghapus data session terkait kalkulasi sebelumnya
        session()->forget([
            'gender',
            'status_pernikahan',
            'tirkah',
            'hutang',
            'wasiat',
            'tazhij',
            'irst',
            'suami',
            'jumlah_istri',
            'anak',
            'cucu',
            'ayah',
            'ibu',
            'kakek',
            'nenek',
            'nenek_dari_ibu',
            'jumlah_anak_lk',
            'jumlah_anak_pr',
            'jumlah_cucu_lk',
            'jumlah_cucu_pr',
            'jumlah_saudara',
            'jumlah_saudari'
        ]);
        session(['current_step' => 'informasi_umum']);
        return view('kalkulator.informasi_umum');
    }

    public function kalkulatorInformasiUmumPost(Request $request)
    {
        // Validasi input
        $validated = $request->validate([
            'gender' => 'required|in:laki_laki,perempuan',
            'status_pernikahan' => 'required|in:menikah,belum_menikah',
        ]);

        // Simpan data ke session
        session([
            'gender' => $validated['gender'],
            'status_pernikahan' => $validated['status_pernikahan']
        ]);

        // Jika status pernikahan berubah menjadi belum menikah, hapus data keluarga inti
        if ($validated['status_pernikahan'] === 'belum_menikah') {
            session()->forget([
                'jumlah_anak_lk',
                'jumlah_anak_pr',
                'jumlah_cucu_lk',
                'jumlah_cucu_pr',
                'jumlah_istri',
                'anak',
                'cucu',
                'suami'
            ]);
        }

        // Redirect ke halaman berikutnya
        return redirect()->route('informasi_harta');
    }


    // Kalkulator - Informasi Harta
    public function kalkulatorInformasiHarta()
    {
        session(['current_step' => 'informasi_harta']);
        return view('kalkulator.informasi_harta');
    }

    public function kalkulatorInformasiHartaPost(Request $request)
    {
        // Validasi input
        $validated = $request->validate([
            'tirkah' => ['required', 'regex:/^\d+$/', 'gt:0'],
            'hutang' => ['nullable', 'regex:/^\d+$/'],
            'wasiat' => ['nullable', 'regex:/^\d+$/'],
            'tazhij' => ['nullable', 'regex:/^\d+$/'],
        ]);

        // Konversi input menjadi float
        $tirkah = floatval($validated['tirkah']);
        $hutang = floatval($validated['hutang'] ?? '0');
        $wasiat = floatval($validated['wasiat'] ?? '0');
        $tazhij = floatval($validated['tazhij'] ?? '0');

        // Hitung maksimum wasiat (1/3 dari tirkah)
        $maksWasiat = $tirkah / 3;

        // Pastikan wasiat tidak melebihi 1/3 dari tirkah
        if ($wasiat > $maksWasiat) {
            return back()->withErrors(['wasiat' => 'Wasiat tidak boleh melebihi 1/3 dari harta warisan.'])->withInput();
        }

        // Hitung irst
        $irst = $tirkah - $hutang - $wasiat - $tazhij;

        // Pastikan irst lebih dari nol
        if ($irst <= 0) {
            return back()->withErrors(['irst' => 'Harta siap dibagi (Al-Irst) harus lebih dari nol.'])->withInput();
        }

        // Simpan data ke session
        session([
            'tirkah' => $tirkah,
            'hutang' => $hutang,
            'wasiat' => $wasiat,
            'tazhij' => $tazhij,
            'irst' => $irst,
        ]);

        // Tampilkan isi session
        // dd(session()->all());

        // Redirect berdasarkan status pernikahan
        $statusPernikahan = session('status_pernikahan');
        if ($statusPernikahan === 'belum_menikah') {
            return redirect()->route('informasi_keluarga');
        } else {
            return redirect()->route('informasi_keluarga_inti');
        }
    }

    // Kalkulator - Informasi Keluarga Inti
    public function kalkulatorInformasiKeluargaInti()
    {
        session(['current_step' => 'keluarga_inti']);

        return view('kalkulator.informasi_keluarga_inti');
    }
    public function kalkulatorInformasiKeluargaIntiPost(Request $request)
    {
        // Atur aturan validasi dasar
        $rules = [
            'anak' => 'required|in:ya,tidak',
            'cucu' => 'required|in:ya,tidak',
            'jumlah_anak_lk' => 'required|numeric|min:0',
            'jumlah_anak_pr' => 'required|numeric|min:0',
            'jumlah_cucu_lk' => 'required|numeric|min:0',
            'jumlah_cucu_pr' => 'required|numeric|min:0',
        ];

        // Tambahkan aturan berdasarkan gender dan status pernikahan
        if (session('gender') === 'perempuan' && session('status_pernikahan') === 'menikah') {
            $rules['suami'] = 'required|in:ya,tidak';
        } elseif (session('gender') === 'laki_laki' && session('status_pernikahan') === 'menikah') {
            $rules['jumlah_istri'] = 'required|numeric|min:0';
        }

        // Validasi input
        $validated = $request->validate($rules);

        // Siapkan data untuk disimpan ke session
        $sessionData = [
            'anak' => $validated['anak'],
            'cucu' => $validated['cucu'],
            'jumlah_anak_lk' => $validated['jumlah_anak_lk'],
            'jumlah_anak_pr' => $validated['jumlah_anak_pr'],
            'jumlah_cucu_lk' => $validated['jumlah_cucu_lk'],
            'jumlah_cucu_pr' => $validated['jumlah_cucu_pr'],
        ];

        // Tambahkan data suami atau jumlah istri jika ada
        if (isset($validated['suami'])) {
            $sessionData['suami'] = $validated['suami'];
        }
        if (isset($validated['jumlah_istri'])) {
            $sessionData['jumlah_istri'] = $validated['jumlah_istri'];
        }

        // Simpan data ke session
        session($sessionData);

        // dd(session()->all());

        // Redirect ke halaman berikutnya
        return redirect()->route('informasi_keluarga');
    }

    // Kalkulator - Informasi Keluarga
    public function kalkulatorInformasiKeluarga()
    {
        session(['current_step' => 'keluarga']);
        return view('kalkulator.informasi_keluarga');
    }

    // Kalkulator - Ringkasan
    public function kalkulatorRingkasan()
    {
        session(['current_step' => 'ringkasan']);
        return view('kalkulator.ringkasan');
    }



    public function kalkulatorInformasiKeluargaPost(Request $request)
    {
        // Atur aturan validasi dasar
        $rules = [
            'ayah' => 'nullable|in:hidup',
            'ibu' => 'nullable|in:hidup',
            'nenek_dari_ibu' => 'required_if:ibu,null|in:ya,tidak',
            'kakek' => 'nullable|in:hidup',
            'nenek' => 'nullable|in:hidup',
        ];

        // Tambahkan validasi untuk jumlah_saudara dan jumlah_saudari hanya jika diperlukan
        if (!$request->has('ayah') && session('jumlah_anak_lk', 0) == 0 && session('jumlah_cucu_lk', 0) == 0) {
            $rules['jumlah_saudara'] = 'required|integer|min:0';
            $rules['jumlah_saudari'] = 'required|integer|min:0';
        }

        // Validasi input
        $validated = $request->validate($rules);

        // Siapkan data untuk disimpan ke session
        $sessionData = [
            'ayah' => $validated['ayah'] ?? 'meninggal',
            'ibu' => $validated['ibu'] ?? 'meninggal',
            'kakek' => 'meninggal',  // Default value
            'nenek' => 'meninggal',  // Default value
        ];

        // Jika ibu meninggal, simpan data nenek dari ibu
        if ($sessionData['ibu'] === 'meninggal') {
            $sessionData['nenek_dari_ibu'] = $validated['nenek_dari_ibu'] ?? 'tidak';
        } else {
            $sessionData['nenek_dari_ibu'] = 'tidak';  // Default jika ibu hidup
        }

        // Jika ayah meninggal, periksa input untuk kakek dan nenek
        if ($sessionData['ayah'] === 'meninggal') {
            $sessionData['kakek'] = $validated['kakek'] ?? 'meninggal';
            $sessionData['nenek'] = $validated['nenek'] ?? 'meninggal';
        }

        // Hanya set jumlah_saudara dan jumlah_saudari jika diperlukan
        if (!$request->has('ayah') && session('jumlah_anak_lk', 0) == 0 && session('jumlah_cucu_lk', 0) == 0) {
            $sessionData['jumlah_saudara'] = $validated['jumlah_saudara'];
            $sessionData['jumlah_saudari'] = $validated['jumlah_saudari'];
        } else {
            $sessionData['jumlah_saudara'] = 0;
            $sessionData['jumlah_saudari'] = 0;
        }

        // Simpan data ke session
        session($sessionData);

        // Redirect ke halaman ringkasan
        return redirect()->route('ringkasan');
    }


    public function hitungHartaWarisan()
    {
        $irst = (float) session('irst', 0);
        $ahliWaris = [
            'suami' => ['jumlah' => session('suami') === 'ya' ? 1 : 0, 'pecahan' => 0, 'bagian' => 0],
            'istri' => ['jumlah' => (int) session('jumlah_istri', 0), 'pecahan' => 0, 'bagian' => 0],
            'ayah' => ['jumlah' => session('ayah') === 'hidup' ? 1 : 0, 'pecahan' => 0, 'bagian' => 0],
            'ibu' => ['jumlah' => session('ibu') === 'hidup' ? 1 : 0, 'pecahan' => 0, 'bagian' => 0],
            'kakek' => ['jumlah' => session('kakek') === 'hidup' ? 1 : 0, 'pecahan' => 0, 'bagian' => 0],
            'nenek' => ['jumlah' => session('nenek') === 'hidup' ? 1 : 0, 'pecahan' => 0, 'bagian' => 0],
            'nenek_dari_ibu' => ['jumlah' => session('nenek_dari_ibu') === 'ya' ? 1 : 0, 'pecahan' => 0, 'bagian' => 0],
            'anak_lk' => ['jumlah' => (int) session('jumlah_anak_lk', 0), 'pecahan' => 0, 'bagian' => 0],
            'anak_pr' => ['jumlah' => (int) session('jumlah_anak_pr', 0), 'pecahan' => 0, 'bagian' => 0],
            'cucu_lk' => ['jumlah' => (int) session('jumlah_cucu_lk', 0), 'pecahan' => 0, 'bagian' => 0],
            'cucu_pr' => ['jumlah' => (int) session('jumlah_cucu_pr', 0), 'pecahan' => 0, 'bagian' => 0],
            'saudara' => ['jumlah' => (int) session('jumlah_saudara', 0), 'pecahan' => 0, 'bagian' => 0],
            'saudari' => ['jumlah' => (int) session('jumlah_saudari', 0), 'pecahan' => 0, 'bagian' => 0],
        ];
        $totalHeirs = 0;
        $singleHeir = null;

        foreach ($ahliWaris as $tipe => $data) {
            if ($data['jumlah'] > 0) {
                $totalHeirs++;
                $singleHeir = $tipe;
            }
        }

        if ($totalHeirs === 1) {
            $ahliWaris[$singleHeir]['pecahan'] = 1;
            $ahliWaris[$singleHeir]['bagian'] = $irst;
            return $ahliWaris;
        }

        $adaKeturunanLangsung = $ahliWaris['anak_lk']['jumlah'] || $ahliWaris['anak_pr']['jumlah'];
        $adaKeturunanCucu = $ahliWaris['cucu_lk']['jumlah'] || $ahliWaris['cucu_pr']['jumlah'];




        //  Hitung bagian tetap
        if ($ahliWaris['suami']['jumlah']) {
            $ahliWaris['suami']['pecahan'] = ($adaKeturunanLangsung || $adaKeturunanCucu) ? 1 / 4 : 1 / 2;
        }
        if ($ahliWaris['istri']['jumlah']) {
            $ahliWaris['istri']['pecahan'] = ($adaKeturunanLangsung || $adaKeturunanCucu) ? 1 / 8 : 1 / 4;
        }

        if ($ahliWaris['ibu']['jumlah']) {
            $adaAnakAtauCucu = $adaKeturunanLangsung || $adaKeturunanCucu;
            $adaSaudaraBanyak = ($ahliWaris['saudara']['jumlah'] + $ahliWaris['saudari']['jumlah']) > 1;

            // ✅ Kasus khusus: Hanya ada ibu, ayah, dan istri/suami
            $hanyaIbuAyahPasangan = $ahliWaris['ibu']['jumlah'] && $ahliWaris['ayah']['jumlah'] && ($ahliWaris['istri']['jumlah'] || $ahliWaris['suami']['jumlah']) && !$adaAnakAtauCucu;

            if ($hanyaIbuAyahPasangan) {
                // Ibu mendapat sepertiga dari sisa setelah bagian pasangan diambil
                $bagianPasangan = $ahliWaris['suami']['pecahan'] + $ahliWaris['istri']['pecahan'];
                $ahliWaris['ibu']['pecahan'] = (1 - $bagianPasangan) * (1 / 3);
            } else {
                // Aturan umum untuk ibu
                $ahliWaris['ibu']['pecahan'] = ($adaAnakAtauCucu || $adaSaudaraBanyak) ? 1 / 6 : 1 / 3;
            }
        }



        if ($ahliWaris['ayah']['jumlah']) {
            $ahliWaris['ayah']['pecahan'] = ($adaKeturunanLangsung || $adaKeturunanCucu) ? 1 / 6 : 0;
        }


        if ($ahliWaris['kakek']['jumlah'] && !$ahliWaris['ayah']['jumlah']) {
            $ahliWaris['kakek']['pecahan'] = ($adaKeturunanLangsung || $adaKeturunanCucu) ? 1 / 6 : 0;
        }
        if ($ahliWaris['anak_pr']['jumlah'] && !$ahliWaris['anak_lk']['jumlah']) {
            $ahliWaris['anak_pr']['pecahan'] = ($ahliWaris['anak_pr']['jumlah'] === 1) ? 1 / 2 : 2 / 3;
        }

        if (($ahliWaris['nenek']['jumlah'] > 0 || $ahliWaris['nenek_dari_ibu']['jumlah'] > 0) &&
            $ahliWaris['ibu']['jumlah'] == 0
        ) {
            $pecahanNenek = 1 / 6;
            if ($ahliWaris['nenek']['jumlah'] > 0 && $ahliWaris['nenek_dari_ibu']['jumlah'] > 0) {
                $ahliWaris['nenek']['pecahan'] = $pecahanNenek / 2;
                $ahliWaris['nenek_dari_ibu']['pecahan'] = $pecahanNenek / 2;
            } else {
                if ($ahliWaris['nenek']['jumlah'] > 0) {
                    $ahliWaris['nenek']['pecahan'] = $pecahanNenek;
                } else {
                    $ahliWaris['nenek_dari_ibu']['pecahan'] = $pecahanNenek;
                }
            }
        }

        if ($ahliWaris['cucu_pr']['jumlah'] > 0 && $ahliWaris['cucu_lk']['jumlah'] == 0) {
            if ($ahliWaris['anak_pr']['jumlah'] > 0) {
                $ahliWaris['cucu_pr']['pecahan'] = 1 / 6;
            } else {
                $ahliWaris['cucu_pr']['pecahan'] = $ahliWaris['cucu_pr']['jumlah'] == 1 ? 1 / 2 : 2 / 3;
            }
        }

        if ($ahliWaris['saudari']['jumlah'] > 0 && $ahliWaris['saudara']['jumlah'] == 0 && !$adaKeturunanLangsung && !$adaKeturunanCucu && $ahliWaris['ayah']['jumlah'] == 0 && $ahliWaris['kakek']['jumlah'] == 0) {

            $ahliWaris['saudari']['pecahan'] = $ahliWaris['saudari']['jumlah'] == 1 ? 1 / 2 : 2 / 3;
        }

        // Ashabah bil-ghair:
        // Anak perempuan + anak laki-laki (2:1)
        if ($ahliWaris['anak_lk']['jumlah']) {
            $totalAnak = ($ahliWaris['anak_lk']['jumlah'] * 2) + $ahliWaris['anak_pr']['jumlah'];
            $sisa = 1 - array_sum(array_column($ahliWaris, 'pecahan'));
            if ($sisa > 0) {
                $ahliWaris['anak_lk']['pecahan'] += ($sisa * ($ahliWaris['anak_lk']['jumlah'] * 2)) / $totalAnak;
                $ahliWaris['anak_pr']['pecahan'] += ($sisa * $ahliWaris['anak_pr']['jumlah']) / $totalAnak;
            }
        }

        // Cucu laki-laki + cucu perempuan (jika anak tidak ada): 2:1
        if (!$ahliWaris['anak_lk']['jumlah'] && $ahliWaris['cucu_lk']['jumlah']) {
            $totalCucu = ($ahliWaris['cucu_lk']['jumlah'] * 2) + $ahliWaris['cucu_pr']['jumlah'];
            $sisa = 1 - array_sum(array_column($ahliWaris, 'pecahan'));
            if ($sisa > 0) {
                $ahliWaris['cucu_lk']['pecahan'] += ($sisa * ($ahliWaris['cucu_lk']['jumlah'] * 2)) / $totalCucu;
                $ahliWaris['cucu_pr']['pecahan'] += ($sisa * $ahliWaris['cucu_pr']['jumlah']) / $totalCucu;
            }
        }

        // Saudara laki-laki + saudari perempuan (2:1 jika tidak ada anak, cucu, ayah, kakek)
        if (!$ahliWaris['anak_lk']['jumlah'] && !$ahliWaris['cucu_lk']['jumlah'] && !$ahliWaris['ayah']['jumlah'] && !$ahliWaris['kakek']['jumlah'] && $ahliWaris['saudara']['jumlah']) {
            $totalSaudara = ($ahliWaris['saudara']['jumlah'] * 2) + $ahliWaris['saudari']['jumlah'];
            $sisa = 1 - array_sum(array_column($ahliWaris, 'pecahan'));
            if ($sisa > 0) {
                $ahliWaris['saudara']['pecahan'] += ($sisa * ($ahliWaris['saudara']['jumlah'] * 2)) / $totalSaudara;
                $ahliWaris['saudari']['pecahan'] += ($sisa * $ahliWaris['saudari']['jumlah']) / $totalSaudara;
            }
        }

        // Ashabah ma’al-ghair: Saudari + anak perempuan (saudari jadi ashobah jika ada anak perempuan & tidak ada anak laki-laki)
        if ($ahliWaris['anak_pr']['jumlah'] && !$ahliWaris['anak_lk']['jumlah'] && $ahliWaris['saudari']['jumlah']) {
            $sisa = 1 - array_sum(array_column($ahliWaris, 'pecahan'));
            if ($sisa > 0) {
                $ahliWaris['saudari']['pecahan'] += $sisa;
            }
        }

        // Ashabah untuk ayah atau kakek jika ada sisa
        $sisa = 1 - array_sum(array_column($ahliWaris, 'pecahan'));
        if ($sisa > 0) {
            if ($ahliWaris['ayah']['jumlah']) {
                $ahliWaris['ayah']['pecahan'] += $sisa;
            } elseif ($ahliWaris['kakek']['jumlah']) {
                $ahliWaris['kakek']['pecahan'] += $sisa;
            }
        }

        // Al-Aul: Jika total pecahan > 1 → proporsional dikurangi
        $totalPecahan = array_sum(array_column($ahliWaris, 'pecahan'));
        if ($totalPecahan > 1) {
            foreach ($ahliWaris as &$data) {
                $data['pecahan'] /= $totalPecahan;
            }
        }

        // Ar-Radd: Jika total pecahan < 1 & tidak ada ashobah → sisa dibagikan ke ahli waris pecahan (kecuali suami/istri)
        $adaAshobah = $ahliWaris['anak_lk']['jumlah'] || $ahliWaris['cucu_lk']['jumlah'] || $ahliWaris['ayah']['jumlah'] || $ahliWaris['kakek']['jumlah'] || $ahliWaris['saudara']['jumlah'];

        if ($totalPecahan < 1 && !$adaAshobah) {
            $sisa = 1 - $totalPecahan;
            $ahliWarisRadd = array_filter($ahliWaris, fn($data, $tipe) => $data['pecahan'] > 0 && !in_array($tipe, ['suami', 'istri']), ARRAY_FILTER_USE_BOTH);
            $totalRaddPecahan = array_sum(array_column($ahliWarisRadd, 'pecahan'));

            foreach ($ahliWarisRadd as $tipe => $data) {
                $ahliWaris[$tipe]['pecahan'] += ($sisa * $data['pecahan']) / $totalRaddPecahan;
            }
        }


        // 🧮 Hitung bagian akhir
        foreach ($ahliWaris as &$data) {
            $data['bagian'] = $irst * $data['pecahan'];
        }

        return $ahliWaris;
    }

    // Fungsi konversi desimal ke pecahan
    private function desimalKePecahan($desimal)
    {
        if ($desimal == 0) return "0";

        $epsilon = 1.0E-6; // Toleransi kesalahan kecil
        $penyebut = 1;
        while (abs(round($desimal * $penyebut) / $penyebut - $desimal) > $epsilon) {
            $penyebut++;
        }
        $pembilang = round($desimal * $penyebut);
        return $this->sederhanakanPecahan($pembilang, $penyebut);
    }

    // Fungsi untuk menyederhanakan pecahan
    private function sederhanakanPecahan($pembilang, $penyebut)
    {
        $fpb = $this->cariFPB($pembilang, $penyebut);
        $pembilang /= $fpb;
        $penyebut /= $fpb;

        return "{$pembilang}/{$penyebut}";
    }

    // Fungsi mencari FPB
    private function cariFPB($a, $b)
    {
        return ($b == 0) ? $a : $this->cariFPB($b, $a % $b);
    }

    public function hasilKalkulator()
    {
        $ahliWaris = $this->hitungHartaWarisan();
        $hasilKalkulasi = [];

        $jumlahAnakLk = $ahliWaris['anak_lk']['jumlah'];
        $jumlahAnakPr = $ahliWaris['anak_pr']['jumlah'];
        $bobotTotal = ($jumlahAnakLk * 2) + $jumlahAnakPr;

        $jumlahCucuLk = $ahliWaris['cucu_lk']['jumlah'];
        $jumlahCucuPr = $ahliWaris['cucu_pr']['jumlah'];
        $bobotTotalCucu = ($jumlahCucuLk * 2) + $jumlahCucuPr;

        $jumlahSdk = $ahliWaris['saudara']['jumlah'];
        $jumlahSdp = $ahliWaris['saudari']['jumlah'];
        $bobotTotalSaudara = ($jumlahSdk * 2) + $jumlahSdp;

        $adaKeturunan = ($jumlahAnakLk > 0 || $jumlahAnakPr > 0 ||
            $jumlahCucuLk > 0 ||  $jumlahCucuPr > 0);

        foreach ($ahliWaris as $tipe => $data) {
            if ($data['jumlah'] > 0) {
                // Kondisi untuk Ayah
                if ($tipe === 'ayah' && $jumlahAnakLk == 0 && $jumlahCucuLk == 0 && $jumlahAnakPr == 0) {
                    $bagianPecahan = "A"; // A untuk Ashabah
                } else if ($tipe === 'ayah' && $jumlahAnakPr > 0) {
                    $bagianPecahan = "1/6+A";
                } else {
                    if ($tipe === 'anak_pr' && $jumlahAnakLk == 0) {
                        if ($data['jumlah'] == 1) {
                            $bagianPecahan = "1/2";  // Single daughter gets 1/2
                        } else {
                            $bagianPecahan = "2/3";  // Multiple daughters share 2/3
                        }
                    } else if ($tipe === 'cucu_pr') {
                        if ($ahliWaris['anak_lk']['jumlah'] == 0 && $ahliWaris['anak_pr']['jumlah'] == 0) {
                            if ($data['jumlah'] == 1) {
                                $bagianPecahan = "1/2";
                            } else {
                                $bagianPecahan = "2/3";
                            }
                        } else if ($ahliWaris['anak_lk']['jumlah'] == 0 && $ahliWaris['anak_pr']['jumlah'] == 1) {
                            $bagianPecahan = "1/6";
                        }
                    } elseif ($tipe === 'saudari' && $jumlahCucuLk == 0 && $jumlahSdk == 0) {
                        if (!$adaKeturunan && $ahliWaris['ayah']['jumlah'] == 0 && $ahliWaris['kakek']['jumlah'] == 0) {
                            if ($ahliWaris['saudara']['jumlah'] == 0) {
                                if ($data['jumlah'] == 1) {
                                    $bagianPecahan = "1/2";
                                } else {
                                    $bagianPecahan = "2/3";
                                }
                            } else {
                                $bagianPecahan = "A"; // Ashabah bil ghair
                            }
                        }
                    }

                    // Anak calculations
                    elseif ($tipe === 'anak_lk' && $bobotTotal > 0) {
                        $bagianPecahan = $this->desimalKePecahan(2 / $bobotTotal);
                    } elseif ($tipe === 'anak_pr' && $bobotTotal > 0) {
                        $bagianPecahan = $this->desimalKePecahan(1 / $bobotTotal);
                    }
                    // Cucu calculations
                    elseif ($tipe === 'cucu_lk' && $bobotTotalCucu > 0) {
                        $bagianPecahan = $this->desimalKePecahan(2 / $bobotTotalCucu);
                    } elseif ($tipe === 'cucu_pr' && $bobotTotalCucu > 0) {
                        $bagianPecahan = $this->desimalKePecahan(1 / $bobotTotalCucu);
                    }
                    // Saudara calculations
                    elseif ($tipe === 'saudara' && $bobotTotalSaudara > 0) {
                        $bagianPecahan = $this->desimalKePecahan(2 / $bobotTotalSaudara);
                    } elseif ($tipe === 'saudari' && $bobotTotalSaudara > 0) {
                        $bagianPecahan = $this->desimalKePecahan(1 / $bobotTotalSaudara);
                    } else {

                        $bagianPecahan = $this->desimalKePecahan($data['pecahan']);
                    }
                }


                $hasilKalkulasi[] = [
                    'ahli_waris' => ucfirst(str_replace('_', ' ', $tipe)),
                    'jumlah' => $data['jumlah'],
                    'bagian' => $bagianPecahan,
                    'harta_bagian' => round($data['bagian'], 2),
                    'harta_per_orang' => $data['jumlah'] > 0 ? round($data['bagian'] / $data['jumlah'], 2) : 0
                ];
                // Menampilkan hasil di terminal

            }
        }

        return view('kalkulator.hasil', [
            'total_harta' => number_format((float)session('irst', 0), 0, ',', '.'),
            'hasil_kalkulasi' => $hasilKalkulasi
        ]);
    }
}
