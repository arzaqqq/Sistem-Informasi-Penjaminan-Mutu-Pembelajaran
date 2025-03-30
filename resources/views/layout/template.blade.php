<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    @vite('resources/css/app.css')
    <title>@yield('title')</title>
    <link rel="stylesheet" href="/css/app.css">
    <link href="https://cdn.jsdelivr.net/npm/flowbite@2.5.2/dist/flowbite.min.css" rel="stylesheet" />
    <script src="https://cdn.jsdelivr.net/npm/flowbite@2.5.2/dist/flowbite.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <link rel="stylesheet" href="https://unpkg.com/aos@next/dist/aos.css" />
    <link rel="icon" href="{{ asset('img/logo3.png') }}" type="image/png">
    <script src="https://unpkg.com/aos@next/dist/aos.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/gsap@3.12.5/dist/gsap.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/gsap@3.12.5/dist/TextPlugin.min.js"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function () {
      AOS.init({
        once: true,
      });

      function typeEffect(elementId, duration, delay) {
            const element = document.getElementById(elementId);
            const fullText = element.innerHTML; // Ambil teks asli
            element.innerHTML = ''; // Hapus konten asli dari elemen

            // Animasi mengetik menggunakan GSAP TextPlugin
            gsap.to(element, {
                duration: duration, // Durasi efek mengetik
                text: fullText, // Teks yang akan ditampilkan
                ease: "power1.in", // Jenis easing untuk efek
                delay: delay,
            });
        }

        // Panggil fungsi untuk masing-masing elemen
        typeEffect('narasi1', 3, 0); // Durasi 4 detik untuk narasi1
        typeEffect('narasi2', 3, 2.5); // Durasi 3 detik untuk narasi2
    });
    </script>
    
    <style>
    @import url('https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap');

    body {
        font-family: "Poppins", sans-serif;
        background-color: white;
    }

    </style>
</head>

<body>
    @include('layout.navbar')
    @yield('content')
    @include('layout.footer')


</body>

</html>