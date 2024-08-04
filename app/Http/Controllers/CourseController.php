<?php

namespace App\Http\Controllers;

use App\Models\Course;
use Illuminate\Http\Request;

class CourseController extends Controller
{
    // Mostrar la lista de cursos
    public function index()
    {
        $courses = Course::all();
        return view('admin.cursos', compact('courses'));
    }

    // Mostrar el formulario para crear un nuevo curso
    public function create()
    {
        return view('admin.create_course');
    }

    // Almacenar un nuevo curso en la base de datos
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
        ]);

        Course::create($request->all());

        return redirect()->route('admin.cursos')->with('success', 'Curso creado exitosamente.');
    }

    // Mostrar un curso específico
    public function show(Course $course)
    {
        return view('admin.show_course', compact('course'));
    }

    // Mostrar el formulario para editar un curso existente
    public function edit(Course $course)
    {
        return view('admin.edit_course', compact('course'));
    }

    // Actualizar un curso existente en la base de datos
    public function update(Request $request, Course $course)
    {
        $request->validate([
            'name' => 'required|string|max:255',
        ]);

        $course->update($request->all());

        return redirect()->route('admin.cursos')->with('success', 'Curso actualizado exitosamente.');
    }

    // Eliminar un curso
    public function destroy(Course $course)
    {
        $course->delete();

        return redirect()->route('admin.cursos')->with('success', 'Curso eliminado exitosamente.');
    }
}
