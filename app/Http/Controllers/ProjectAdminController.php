<?php

namespace App\Http\Controllers;

use App\Models\Course;
use App\Models\User;
use App\Models\Student;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;


class ProjectAdminController extends Controller
{
    protected $project;

    public function __construct()
    {
        $this->project = Auth::user()->projects()->first(); // Asegúrate de que esto funciona
    }

    public function index()
    {
        // Asegurarte de que $this->project está correctamente asignado
        $project = $this->project;

        // Comprobación si el proyecto existe
        if (!$project) {
            return redirect()->route('home')->withErrors('No se encontró el proyecto asignado.');
        }

        return view('adminproy.dashboard', compact('project'));
    }

    // Alumnos

    public function viewStudents()
    {
        $students = $this->project->students()->with('courses', 'user')->get(); // Obtener alumnos relacionados al proyecto
        return view('adminproy.alumnos.index', compact('students'));
    }

    public function createStudent()
    {
        $courses = $this->project->courses()->get(); // Obtener cursos relacionados al proyecto
        return view('adminproy.alumnos.create', compact('courses'));
    }

    public function storeStudent(Request $request)
    {
        $validated = $request->validate([
            'first_name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => [
                'required',
                'string',
                'min:8', // Mínimo de 12 caracteres
                'max:64', // Máximo de 64 caracteres
                'regex:/[a-z]/', // Al menos una letra minúscula
                'regex:/[A-Z]/', // Al menos una letra mayúscula
                'regex:/[0-9]/', // Al menos un número
                'regex:/[@$!%*?&#]/', // Al menos un carácter especial
                'confirmed', // Confirmación
            ],
            'courses' => 'array',
            'courses.*' => 'exists:courses,id',
        ]);

        try {
            // Iniciar una transacción de base de datos
            DB::beginTransaction();

            // Crear nuevo estudiante
            $student = Student::create([
                'first_name' => $request->first_name,
                'last_name' => $request->last_name,
            ]);

            // Crear nuevo usuario para el alumno
            $user = User::create([
                'name' => $request->first_name . ' ' . $request->last_name,
                'email' => $request->email,
                'password' => Hash::make($request->password),
                'role_id' => 3,
                'student_id' => $student->id,
            ]);

            // Asignar cursos al alumno
            $student->courses()->sync($request->courses);
            // Asignar estudiante al proyecto
            $this->project->students()->attach($student->id);

            // Confirmar la transacción
            DB::commit();

            return redirect()->route('adminproy.alumnos.index')->with('success', 'Alumno creado exitosamente.');
        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->route('adminproy.alumnos.create')->withErrors('Error al crear el alumno.');
        }
    }

    public function editStudent($id)
    {
        $student = Student::with('courses', 'user')->findOrFail($id);
        $courses = $this->project->courses()->get(); // Obtener cursos del proyecto actual
        return view('adminproy.alumnos.edit', compact('student', 'courses'));
    }

    public function updateStudent(Request $request, $id)
    {
        $student = Student::findOrFail($id);
        $user = $student->user; // Obtener el usuario relacionado

        $validated = $request->validate([
            'first_name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users,email,' . $user->id,
            'password' => [
                'required',
                'string',
                'min:8', // Mínimo de 12 caracteres
                'max:64', // Máximo de 64 caracteres
                'regex:/[a-z]/', // Al menos una letra minúscula
                'regex:/[A-Z]/', // Al menos una letra mayúscula
                'regex:/[0-9]/', // Al menos un número
                'regex:/[@$!%*?&#]/', // Al menos un carácter especial
                'confirmed', // Confirmación
            ],
            'courses' => 'array',
            'courses.*' => 'exists:courses,id',
        ]);

        // Actualizar datos del estudiante
        $student->first_name = $request->first_name;
        $student->last_name = $request->last_name;
        $student->save();

        // Actualizar datos del usuario
        $user->name = $request->first_name . ' ' . $request->last_name;
        $user->email = $request->email;
        if ($request->filled('password')) {
            $user->password = Hash::make($request->password);
        }
        $user->save();

        // Actualizar cursos asignados
        $student->courses()->sync($request->courses);

        return redirect()->route('adminproy.alumnos.index')->with('success', 'Alumno actualizado exitosamente.');
    }

    public function destroyStudent($id)
    {
        $student = Student::with('user')->findOrFail($id);
        $user = $student->user; // Obtener el usuario relacionado

        if ($user) {
            $user->delete(); // Eliminar el usuario relacionado
        }
        $student->delete(); // Eliminar el estudiante

        return redirect()->route('adminproy.alumnos.index')->with('success', 'Alumno eliminado exitosamente.');
    }

    // Cursos

    public function viewCourses()
    {
        $courses = $this->project->courses()->get(); // Obtener cursos relacionados al proyecto
        return view('adminproy.cursos.index', compact('courses'));
    }

    public function editCourse($id)
    {
        $course = Course::findOrFail($id); // Cargar el curso
        return view('adminproy.cursos.edit', compact('course'));
    }

    public function updateCourse(Request $request, $id)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
        ]);

        $course = Course::findOrFail($id);
        $course->name = $request->name;
        $course->save();

        return redirect()->route('adminproy.cursos.index')->with('success', 'Curso actualizado exitosamente.');
    }
}
