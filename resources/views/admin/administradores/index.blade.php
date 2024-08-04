<!-- resources/views/admin/administradores/index.blade.php -->
<x-app-layout>
    <x-slot name="header">
        <div class="d-flex justify-content-between align-items-center">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ __('Administradores') }}
            </h2>
            <a href="{{ route('admin.administradores.create') }}" class="btn btn-primary">Agregar Nuevo Administrador</a>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="container">
            <div class="card shadow-sm">
                <div class="card-body">
                    <table class="table table-striped">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Nombre</th>
                                <th>Email</th>
                                <th>Proyecto Asignado</th>
                                <th>Acciones</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($administrators as $admin)
                                <tr>
                                    <td>{{ $admin->id }}</td>
                                    <td>{{ $admin->name }}</td>
                                    <td>{{ $admin->email }}</td>
                                    <td>
                                        @if ($admin->projects->first())
                                            {{ $admin->projects->first()->name }}
                                        @else
                                            <span class="text-muted">Sin Proyecto</span>
                                        @endif
                                    </td>
                                    <td>
                                        <a href="{{ route('admin.administradores.edit', $admin->id) }}" class="btn btn-warning">Editar</a>
                                        <form action="{{ route('admin.administradores.destroy', $admin->id) }}" method="POST" class="d-inline-block">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-danger" onclick="return confirm('¿Estás seguro de eliminar este administrador?')">Eliminar</button>
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
