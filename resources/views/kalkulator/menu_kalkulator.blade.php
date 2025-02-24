<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>WarisanQ</title>
    <link rel="icon" href="https://warisanq.vercel.app/images/logo.png" type="image/png">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous">
    </script>
    <script src="https://cdn.tailwindcss.com"></script>

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css"
        integrity="sha512-Kc323vGBEqzTmouAECnVceyQqyqdsSiqLQISBL29aUW4U/M7pSPA/gEUZQqv1cwx4OnYxTxve5UMg5GT6L4JJg=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />

    <style>
        /* .container-fluid {
            min-height: 100vh;
        } */

        .progress-step {
            width: 40px;
            height: 40px;
            background-color: white;
            border: 3px solid black;
            border-radius: 50%;
            display: flex;
            justify-content: center;
            align-items: center;
            font-weight: bold;
            position: relative;
            z-index: 1;
            left: 30%;
        }

        .progress-bar {
            position: relative;
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin: 1rem 0;
        }

        .progress-line {
            position: absolute;
            top: 25%;
            left: 0;
            right: 0;
            height: 3px;
            background-color: black;
            z-index: 0;
            width: 93%;
            margin-left: 50px;
            /* left: 5%; */
        }

        .step-label {
            margin-top: 10px;
            font-size: 14px;
            color: black;


        }

        .active .progress-step {
            background-color: #66E13A;
            color: white;


        }

        @media (max-width: 768px) {
            .progress-step {
                width: 30px;
                height: 30px;
            }

            .step-label {
                font-size: 12px;
                width: 6rem;
            }

            .progress-line {
                /* margin-left: 20px; */
                width: 80%;
                top: 20%;

            }

            .form-wrapper form {
                width: 100%;

            }

        }

        form {
            width: 70%;
            background-color: #fff;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.2);
        }

        .form-wrapper {
            padding: 2rem 0;
        }

        ..section-title {
            font-weight: bold;
            margin-bottom: 20px;
        }

        .hidden {
            display: none;
        }

        .form-control-small {
            width: 80px;
            margin-left: 10px;
            /* Mengecilkan panjang textbox */
        }

        .d-flex-inline {
            display: flex;
            align-items: center;
            margin-bottom: 10px;
        }

        .label-inline {
            min-width: 150px;
            /* Sama untuk semua label */
            margin-right: 10px;
            /* Mengatur jarak label dengan textbox */
        }

        .form-button-container {
            margin-top: 20px;
            display: flex;
            justify-content: center;
        }

        .section-title {
            font-weight: bold;
            margin-top: 20px;
        }

        .detail-item {
            display: flex;
            justify-content: space-between;
            padding: 10px 0;
            border-bottom: 1px solid #ddd;
        }
    </style>

</head>

