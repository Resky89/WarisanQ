@extends('kalkulator.menu_kalkulator')

@section('content')
    <!-- Form Section -->
    <div class="min-h-screen bg-gray-50 flex justify-center items-center py-12">
        <div class="w-full max-w-4xl mx-auto bg-white rounded-2xl shadow-lg overflow-hidden">
            <div class="bg-dark px-6 py-4 sm:px-8 sm:py-6">
                <h2 class="text-2xl sm:text-3xl font-bold text-white text-center">Informasi Keluarga Pewaris</h2>
                <p class="text-sm sm:text-base text-gray-300 text-center mt-2">Silakan lengkapi informasi keluarga pewaris</p>
            </div>
            <form action="{{ route('informasi_keluarga_post') }}" method="post" id="keluargaForm" class="px-6 sm:px-10 py-6 w-full">
                @csrf

                <!-- Orang Tua -->
                <div class="mb-6">
                    <label class="block text-lg font-medium text-gray-800 mb-2">Apakah Orang tua kandung pewaris masih hidup?</label>
                    <p class="text-sm text-gray-500 mb-3">Centang jika Ayah atau Ibu pewaris masih hidup</p>
                    <div class="grid grid-cols-2 gap-4">
                        <label class="flex items-center p-4 rounded-xl border-2 border-gray-200 hover:bg-[#66E13A]/10 cursor-pointer">
                            <input type="checkbox" name="ayah" value="hidup" id="kondisiAyah" class="peer hidden" onchange="toggleAyah(this)"
                                {{ old('ayah', session('ayah')) == 'hidup' ? 'checked' : '' }}>
                            <div class="w-5 h-5 md:w-6 md:h-6 rounded-full border-2 border-black peer-checked:bg-[#66E13A] peer-checked:border-[#66E13A] peer-checked:text-white flex items-center justify-center mr-3">
                                <div class="opacity-0 peer-checked:opacity-100">✓</div>
                            </div>
                            <span class="text-sm sm:text-base text-gray-700">Ayah</span>
                        </label>
                        <label class="flex items-center p-4 rounded-xl border-2 border-gray-200 hover:bg-[#66E13A]/10 cursor-pointer">
                            <input type="checkbox" name="ibu" value="hidup" id="kondisiIbu" class="peer hidden" onchange="toggleIbu(this)"
                                {{ old('ibu', session('ibu')) == 'hidup' ? 'checked' : '' }}>
                            <div class="w-5 h-5 md:w-6 md:h-6 rounded-full border-2 border-black peer-checked:bg-[#66E13A] peer-checked:border-[#66E13A] peer-checked:text-white flex items-center justify-center mr-3">
                                <div class="opacity-0 peer-checked:opacity-100">✓</div>
                            </div>
                            <span class="text-sm sm:text-base text-gray-700">Ibu</span>
                        </label>
                    </div>
                </div>

                <!-- Nenek dari Ibu -->
                <div class="mb-6" id="nenekDariIbuContainer">
                    <label class="block text-lg font-medium text-gray-800 mb-2">Apakah nenek kandung dari sisi ibu masih hidup?</label>
                    <div class="grid grid-cols-2 gap-4">
                        <label class="flex items-center p-4 rounded-xl border-2 border-gray-200 hover:bg-[#66E13A]/10 cursor-pointer">
                            <input type="radio" name="nenek_dari_ibu" value="ya" id="nenekYa" class="peer hidden"
                                {{ old('nenek_dari_ibu', session('nenek_dari_ibu')) == 'ya' ? 'checked' : '' }}>
                            <div class="w-5 h-5 md:w-6 md:h-6 rounded-full border-2 border-black peer-checked:bg-[#66E13A] peer-checked:border-[#66E13A] peer-checked:text-white flex items-center justify-center mr-3">
                                <div class="opacity-0 peer-checked:opacity-100">✓</div>
                            </div>
                            <span class="text-sm sm:text-base text-gray-700">Ya</span>
                        </label>
                        <label class="flex items-center p-4 rounded-xl border-2 border-gray-200 hover:bg-[#66E13A]/10 cursor-pointer">
                            <input type="radio" name="nenek_dari_ibu" value="tidak" id="nenekTidak" class="peer hidden"
                                {{ old('nenek_dari_ibu', session('nenek_dari_ibu')) == 'tidak' ? 'checked' : '' }}>
                            <div class="w-5 h-5 md:w-6 md:h-6 rounded-full border-2 border-black peer-checked:bg-[#66E13A] peer-checked:border-[#66E13A] peer-checked:text-white flex items-center justify-center mr-3">
                                <div class="opacity-0 peer-checked:opacity-100">✓</div>
                            </div>
                            <span class="text-sm sm:text-base text-gray-700">Tidak</span>
                        </label>
                    </div>
                </div>

                <!-- Jumlah Saudara -->
                @if(session('jumlah_anak_lk', 0) == 0 && session('jumlah_cucu_lk', 0) == 0)
                <div class="mb-6" id="jumlahSaudaraKandung">
                    <label class="block text-lg font-medium text-gray-800 mb-2">Jumlah saudara kandung pewaris yang masih hidup</label>
                    <p class="text-sm text-gray-500 mb-3">Hanya hitung jumlah saudara yang beragama Islam</p>
                    <div class="grid grid-cols-2 gap-4">
                        <div class="space-y-2">
                            <label class="block text-sm font-medium text-gray-700">Saudara Laki-laki</label>
                            <input type="number" name="jumlah_saudara" id="jumlahSaudara"
                                class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-[#66E13A] focus:border-[#66E13A]"
                                value="{{ old('jumlah_saudara', session('jumlah_saudara', 0)) }}">
                        </div>
                        <div class="space-y-2">
                            <label class="block text-sm font-medium text-gray-700">Saudara Perempuan</label>
                            <input type="number" name="jumlah_saudari" id="jumlahSaudari"
                                class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-[#66E13A] focus:border-[#66E13A]"
                                value="{{ old('jumlah_saudari', session('jumlah_saudari', 0)) }}">
                        </div>
                    </div>
                </div>
                @endif

                <!-- Kakek Nenek -->
                <div class="mb-6" id="kakek-nenek">
                    <label class="block text-lg font-medium text-gray-800 mb-2">Apakah kakek-nenek kandung dari pewaris masih hidup?</label>
                    <p class="text-sm text-gray-500 mb-3">Centang jika Kakek atau Nenek dari sisi Ayah pewaris masih hidup</p>
                    <div class="grid grid-cols-2 gap-4">
                        <label class="flex items-center p-4 rounded-xl border-2 border-gray-200 hover:bg-[#66E13A]/10 cursor-pointer">
                            <input type="checkbox" name="kakek" value="hidup" id="kondisiKakek" class="peer hidden" onchange="toggleKakek(this)"
                                {{ old('kakek', session('kakek')) == 'hidup' ? 'checked' : '' }}>
                            <div class="w-5 h-5 md:w-6 md:h-6 rounded-full border-2 border-black peer-checked:bg-[#66E13A] peer-checked:border-[#66E13A] peer-checked:text-white flex items-center justify-center mr-3">
                                <div class="opacity-0 peer-checked:opacity-100">✓</div>
                            </div>
                            <span class="text-sm sm:text-base text-gray-700">Kakek</span>
                        </label>
                        <label class="flex items-center p-4 rounded-xl border-2 border-gray-200 hover:bg-[#66E13A]/10 cursor-pointer" id="NenekDariAyah">
                            <input type="checkbox" name="nenek" value="hidup" id="kondisiNenek" class="peer hidden"
                                {{ old('nenek', session('nenek')) == 'hidup' ? 'checked' : '' }}>
                            <div class="w-5 h-5 md:w-6 md:h-6 rounded-full border-2 border-black peer-checked:bg-[#66E13A] peer-checked:border-[#66E13A] peer-checked:text-white flex items-center justify-center mr-3">
                                <div class="opacity-0 peer-checked:opacity-100">✓</div>
                            </div>
                            <span class="text-sm sm:text-base text-gray-700">Nenek</span>
                        </label>
                    </div>
                </div>

                <!-- Hijab Messages -->
                <div class="space-y-3">
                    <div class="hidden bg-red-50 p-4 rounded-lg text-red-700 text-sm" id="hijab_nenekdariibu">
                        Nenek dari ibu pewaris terhalangi oleh adanya ibu pewaris
                    </div>
                    <div class="hidden bg-red-50 p-4 rounded-lg text-red-700 text-sm" id="hijab_saudara">
                        Saudara kandung pewaris terhalangi oleh adanya anak laki-laki, cucu laki-laki dari anak laki-laki, ayah dan kakek pewaris
                    </div>
                    <div class="hidden bg-red-50 p-4 rounded-lg text-red-700 text-sm" id="hijab_kakeknenek">
                        Kakek dan nenek kandung pewaris terhalangi oleh adanya ayah pewaris
                    </div>
                    <div class="hidden bg-red-50 p-4 rounded-lg text-red-700 text-sm" id="hijab_nenekdariayah">
                        Nenek dari ayah pewaris terhalangi oleh adanya ibu atau ayah pewaris
                    </div>
                </div>

                <!-- Submit Button -->
                <div class="flex justify-end mt-6">
                    <button type="submit" id="next-button"
                        class="w-full sm:w-auto px-6 py-3 bg-black text-[#66E13A] text-sm sm:text-base font-bold rounded-2xl hover:bg-gray-900 flex items-center justify-center gap-2 transition-all duration-200 border-2 border-black shadow-[5px_5px_#66E13A] hover:shadow-none hover:translate-x-[5px] hover:translate-y-[5px] group">
                        Lanjutkan
                        <svg class="w-5 h-5 transition-all duration-300 group-hover:translate-x-2 group-hover:scale-110" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7l5 5m0 0l-5 5m5-5H6" />
                        </svg>
                    </button>
                </div>
            </form>
        </div>
    </div>

    <!-- Keep the existing JavaScript -->
    <script>
        function updateVisibility() {
            const kondisiAyah = document.getElementById('kondisiAyah').checked;
            const kondisiIbu = document.getElementById('kondisiIbu').checked;
            const kondisiKakek = document.getElementById('kondisiKakek').checked;
            const kondisiNenek = document.getElementById('kondisiNenek').checked;

            const jumlahAnakLk = {{ session('jumlah_anak_lk', 0) }};
            const jumlahCucuLk = {{ session('jumlah_cucu_lk', 0) }};

            // Elemen-elemen yang perlu diupdate
            const jumlahSaudaraKandung = document.getElementById('jumlahSaudaraKandung');
            const hijab_saudara = document.getElementById('hijab_saudara');
            const hijab_kakeknenek = document.getElementById('hijab_kakeknenek');
            const hijab_nenekdariayah = document.getElementById('hijab_nenekdariayah');
            const nenekDariIbuContainer = document.getElementById('nenekDariIbuContainer');
            const hijab_nenekdariibu = document.getElementById('hijab_nenekdariibu');
            const kakekNenekContainer = document.getElementById('kakek-nenek');
            const NenekDariAyah = document.getElementById('NenekDariAyah');

            console.log('updateVisibility called');
            console.log('jumlahAnakLk:', jumlahAnakLk);
            console.log('jumlahCucuLk:', jumlahCucuLk);
            console.log('kondisiAyah:', kondisiAyah);
            console.log('kondisiKakek:', kondisiKakek);

            // Logika untuk Ayah
            if (kondisiAyah) {
                if (jumlahSaudaraKandung) jumlahSaudaraKandung.classList.add('hidden');
                hijab_saudara.classList.remove('hidden');
                hijab_kakeknenek.classList.remove('hidden');
                kakekNenekContainer.classList.add('hidden');
                kondisiKakek.checked = false;
                kondisiNenek.checked = false;
                hijab_nenekdariayah.classList.add('hidden');
            } else {
                if (jumlahSaudaraKandung && !kondisiKakek && jumlahAnakLk === 0 && jumlahCucuLk === 0) jumlahSaudaraKandung.classList.remove('hidden');
                if (!kondisiKakek && jumlahAnakLk === 0 && jumlahCucuLk === 0) hijab_saudara.classList.add('hidden');
                hijab_kakeknenek.classList.add('hidden');
                kakekNenekContainer.classList.remove('hidden');
            }

            // Logika untuk Ibu
            if (kondisiIbu) {
                nenekDariIbuContainer.classList.add('hidden');
                hijab_nenekdariibu.classList.remove('hidden');
                NenekDariAyah.classList.add('hidden');
                if (!kondisiAyah) {
                    hijab_nenekdariayah.classList.remove('hidden');
                }
            } else {
                nenekDariIbuContainer.classList.remove('hidden');
                hijab_nenekdariibu.classList.add('hidden');
                if (!kondisiAyah) {
                    NenekDariAyah.classList.remove('hidden');
                    hijab_nenekdariayah.classList.add('hidden');
                }
            }

            // Logika untuk Kakek
            if (kondisiKakek) {
                if (jumlahSaudaraKandung) jumlahSaudaraKandung.classList.add('hidden');
                hijab_saudara.classList.remove('hidden');
            } else if (!kondisiAyah && jumlahAnakLk === 0 && jumlahCucuLk === 0) {
                if (jumlahSaudaraKandung) jumlahSaudaraKandung.classList.remove('hidden');
                hijab_saudara.classList.add('hidden');
            }

            // Logika untuk anak laki-laki dan cucu laki-laki
            if (jumlahAnakLk > 0 || jumlahCucuLk > 0) {
                if (jumlahSaudaraKandung) jumlahSaudaraKandung.classList.add('hidden');
                hijab_saudara.classList.remove('hidden');
            }
        }

        function toggleAyah(checkbox) {
            updateVisibility();
        }

        function toggleIbu(checkbox) {
            updateVisibility();
        }

        function toggleKakek(checkbox) {
            updateVisibility();
        }

        // Event listener saat halaman dimuat
        document.addEventListener('DOMContentLoaded', function() {
            console.log('DOMContentLoaded event fired');
            const kondisiAyah = document.getElementById('kondisiAyah');
            const kondisiIbu = document.getElementById('kondisiIbu');
            const kondisiKakek = document.getElementById('kondisiKakek');
            const kondisiNenek = document.getElementById('kondisiNenek');

            // Tambahkan event listener untuk setiap checkbox
            kondisiAyah.addEventListener('change', updateVisibility);
            kondisiIbu.addEventListener('change', updateVisibility);
            kondisiKakek.addEventListener('change', updateVisibility);
            kondisiNenek.addEventListener('change', updateVisibility);

            // Panggil updateVisibility saat halaman dimuat
            updateVisibility();
        });
    </script>

@if ($errors->any())
    <div class="fixed top-4 right-4 bg-red-100 border-l-4 border-red-500 text-red-700 p-4 rounded shadow-lg">
        <ul class="list-disc list-inside">
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif

@endsection
