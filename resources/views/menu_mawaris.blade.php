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


.container-fluid {
            min-height: 100vh;
        }
        .accordion {
            --bs-accordion-active-bg: #fff;
            --bs-accordion-active-color: #111;
            --bs-accordion-bg: #fff;
            --bs-accordion-btn-focus-box-shadow: none;
        }

        .accordion-button.collapsed {
            border: 1px solid #000000;

        }

        .accordion-item:has(.accordion-button) {
            border: 2px solid #000000;
            box-shadow: 5px 5px #000000;
        }

        .accordion-button:not(.collapsed) {
            box-shadow: none;
        }

        .img-container {
            max-width: 100%;
            /* Membuat container menyesuaikan lebar elemen parent */
            height: auto;
            /* Hapus batasan tinggi agar responsif */
            overflow: hidden;
            /* Tambahkan overflow agar tidak ada bagian gambar yang terpotong */
        }

        .img-container img {
            width: 100%;
            /* Membuat gambar menyesuaikan lebar container */
            height: auto;
            /* Memastikan gambar tetap proporsional */
            object-fit: contain;
            /* Memastikan gambar tidak terdistorsi dan tampil penuh */
            max-width: 100%;
            /* Pastikan gambar tidak melebihi ukuran container */
        }
    </style>

</head>

<body class="min-h-screen flex flex-col">
    <nav class="navbar bg-dark shadow sticky-top mb-5">
        <div class="container-xl d-flex justify-content-between align-items-center">
            <a class="back-btn" href="{{ route('home') }}">
                <i class="fa-solid fa-xl fa-arrow-left" style="color: white;"></i>
            </a>
            <h2 class="text-light text-center text-1xl md:text-2xl font-bold">
                Mawaris
            </h2>
            <a class="navbar-brand" href="#">
                <img src="{{ asset('images/logo.png') }}" alt="Logo" width="60">
            </a>
        </div>
    </nav>

    <div class="flex-1">
        <div class="container mx-auto px-4">
            @include('mawaris')

            <footer class="w-full bg-white border-t mt-auto">
                @include('layouts.footer')
            </footer>
        </div>
    </div>
</body>

</html>
