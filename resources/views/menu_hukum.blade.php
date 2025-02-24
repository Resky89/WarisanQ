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

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css"
        integrity="sha512-Kc323vGBEqzTmouAECnVceyQqyqdsSiqLQISBL29aUW4U/M7pSPA/gEUZQqv1cwx4OnYxTxve5UMg5GT6L4JJg=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />

    <script src="https://cdn.tailwindcss.com"></script>

    <style>
        .navbar {

            height: 4rem;
        }

        .nav {
            position: relative;
            width: 100%;
            height: 50px;
            border-radius: 15px;
            background-color: black;
            display: flex;
            justify-content: center;
            align-items: center;
            margin-bottom: 20px;
        }

        .nav__list {
            list-style: none;
            padding: 0;
            margin: 0;
            display: flex;
            justify-content: space-between;
            width: 100%;
            height: 100%;
            z-index: 1;
        }

        .nav__item {
            position: relative;
            flex: 1;
            display: flex;
            justify-content: center;
            align-items: center;
            z-index: 1;
        }

        .nav__link {
            display: flex;
            flex: 1;
            align-items: center;
            justify-content: center;
            height: 70%;
            color: #66E13A;
            text-decoration: none;
            transition: color 0.2s ease-in-out;
        }

        .nav__link_active {
            color: black;
            border-radius: 10px;
        }

        .nav__slider {
            position: absolute;
            top: 0;
            right: 0;
            bottom: 0;
            left: 0;
            padding: 3px;
            pointer-events: none;
            z-index: 0;
        }

        .nav__slider-rect {
            width: 33.3%;
            height: 100%;
            background-color: #66E13A;
            border-radius: 12px;
            transition: transform 0.5s;
        }

        .container-fluid {
            min-height: 100vh;
        }

        .content-section {
            display: none;
        }

        .content-section.active {
            display: block;
        }

        .hidden {
            display: none !important;
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
            height: auto;
            overflow: hidden;
        }

        .img-container img {
            width: 100%;
            height: auto;
            object-fit: contain;
            max-width: 100%;
        }

        /* Tambahkan styles untuk modal */
        .modal {
            display: none;
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background-color: rgba(0, 0, 0, 0.75);
            z-index: 9999;
            opacity: 0;
            transition: all 0.3s ease;
        }

        .modal.show {
            display: flex;
            opacity: 1;
        }

        .modal-content {
            position: relative;
            margin: auto;
            width: auto;
            height: auto;
            transform: scale(0.7);
            transition: all 0.3s ease;
            padding-top: 4rem;
            background: transparent;
        }

        .modal.show .modal-content {
            transform: scale(1);
        }

        .modal-image-container {
            position: relative;
            width: 100%;
            height: 100%;
        }

        .modal-image {
            max-height: 85vh;
            width: auto;
            transform-origin: center;
            transition: transform 0.3s ease;
            cursor: zoom-in;
            display: block;
            margin: 0 auto;
        }

        .modal-controls {
            position: fixed;
            top: 1rem;
            right: 1rem;
            display: flex;
            gap: 0.5rem;
            z-index: 10000;
        }

        .modal-button {
            background-color: #66E13A;
            border: 2px solid #212529;
            color: #212529;
            width: 40px;
            height: 40px;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            cursor: pointer;
            transition: all 0.2s ease;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.2);
        }

        .zoom-level {
            position: fixed;
            bottom: 1rem;
            left: 50%;
            transform: translateX(-50%);
            background-color: #66E13A;
            color: #212529;
            padding: 0.5rem 1rem;
            border-radius: 20px;
            font-size: 0.9rem;
            opacity: 0;
            transition: opacity 0.3s ease;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.2);
        }

        .zoom-level.show {
            opacity: 1;
        }
    </style>

</head>

