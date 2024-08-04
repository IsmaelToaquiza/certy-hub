<?php

use App\Http\Controllers\AdminPrinController;
use App\Http\Controllers\ProjectAdminController;
use App\Http\Controllers\StudentController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\CertificateController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

// Ruta para Admin Principal
// routes/web.php

// routes/web.php

Route::middleware(['auth', 'adminprin'])->group(function () {
    //PROYECTOS
    Route::get('admin/dashboard', [AdminPrinController::class, 'index'])->name('admin.dashboard');
    Route::get('admin/proyectos', [AdminPrinController::class, 'viewProjects'])->name('admin.proyectos.index');
    Route::get('admin/proyectos/create', [AdminPrinController::class, 'createProject'])->name('admin.proyectos.create');
    Route::post('admin/proyectos', [AdminPrinController::class, 'storeProject'])->name('admin.proyectos.store');
    Route::get('admin/proyectos/{id}/edit', [AdminPrinController::class, 'editProject'])->name('admin.proyectos.edit');
    Route::put('admin/proyectos/{id}', [AdminPrinController::class, 'updateProject'])->name('admin.proyectos.update');
    Route::delete('admin/proyectos/{id}', [AdminPrinController::class, 'destroyProject'])->name('admin.proyectos.destroy');

    Route::get('admin/proyectos/{id}/assign-students', [AdminPrinController::class, 'assignStudents'])->name('admin.proyectos.assign_students');
    Route::post('admin/proyectos/{id}/assign-students', [AdminPrinController::class, 'saveStudentAssignments'])->name('admin.proyectos.students.assign');
    Route::delete('admin/proyectos/{project_id}/remove-student/{student_id}', [AdminPrinController::class, 'removeStudent'])->name('admin.proyectos.students.remove');

    Route::get('admin/proyectos/{id}/assign-courses', [AdminPrinController::class, 'assignCourses'])->name('admin.proyectos.assign_courses');
    Route::post('admin/proyectos/{id}/assign-courses', [AdminPrinController::class, 'saveCourseAssignments'])->name('admin.proyectos.courses.assign');
    Route::delete('admin/proyectos/{project_id}/remove-course/{course_id}', [AdminPrinController::class, 'removeCourse'])->name('admin.proyectos.courses.remove');
    //Administradores
    Route::get('admin/administradores', [AdminPrinController::class, 'viewAdministrators'])->name('admin.administradores.index');
    Route::get('admin/administradores/create', [AdminPrinController::class, 'createAdministrator'])->name('admin.administradores.create');
    Route::post('admin/administradores/store', [AdminPrinController::class, 'storeAdministrator'])->name('admin.administradores.store');
    Route::get('admin/administradores/{id}/edit', [AdminPrinController::class, 'editAdministrator'])->name('admin.administradores.edit');
    Route::put('admin/administradores/{id}', [AdminPrinController::class, 'updateAdministrator'])->name('admin.administradores.update');
    Route::delete('admin/administradores/{id}', [AdminPrinController::class, 'destroyAdministrator'])->name('admin.administradores.destroy');

    //Alumnos
    Route::get('admin/alumnos', [AdminPrinController::class, 'viewStudents'])->name('admin.alumnos.index');
    Route::get('admin/alumnos/create', [AdminPrinController::class, 'createStudent'])->name('admin.alumnos.create');
    Route::post('admin/alumnos', [AdminPrinController::class, 'storeStudent'])->name('admin.alumnos.store');
    Route::get('admin/alumnos/{id}/edit', [AdminPrinController::class, 'editStudent'])->name('admin.alumnos.edit');
    Route::put('admin/alumnos/{id}', [AdminPrinController::class, 'updateStudent'])->name('admin.alumnos.update');
    Route::delete('admin/alumnos/{id}', [AdminPrinController::class, 'destroyStudent'])->name('admin.alumnos.destroy');

    //Cursos
    Route::get('admin/cursos', [AdminPrinController::class, 'viewCourses'])->name('admin.cursos.index');
    Route::get('admin/cursos/create', [AdminPrinController::class, 'createCourse'])->name('admin.cursos.create');
    Route::post('admin/cursos', [AdminPrinController::class, 'storeCourse'])->name('admin.cursos.store');
    Route::get('admin/cursos/{id}/edit', [AdminPrinController::class, 'editCourse'])->name('admin.cursos.edit');
    Route::put('admin/cursos/{id}', [AdminPrinController::class, 'updateCourse'])->name('admin.cursos.update');
    Route::delete('admin/cursos/{id}', [AdminPrinController::class, 'destroyCourse'])->name('admin.cursos.destroy');
});

// Ruta para Administrador de Proyecto

Route::middleware(['auth', 'adminproy'])->group(function () {
    // Rutas para Alumnos
    Route::get('adminproy/dashboard', [ProjectAdminController::class, 'index'])->name('adminproy.dashboard');

    // Alumnos
    Route::get('alumnos', [ProjectAdminController::class, 'viewStudents'])->name('adminproy.alumnos.index');
    Route::get('alumnos/create', [ProjectAdminController::class, 'createStudent'])->name('adminproy.alumnos.create');
    Route::post('alumnos/store', [ProjectAdminController::class, 'storeStudent'])->name('adminproy.alumnos.store');
    Route::get('alumnos/{id}/edit', [ProjectAdminController::class, 'editStudent'])->name('adminproy.alumnos.edit');
    Route::put('alumnos/{id}', [ProjectAdminController::class, 'updateStudent'])->name('adminproy.alumnos.update');
    Route::delete('alumnos/{id}', [ProjectAdminController::class, 'destroyStudent'])->name('adminproy.alumnos.destroy');

    // Cursos
    Route::get('cursos', [ProjectAdminController::class, 'viewCourses'])->name('adminproy.cursos.index');
    Route::get('cursos/{id}/edit', [ProjectAdminController::class, 'editCourse'])->name('adminproy.cursos.edit');
    Route::put('cursos/{id}', [ProjectAdminController::class, 'updateCourse'])->name('adminproy.cursos.update');
});

// Ruta para Alumno
Route::middleware(['auth', 'student'])->group(function () {
    Route::get('/student/dashboard', [StudentController::class, 'dashboard'])->name('student.dashboard');
    Route::get('/student/cursos', [StudentController::class, 'cursosIndex'])->name('student.cursos.index');
    Route::get('/certificado/ver/{courseId}', [StudentController::class, 'viewCertificado'])->name('student.certificado.ver');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__ . '/auth.php';
