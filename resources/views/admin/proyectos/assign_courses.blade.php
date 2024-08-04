<!-- resources/views/admin/proyectos/assign_courses.blade.php -->
<x-app-layout>
    <x-slot name="header">
        <div class="d-flex justify-content-between align-items-center">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ __('Asignar Cursos al Proyecto: ') . $project->name }}
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
                    <form action="{{ route('admin.proyectos.courses.assign', $project->id) }}" method="POST">
                        @csrf
                        <div class="mb-3">
                            <label class="form-label">Selecciona Cursos:</label>
                            <select name="courses[]" multiple class="form-control" size="10">
                                @foreach($courses as $course)
                                    <option value="{{ $course->id }}" {{ $project->courses->contains($course->id) ? 'selected' : '' }}>
                                        {{ $course->name }}
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