<body class="min-h-screen flex flex-col">

    <nav class="bg-dark shadow sticky top-0 mb-5 h-16 z-50">
        <div class="container-xl mx-auto px-4 h-full flex justify-between items-center">
            <a class="back-btn" href="{{ route('home') }}">
                <i class="fa-solid fa-xl fa-arrow-left text-white"></i>
            </a>
            <h2 class="text-light text-center text-1xl md:text-2xl font-bold">
                Dasar Hukum Mawaris
            </h2>
            <a class="navbar-brand" href="#">
                <img src="{{ asset('images/logo.png') }}" alt="Logo" width="60">
            </a>
        </div>
    </nav>

    <div class="flex-1">
        <div class="container mx-auto px-4">
            <div class="fixed top-16 left-0 right-0 z-40 bg-white py-3">
                <div class="container mx-auto px-4">
                    <nav class="relative w-full h-[50px] rounded-2xl bg-black flex justify-center items-center js-nav">
                        <ul class="list-none p-0 m-0 flex justify-between w-full h-full z-10 font-bold text-2xl">
                            <li class="relative flex-1 flex justify-center items-center z-10">
                                <a href="#" class="flex-1 flex items-center justify-center h-[70%] text-[#66E13A] hover:text-[#66E13A] transition-colors duration-200 nav__link nav__link_active text-black" data-transform="0" data-target="khi-section">KHI</a>
                            </li>
                            <li class="relative flex-1 flex justify-center items-center z-10">
                                <a href="#" class="flex-1 flex items-center justify-center h-[70%] text-[#66E13A] hover:text-[#66E13A] transition-colors duration-200 nav__link" data-transform="100" data-target="dalil-section">Dalil</a>
                            </li>
                            <li class="relative flex-1 flex justify-center items-center z-10">
                                <a href="#" class="flex-1 flex items-center justify-center h-[70%] text-[#66E13A] hover:text-[#66E13A] transition-colors duration-200 nav__link" data-transform="200" data-target="hadist-section">Hadits</a>
                            </li>
                        </ul>
                        <div class="absolute inset-0 p-[3px] pointer-events-none z-0">
                            <div class="w-1/3 h-full bg-[#66E13A] rounded-xl transition-transform duration-500 nav__slider-rect"></div>
                        </div>
                    </nav>
                </div>
            </div>

            <div class="content-sections mt-28">
                <div id="khi-section" class="content-section z-0" style="display: block;">
                    @include('khi')
                </div>
                <div id="dalil-section" class="content-section hidden z-0">
                    @include('dalil')
                </div>
                <div id="hadist-section" class="content-section hidden z-0">
                    @include('hadits')
                </div>
            </div>

            <footer class="w-full bg-white border-t mt-auto">
                @include('layouts.footer')
            </footer>
        </div>
    </div>

    <!-- Tambahkan Modal -->
    <div id="imageModal" class="modal" onclick="handleModalClick(event)">
        <div class="modal-controls">
            <button class="modal-button" onclick="zoomIn(event)" title="Zoom In">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6" />
                </svg>
            </button>
            <button class="modal-button" onclick="zoomOut(event)" title="Zoom Out">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M18 12H6" />
                </svg>
            </button>
            <button class="modal-button" onclick="closeModal(event)" title="Close">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                </svg>
            </button>
        </div>
        <div class="modal-content" onclick="event.stopPropagation()">
            <div class="modal-image-container">
                <img src="" alt="Preview Image" class="modal-image w-full h-auto rounded-lg shadow-lg" id="modalImage">
            </div>
        </div>
        <div class="zoom-level" id="zoomLevel">100%</div>
    </div>

    <script>
     document.addEventListener('DOMContentLoaded', function() {
    const accordionButtons = document.querySelectorAll('.accordion-button');
    const sections = document.querySelectorAll('.content-section');
    const navLinks = document.querySelectorAll('.nav__link');

    // Handle accordion toggle
    accordionButtons.forEach(button => {
        button.addEventListener('click', function() {
            const targetId = button.getAttribute('data-bs-target');
            const collapseElement = document.querySelector(targetId);
            const bsCollapse = bootstrap.Collapse.getOrCreateInstance(collapseElement);

            bsCollapse.toggle(); // Toggle hanya elemen yang diklik
        });
    });

    // Handle menu navigation
    navLinks.forEach(nav => {
        nav.addEventListener('click', function(evt) {
            evt.preventDefault();

            // Hide all sections and remove active class
            sections.forEach(section => section.classList.add('hidden'));
            navLinks.forEach(link => link.classList.remove('nav__link_active', 'text-black'));

            // Show the selected section
            const targetId = this.getAttribute('data-target');
            document.getElementById(targetId).classList.remove('hidden');

            // Move slider
            document.querySelector('.nav__slider-rect').style.transform = `translateX(${this.dataset.transform}%)`;

            // Set active link
            this.classList.add('nav__link_active', 'text-black');

            // **Collapse all accordions when switching menus**
            document.querySelectorAll('.accordion-collapse.show').forEach(collapse => {
                bootstrap.Collapse.getInstance(collapse).hide();
            });
        });
    });
});



        const nav = () => {
            const nav = document.querySelector(".js-nav");
            const navLinks = nav.querySelectorAll(".nav__link");
            const slideRect = nav.querySelector(".nav__slider-rect");
            const sections = document.querySelectorAll('.content-section');

            nav.addEventListener("click", (evt) => {
                if (!evt.target.classList.contains("nav__link")) {
                    return;
                }
                evt.preventDefault();

                // Remove active class from all nav links
                navLinks.forEach((item) => {
                    item.classList.remove("nav__link_active");
                    item.classList.remove("text-black");
                });

                // Add active class to the clicked link
                evt.target.classList.add("nav__link_active");
                evt.target.classList.add("text-black");

                // Handle section visibility
                const targetId = evt.target.getAttribute('data-target');
                sections.forEach(section => {
                    if (section.id === targetId) {
                        section.style.display = 'block';
                        section.classList.remove('hidden');
                    } else {
                        section.style.display = 'none';
                        section.classList.add('hidden');
                    }
                });

                // Move slider
                slideRect.style.transform = `translateX(${evt.target.dataset.transform}%)`;
            });
        };
        nav();

        // Tambahkan script untuk preview image
        let currentZoom = 1;
        let isDragging = false;
        let startX, startY, translateX = 0, translateY = 0;

        // Fungsi untuk membuka modal dengan gambar yang diklik
        function openModal(imageSrc) {
            const modal = document.getElementById('imageModal');
            const modalImage = document.getElementById('modalImage');
            modalImage.src = imageSrc;
            modal.classList.add('show');
            document.body.style.overflow = 'hidden';
            resetZoom();
        }

        function closeModal(event) {
            if (event) event.stopPropagation();
            const modal = document.getElementById('imageModal');
            modal.classList.remove('show');
            document.body.style.overflow = 'auto';
            resetZoom();
        }

        function resetZoom() {
            currentZoom = 1;
            translateX = 0;
            translateY = 0;
            updateImageTransform();
            updateZoomLevel();
        }

        function zoomIn(event) {
            event.stopPropagation();
            if (currentZoom < 3) {
                currentZoom += 0.25;
                updateImageTransform();
                updateZoomLevel();
            }
        }

        function zoomOut(event) {
            event.stopPropagation();
            if (currentZoom > 0.5) {
                currentZoom -= 0.25;
                updateImageTransform();
                updateZoomLevel();
            }
        }

        function updateImageTransform() {
            const image = document.getElementById('modalImage');
            image.style.transform = `translate(${translateX}px, ${translateY}px) scale(${currentZoom})`;
        }

        function updateZoomLevel() {
            const zoomLevel = document.getElementById('zoomLevel');
            zoomLevel.textContent = `${Math.round(currentZoom * 100)}%`;
            zoomLevel.classList.add('show');
            clearTimeout(zoomLevel.timeout);
            zoomLevel.timeout = setTimeout(() => {
                zoomLevel.classList.remove('show');
            }, 1500);
        }

        function handleModalClick(event) {
            if (event.target.classList.contains('modal')) {
                closeModal();
            }
        }

        // Tambahkan event listener untuk semua gambar yang dapat di-preview
        document.addEventListener('DOMContentLoaded', function() {
            const previewableImages = document.querySelectorAll('.img-container img');
            previewableImages.forEach(img => {
                img.style.cursor = 'pointer';
                img.addEventListener('click', function() {
                    openModal(this.src);
                });
            });
        });

        // Close modal when pressing Escape key
        document.addEventListener('keydown', function(event) {
            if (event.key === 'Escape') {
                closeModal();
            }
        });
    </script>

</body>

</html>
