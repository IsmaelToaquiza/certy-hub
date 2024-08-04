<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard del Administrador Principal') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-gray-100">
                    <h1 class="text-2xl font-bold text-gray-800 mb-4">Bienvenido al Panel de Control</h1>
                    <p class="text-gray-600 mb-6">
                        Aquí puedes gestionar los diferentes aspectos de la plataforma como proyectos, administradores, alumnos y cursos.
                    </p>
                    <ul class="grid gap-4 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4">
                        <li class="bg-white p-4 rounded-lg shadow hover:shadow-md transition-shadow duration-300">
                            <a href="{{ route('admin.proyectos.index') }}" class="block text-center">
                                <svg class="w-12 h-12 mx-auto text-indigo-500 mb-2" fill="none" stroke="currentColor" stroke-width="1.5" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M4 16s1.5 2 4 2 4-2 4-2V7c0-.28-.22-.5-.5-.5h-3c-.28 0-.5.22-.5.5v6c0 .28.22.5.5.5h3c.28 0 .5.22.5.5v2c0 1.1-.9 2-2 2s-2-.9-2-2H4v3c0 .28.22.5.5.5H10M6 10h4M6 13h4"></path>
                                </svg>
                                <span class="text-lg font-semibold text-indigo-600">Ver Proyectos</span>
                            </a>
                        </li>
                        <li class="bg-white p-4 rounded-lg shadow hover:shadow-md transition-shadow duration-300">
                            <a href="{{ route('admin.administradores.index') }}" class="block text-center">
                                <svg class="w-12 h-12 mx-auto text-green-500 mb-2" fill="none" stroke="currentColor" stroke-width="1.5" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M16 7.5c0 1.933-1.567 3.5-3.5 3.5S9 9.433 9 7.5 10.567 4 12.5 4 16 5.567 16 7.5zM12.5 10.5c-2.5 0-4.5 2-4.5 4.5V20h9v-5c0-2.5-2-4.5-4.5-4.5z"></path>
                                </svg>
                                <span class="text-lg font-semibold text-green-600">Ver Administradores</span>
                            </a>
                        </li>
                        <li class="bg-white p-4 rounded-lg shadow hover:shadow-md transition-shadow duration-300">
                            <a href="{{ route('admin.alumnos.index') }}" class="block text-center">
                                <svg class="w-12 h-12 mx-auto text-blue-500 mb-2" fill="none" stroke="currentColor" stroke-width="1.5" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M12 7.5c0 1.933-1.567 3.5-3.5 3.5S5 9.433 5 7.5 6.567 4 8.5 4 12 5.567 12 7.5zM8.5 10.5c-2.5 0-4.5 2-4.5 4.5V20h9v-5c0-2.5-2-4.5-4.5-4.5z"></path>
                                </svg>
                                <span class="text-lg font-semibold text-blue-600">Ver Alumnos</span>
                            </a>
                        </li>
                        <li class="bg-white p-4 rounded-lg shadow hover:shadow-md transition-shadow duration-300">
                            <a href="{{ route('admin.cursos.index') }}" class="block text-center">
                                <svg class="w-12 h-12 mx-auto text-yellow-500 mb-2" fill="none" stroke="currentColor" stroke-width="1.5" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M6 10h4M6 13h4m2 1h4m-4-3h4M3 19h18M4 8h16M5 6h14c1.1 0 2 .9 2 2v8c0 1.1-.9 2-2 2H5c-1.1 0-2-.9-2-2V8c0-1.1.9-2 2-2z"></path>
                                </svg>
                                <span class="text-lg font-semibold text-yellow-600">Ver Cursos</span>
                            </a>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
