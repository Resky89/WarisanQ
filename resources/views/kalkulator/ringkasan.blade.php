@extends('kalkulator.menu_kalkulator')

@section('content')
<div class="min-h-screen bg-gray-50 flex justify-center items-center py-12">
    <div class="w-full max-w-4xl mx-auto bg-white rounded-2xl shadow-lg overflow-hidden">
        <!-- Header -->
        <div class="bg-dark px-6 py-4 sm:px-8 sm:py-6">
            <h2 class="text-2xl sm:text-3xl font-bold text-white text-center">Ringkasan Data Pewaris</h2>
            <p class="text-sm sm:text-base text-gray-300 text-center mt-2">Periksa kembali data yang telah dimasukkan</p>
        </div>

        <!-- Detail Keluarga Pewaris -->
        <div class="px-6 sm:px-10 py-6">
            <div class="mb-6">
                <h3 class="text-xl font-semibold text-gray-800 mb-4">Detail Keluarga Pewaris</h3>
                <div class="space-y-4">
                    <div class="flex justify-between items-center py-2 border-b border-gray-200">
                        <span class="text-gray-600">Pewaris adalah</span>
                        <span class="font-medium">{{ session('gender') === 'laki_laki' ? 'Laki-laki' : 'Perempuan' }}</span>
                    </div>
                    <div class="flex justify-between items-center py-2 border-b border-gray-200">
                        <span class="text-gray-600">Status pernikahan</span>
                        <span class="font-medium">{{ session('status_pernikahan') === 'menikah' ? 'Sudah menikah' : 'Belum menikah' }}</span>
                    </div>

                    @if(session('status_pernikahan') === 'menikah')
                        <div class="flex justify-between items-center py-2 border-b border-gray-200">
                            <span class="text-gray-600">Pasangan pewaris</span>
                            <span class="font-medium">
                                @if(session('gender') === 'laki_laki')
                                    Istri ({{ session('jumlah_istri', 0) }})
                                @else
                                    {{ session('suami') === 'ya' ? 'Suami' : '-' }}
                                @endif
                            </span>
                        </div>
                    @endif

                    @if(session('anak') === 'ya')
                        <div class="flex justify-between items-center py-2 border-b border-gray-200">
                            <span class="text-gray-600">Anak pewaris</span>
                            <span class="font-medium">Laki-laki {{ session('jumlah_anak_lk', 0) }}, Perempuan {{ session('jumlah_anak_pr', 0) }}</span>
                        </div>
                    @endif

                    @if(session('cucu') === 'ya')
                        <div class="flex justify-between items-center py-2 border-b border-gray-200">
                            <span class="text-gray-600">Cucu pewaris</span>
                            <span class="font-medium">Laki-laki {{ session('jumlah_cucu_lk', 0) }}, Perempuan {{ session('jumlah_cucu_pr', 0) }}</span>
                        </div>
                    @endif

                    <div class="flex justify-between items-center py-2 border-b border-gray-200">
                        <span class="text-gray-600">Orang tua pewaris</span>
                        <span class="font-medium">
                            @php
                                $orangTua = [];
                                if(session('ayah') === 'hidup') $orangTua[] = 'Ayah';
                                if(session('ibu') === 'hidup') $orangTua[] = 'Ibu';
                                echo !empty($orangTua) ? implode(', ', $orangTua) : '-';
                            @endphp
                        </span>
                    </div>

                    <div class="flex justify-between items-center py-2 border-b border-gray-200">
                        <span class="text-gray-600">Saudara pewaris</span>
                        <span class="font-medium">Laki-laki {{ session('jumlah_saudara', 0) }}, Perempuan {{ session('jumlah_saudari', 0) }}</span>
                    </div>

                    <div class="flex justify-between items-center py-2 border-b border-gray-200">
                        <span class="text-gray-600">Kakek-nenek pewaris</span>
                        <span class="font-medium">
                            @php
                                $kakekNenek = [];
                                if(session('kakek') === 'hidup') $kakekNenek[] = 'Kakek';
                                if(session('nenek') === 'hidup') $kakekNenek[] = 'Nenek';
                                if(session('nenek_dari_ibu') === 'ya') $kakekNenek[] = 'Nenek dari Ibu';
                                echo !empty($kakekNenek) ? implode(', ', $kakekNenek) : '-';
                            @endphp
                        </span>
                    </div>
                </div>
            </div>

            <!-- Detail Harta Pewaris -->
            <div class="mb-6">
                <h3 class="text-xl font-semibold text-gray-800 mb-4">Detail Harta Pewaris</h3>
                <div class="space-y-4">
                    <div class="flex justify-between items-center py-2 border-b border-gray-200">
                        <span class="text-gray-600">Total Harta</span>
                        <span class="font-medium">Rp. {{ number_format(session('tirkah', 0), 0, ',', '.') }}</span>
                    </div>
                    <div class="flex justify-between items-center py-2 border-b border-gray-200">
                        <span class="text-gray-600">Hutang</span>
                        <span class="font-medium">Rp. {{ number_format(session('hutang', 0), 0, ',', '.') }}</span>
                    </div>
                    <div class="flex justify-between items-center py-2 border-b border-gray-200">
                        <span class="text-gray-600">Wasiat</span>
                        <span class="font-medium">Rp. {{ number_format(session('wasiat', 0), 0, ',', '.') }}</span>
                    </div>
                    <div class="flex justify-between items-center py-2 border-b border-gray-200">
                        <span class="text-gray-600">Biaya Pengurusan Jenazah</span>
                        <span class="font-medium">Rp. {{ number_format(session('tazhij', 0), 0, ',', '.') }}</span>
                    </div>
                    <div class="flex justify-between items-center py-2 border-b border-gray-200">
                        <span class="text-gray-600">Harta Yang Siap Dibagikan</span>
                        <span class="font-medium">Rp. {{ number_format(session('irst', 0), 0, ',', '.') }}</span>
                    </div>
                </div>
            </div>

            <!-- Action Buttons -->
            <div class="px-6 mt-6 mb-6">
                <!-- Ubah Data Link -->
                <div class="text-right mb-6">
                    <a href="{{ route('informasi_umum') }}" class="text-[#66E13A] hover:text-[#50B42E] font-medium transition-colors duration-200">
                        ← Ubah Data
                    </a>
                </div>

                <!-- Hitung Waris Button -->
                <a href="{{ route('hasil') }}"
                   class="w-full px-6 py-3 bg-black text-[#66E13A] text-sm sm:text-base font-bold rounded-2xl hover:bg-gray-900 flex items-center justify-center gap-2 transition-all duration-200 border-2 border-black shadow-[5px_5px_#66E13A] hover:shadow-none hover:translate-x-[5px] hover:translate-y-[5px] group">
                    Hitung Waris
                    <svg class="w-5 h-5 transition-all duration-300 group-hover:translate-x-2 group-hover:scale-110" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7l5 5m0 0l-5 5m5-5H6" />
                    </svg>
                </a>
            </div>
        </div>
    </div>
</div>
@endsection
