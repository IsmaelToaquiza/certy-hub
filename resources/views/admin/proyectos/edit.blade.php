<!-- resources/views/admin/proyectos/edit.blade.php -->
<x-app-layout>
    <x-slot name="header">
        <div class="d-flex justify-content-between align-items-center">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ __('Editar Proyecto') }}
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
                    <form action="{{ route('admin.proyectos.update', $project->id) }}" method="POST">
                        @csrf
                        @method('PUT')
                        <div class="mb-3">
                            <label for="name" class="form-label">Nombre del Proyecto</label>
                            <input type="text" name="name" id="name" value="{{ $project->name }}" class="form-control" required>
                        </div>
                        <div class="mb-3">
                            <label for="description" class="form-label">Descripción</label>
                            <textarea name="description" id="description" rows="4" class="form-control" required>{{ $project->description }}</textarea>
                        </div>
                        <div class="d-flex justify-content-end">
                            <button type="submit" class="btn btn-success">Actualizar Proyecto</button>
                        </div>
                    </form>

                    <!-- Estudiantes Asignados -->
                    <h4 class="mt-5">Estudiantes Asignados</h4>
                    <form action="{{ route('admin.proyectos.students.assign', $project->id) }}" method="POST">
                        @csrf
                        <div class="mb-3">
                            <select name="students[]" multiple class="form-control" size="10">
                                @foreach($assignedStudents as $student)
                                    <option value="{{ $student->id }}" {{ $project->students->contains($student->id) ? 'selected' : '' }}>
                                        {{ $student->first_name }} {{ $student->last_name }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                        <div class="d-flex justify-content-end">
                            <button type="submit" class="btn btn-primary">Guardar Asignaciones de Estudiantes</button>
                        </div>
                    </form>

                    <!-- Cursos Asignados -->
                    <h4 class="mt-5">Cursos Asignados</h4>
                    <form action="{{ route('admin.proyectos.courses.assign', $project->id) }}" method="POST">
                        @csrf
                        <div class="mb-3">
                            <select name="courses[]" multiple class="form-control" size="10">
                                @foreach($assignedCourses as $course)
                                    <option value="{{ $course->id }}" {{ $project->courses->contains($course->id) ? 'selected' : '' }}>
                                        {{ $course->name }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                        <div class="d-flex justify-content-end">
                            <button type="submit" class="btn btn-primary">Guardar Asignaciones de Cursos</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
