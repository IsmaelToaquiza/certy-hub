<!-- resources/views/admin/proyectos/index.blade.php -->
<x-app-layout>
    <x-slot name="header">
        <div class="d-flex justify-content-between align-items-center">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ __('Proyectos') }}
            </h2>
            <a href="{{ route('admin.proyectos.create') }}" class="btn btn-primary">
                Agregar Nuevo Proyecto
            </a>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="container">
            <div class="card shadow-sm">
                <div class="card-body">
                    @if (session('success'))
                        <div class="alert alert-success">
                            {{ session('success') }}
                        </div>
                    @endif
                    <table class="table table-striped">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Nombre del Proyecto</th>
                                <th>Descripción</th>
                                <th>Acciones</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($projects as $project)
                                <tr>
                                    <td>{{ $project->id }}</td>
                                    <td>{{ $project->name }}</td>
                                    <td>{{ $project->description }}</td>
                                    <td>
                                        <a href="{{ route('admin.proyectos.edit', $project->id) }}" class="btn btn-warning btn-sm">Editar</a>
                                        <form action="{{ route('admin.proyectos.destroy', $project->id) }}" method="POST" class="d-inline">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('¿Estás seguro de eliminar este proyecto?')">Eliminar</button>
                                        </form>
                                        <a href="{{ route('admin.proyectos.assign_students', $project->id) }}" class="btn btn-info btn-sm">Asignar Estudiantes y Cursos</a>
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
