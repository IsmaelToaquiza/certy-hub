<!-- resources/views/admin/proyectos/assign_students.blade.php -->
<x-app-layout>
    <x-slot name="header">
        <div class="d-flex justify-content-between align-items-center">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ __('Asignar Estudiantes al Proyecto: ') . $project->name }}
            </h2>
            <a href="{{ route('admin.proyectos.index') }}" class="btn btn-secondary">
                Volver a la Lista de Proyectos
            </a>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="container">
            <div class="card shadow-sm">
                <div class="card-body">
                    <form action="{{ route('admin.proyectos.students.assign', $project->id) }}" method="POST">
                        @csrf
                        <div class="mb-3">
                            <label class="form-label">Selecciona Estudiantes:</label>
                            <select name="students[]" multiple class="form-control" size="10">
                                @foreach($students as $student)
                                    <option value="{{ $student->id }}" {{ $project->students->contains($student->id) ? 'selected' : '' }}>
                                        {{ $student->first_name }} {{ $student->last_name }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                        <div class="d-flex justify-content-end">
                            <button type="submit" class="btn btn-primary">Guardar Asignaciones</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
