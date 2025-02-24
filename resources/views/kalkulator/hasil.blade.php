@extends('kalkulator.menu_kalkulator')

@section('content')
    <!-- Form Section -->
    <div class="min-h-screen bg-gray-50 flex justify-center items-center py-12">
        <div class="w-full max-w-4xl mx-auto bg-white rounded-2xl shadow-lg overflow-hidden">
            <!-- Header -->
            <div class="bg-dark px-6 py-4 sm:px-8 sm:py-6">
                <h2 class="text-2xl sm:text-3xl font-bold text-white text-center">Hasil Kalkulasi Waris</h2>
                <p class="text-sm sm:text-base text-gray-300 text-center mt-2">Berikut adalah hasil perhitungan harta waris</p>
            </div>

            <!-- Content -->
            <div class="px-2 sm:px-10 py-6">
                <!-- Total Harta -->
                <div class="mb-6">
                    <div class="flex justify-between items-center py-3 px-4 bg-gray-50 rounded-xl">
                        <span class="text-sm sm:text-lg font-medium text-gray-800">Total Harta Pewaris</span>
                        <span class="text-sm sm:text-lg font-bold text-gray-900">Rp. {{ $total_harta }}</span>
                    </div>
                </div>

                <!-- Hasil Kalkulasi Table -->
                <div class="mb-6 overflow-x-auto">
                    <div class="min-w-full inline-block align-middle">
                        <div class="overflow-hidden">
                            <table class="min-w-full divide-y divide-gray-200">
                                <thead>
                                    <tr>
                                        <th class="px-2 sm:px-4 py-3 bg-gray-100 text-left text-xs sm:text-sm font-medium text-gray-700 rounded-tl-xl whitespace-nowrap">Ahli Waris</th>
                                        <th class="px-2 sm:px-4 py-3 bg-gray-100 text-center text-xs sm:text-sm font-medium text-gray-700 whitespace-nowrap">Bagian</th>
                                        <th class="px-2 sm:px-4 py-3 bg-gray-100 text-center text-xs sm:text-sm font-medium text-gray-700 whitespace-nowrap">Jumlah</th>
                                        <th class="px-2 sm:px-4 py-3 bg-gray-100 text-right text-xs sm:text-sm font-medium text-gray-700 whitespace-nowrap">Harta Bagian</th>
                                        <th class="px-2 sm:px-4 py-3 bg-gray-100 text-right text-xs sm:text-sm font-medium text-gray-700 rounded-tr-xl whitespace-nowrap">Harta Per Orang</th>
                                    </tr>
                                </thead>
                                <tbody class="divide-y divide-gray-200">
                                    @foreach ($hasil_kalkulasi as $hasil)
                                        <tr class="hover:bg-gray-50">
                                            <td class="px-2 sm:px-4 py-3 text-xs sm:text-sm text-gray-900 whitespace-nowrap">{{ $hasil['ahli_waris'] }}</td>
                                            <td class="px-2 sm:px-4 py-3 text-xs sm:text-sm text-gray-900 text-center whitespace-nowrap">{{ $hasil['bagian'] }}</td>
                                            <td class="px-2 sm:px-4 py-3 text-xs sm:text-sm text-gray-900 text-center whitespace-nowrap">{{ $hasil['jumlah'] }}</td>
                                            <td class="px-2 sm:px-4 py-3 text-xs sm:text-sm text-gray-900 text-right whitespace-nowrap">
                                                Rp. {{ number_format($hasil['harta_bagian'], 0, ',', '.') }}
                                            </td>
                                            <td class="px-2 sm:px-4 py-3 text-xs sm:text-sm text-gray-900 text-right whitespace-nowrap">
                                                Rp. {{ number_format($hasil['harta_per_orang'], 0, ',', '.') }}
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>

                <!-- Dasar Hukum Link -->
                <div class="text-right mb-6">
                    <a href="{{ route('hukum') }}" class="text-[#66E13A] hover:text-[#50B42E] font-medium transition-colors duration-200">
                        Lihat dasar hukum →
                    </a>
                </div>

                <!-- Action Button -->
                <div class="px-6 mt-6 mb-6">
                    <a href="{{ route('informasi_umum') }}"
                       class="w-full px-6 py-3 bg-black text-[#66E13A] text-sm sm:text-base font-bold rounded-2xl hover:bg-gray-900 flex items-center justify-center gap-2 transition-all duration-200 border-2 border-black shadow-[5px_5px_#66E13A] hover:shadow-none hover:translate-x-[5px] hover:translate-y-[5px] group">
                        Hitung Ulang
                        <svg class="w-5 h-5 transition-transform duration-300 group-hover:rotate-180" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15" />
                        </svg>
                    </a>
                </div>
            </div>
        </div>
    </div>
@endsection
