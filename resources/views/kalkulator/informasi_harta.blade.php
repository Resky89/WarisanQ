@extends('kalkulator.menu_kalkulator')

@section('content')
    <!-- Form Section -->
    <div class="min-h-screen bg-gray-50 flex justify-center items-center py-12">
        <div class="w-full max-w-4xl mx-auto bg-white rounded-2xl shadow-lg overflow-hidden">
            <div class="bg-dark px-6 py-4 sm:px-8 sm:py-6">
                <h2 class="text-2xl sm:text-3xl font-bold text-white text-center">Informasi Harta Pewaris</h2>
                <p class="text-sm sm:text-base text-gray-300 text-center mt-2">Silakan lengkapi informasi harta pewaris</p>
            </div>
            <form action="{{ route('informasi_harta_post') }}" method="post" onsubmit="return cleanInputsBeforeSubmit()" class="px-6 sm:px-10 py-6 w-full">
                @csrf

                <!-- Tirkah -->
                <div class="mb-6">
                    <label for="tirkah" class="block text-lg font-medium text-gray-800 mb-2">Tirkah (Harta Pewaris)</label>
                    <input type="text"
                        class="w-full px-4 py-3 rounded-xl border-2 border-gray-200 focus:ring-2 focus:ring-[#66E13A] focus:border-[#66E13A] transition-colors"
                        id="tirkah"
                        placeholder="Masukan Harta Pewaris"
                        name="tirkah"
                        value="{{ old('tirkah', session('tirkah')) }}">
                </div>

                <!-- Hutang -->
                <div class="mb-6">
                    <label for="hutang" class="block text-lg font-medium text-gray-800 mb-2">Hutang</label>
                    <input type="text"
                        class="w-full px-4 py-3 rounded-xl border-2 border-gray-200 focus:ring-2 focus:ring-[#66E13A] focus:border-[#66E13A] transition-colors"
                        id="hutang"
                        placeholder="Masukan Hutang Pewaris Jika ada.."
                        name="hutang"
                        value="{{ old('hutang', session('hutang')) }}">
                </div>

                <!-- Wasiat -->
                <div class="mb-6">
                    <label for="wasiat" class="block text-lg font-medium text-gray-800 mb-2">
                        Wasiat (maksimal 1/3 Harta Waris)
                        <span class="block text-sm font-normal text-gray-500 mt-1">
                            Maks: Rp. <strong id="maks">0,00</strong>
                        </span>
                    </label>
                    <input type="text"
                        class="w-full px-4 py-3 rounded-xl border-2 border-gray-200 focus:ring-2 focus:ring-[#66E13A] focus:border-[#66E13A] transition-colors"
                        id="wasiat"
                        placeholder="Masukan Wasiat Pewaris Jika Ada.."
                        name="wasiat"
                        value="{{ old('wasiat', session('wasiat')) }}">
                </div>

                <!-- Tazhij -->
                <div class="mb-6">
                    <label for="tazhij" class="block text-lg font-medium text-gray-800 mb-2">Pengurusan Jenazah (Tazhij)</label>
                    <input type="text"
                        class="w-full px-4 py-3 rounded-xl border-2 border-gray-200 focus:ring-2 focus:ring-[#66E13A] focus:border-[#66E13A] transition-colors"
                        id="tazhij"
                        placeholder="Masukan Biaya Pengurusan Jenazah Pewaris"
                        name="tazhij"
                        value="{{ old('tazhij', session('tazhij')) }}">
                </div>

                <!-- Al-Irst -->
                <div class="mb-6">
                    <label for="irst" class="block text-lg font-medium text-gray-800 mb-2">Harta Siap Dibagi (Al-Irst)</label>
                    <input type="text"
                        class="w-full px-4 py-3 rounded-xl border-2 border-gray-200 bg-gray-50 cursor-not-allowed"
                        id="irst"
                        value="{{ old('irst', session('irst', '0')) }}"
                        disabled
                        name="irst">
                </div>

                <!-- Submit Button -->
                <div class="flex justify-end mt-6">
                    <button type="submit" id="next-button"
                        class="w-full sm:w-auto px-6 py-3 bg-black text-[#66E13A] text-sm sm:text-base font-bold rounded-2xl hover:bg-gray-900 flex items-center justify-center gap-2 transition-all duration-200 border-2 border-black shadow-[5px_5px_#66E13A] hover:shadow-none hover:translate-x-[5px] hover:translate-y-[5px] group disabled:opacity-50 disabled:cursor-not-allowed">
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
        // Fungsi untuk memformat angka dengan pemisah ribuan
        function formatNumberWithCommas(number) {
            return number.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ".");
        }

        // Fungsi untuk membersihkan input dari non-digit characters
        function cleanNumberInput(input) {
            return input.replace(/\D/g, "");
        }

        // Fungsi untuk menghitung nilai Al-Irst (Tirkah - Hutang - Wasiat - Tazhij)
        function calculateIrst() {
            const tirkah = parseInt(cleanNumberInput(document.getElementById('tirkah').value)) || 0;
            const hutang = parseInt(cleanNumberInput(document.getElementById('hutang').value)) || 0;
            const wasiat = parseInt(cleanNumberInput(document.getElementById('wasiat').value)) || 0;
            const tazhij = parseInt(cleanNumberInput(document.getElementById('tazhij').value)) || 0;

            const irstValue = tirkah - hutang - wasiat - tazhij;
            document.getElementById('irst').value = formatNumberWithCommas(irstValue >= 0 ? irstValue : 0);

            return irstValue;
        }

        function calculateWasiat() {
            const tirkah = parseInt(cleanNumberInput(document.getElementById('tirkah').value)) || 0;
            const maksWasiat = tirkah * (1 / 3);

            // Round to 2 decimal places
            const roundedMaksWasiat = Math.round(maksWasiat * 100) / 100;

            // Format with thousand separators and two decimal places
            const formattedMaksWasiat = roundedMaksWasiat.toLocaleString('id-ID', {
                minimumFractionDigits: 2,
                maximumFractionDigits: 2
            });

            document.getElementById('maks').innerText = formattedMaksWasiat;

            return roundedMaksWasiat;
        }

        // Fungsi untuk mengaktifkan tombol berdasarkan kondisi irst dan wasiat
        function toggleNextButton() {
            const irstValue = calculateIrst();
            const wasiat = parseInt(cleanNumberInput(document.getElementById('wasiat').value)) || 0;
            const maksWasiat = calculateWasiat();

            const nextButton = document.getElementById('next-button');
            if (irstValue >= 0 && wasiat < maksWasiat) {
                nextButton.disabled = false;
            } else {
                nextButton.disabled = true;
            }
        }

        // Fungsi untuk menambahkan event listener pada setiap input
        function addInputListener(inputElement) {
            inputElement.addEventListener('input', function(event) {
                // Ambil angka dari input dan bersihkan dari karakter selain angka
                let cleanedValue = cleanNumberInput(event.target.value);

                // Format angka dengan pemisah ribuan
                if (cleanedValue !== '') {
                    event.target.value = formatNumberWithCommas(cleanedValue);
                } else {
                    event.target.value = ''; // Kosongkan input jika tidak ada angka
                }

                // Hitung ulang nilai Al-Irst dan periksa tombol
                toggleNextButton();
            });

            // Cegah input selain angka
            inputElement.addEventListener('keydown', function(event) {
                const allowedKeys = [46, 8, 9, 27, 13, 65, 67, 86, 88, 35, 36, 37, 38, 39];
                if (allowedKeys.includes(event.keyCode) ||
                    (event.ctrlKey && ['a', 'c', 'v', 'x'].includes(event.key.toLowerCase()))) {
                    return;
                }
                if ((event.shiftKey || (event.keyCode < 48 || event.keyCode > 57)) &&
                    (event.keyCode < 96 || event.keyCode > 105)) {
                    event.preventDefault();
                }
            });
        }

        // Event listener untuk setiap input
        document.addEventListener('DOMContentLoaded', function() {
            const tirkahInput = document.getElementById('tirkah');
            const hutangInput = document.getElementById('hutang');
            const wasiatInput = document.getElementById('wasiat');
            const tazhijInput = document.getElementById('tazhij');

            // Tambahkan event listener pada setiap input
            addInputListener(tirkahInput);
            addInputListener(hutangInput);
            addInputListener(wasiatInput);
            addInputListener(tazhijInput);
        });

        function cleanInputsBeforeSubmit() {
            const inputs = ['tirkah', 'hutang', 'wasiat', 'tazhij'];
            inputs.forEach(inputId => {
                const input = document.getElementById(inputId);
                input.value = cleanNumberInput(input.value);
            });
            return true;
        }

        // Tambahkan ini di akhir script
        document.addEventListener('DOMContentLoaded', function() {
            // Format nilai yang ada saat halaman dimuat
            const inputs = ['tirkah', 'hutang', 'wasiat', 'tazhij'];
            inputs.forEach(inputId => {
                const input = document.getElementById(inputId);
                if (input.value) {
                    input.value = formatNumberWithCommas(input.value);
                }
            });

            // Hitung ulang nilai Al-Irst dan periksa tombol
            toggleNextButton();
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
