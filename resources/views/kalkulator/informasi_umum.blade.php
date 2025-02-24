@extends('kalkulator.menu_kalkulator')

@section('content')
    <!-- Form Section -->
    <div class="min-h-screen bg-gray-50 flex justify-center items-center py-12">
        <div class="w-full max-w-4xl mx-auto bg-white rounded-2xl shadow-lg overflow-hidden">
            <div class="bg-dark px-6 py-4 sm:px-8 sm:py-6">
                <h2 class="text-2xl sm:text-3xl font-bold text-white text-center">Informasi Umum Pewaris</h2>
                <p class="text-sm sm:text-base text-gray-300 text-center mt-2">Silakan lengkapi informasi dasar pewaris</p>
            </div>
            <form action="{{ route('informasi_umum_post') }}" method="post" class="px-6 sm:px-10 w-full">
                @csrf
                <!-- Gender Selection -->
                <div class="mb-6">
                    <label class="block text-lg font-medium text-gray-800 mb-2">Jenis Kelamin Pewaris</label>
                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                        <label class="flex items-center p-4 rounded-xl border-2 border-gray-200 hover:bg-[#66E13A]/10 cursor-pointer">
                            <input type="radio" name="gender" value="laki_laki" class="peer hidden" {{ old('gender', session('gender')) == 'laki_laki' ? 'checked' : '' }}>
                            <div class="w-5 h-5 md:w-6 md:h-6 rounded-full border-2 border-black peer-checked:bg-[#66E13A] peer-checked:border-[#66E13A] peer-checked:text-white flex items-center justify-center mr-3">
                                <div class="opacity-0 peer-checked:opacity-100">✓</div>
                            </div>
                            <span class="text-sm sm:text-base text-gray-700">Laki-laki</span>
                        </label>
                        <label class="flex items-center p-4 rounded-xl border-2 border-gray-200 hover:bg-[#66E13A]/10 cursor-pointer">
                            <input type="radio" name="gender" value="perempuan" class="peer hidden" {{ old('gender', session('gender')) == 'perempuan' ? 'checked' : '' }}>
                            <div class="w-5 h-5 md:w-6 md:h-6 rounded-full border-2 border-black peer-checked:bg-[#66E13A] peer-checked:border-[#66E13A] peer-checked:text-white flex items-center justify-center mr-3">
                                <div class="opacity-0 peer-checked:opacity-100">✓</div>
                            </div>
                            <span class="text-sm sm:text-base text-gray-700">Perempuan</span>
                        </label>
                    </div>
                </div>
                <!-- Marriage Status -->
                <div class="mb-6">
                    <label class="block text-lg font-medium text-gray-800 mb-2">Apakah pewaris pernah menikah secara sah?</label>
                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                        <label class="flex items-center p-4 rounded-xl border-2 border-gray-200 hover:bg-[#66E13A]/10 cursor-pointer">
                            <input type="radio" name="status_pernikahan" value="menikah" class="peer hidden" {{ old('status_pernikahan', session('status_pernikahan')) == 'menikah' ? 'checked' : '' }}>
                            <div class="w-5 h-5 md:w-6 md:h-6 rounded-full border-2 border-black peer-checked:bg-[#66E13A] peer-checked:border-[#66E13A] peer-checked:text-white flex items-center justify-center mr-3">
                                <div class="opacity-0 peer-checked:opacity-100">✓</div>
                            </div>
                            <span class="text-sm sm:text-base text-gray-700">Ya, sudah menikah</span>
                        </label>
                        <label class="flex items-center p-4 rounded-xl border-2 border-gray-200 hover:bg-[#66E13A]/10 cursor-pointer">
                            <input type="radio" name="status_pernikahan" value="belum_menikah" class="peer hidden" {{ old('status_pernikahan', session('status_pernikahan')) == 'belum_menikah' ? 'checked' : '' }}>
                            <div class="w-5 h-5 md:w-6 md:h-6 rounded-full border-2 border-black peer-checked:bg-[#66E13A] peer-checked:border-[#66E13A] peer-checked:text-white flex items-center justify-center mr-3">
                                <div class="opacity-0 peer-checked:opacity-100">✓</div>
                            </div>
                            <span class="text-sm sm:text-base text-gray-700">Tidak, belum menikah</span>
                        </label>
                    </div>
                </div>
                <!-- Submit Button -->
                <div class="flex justify-end mt-6">
                    <button type="submit" id="next-button"
                        class="w-full sm:w-auto px-6 py-3 bg-black text-[#66E13A] text-sm sm:text-base font-bold rounded-2xl hover:bg-gray-900 flex items-center justify-center gap-2 transition-all duration-200 border-2 border-black shadow-[5px_5px_#66E13A] hover:shadow-none hover:translate-x-[5px] hover:translate-y-[5px] group disabled:opacity-50 disabled:cursor-not-allowed"
                        disabled>
                        Lanjutkan
                        <svg class="w-5 h-5 transition-all duration-300 group-hover:translate-x-2 group-hover:scale-110" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7l5 5m0 0l-5 5m5-5H6" />
                        </svg>
                    </button>
                </div>
            </form>
        </div>
    </div>

    <script>
        // Fungsi untuk mengaktifkan tombol "Next"
        function enableNextButton() {
            const genderSelected = document.querySelector('input[name="gender"]:checked');
            const statusSelected = document.querySelector('input[name="status_pernikahan"]:checked');
            const nextButton = document.getElementById('next-button');
            nextButton.disabled = !(genderSelected && statusSelected);
        }

        // Menambahkan event listener ke semua radio button
        document.querySelectorAll('input[type="radio"]').forEach(radio => {
            radio.addEventListener('change', enableNextButton);
        });

        // Memanggil fungsi saat halaman dimuat
        window.onload = enableNextButton;
    </script>
@endsection
