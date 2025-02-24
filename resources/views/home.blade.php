<style>
    .swiper-button-next,
    .swiper-button-prev,
    .swiper-pagination {
        display: none !important;
    }

    .text-content:hover .swiper-button-next,
    .text-content:hover .swiper-button-prev,
    .text-content:hover .swiper-pagination {
        opacity: 1;
    }

    .swiper-button-next,
    .swiper-button-prev {
        position: absolute;
        background-color: rgba(0, 0, 0, 0.5);
        padding: 2rem;
        border-radius: 50%;
        color: white;
        transform: translateY(-50%);
    }

    .swiper-button-next {
        right: 90px;                /* Move further to the right */
    }

    .swiper-button-prev {
        left: 90px;                 /* Move further to the left */
    }

    .swiper-pagination {
        position: absolute;
        width: 100%;
        text-align: center;
    }

    .swiper-container {
        width: 100%;
        height: 100%;
        overflow: hidden;
        position: relative;
        padding: 0;
        margin: 0;
        display: flex;
        align-items: center;
    }

    .swiper-slide {
        display: flex;
        flex-direction: column;
        justify-content: flex-start;
        align-items: flex-start;
        padding: 1.5rem;
        min-width: 300px;
        box-sizing: border-box;
        height: 100%;
    }

    .banner {
        display: flex;
        justify-content: space-between;
        align-items: center;
        min-height: 50vh;
        width: 100%;
        background: linear-gradient(135deg, #66E13A, #212529); /* Ubah warna sesuai keinginan */
        box-shadow: 0 4px 15px rgba(0, 0, 0, 0.1);
        position: relative;
        overflow: hidden;
    }

    .text-content h1 {
        text-shadow: 2px 2px 4px rgba(0, 0, 0, 0.3);
        font-size: 3rem;
        transition: transform 0.5s ease;
        animation: slideInLeft 1s ease-in-out;
    }

    .text-content h2 {
        text-shadow: 1px 1px 3px rgba(0, 0, 0, 0.3);
        font-size: 2rem;
        animation: slideInLeft 1.2s ease-in-out;
    }

    .text-content p {
        font-size: 1rem;
        line-height: 1.6;
        margin-bottom: 1rem;
    }

    @keyframes fadeIn {
        0% {
            opacity: 0;
            transform: translateY(20px);
        }
        100% {
            opacity: 1;
            transform: translateY(0);
        }
    }

    @keyframes slideInLeft {
        0% {
            opacity: 0;
            transform: translateY(-30px);
        }
        100% {
            opacity: 1;
            transform: translateY(0);
        }
    }

    .banner .text-content {
        width: 50%;
        padding: 3rem 3rem;
        color: #212529;
        display: flex;
        flex-direction: column;
        justify-content: center;
        text-align: left;
        z-index: 1;
    }

    .banner .image-content {
        width: 50%;
        display: flex;
        justify-content: flex-end;
        align-items: center;
        position: relative;
        z-index: 0;
    }

    .banner .image-content img {
        width: 90%;
        height: auto;
        object-fit: cover;
        position: relative;
        z-index: 0;
    }

    .sec-2 img {
        width: 100%;
        height: auto;
    }

    .menu .card-icon img {
        height: 7rem;
        width: 7rem;
    }

    .card-wrapper {
        height: 30rem;
    }

    .menu .card {
        background-color: #66E13A;
        min-height: 70%;
        border-radius: 0;
        border-top-left-radius: 25px;
        border-top-right-radius: 25px;
        border-bottom-left-radius: 15px;
        border-bottom-right-radius: 15px;
        box-shadow: 5px 7px rgba(0, 0, 0, 0.508);
        transition: all 0.3s ease;
    }

    .menu .card:hover {
        transform: translateY(-10px);
        box-shadow: 8px 10px rgba(0, 0, 0, 0.6);
        background-color: #5bd132;
    }

    .menu .card .card-icon {
        transition: all 0.3s ease;
    }

    .menu .card:hover .card-icon {
        transform: scale(1.1) translateY(-5px);
    }

    .menu .card .btn-outline-dark {
        transition: all 0.3s ease;
        border: 2px solid #212529;
        color: #212529;
    }

    .menu .card .btn-outline-dark:hover {
        background-color: #212529;
        color: white;
        transform: scale(1.05);
        border-color: #212529;
    }

    .swiper-pagination {
        bottom: 10px;
        text-align: center;
        z-index: 1;
    }

    .swiper-pagination-bullet {
        background: gainsboro;
        opacity: 0.7;
    }

    .swiper-pagination-bullet-active {
        opacity: 1;
    }

    @keyframes moveParticles {
        0% {
            transform: translateY(0) translateX(0);
            opacity: 1;
        }
        100% {
            transform: translateY(-100vh) translateX(40px);
            opacity: 0;
        }
    }

    .particle {
        position: absolute;
        top: 100%;
        left: 50%;
        background-color: rgba(255, 255, 255, 0.7);
        border-radius: 50%;
        opacity: 0;
        animation: moveParticles 7s linear infinite;
    }

    .particle:nth-child(2) {
        left: 20%;
        width: 15px;
        height: 15px;
        animation-duration: 8s;
        animation-delay: 0.5s;
    }

    .particle:nth-child(3) {
        left: 70%;
        width: 12px;
        height: 12px;
        animation-duration: 7s;
        animation-delay: 1s;
    }

    .particle:nth-child(4) {
        left: 30%;
        width: 10px;
        height: 10px;
        animation-duration: 5s;
        animation-delay: 2s;
    }

    .particle:nth-child(5) {
        left: 50%;
        width: 20px;
        height: 20px;
        animation-duration: 10s;
        animation-delay: 0.3s;
    }

    .particle:nth-child(6) {
        left: 10%;
        width: 25px;
        height: 25px;
        animation-duration: 12s;
        animation-delay: 0.7s;
    }

    .particle:nth-child(7) {
        left: 80%;
        width: 18px;
        height: 18px;
        animation-duration: 6s;
        animation-delay: 0.9s;
    }

    .particle:nth-child(8) {
        left: 40%;
        width: 30px;
        height: 30px;
        animation-duration: 15s;
        animation-delay: 1.5s;
    }

    .particle:nth-child(9) {
        left: 90%;
        width: 10px;
        height: 10px;
        animation-duration: 5s;
        animation-delay: 2s;
    }

    .particle:nth-child(10) {
        left: 60%;
        width: 35px;
        height: 35px;
        animation-duration: 18s;
        animation-delay: 0.6s;
    }

    /* Base styles tetap */
    .text-content h1, .text-content h2 {
        text-align: left;
    }

    /* Responsive styles */
    @media (max-width: 768px) {
        .text-content {
            padding: 1.5rem !important;
        }

        .text-content h1 {
            font-size: 2rem;
            margin-bottom: 1rem;
        }

        .text-content h2 {
            font-size: 1.5rem;
            margin-bottom: 0.75rem;
        }

        .text-content p {
            font-size: 0.95rem;
            line-height: 1.5;
        }

        .swiper-slide {
            padding: 2rem 1rem;
            min-height: 400px;
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
        }

        .swiper-slide h2 {
            font-size: 1.5rem !important;
            margin-bottom: 1.5rem;
            text-align: center;
            width: 100%;
        }

        .swiper-slide p {
            font-size: 0.95rem;
            line-height: 1.6;
            padding: 0 0.5rem;
            text-align: justify;
            margin-bottom: 2rem;
        }

        .swiper-button-next,
        .swiper-button-prev {
            width: 35px;
            height: 35px;
            color: white;
            background: rgba(0, 0, 0, 0.3);
            border-radius: 50%;
            padding: 20px;
        }

        .swiper-button-next {
            right: -50px;
        }

        .swiper-button-prev {
            left: -50px;
        }

        .swiper-button-next::after,
        .swiper-button-prev::after {
            font-size: 18px;
        }

        .swiper-pagination {
            bottom: 0;
        }

        .swiper-pagination-bullet {
            width: 10px;
            height: 10px;
            margin: 0 6px;
            background: white;
            opacity: 0.7;
        }

        .swiper-pagination-bullet-active {
            opacity: 1;
            background: white;
        }

        .swiper-button-next,
        .swiper-button-prev,
        .swiper-pagination {
            opacity: 1;
        }

        .max-w-[2000px] {
            flex-direction: column;
        }

        .w-full.lg\:w-1/2 {
            width: 100%;
            padding: 0 !important;
        }

        .text-content h1 {
            font-size: 1.75rem;
            margin-bottom: 1rem;
            padding: 0 1rem;
        }

        .swiper-slide h2 {
            font-size: 1.25rem !important;
            margin-bottom: 0.75rem;
        }

        .swiper-slide p {
            font-size: 0.9rem;
            line-height: 1.5;
            padding: 0 0.5rem;
        }

        .text-white.text-justify {
            text-align: left;
        }

        .swiper-button-next::after,
        .swiper-button-prev::after {
            font-size: 20px;
        }

        .swiper-pagination {
            bottom: 0;
        }
    }

    @media (max-width: 480px) {
        .text-content h1 {
            font-size: 1.5rem;
            padding: 0 1rem;
        }

        .text-content h2 {
            font-size: 1.1rem !important;
        }

        .text-content p {
            font-size: 0.85rem;
            line-height: 1.4;
        }

        .swiper-slide {
            padding: 1.5rem 1rem;
            min-height: 450px;
        }

        .swiper-slide h2 {
            font-size: 1.25rem !important;
            margin-bottom: 1rem;
        }

        .swiper-slide p {
            font-size: 0.9rem;
            line-height: 1.5;
            padding: 0 0.25rem;
        }

        .swiper-button-next,
        .swiper-button-prev {
            width: 30px;
            height: 30px;
        }

        .swiper-button-next {
            right: 5px;
        }

        .swiper-button-prev {
            left: 5px;
        }

        .swiper-pagination {
            bottom: 5px;
        }

        .swiper-pagination-bullet {
            width: 8px;
            height: 8px;
            margin: 0 5px;
        }
    }

    .menu-section {
        width: 100%;
        padding: 4rem 2rem;
        background: white;
    }

    .menu-title {
        text-align: center;
        margin-bottom: 4rem;
        position: relative;
    }

    .menu-title h2 {
        font-size: 2rem;
        font-weight: bold;
        color: #333;
    }

    .menu-title::after {
        content: '';
        position: absolute;
        bottom: -10px;
        left: 50%;
        transform: translateX(-50%);
        width: 100%;
        height: 1px;
        background: #ccc;
    }

    .card-container {
        max-width: 1200px;
        margin: 0 auto;
        display: flex;
        justify-content: space-between;
        gap: 2rem;
    }

    .card {
        flex: 1;
        min-width: 250px;
        max-width: 300px;
        background-color: #66E13A;
        border-radius: 15px 15px 50px 50px;
        padding: 2rem;
        position: relative;
        box-shadow: 8px 8px rgba(0, 0, 0, 0.2);
        display: flex;
        flex-direction: column;
        align-items: center;
        text-align: center;
        transition: transform 0.3s ease, box-shadow 0.3s ease;
        min-height: 400px;
    }

    .card:hover {
        transform: translateY(-10px);
        box-shadow: 12px 12px rgba(0, 0, 0, 0.3);
    }

    .card-icon {
        position: absolute;
        top: -40px;
        left: 50%;
        transform: translateX(-50%);
        width: 100px;
        height: 100px;
        display: flex;
        justify-content: center;
        align-items: center;
        transition: transform 0.3s ease;
    }

    .card:hover .card-icon {
        transform: translateX(-50%) scale(1.1);
    }

    .card-icon img {
        width: 100%;
        height: 100%;
        object-fit: contain;
    }

    .card-title {
        margin-top: 2.5rem;
        font-size: 1.5rem;
        font-weight: bold;
        color: #000;
        margin-bottom: 1rem;
    }

    .card-text {
        color: #000;
        line-height: 1.6;
        margin-bottom: 2rem;
    }

    .card-button {
        display: inline-block;
        padding: 0.5rem 1.5rem;
        border: 2px solid #000;
        border-radius: 8px;
        color: #000;
        font-weight: bold;
        text-decoration: none;
        transition: all 0.3s ease;
        background: transparent;
    }

    .card-button:hover {
        background: #000;
        color: white;
        transform: scale(1.05);
    }

    @media (max-width: 1200px) {
        .card-container {
            flex-wrap: wrap;
            justify-content: center;
        }

        .card {
            margin-top: 4rem;
        }
    }

    @media (max-width: 768px) {
        .menu-section {
            padding: 3rem 1rem;
        }

        .menu-title h2 {
            font-size: 1.5rem;
            padding: 0 1rem;
        }

        .card {
            flex: 0 1 100%;
            margin: 4rem 1rem;
        }
    }

    .card-content {
        display: flex;
        flex-direction: column;
        height: 100%;
        justify-content: space-between;
    }

    .card-text-wrapper {
        flex-grow: 1;
        display: flex;
        flex-direction: column;
    }

    .card-button-wrapper {
        margin-top: auto;
        padding-top: 1rem;
    }

    img {
        display: block;
        vertical-align: middle;
        line-height: 0;
    }

    @media (max-width: 1024px) {
        .swiper-button-next {
            right: 5px;
        }
        .swiper-button-prev {
            left: 5px;
        }
    }

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

    .modal-image.rounded-lg {
        border-radius: 0;
        background: none;
        box-shadow: none;
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

    .modal-button:hover {
        background-color: #5bd132;
        transform: scale(1.1);
    }

    .modal-button:active {
        transform: scale(0.95);
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

    @media (max-width: 768px) {
        .modal-content {
            padding-top: 3rem;
        }

        .modal-button {
            width: 35px;
            height: 35px;
        }

        .modal-controls {
            top: 0.5rem;
            right: 0.5rem;
        }
    }
</style>

<body>
    <section class="relative w-full bg-gradient-to-br from-[#66E13A] to-[#212529] shadow-lg">
        <!-- Particles -->
        <div class="absolute inset-0">
            <div class="particle"></div>
            <div class="particle"></div>
            <div class="particle"></div>
            <div class="particle"></div>
            <div class="particle"></div>
            <div class="particle"></div>
            <div class="particle"></div>
            <div class="particle"></div>
            <div class="particle"></div>
            <div class="particle"></div>
        </div>

        <!-- Main Content -->
        <div class="max-w-[2000px] mx-auto flex flex-col lg:flex-row items-start justify-between px-4 lg:px-8 h-full">
            <!-- Text Content -->
            <div class="w-full lg:w-1/2 p-6 lg:p-12 text-gray-900 z-10 animate-fade-right animate-once animate-duration-[800ms] animate-delay-200">
                <h1 class="text-4xl lg:text-5xl font-bold shadow-text mb-6">
                    Sejarah Mawaris
                </h1>
                <div class="relative w-full">
                    <div class="swiper-container">
                        <div class="swiper-wrapper">
                            <div class="swiper-slide">
                                <h2 class="text-2xl lg:text-3xl font-semibold shadow-text animate-slideInLeft mb-4">
                                    Masa Pra-Islam
                                </h2>
                                <p class="text-white text-justify animate-fadeIn">Pada masa pra-Islam, yang dikenal sebagai masa jahiliah, sistem kewarisan di kalangan bangsa Arab bersifat diskriminatif. Harta warisan hanya diberikan kepada laki-laki dewasa yang memiliki kekuatan, sementara perempuan dan anak-anak tidak memiliki hak waris. Pembagian harta dilakukan melalui dua sistem: sistem keturunan yang bersifat patrilinear dan sistem sebab. Ahli waris yang berhak terdiri dari anak laki-laki, saudara laki-laki, paman, dan anak laki-laki paman. Kaum wanita, termasuk janda, sering kali dianggap sebagai harta yang diwariskan, sehingga mereka tidak mendapatkan hak yang setara dalam pembagian warisan.</p>
                            </div>
                            <div class="swiper-slide">
                                <h2 class="text-2xl lg:text-3xl font-semibold shadow-text animate-slideInLeft mb-4">
                                    Masa Awal Islam
                                </h2>
                                <p class="text-white text-justify animate-fadeIn">Dengan munculnya Islam, sistem kewarisan mengalami perubahan signifikan. Pada masa awal Islam, hak waris tidak hanya diberikan kepada laki-laki dewasa, tetapi juga kepada perempuan dan anak-anak, sebagaimana diatur dalam ayat Al-Qur'an (Q.S. an-Nisa' 4:7) yang menyatakan bahwa semua anggota keluarga, tanpa memandang usia atau jenis kelamin, berhak atas harta peninggalan. Rasulullah SAW juga menerapkan sistem pewarisan yang berdasarkan pertalian kerabat, hijrah, dan ikatan persaudaraan. Dalam konteks ini, sahabat yang tidak memiliki wali dapat mewariskan hartanya kepada orang-orang yang memiliki ikatan persaudaraan, sehingga menciptakan sistem kewarisan yang lebih adil dan inklusif.</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Image Content -->
            <div class="w-full lg:w-1/2 flex items-center justify-end z-10 animate-fade-left animate-once animate-duration-[800ms] animate-delay-200">
                <img src="{{ asset('images/family.png') }}"
                     alt="Gambar Keluarga"
                     class="w-full h-auto object-cover align-bottom block" />
            </div>
        </div>
    </section>

    <!-- Diagram Section -->
    <section class="w-full bg-white py-12 -mt-[2px]">
        <div class="max-w-[2000px] mx-auto px-4">
            <div class="text-center mb-12 animate-fade-up animate-once animate-duration-[800ms] animate-delay-200">
                <h2 class="text-uppercase fw-bold text-center fs-3">
                    Diagram Ahli Waris
                </h2>
                <hr class="border-success border-3 mx-3 my-0">
            </div>
            <div class="flex justify-center animate-fade-up animate-once animate-duration-[800ms] animate-delay-400">
                <img src="{{ asset('images/diagram.jpg') }}"
                     alt="Diagram Ahli Waris"
                     class="w-full max-w-5xl h-auto shadow-lg rounded-lg cursor-pointer hover:opacity-90 transition-opacity duration-300"
                     id="diagramImage"
                     onclick="openModal()">
            </div>
        </div>

        <!-- Modal -->
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
                    <img src="{{ asset('images/diagram.jpg') }}"
                         alt="Diagram Ahli Waris"
                         class="modal-image w-full h-auto rounded-lg shadow-lg"
                         id="modalImage">
                </div>
            </div>
            <div class="zoom-level" id="zoomLevel">100%</div>
        </div>
    </section>

    <section class="menu-section">
        <div class="menu-title animate-fade-up animate-once animate-duration-[800ms] animate-delay-200">
            <h2>PELAJARI DAN HITUNG WARISAN ANDA DENGAN MUDAH</h2>
        </div>

        <div class="card-container">
            <!-- Card 1 -->
            <div class="card animate-fade-up animate-once animate-duration-[800ms] animate-delay-300">
                <div class="card-icon">
                    <img src="{{ asset('images/law.png') }}" alt="Hukum Icon">
                </div>
                <div class="card-content">
                    <div class="card-text-wrapper">
                        <h3 class="card-title">Dasar Hukum Mawaris</h3>
                        <p class="card-text">Temukan dasar-dasar hukum waris yang diatur dalam Al-Qur'an, Hadis, dan Kompilasi Hukum Islam (KHI). Pelajari bagaimana Islam mengatur pembagian harta warisan.</p>
                    </div>
                    <div class="card-button-wrapper">
                        <a href="{{ route('hukum') }}" class="card-button">Baca Selengkapnya</a>
                    </div>
                </div>
            </div>

            <!-- Card 2 -->
            <div class="card animate-fade-up animate-once animate-duration-[800ms] animate-delay-500">
                <div class="card-icon">
                    <img src="{{ asset('images/book.png') }}" alt="Book Icon">
                </div>
                <div class="card-content">
                    <div class="card-text-wrapper">
                        <h3 class="card-title">Mawaris</h3>
                        <p class="card-text">Pahami konsep hak waris, serta istilah penting dalam pembagian warisan. Dapatkan panduan lengkap untuk memahami waris dalam Islam.</p>
                    </div>
                    <div class="card-button-wrapper">
                        <a href="{{ route('mawaris') }}" class="card-button">Baca Selengkapnya</a>
                    </div>
                </div>
            </div>

            <!-- Card 3 -->
            <div class="card animate-fade-up animate-once animate-duration-[800ms] animate-delay-700">
                <div class="card-icon">
                    <img src="{{ asset('images/calculator.png') }}" alt="Calculator Icon">
                </div>
                <div class="card-content">
                    <div class="card-text-wrapper">
                        <h3 class="card-title">Kalkulator Ahli Waris</h3>
                        <p class="card-text">Hitung pembagian harta warisan dengan mudah dan akurat. Gunakan kalkulator ahli waris ini untuk memastikan pembagian harta sesuai dengan hukum syariah.</p>
                    </div>
                    <div class="card-button-wrapper">
                        <a href="{{ route('informasi_umum') }}" class="card-button">Hitung Sekarang</a>
                    </div>
                </div>
            </div>
        </div>
    </section>

</body>

<script>
document.addEventListener('DOMContentLoaded', function() {
    var swiper = new Swiper('.swiper-container', {
        loop: true,
        autoplay: {
            delay: 7000,
            disableOnInteraction: false,
        },
        pagination: {
            el: '.swiper-pagination',
            clickable: true,
            renderBullet: function (index, className) {
                return '<span class="' + className + '"></span>';
            },
        },
        navigation: {
            nextEl: '.swiper-button-next',
            prevEl: '.swiper-button-prev',
        },
        effect: 'fade',
        fadeEffect: {
            crossFade: true
        },
        autoHeight: true,
        spaceBetween: 30,
    });
});

let currentZoom = 1;
let isDragging = false;
let startX, startY, translateX = 0, translateY = 0;

function openModal() {
    const modal = document.getElementById('imageModal');
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
    image.classList.toggle('zoomed', currentZoom > 1);
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

// Add mouse drag functionality
document.getElementById('modalImage').addEventListener('mousedown', startDragging);
document.addEventListener('mousemove', drag);
document.addEventListener('mouseup', stopDragging);
document.addEventListener('mouseleave', stopDragging);

function startDragging(e) {
    if (currentZoom > 1) {
        isDragging = true;
        startX = e.clientX - translateX;
        startY = e.clientY - translateY;
    }
}

function drag(e) {
    if (!isDragging) return;
    e.preventDefault();
    translateX = e.clientX - startX;
    translateY = e.clientY - startY;
    updateImageTransform();
}

function stopDragging() {
    isDragging = false;
}

// Add touch support for mobile devices
document.getElementById('modalImage').addEventListener('touchstart', handleTouchStart);
document.getElementById('modalImage').addEventListener('touchmove', handleTouchMove);
document.getElementById('modalImage').addEventListener('touchend', handleTouchEnd);

let lastTouchDistance = 0;

function handleTouchStart(e) {
    if (e.touches.length === 2) {
        lastTouchDistance = getTouchDistance(e.touches);
    } else if (e.touches.length === 1 && currentZoom > 1) {
        isDragging = true;
        startX = e.touches[0].clientX - translateX;
        startY = e.touches[0].clientY - translateY;
    }
}

function handleTouchMove(e) {
    e.preventDefault();
    if (e.touches.length === 2) {
        const distance = getTouchDistance(e.touches);
        const scale = distance / lastTouchDistance;

        currentZoom *= scale;
        currentZoom = Math.min(Math.max(currentZoom, 0.5), 3);

        lastTouchDistance = distance;
        updateImageTransform();
        updateZoomLevel();
    } else if (isDragging && e.touches.length === 1) {
        translateX = e.touches[0].clientX - startX;
        translateY = e.touches[0].clientY - startY;
        updateImageTransform();
    }
}

function handleTouchEnd() {
    isDragging = false;
    lastTouchDistance = 0;
}

function getTouchDistance(touches) {
    return Math.hypot(
        touches[0].clientX - touches[1].clientX,
        touches[0].clientY - touches[1].clientY
    );
}

// Close modal when pressing Escape key
document.addEventListener('keydown', function(event) {
    if (event.key === 'Escape') {
        closeModal();
    }
});
</script>
