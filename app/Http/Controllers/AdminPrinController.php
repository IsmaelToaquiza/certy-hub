<?php

namespace App\Http\Controllers;

use App\Models\Course;
use App\Models\Project;
use App\Models\User;
use App\Models\Student;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\DB;

class AdminPrinController extends Controller
{
    //PROYECTOS LOGICA
    // Mostrar el dashboard
    public function index()
    {
        return view('admin.dashboard');
    }

    // Mostrar lista de proyectos
    public function viewProjects()
    {
        $projects = Project::all(); // Obtiene todos los proyectos
        return view('admin.proyectos.index', compact('projects'));
    }

    // Formulario para crear un nuevo proyecto
    public function createProject()
    {
        return view('admin.proyectos.create');
    }

    // Guardar un nuevo proyecto
    public function storeProject(Request $request)
    {
        // Validación de los datos
        $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
        ]);

        // Creación del proyecto
        $project = Project::create($request->only(['name', 'description']));

        // Redirigir a la vista de asignación de estudiantes
        return redirect()->route('admin.proyectos.assign_students', $project->id)
            ->with('success', 'Proyecto creado con éxito. Ahora puedes asignar estudiantes y cursos.');
    }

    // Formulario para editar un proyecto
    public function editProject($id)
    {
        // Cargar el proyecto con estudiantes y cursos asignados
        $project = Project::with(['students', 'courses'])->findOrFail($id);

        // Solo obtener los estudiantes y cursos asignados
        $assignedStudents = $project->students;
        $assignedCourses = $project->courses;

        return view('admin.proyectos.edit', compact('project', 'assignedStudents', 'assignedCourses'));
    }

    // Actualizar un proyecto existente
    public function updateProject(Request $request, $id)
    {
        // Validación de los datos
        $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
        ]);

        // Actualización del proyecto
        $project = Project::findOrFail($id);
        $project->update($request->only(['name', 'description']));

        // Redirigir a la vista de asignación de estudiantes
        return redirect()->route('admin.proyectos.assign_students', $project->id)
            ->with('success', 'Proyecto actualizado con éxito. Puedes revisar las asignaciones.');
    }

    // Asignación de estudiantes a un proyecto
    public function assignStudents($id)
    {
        $project = Project::findOrFail($id);
        $students = Student::all();

        return view('admin.proyectos.assign_students', compact('project', 'students'));
    }

    // Guardar asignaciones de estudiantes
    public function saveStudentAssignments(Request $request, $id)
    {
        $project = Project::findOrFail($id);
        $project->students()->sync($request->students);

        return redirect()->route('admin.proyectos.assign_courses', $project->id)
            ->with('success', 'Estudiantes asignados con éxito. Ahora puedes asignar cursos.');
    }

    // Asignación de cursos a un proyecto
    public function assignCourses($id)
    {
        $project = Project::findOrFail($id);
        $courses = Course::all();

        return view('admin.proyectos.assign_courses', compact('project', 'courses'));
    }

    // Guardar asignaciones de cursos
    public function saveCourseAssignments(Request $request, $id)
    {
        $project = Project::findOrFail($id);
        $project->courses()->sync($request->courses);

        return redirect()->route('admin.proyectos.index')->with('success', 'Cursos asignados con éxito.');
    }

    // Eliminar un proyecto
    public function destroyProject($id)
    {
        $project = Project::findOrFail($id);
        $project->delete();

        return redirect()->route('admin.proyectos.index')->with('success', 'Proyecto eliminado con éxito.');
    }

    // Eliminar un estudiante asignado
    public function removeStudent($project_id, $student_id)
    {
        $project = Project::findOrFail($project_id);
        $project->students()->detach($student_id);

        return redirect()->back()->with('success', 'Estudiante retirado del proyecto con éxito.');
    }

    // Eliminar un curso asignado
    public function removeCourse($project_id, $course_id)
    {
        $project = Project::findOrFail($project_id);
        $project->courses()->detach($course_id);

        return redirect()->back()->with('success', 'Curso retirado del proyecto con éxito.');
    }
    //Administradores
    // Mostrar lista de administradores
    public function viewAdministrators()
    {
        $administrators = User::where('role_id', 2)->with('projects')->get(); // Obtener administradores con sus proyectos
        return view('admin.administradores.index', compact('administrators'));
    }

    // Mostrar formulario de creación de administrador
    public function createAdministrator()
    {
        $projects = Project::all(); // Obtener todos los proyectos para asignación
        return view('admin.administradores.create', compact('projects'));
    }

    // Guardar nuevo administrador
    public function storeAdministrator(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:8|confirmed',
            'project_id' => 'required|exists:projects,id', // Validar que el proyecto existe
        ]);

        // Crear nuevo usuario administrador
        $administrator = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'role_id' => 2,
        ]);

        // Asignar un único proyecto al administrador
        $administrator->projects()->sync([$request->project_id]);

        return redirect()->route('admin.administradores.index')->with('success', 'Administrador creado exitosamente.');
    }

    // Mostrar formulario de edición de administrador
    public function editAdministrator($id)
    {
        $administrator = User::where('role_id', 2)->with('projects')->findOrFail($id);
        $projects = Project::all();
        $assignedProjectId = $administrator->projects->first() ? $administrator->projects->first()->id : null; // Obtener el ID del proyecto asignado
        return view('admin.administradores.edit', compact('administrator', 'projects', 'assignedProjectId'));
    }

    // Actualizar información de administrador
    public function updateAdministrator(Request $request, $id)
    {
        $administrator = User::where('role_id', 2)->findOrFail($id);

        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users,email,' . $administrator->id,
            'password' => 'nullable|string|min:8|confirmed',
            'project_id' => 'required|exists:projects,id', // Validar que el proyecto existe
        ]);

        $administrator->name = $request->name;
        $administrator->email = $request->email;

        // Solo actualizar contraseña si se proporciona una nueva
        if ($request->filled('password')) {
            $administrator->password = Hash::make($request->password);
        }

        $administrator->save();

        // Actualizar el único proyecto asignado
        $administrator->projects()->sync([$request->project_id]);

        return redirect()->route('admin.administradores.index')->with('success', 'Administrador actualizado exitosamente.');
    }

    // Eliminar administrador
    public function destroyAdministrator($id)
    {
        $administrator = User::where('role_id', 2)->findOrFail($id);
        $administrator->delete();

        return redirect()->route('admin.administradores.index')->with('success', 'Administrador eliminado exitosamente.');
    }



    // Vista de alumnos
    // Mostrar lista de alumnos
    public function viewStudents()
    {
        $students = Student::with('courses', 'user')->get(); // Obtener alumnos con sus cursos y usuarios
        return view('admin.alumnos.index', compact('students'));
    }

    // Mostrar formulario de creación de alumno
    public function createStudent()
    {
        $courses = Course::all(); // Obtener todos los cursos para asignación
        return view('admin.alumnos.create', compact('courses'));
    }

    // Guardar nuevo alumno
    public function storeStudent(Request $request)
    {
        // Validar los datos del formulario
        $validated = $request->validate([
            'first_name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:8|confirmed',
            'courses' => 'array',
            'courses.*' => 'exists:courses,id',
        ]);

        try {
            // Iniciar una transacción de base de datos
            DB::beginTransaction();

            // Crear nuevo estudiante
            $student = Student::create([
                'first_name' => $request->first_name, // No aplicar strtolower
                'last_name' => $request->last_name, // No aplicar strtolower
            ]);

            // Crear nuevo usuario para el alumno
            $user = User::create([
                'name' => $request->first_name . ' ' . $request->last_name,
                'email' => $request->email,
                'password' => Hash::make($request->password), // Hash de la contraseña
                'role_id' => 3,
                'student_id' => $student->id, // Asignar el student_id aquí
            ]);

            // Asignar cursos al alumno
            $student->courses()->sync($request->courses);

            // Confirmar la transacción
            DB::commit();

            return redirect()->route('admin.alumnos.index')->with('success', 'Alumno creado exitosamente.');
        } catch (\Exception $e) {
            // Deshacer la transacción en caso de error
            DB::rollBack();

            return redirect()->route('admin.alumnos.create')->withErrors('Error al crear el alumno.');
        }
    }

    // Mostrar formulario de edición de alumno
    public function editStudent($id)
    {
        $student = Student::with('courses', 'user')->findOrFail($id); // Cargar usuario y cursos
        $courses = Course::all();
        return view('admin.alumnos.edit', compact('student', 'courses'));
    }

    // Actualizar información de alumno
    public function updateStudent(Request $request, $id)
    {
        $student = Student::findOrFail($id);
        $user = $student->user; // Obtener el usuario relacionado

        $request->validate([
            'first_name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users,email,' . $user->id,
            'password' => 'nullable|string|min:8|confirmed',
            'courses' => 'array',
            'courses.*' => 'exists:courses,id',
        ]);

        // Actualizar datos del estudiante
        $student->first_name = $request->first_name; // No aplicar strtolower
        $student->last_name = $request->last_name; // No aplicar strtolower
        $student->save();

        // Actualizar datos del usuario
        $user->name = $request->first_name . ' ' . $request->last_name;
        $user->email = $request->email;

        // Actualizar contraseña solo si se proporciona una nueva
        if ($request->filled('password')) {
            $user->password = Hash::make($request->password); // Hash de la nueva contraseña
        }

        $user->save();

        // Actualizar cursos asignados
        $student->courses()->sync($request->courses);

        return redirect()->route('admin.alumnos.index')->with('success', 'Alumno actualizado exitosamente.');
    }

    // Eliminar alumno
    public function destroyStudent($id)
    {
        $student = Student::with('user')->findOrFail($id);
        $user = $student->user; // Obtener el usuario relacionado

        // Eliminar usuario y estudiante
        if ($user) {
            $user->delete(); // Asegurarse de eliminar el usuario relacionado
        }
        $student->delete();

        return redirect()->route('admin.alumnos.index')->with('success', 'Alumno eliminado exitosamente.');
    }

    //Cursos
    // Mostrar lista de cursos
    public function viewCourses()
    {
        $courses = Course::all(); // Obtener todos los cursos
        return view('admin.cursos.index', compact('courses'));
    }

    // Mostrar formulario de creación de curso
    public function createCourse()
    {
        return view('admin.cursos.create');
    }

    // Guardar nuevo curso
    public function storeCourse(Request $request)
    {
        // Validar los datos del formulario
        $request->validate([
            'name' => 'required|string|max:255|unique:courses,name',
        ]);

        // Crear nuevo curso
        Course::create([
            'name' => $request->input('name'), // Asegúrate de que el campo 'name' está presente
        ]);

        return redirect()->route('admin.cursos.index')->with('success', 'Curso creado exitosamente.');
    }

    // Mostrar formulario de edición de curso
    public function editCourse($id)
    {
        $course = Course::findOrFail($id); // Obtener el curso a editar
        return view('admin.cursos.edit', compact('course'));
    }

    // Actualizar curso
    public function updateCourse(Request $request, $id)
    {
        $course = Course::findOrFail($id); // Obtener el curso a actualizar

        // Validar los datos del formulario
        $request->validate([
            'name' => 'required|string|max:255|unique:courses,name,' . $course->id,
        ]);

        // Actualizar curso
        $course->update([
            'name' => $request->name,
        ]);

        return redirect()->route('admin.cursos.index')->with('success', 'Curso actualizado exitosamente.');
    }

    // Eliminar curso
    public function destroyCourse($id)
    {
        $course = Course::findOrFail($id); // Obtener el curso a eliminar
        $course->delete();

        return redirect()->route('admin.cursos.index')->with('success', 'Curso eliminado exitosamente.');
    }

}
