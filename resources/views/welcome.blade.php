<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>CertyHub - Tu Plataforma de Certificación</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,600&display=swap" rel="stylesheet" />

    <!-- Tailwind CSS CDN -->
    <script src="https://cdn.tailwindcss.com"></script>

    <!-- Styles -->
    <style>
        body {
            font-family: 'Figtree', sans-serif;
        }

        .bg-hero-pattern {
            background-image: url('https://www.vistazo.com/binrepository/799x533/100c-67/600d600/none/12727/PJKT/36218837621-d11f3914ec-c_1557665_20240531113125.jpg');
            /* Cambia esto a tu imagen de fondo */
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
                La plataforma más confiable para la gestión y generación de certificados en línea. Simplifica,
                automatiza y lleva tus certificados al siguiente nivel.
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

    <!-- Footer -->
    <footer class="py-6 text-center text-sm text-gray-400">
        © 2024 CertyHub. Todos los derechos reservados.
        <button id="openModal" class="text-white underline">Políticas de Seguridad</button>
    </footer>

    <!-- Modal -->
    <div id="securityPoliciesModal"
        class="fixed inset-0 flex items-center justify-center bg-black bg-opacity-50 hidden">
        <div class="bg-white rounded-lg shadow-lg w-full max-w-3xl mx-4 p-6">
            <div class="flex justify-between items-center mb-4">
                <h5 class="text-2xl font-bold text-gray-800">Políticas de Seguridad de CertyHub</h5>
                <button id="closeModal" class="text-gray-500 hover:text-gray-800">&times;</button>
            </div>
            <div class="overflow-y-auto max-h-96">
                <p class="mb-4 text-gray-700">En CertyHub, valoramos tu privacidad y nos comprometemos a proteger tus
                    datos personales. Implementamos diversas políticas de seguridad para garantizar la integridad y
                    confidencialidad de la información. Aquí te explicamos cómo lo hacemos:</p>

                <h2 class="text-xl font-semibold mb-2 text-gray-800">Nuestras Políticas de Seguridad</h2>
                <ul class="list-disc pl-6 mb-4 text-gray-700">
                    <li><strong>Protección de Datos:</strong> Todos tus datos personales están encriptados utilizando
                        tecnología avanzada para prevenir accesos no autorizados.</li>
                    <li><strong>Autenticación Segura:</strong> Utilizamos procesos de autenticación seguros para
                        asegurar que solo tú puedas acceder a tu cuenta.</li>
                    <li><strong>Gestión de Contraseñas:</strong> Requerimos contraseñas fuertes que incluyan una
                        combinación de letras, números y caracteres especiales.</li>
                    <li><strong>Seguridad de Sesiones:</strong> Nos aseguramos de que las sesiones de usuario sean
                        gestionadas de forma segura y expiren automáticamente tras períodos de inactividad.</li>

                </ul>

                <h3 class="text-lg font-semibold mb-2 text-gray-800">Nuestros Compromisos</h3>
                <p class="mb-4 text-gray-700">Hemos realizado un análisis exhaustivo para identificar áreas de mejora y
                    fortalecer aún más nuestra infraestructura de seguridad. Aquí te mostramos los principales aspectos:
                </p>

                <table class="min-w-full bg-white text-gray-700 mb-4">
                    <thead>
                        <tr>
                            <th class="py-2 px-4 border-b border-gray-200 bg-gray-50 text-left text-sm font-semibold">
                                Aspecto de Seguridad</th>
                            <th class="py-2 px-4 border-b border-gray-200 bg-gray-50 text-left text-sm font-semibold">
                                Descripción</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                        </tr>
                        <tr>
                            <td class="py-2 px-4 border-b border-gray-200">Prevención de Accesos No Autorizados</td>
                            <td class="py-2 px-4 border-b border-gray-200">Se implementan medidas para detectar y
                                bloquear intentos de acceso no autorizados de manera proactiva.</td>
                        </tr>
                        <tr>
                            <td class="py-2 px-4 border-b border-gray-200">Monitoreo Constante</td>
                            <td class="py-2 px-4 border-b border-gray-200">Nuestro sistema es monitoreado 24/7 para
                                detectar actividades sospechosas y actuar rápidamente.</td>
                        </tr>
                        <tr>
                            <td class="py-2 px-4 border-b border-gray-200">Protección contra Malware</td>
                            <td class="py-2 px-4 border-b border-gray-200">Se utilizan herramientas avanzadas para
                                identificar y neutralizar amenazas de malware.</td>
                        </tr>
                        <tr>
                            <td class="py-2 px-4 border-b border-gray-200">Actualizaciones de Seguridad</td>
                            <td class="py-2 px-4 border-b border-gray-200">Mantenemos nuestros sistemas actualizados
                                para asegurar la protección contra las últimas amenazas.</td>
                        </tr>
                    </tbody>
                </table>

                <div class="bg-blue-100 p-4 rounded-lg">
                    <h3 class="text-lg font-semibold mb-2 text-blue-800">Tu Seguridad es Nuestra Prioridad</h3>
                    <p class="text-blue-800">Nos comprometemos a seguir mejorando nuestras prácticas de seguridad y a
                        garantizar que CertyHub siga siendo un entorno seguro y confiable para ti. Si tienes preguntas o
                        necesitas más información, no dudes en contactarnos.</p>
                </div>
            </div>
            <div class="flex justify-end mt-4">
                <button id="closeModalBottom"
                    class="bg-gray-800 text-white py-2 px-4 rounded-lg hover:bg-gray-700">Cerrar</button>
            </div>
        </div>
    </div>

    <!-- JavaScript for Modal -->
    <script>
        document.getElementById('openModal').addEventListener('click', function() {
            document.getElementById('securityPoliciesModal').classList.remove('hidden');
        });

        document.getElementById('closeModal').addEventListener('click', function() {
            document.getElementById('securityPoliciesModal').classList.add('hidden');
        });

        document.getElementById('closeModalBottom').addEventListener('click', function() {
            document.getElementById('securityPoliciesModal').classList.add('hidden');
        });
    </script>

</body>

</html>
