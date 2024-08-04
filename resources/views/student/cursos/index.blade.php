<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Mis Cursos') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-gray-100">
                    <h1 class="text-2xl font-bold text-gray-800 mb-4">Cursos Asignados</h1>
                    <p class="text-gray-600 mb-6">
                        Aquí puedes ver tus cursos asignados.
                    </p>
                    <ul>
                        @foreach ($courses as $course)
                            <li class="mb-4">
                                <div class="p-4 bg-white rounded-lg shadow">
                                    <h3 class="text-lg font-bold text-gray-800">{{ $course->name }}</h3>
                                    <p class="text-gray-600">{{ $course->description }}</p>
                                    <a href="{{ route('student.certificado.ver', $course->id) }}"
                                        class="btn btn-primary">Ver Certificado</a>
                                </div>
                            </li>
                        @endforeach
                    </ul>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>