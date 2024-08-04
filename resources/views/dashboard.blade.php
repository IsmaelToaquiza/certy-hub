<!-- resources/views/student/dashboard.blade.php -->

<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard del Alumno: ') }}{{ Auth::user()->name }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-gray-100">
                    <h1 class="text-2xl font-bold text-gray-800 mb-4">Bienvenido al Panel de Control</h1>
                    <p class="text-gray-600 mb-6">
                        Aquí puedes ver tus cursos y descargar tus certificados.
                    </p>
                    <ul class="grid gap-4 sm:grid-cols-2 md:grid-cols-3">
                        <!-- Cursos -->
                        <li class="bg-white p-4 rounded-lg shadow hover:shadow-md transition-shadow duration-300">
                            <a href="{{ route('student.cursos.index') }}" class="block text-center">
                                <svg class="w-12 h-12 mx-auto text-yellow-500 mb-2" fill="none" stroke="currentColor" stroke-width="1.5" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M6 10h4M6 13h4m2 1h4m-4-3h4M3 19h18M4 8h16M5 6h14c1.1 0 2 .9 2 2v8c0 1.1-.9 2-2 2H5c-1.1 0-2-.9-2-2V8c0-1.1.9-2 2-2z"></path>
                                </svg>
                                <span class="text-lg font-semibold text-yellow-600">Ver Mis Cursos</span>
                            </a>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
