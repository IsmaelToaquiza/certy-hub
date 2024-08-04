<!-- resources/views/admin/alumnos/index.blade.php -->
<x-app-layout>
    <x-slot name="header">
        <div class="d-flex justify-content-between align-items-center">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ __('Alumnos') }}
            </h2>
            <a href="{{ route('admin.alumnos.create') }}" class="btn btn-primary">Agregar Nuevo Alumno</a>
        </div>
        </x-slot>

            <div class="py-12">
                <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                    <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                        <div class="p-6 text-gray-900">
                            <table class="table table-bordered">
                                <thead>
                                    <tr>
                                        <th>ID</th>
                                        <th>Nombre</th>
                                        <th>Apellido</th>
                                        <th>Email</th>
                                        <th>Cursos</th>
                                        <th>Acciones</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($students as $student)
                                        <tr>
                                            <td>{{ $student->id }}</td>
                                            <td>{{ $student->first_name }}</td>
                                            <td>{{ $student->last_name }}</td>
                                            <td>{{ $student->user ? $student->user->email : 'No asignado' }}</td>
                                            <td>
                                                @foreach ($student->courses as $course)
                                                    {{ $course->name }}@if (!$loop->last), @endif
                                                @endforeach
                                            </td>
                                            <td>
                                                <a href="{{ route('admin.alumnos.edit', $student->id) }}"
                                                    class="btn btn-primary btn-sm">Editar</a>
                                                <form action="{{ route('admin.alumnos.destroy', $student->id) }}"
                                                    method="POST" class="d-inline">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn btn-danger btn-sm"
                                                        onclick="return confirm('¿Estás seguro de eliminar este alumno?')">Eliminar</button>
                                                </form>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
</x-app-layout>