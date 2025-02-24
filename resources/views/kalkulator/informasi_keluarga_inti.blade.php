@extends('kalkulator.menu_kalkulator')

@section('content')
    <div class="min-h-screen bg-gray-50 flex justify-center items-center py-12">
        <div class="w-full max-w-4xl mx-auto bg-white rounded-2xl shadow-lg overflow-hidden">
            <div class="bg-dark px-6 py-4 sm:px-8 sm:py-6">
                <h2 class="text-2xl sm:text-3xl font-bold text-white text-center">Informasi Keluarga Inti Pewaris</h2>
                <p class="text-sm sm:text-base text-gray-300 text-center mt-2">Silakan lengkapi informasi keluarga inti pewaris</p>
            </div>

            <form action="{{ route('informasi_keluarga_inti_post') }}" method="post" id="keluargaIntiForm" class="px-6 sm:px-10 w-full">
                @csrf

                @if (session('gender') === 'perempuan' && session('status_pernikahan') === 'menikah')
                    <div class="mb-6">
                        <label class="block text-lg font-medium text-gray-800 mb-2">Apakah suami pewaris masih hidup?</label>
                        <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                            <label class="flex items-center p-4 rounded-xl border-2 border-gray-200 hover:bg-[#66E13A]/10 cursor-pointer">
                                <input type="radio" name="suami" id="cucuYa" value="ya" class="peer hidden" {{ old('suami', session('suami')) === 'ya' ? 'checked' : '' }}>
                                <div class="w-5 h-5 md:w-6 md:h-6 rounded-full border-2 border-black peer-checked:bg-[#66E13A] peer-checked:border-[#66E13A] peer-checked:text-white flex items-center justify-center mr-3">
                                    <div class="opacity-0 peer-checked:opacity-100">✓</div>
                                </div>
                                <span class="text-sm sm:text-base text-gray-700">Ya</span>
                            </label>
                            <label class="flex items-center p-4 rounded-xl border-2 border-gray-200 hover:bg-[#66E13A]/10 cursor-pointer">
                                <input type="radio" name="suami" id="cucuTidak" value="tidak" class="peer hidden" {{ old('suami', session('suami')) === 'tidak' ? 'checked' : '' }}>
                                <div class="w-5 h-5 md:w-6 md:h-6 rounded-full border-2 border-black peer-checked:bg-[#66E13A] peer-checked:border-[#66E13A] peer-checked:text-white flex items-center justify-center mr-3">
                                    <div class="opacity-0 peer-checked:opacity-100">✓</div>
                                </div>
                                <span class="text-sm sm:text-base text-gray-700">Tidak</span>
                            </label>
                        </div>
                    </div>
                @endif

                @if (session('gender') === 'laki_laki' && session('status_pernikahan') === 'menikah')
                    <div class="mb-6">
                        <label class="block text-lg font-medium text-gray-800 mb-2">Jumlah istri pewaris yang masih hidup</label>
                        <p class="text-sm text-gray-600 mb-3">Hanya untuk pasangan suami istri yang sah</p>
                        <input type="number" name="jumlah_istri" id="jumlahIstri"
                            class="w-full px-4 py-2 border-2 border-gray-200 rounded-xl focus:outline-none focus:border-[#66E13A]"
                            value="{{ old('jumlah_istri', session('jumlah_istri', 0)) }}" min="0">
                    </div>
                @endif

                <!-- Continue with similar styling for other form elements -->
                <div class="mb-6">
                    <label class="block text-lg font-medium text-gray-800 mb-2">Apakah pewaris memiliki anak dari pasangan yang sah?</label>
                    <p class="text-sm text-gray-600 mb-3">Anak diluar pernikahan sah belum bisa diakui</p>
                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                        <label class="flex items-center p-4 rounded-xl border-2 border-gray-200 hover:bg-[#66E13A]/10 cursor-pointer">
                            <input type="radio" name="anak" value="ya" class="peer hidden" {{ old('anak', session('anak')) === 'ya' ? 'checked' : '' }} onchange="toggleAnak(true)">
                            <div class="w-5 h-5 md:w-6 md:h-6 rounded-full border-2 border-black peer-checked:bg-[#66E13A] peer-checked:border-[#66E13A] peer-checked:text-white flex items-center justify-center mr-3">
                                <div class="opacity-0 peer-checked:opacity-100">✓</div>
                            </div>
                            <span class="text-sm sm:text-base text-gray-700">Ya</span>
                        </label>
                        <label class="flex items-center p-4 rounded-xl border-2 border-gray-200 hover:bg-[#66E13A]/10 cursor-pointer">
                            <input type="radio" name="anak" value="tidak" class="peer hidden" {{ old('anak', session('anak')) === 'tidak' ? 'checked' : '' }} onchange="toggleAnak(false)">
                            <div class="w-5 h-5 md:w-6 md:h-6 rounded-full border-2 border-black peer-checked:bg-[#66E13A] peer-checked:border-[#66E13A] peer-checked:text-white flex items-center justify-center mr-3">
                                <div class="opacity-0 peer-checked:opacity-100">✓</div>
                            </div>
                            <span class="text-sm sm:text-base text-gray-700">Tidak</span>
                        </label>
                    </div>
                </div>

