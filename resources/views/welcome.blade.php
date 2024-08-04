<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>CertyHub - Tu Plataforma de Certificación</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,600&display=swap" rel="stylesheet"/>

    <!-- Tailwind CSS CDN -->
    <script src="https://cdn.tailwindcss.com"></script>

    <!-- Styles -->
    <style>
        body {
            font-family: 'Figtree', sans-serif;
        }

        .bg-hero-pattern {
            background-image: url('https://www.vistazo.com/binrepository/799x533/100c-67/600d600/none/12727/PJKT/36218837621-d11f3914ec-c_1557665_20240531113125.jpg'); /* Cambia esto a tu imagen de fondo */
            background-size: cover;
            background-position: center;
        }
    </style>
</head>
<body class="antialiased bg-hero-pattern text-white">
<div class="min-h-screen flex flex-col justify-center items-center bg-black/50 px-4">
    <div class="max-w-2xl text-center">
        <h1 class="text-5xl font-bold mb-4">Bienvenido a CertyHub</h1>
        <p class="text-lg mb-6">
            La plataforma más confiable para la gestión y generación de certificados en línea. Simplifica, automatiza y lleva tus certificados al siguiente nivel.
        </p>
        <a href="{{ route('login') }}"
           class="inline-block px-6 py-3 bg-[#FF2D20] text-white font-semibold rounded-lg shadow-md hover:bg-red-700 transition duration-300">
            Iniciar Sesión
        </a>
    </div>

    <div class="mt-12 max-w-3xl text-center">
        <h2 class="text-3xl font-semibold mb-3">¿Por qué elegir CertyHub?</h2>
        <ul class="text-lg">
            <li class="mb-2">✔️ Gestión de certificados sencilla y eficiente</li>
            <li class="mb-2">✔️ Soporte técnico 24/7</li>
        </ul>
    </div>
</div>

<footer class="py-6 text-center text-sm text-gray-400">
    © 2024 CertyHub. Todos los derechos reservados.
</footer>
</body>
</html>