<body class="min-h-screen flex flex-col">
    <nav class="navbar bg-dark shadow sticky-top">
        <div class="container-xl d-flex justify-content-between align-items-center">
            <a class="back-btn"
                href="
            @php
                // Cek langkah saat ini dan arahkan ke langkah sebelumnya
                $current_step = session('current_step');
                $status_pernikahan = session('status_pernikahan');

                // Tentukan halaman sebelumnya berdasarkan urutan
                switch($current_step) {
                    case 'informasi_harta':
                        $back_url = route('informasi_umum');
                        break;
                    case 'keluarga_inti':
                        $back_url = route('informasi_harta');
                        break;
                    case 'keluarga':
                       $back_url = $status_pernikahan === 'belum_menikah' ? route('informasi_harta') : route('informasi_keluarga_inti');
                        break;
                    case 'ringkasan':
                        $back_url = route('informasi_keluarga');
                        break;
                    default:
                        $back_url = route('home'); // Fallback jika tidak ada di session
                        break;
                }
            @endphp
            {{ $back_url }}">
                <i class="fa-solid fa-xl fa-arrow-left" style="color: white;"></i>
            </a>
            <h2 class="text-light text-center text-2xl font-bold">
                Kalkulator Ahli Waris
            </h2>
            <a class="navbar-brand" href="{{ route('home') }}">
                <img src="{{ asset('images/logo.png') }}" alt="Logo" width="60">
            </a>
        </div>
    </nav>
    <div class="flex-1">
        <div class="container mx-auto px-4">
            <!-- Step Indicator - made sticky and full width -->
            @if(!Request::is('kalkulator-waris/hasil'))
                <div class="sticky top-[3.5rem] bg-white py-2 z-10 -mx-4 px-4">
                    <div class="relative flex justify-center my-2 md:my-4 max-w-4xl mx-auto">
                        <!-- Container untuk steps -->
                        <div class="relative flex items-center justify-between w-full max-w-2xl">
                            <!-- Progress Lines - Horizontal -->
                            <div class="absolute h-0.5 bg-black top-4 md:top-6 left-[8%] right-[8%]"></div>

                            <!-- Steps -->
                            <div class="flex justify-between w-full relative z-10">
                                <!-- Step 1 -->
                                <div class="flex flex-col items-center">
                                    <div class="w-8 h-8 md:w-12 md:h-12 rounded-full border-2 border-black flex items-center justify-center text-sm md:text-base font-bold mb-2 bg-[#66E13A] border-[#66E13A] text-white">
                                        1
                                    </div>
                                    <div class="text-center text-[10px] md:text-sm font-medium">
                                        Informasi<br>Umum<br>Pewaris
                                    </div>
                                </div>

                                <!-- Step 2 -->
                                <div class="flex flex-col items-center">
                                    <div class="w-8 h-8 md:w-12 md:h-12 rounded-full border-2 border-black flex items-center justify-center text-sm md:text-base font-bold mb-2 bg-white text-black">
                                        2
                                    </div>
                                    <div class="text-center text-[10px] md:text-sm font-medium">
                                        Informasi<br>Harta<br>Pewaris
                                    </div>
                                </div>

                                <!-- Step 3 -->
                                <div class="flex flex-col items-center">
                                    <div class="w-8 h-8 md:w-12 md:h-12 rounded-full border-2 border-black flex items-center justify-center text-sm md:text-base font-bold mb-2 bg-white text-black">
                                        3
                                    </div>
                                    <div class="text-center text-[10px] md:text-sm font-medium">
                                        Informasi<br>Keluarga<br>Pewaris
                                    </div>
                                </div>

                                <!-- Step 4 -->
                                <div class="flex flex-col items-center">
                                    <div class="w-8 h-8 md:w-12 md:h-12 rounded-full border-2 border-black flex items-center justify-center text-sm md:text-base font-bold mb-2 bg-white text-black">
                                        4
                                    </div>
                                    <div class="text-center text-[10px] md:text-sm font-medium">
                                        Ringkasan
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            @endif
            <!-- End of Step Indicator -->

            @yield('content')

            <!-- Footer -->
            <footer class="w-full bg-white border-t mt-auto">
                @include('layouts.footer')
            </footer>
        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            var currentStep = "{{ session('current_step') }}";
            var steps = document.querySelectorAll('.flex.flex-col.items-center');

            // Reset semua steps ke default style
            steps.forEach(step => {
                const circle = step.querySelector('div:first-child');
                circle.classList.remove('bg-[#66E13A]', 'border-[#66E13A]', 'text-white');
                circle.classList.add('bg-white', 'text-black');
            });

            // Set active steps berdasarkan current_step
            if (currentStep === 'informasi_umum') {
                setActiveStep(steps, 0);
            } else if (currentStep === 'informasi_harta') {
                setActiveStep(steps, 1);
            } else if (currentStep === 'keluarga_inti' || currentStep === 'keluarga') {
                setActiveStep(steps, 2);
            } else if (currentStep === 'ringkasan') {
                setActiveStep(steps, 3);
            }

            function setActiveStep(steps, activeIndex) {
                for (let i = 0; i <= activeIndex; i++) {
                    const circle = steps[i].querySelector('div:first-child');
                    circle.classList.remove('bg-white', 'text-black');
                    circle.classList.add('bg-[#66E13A]', 'border-[#66E13A]', 'text-white');
                }
            }
        });
    </script>

</body>

</html>