<<<<<<< HEAD
                <!-- Jumlah anak pewaris -->
                <div class="mb-3 {{ old('anak', session('anak')) !== 'ya' ? 'hidden' : '' }}" id="jumlahAnak">
                    <p class="fw-bold  my-0">Jumlah anak pewaris yang masih hidup saat pewaris baru saja meninggal</p>
                    <small class="text-muted d-block">Hanya hitung jumlah anak yang beragama Islam</small>
                    <div class="space-y-4">
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-1">Anak Laki-Laki</label>
                            <input type="number" class="form-control form-control-small"
                                value="{{ old('jumlah_anak_lk', session('jumlah_anak_lk', 0)) }}" min="0"
                                id="jumlahAnakLk" oninput="handleJumlahAnakLkChange()" name="jumlah_anak_lk">
=======
                <form action="{{ route('informasi_keluarga_inti_post') }}" method="post" id="keluargaIntiForm" class="px-6 sm:px-10 w-full">
                    @csrf

                    @if (session('gender') === 'perempuan' && session('status_pernikahan') === 'menikah')
                        <div class="mb-6">
                            <label class="block text-lg font-medium text-gray-800 mb-2">Apakah suami pewaris masih hidup?</label>
                            <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                                <label class="flex items-center p-4 rounded-xl border-2 border-gray-200 hover:bg-[#66E13A]/10 cursor-pointer">
                                    <input type="radio" name="suami"  value="ya" class="peer hidden" {{ old('suami', session('suami')) === 'ya' ? 'checked' : '' }}>
                                    <div class="w-5 h-5 md:w-6 md:h-6 rounded-full border-2 border-black peer-checked:bg-[#66E13A] peer-checked:border-[#66E13A] peer-checked:text-white flex items-center justify-center mr-3">
                                        <div class="opacity-0 peer-checked:opacity-100">✓</div>
                                    </div>
                                    <span class="text-sm sm:text-base text-gray-700">Ya</span>
                                </label>
                                <label class="flex items-center p-4 rounded-xl border-2 border-gray-200 hover:bg-[#66E13A]/10 cursor-pointer">
                                    <input type="radio" name="suami"  value="tidak" class="peer hidden" {{ old('suami', session('suami')) === 'tidak' ? 'checked' : '' }}>
                                    <div class="w-5 h-5 md:w-6 md:h-6 rounded-full border-2 border-black peer-checked:bg-[#66E13A] peer-checked:border-[#66E13A] peer-checked:text-white flex items-center justify-center mr-3">
                                        <div class="opacity-0 peer-checked:opacity-100">✓</div>
                                    </div>
                                    <span class="text-sm sm:text-base text-gray-700">Tidak</span>
                                </label>
                            </div>
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-1">Anak Perempuan</label>
                            <input type="number" class="form-control form-control-small"
                                value="{{ old('jumlah_anak_pr', session('jumlah_anak_pr', 0)) }}" min="0"
                                id="jumlahAnakPr" oninput="handleJumlahAnakPrChange()" name="jumlah_anak_pr">
                        </div>
                    </div>
                </div>

                <!-- Apakah pewaris memiliki cucu dari anak laki-lakinya? -->
                <div class="mb-6">
                    <label class="block text-lg font-medium text-gray-800 mb-2">Apakah pewaris memiliki cucu dari anak laki-lakinya?</label>
                    <p class="text-sm text-gray-600 mb-3">Hanya untuk cucu dari anak laki-laki saja</p>
                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                        <label class="flex items-center p-4 rounded-xl border-2 border-gray-200 hover:bg-[#66E13A]/10 cursor-pointer">
                            <input type="radio" name="cucu" id="cucuYa" value="ya" class="peer hidden"
                                onchange="toggleCucu(true)" {{ old('cucu', session('cucu')) === 'ya' ? 'checked' : '' }}>
                            <div class="w-5 h-5 md:w-6 md:h-6 rounded-full border-2 border-black peer-checked:bg-[#66E13A] peer-checked:border-[#66E13A] peer-checked:text-white flex items-center justify-center mr-3">
                                <div class="opacity-0 peer-checked:opacity-100">✓</div>
                            </div>
                            <span class="text-sm sm:text-base text-gray-700">Ya</span>
                        </label>
                        <label class="flex items-center p-4 rounded-xl border-2 border-gray-200 hover:bg-[#66E13A]/10 cursor-pointer">
                            <input type="radio" name="cucu" id="cucuTidak" value="tidak" class="peer hidden"
                                onchange="toggleCucu(false)" {{ old('cucu', session('cucu')) === 'tidak' ? 'checked' : '' }}>
                            <div class="w-5 h-5 md:w-6 md:h-6 rounded-full border-2 border-black peer-checked:bg-[#66E13A] peer-checked:border-[#66E13A] peer-checked:text-white flex items-center justify-center mr-3">
                                <div class="opacity-0 peer-checked:opacity-100">✓</div>
                            </div>
                            <span class="text-sm sm:text-base text-gray-700">Tidak</span>
                        </label>
                    </div>
                </div>

                <!-- Jumlah cucu pewaris -->
                <div class="mb-6 {{ old('cucu', session('cucu')) !== 'ya' ? 'hidden' : '' }}" id="jumlahCucu">
                    <label class="block text-lg font-medium text-gray-800 mb-2">Jumlah cucu dari anak laki-laki pewaris yang masih hidup</label>
                    <p class="text-sm text-gray-600 mb-3">Tidak termasuk cucu dari anak perempuannya</p>
                    <div class="space-y-4">
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-1">Cucu Laki-Laki</label>
                            <input type="number" name="jumlah_cucu_lk" id="jumlahCucuLk"
                                class="w-full px-4 py-2 border-2 border-gray-200 rounded-xl focus:outline-none focus:border-[#66E13A]"
                                value="{{ old('jumlah_cucu_lk', session('jumlah_cucu_lk', 0)) }}" min="0">
                        </div>
                        <div id="cucuPr">
                            <label class="block text-sm font-medium text-gray-700 mb-1">Cucu Perempuan</label>
                            <input type="number" name="jumlah_cucu_pr" id="jumlahCucuPr"
                                class="w-full px-4 py-2 border-2 border-gray-200 rounded-xl focus:outline-none focus:border-[#66E13A]"
                                value="{{ old('jumlah_cucu_pr', session('jumlah_cucu_pr', 0)) }}" min="0">
                    @endif

                    <!-- Continue with similar styling for other form elements -->
                    <div class="mb-6">
                        <label class="block text-lg font-medium text-gray-800 mb-2">Apakah pewaris memiliki anak dari pasangan yang sah?</label>
                        <p class="text-sm text-gray-600 mb-3">Anak diluar pernikahan sah belum bisa diakui</p>
                        <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                            <label class="flex items-center p-4 rounded-xl border-2 border-gray-200 hover:bg-[#66E13A]/10 cursor-pointer">
                                <input type="radio" id="anakYa" name="anak" value="ya" class="peer hidden" {{ old('anak', session('anak')) === 'ya' ? 'checked' : '' }} onchange="toggleAnak(true)">
                                <div class="w-5 h-5 md:w-6 md:h-6 rounded-full border-2 border-black peer-checked:bg-[#66E13A] peer-checked:border-[#66E13A] peer-checked:text-white flex items-center justify-center mr-3">
                                    <div class="opacity-0 peer-checked:opacity-100">✓</div>
                                </div>
                                <span class="text-sm sm:text-base text-gray-700">Ya</span>
                            </label>
                            <label class="flex items-center p-4 rounded-xl border-2 border-gray-200 hover:bg-[#66E13A]/10 cursor-pointer">
                                <input type="radio" name="anak" id="anakTidak" value="tidak" class="peer hidden" {{ old('anak', session('anak')) === 'tidak' ? 'checked' : '' }} onchange="toggleAnak(false)">
                                <div class="w-5 h-5 md:w-6 md:h-6 rounded-full border-2 border-black peer-checked:bg-[#66E13A] peer-checked:border-[#66E13A] peer-checked:text-white flex items-center justify-center mr-3">
                                    <div class="opacity-0 peer-checked:opacity-100">✓</div>
                                </div>
                                <span class="text-sm sm:text-base text-gray-700">Tidak</span>
                            </label>
                        </div>
                    </div>
                </div>

                <!-- Hijab messages -->
                <div class="mb-6 hidden" id="hijab_cucu_pr">
                    <p class="text-sm text-gray-600">
                        Cucu perempuan dari anak laki-laki pewaris terhalangi oleh adanya 2 anak perempuan atau lebih
                    </p>
                </div>

                <div class="mb-6 hidden" id="hijab_cucu">
                    <p class="text-sm text-gray-600">
                        Cucu dari anak laki-laki pewaris terhalangi oleh adanya anak laki-laki pewaris
                    </p>
                </div>

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
        // Function to toggle visibility of anak section
        function toggleAnak(show) {
            const jumlahAnakDiv = document.getElementById('jumlahAnak');
            jumlahAnakDiv.classList.toggle('hidden', !show);
            if (show) {
                document.getElementById('jumlahAnakLk').value = '0';
                document.getElementById('jumlahAnakPr').value = '0';
            } else {
                document.getElementById('jumlahAnakLk').value = '0';
                document.getElementById('jumlahAnakPr').value = '0';
            }
            updateCucuVisibility();
        }

        // Function to handle changes in jumlahAnakLk input
        function handleJumlahAnakLkChange() {
            updateCucuVisibility();
        }

        // Function to handle changes in jumlahAnakPr input
        function handleJumlahAnakPrChange() {
            updateCucuVisibility();
        }

        // Function to toggle visibility of cucu section
        function toggleCucu(show) {
            const jumlahCucuDiv = document.getElementById('jumlahCucu');
            jumlahCucuDiv.classList.toggle('hidden', !show);
            updateCucuVisibility();
        }

        // Function to update cucu visibility based on current state
        function updateCucuVisibility() {
            const anakYa = document.getElementById('anakYa').checked;
            const cucuYa = document.getElementById('cucuYa').checked;
            const jumlahAnakLakiLaki = parseInt(document.getElementById('jumlahAnakLk').value) || 0;
            const jumlahAnakPr = parseInt(document.getElementById('jumlahAnakPr').value) || 0;
            const hijabCucuDiv = document.getElementById('hijab_cucu');
            const hijabCucuPrDiv = document.getElementById('hijab_cucu_pr');
            const jumlahCucuDiv = document.getElementById('jumlahCucu');
            const cucuPrDiv = document.getElementById('cucuPr');
            const jumlahCucuLk = document.getElementById('jumlahCucuLk');
            const jumlahCucuPr = document.getElementById('jumlahCucuPr');

            if (cucuYa) {
                if (anakYa && jumlahAnakLakiLaki > 0) {
                    hijabCucuDiv.classList.remove('hidden');
                    jumlahCucuDiv.classList.add('hidden');
                } else {
                    hijabCucuDiv.classList.add('hidden');
                    jumlahCucuDiv.classList.remove('hidden');
                }

                if (anakYa && jumlahAnakPr > 1) {
                    hijabCucuPrDiv.classList.remove('hidden');
                    cucuPrDiv.classList.add('hidden');
                } else {
                    hijabCucuPrDiv.classList.add('hidden');
                    cucuPrDiv.classList.remove('hidden');
                }
            } else {
                hijabCucuDiv.classList.add('hidden');
                hijabCucuPrDiv.classList.add('hidden');
                jumlahCucuDiv.classList.add('hidden');
                cucuPrDiv.classList.add('hidden');
            }
        }

        // Function to allow only integer input
        function onlyAllowNumbers(event) {
            const input = event.target;
            const value = input.value;
            // Remove any non-digit characters
            input.value = value.replace(/[^0-9]/g, '');

            // If value is empty, set it to 0
            if (input.value === '') {
                input.value = 0;
            }
        }

        // Apply the function to all number inputs
        document.querySelectorAll('input[type="number"]').forEach(function(inputField) {
            inputField.addEventListener('input', onlyAllowNumbers);
        });

        // Fungsi ini akan mengaktifkan tombol "Next" jika salah satu radio button dipilih
        function enableNextButton() {
            const anakSelected = document.querySelector('input[name="anak"]:checked');
            const cucuSelected = document.querySelector('input[name="cucu"]:checked');
            const nextButton = document.getElementById('next-button');
            if (anakSelected && cucuSelected) {
                nextButton.disabled = false;
            } else {
                nextButton.disabled = true;
            }
        }

        // Fungsi untuk memvalidasi form sebelum submit
        function validateForm(event) {
            const anakSelected = document.querySelector('input[name="anak"]:checked').value;
            const cucuSelected = document.querySelector('input[name="cucu"]:checked').value;

            if (anakSelected === 'tidak') {
                document.getElementById('jumlahAnakLk').value = '0';
                document.getElementById('jumlahAnakPr').value = '0';
            }

            if (cucuSelected === 'tidak') {
                document.getElementById('jumlahCucuLk').value = '0';
                document.getElementById('jumlahCucuPr').value = '0';
            }

            // Jika ada validasi tambahan, tambahkan di sini
        }

        // Event listener saat halaman dimuat
        window.onload = function() {
            const anakRadios = document.querySelectorAll('input[name="anak"]');
            const cucuRadios = document.querySelectorAll('input[name="cucu"]');
            const form = document.getElementById('keluargaIntiForm');
            const jumlahAnakLk = document.getElementById('jumlahAnakLk');
            const jumlahAnakPr = document.getElementById('jumlahAnakPr');

            anakRadios.forEach(function(radio) {
                radio.addEventListener('change', enableNextButton);
            });

            cucuRadios.forEach(function(radio) {
                radio.addEventListener('change', enableNextButton);
            });

            jumlahAnakLk.addEventListener('input', handleJumlahAnakLkChange);
            jumlahAnakPr.addEventListener('input', handleJumlahAnakPrChange);

            form.addEventListener('submit', validateForm);

            updateCucuVisibility();
            // Panggil enableNextButton() saat halaman dimuat
            enableNextButton();
        }
    </script>
@endsection

