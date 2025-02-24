<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="author" content="">
  <link rel="icon" href="{{ asset('images/logo.png') }}" type="image/png">
  <title>WarisanQ</title>

  <!-- Custom fonts for this template -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous">
  </script>
  <link rel="stylesheet" href="https://unpkg.com/swiper/swiper-bundle.min.css" />
  <script src="https://unpkg.com/swiper/swiper-bundle.min.js"></script>

  <!-- Fonts -->
  <link rel="preconnect" href="https://fonts.bunny.net">
  <link href="https://fonts.bunny.net/css?family=figtree:400,600&display=swap" rel="stylesheet" />

  <!-- Tailwind CSS -->
  <script src="https://cdn.tailwindcss.com"></script>
  <script>
    tailwind.config = {
      theme: {
        extend: {
          maxWidth: {
            '2000': '2000px',
          },
          colors: {
            primary: '#66E13A',
            secondary: '#212529',
          },
          spacing: {
            '128': '32rem',
          },
        },
      },
    }
  </script>
</head>

<body class="flex flex-col min-h-screen bg-gray-100">

  <!-- Page Wrapper -->
  <div class="flex flex-col min-h-screen">

    <!-- Navbar -->
    @include('layouts.navbar')

    <!-- Main Content -->
    <main class="flex-1 w-full">
      @include('home')
    </main>

    <!-- Footer -->
    <footer class="w-full bg-white border-t mt-auto">
      @include('layouts.footer')
    </footer>

  </div>
  <!-- End of Page Wrapper -->

  <!-- Scroll to Top Button -->
  <button
    onclick="window.scrollTo({top: 0, behavior: 'smooth'})"
    class="fixed bottom-4 right-4 z-50 rounded-full bg-gray-700 p-3 text-white hover:bg-gray-600 shadow-lg transition-all duration-300 opacity-0 translate-y-10 sm:block"
    id="scrollTopBtn"
  >
    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
      <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 10l7-7m0 0l7 7m-7-7v18" />
    </svg>
  </button>

  <!-- Scripts -->
  <script src="{{ asset('vendor/jquery/jquery.min.js') }}"></script>
  <script src="{{ asset('vendor/jquery-easing/jquery.easing.min.js') }}"></script>
  <script src="{{ asset('js/sb-admin-2.min.js') }}"></script>

  <!-- Responsive scroll to top button -->
  <script>
    document.addEventListener('DOMContentLoaded', function() {
      const scrollTopBtn = document.getElementById('scrollTopBtn');

      window.addEventListener('scroll', function() {
        if (window.pageYOffset > 100) {
          scrollTopBtn.classList.remove('opacity-0', 'translate-y-10');
        } else {
          scrollTopBtn.classList.add('opacity-0', 'translate-y-10');
        }
      });
    });
  </script>

  <!-- Prevent zoom on mobile devices -->
  <script>
    document.addEventListener('gesturestart', function(e) {
      e.preventDefault();
    });
  </script>

</body>

</html>
