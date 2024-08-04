<?php

namespace App\Http\Controllers;


use App\Models\Course;
use App\Models\User;
use App\Models\Student;
use App\Http\Controllers\CourseController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Auth;
use setasign\Fpdi\Fpdi;


class StudentController extends Controller
{
    public function dashboard()
    {
        return view('student.dashboard');
    }

    public function cursosIndex()
    {
        // Obtener el estudiante autenticado
        $student = Auth::user()->student;

        // Obtener los cursos relacionados
        $courses = $student->courses;

        return view('student.cursos.index', compact('courses'));
    }

    public function viewCertificado($courseId)
    {
        $student = Auth::user()->student;
        $course = Course::findOrFail($courseId);
    
        // Verifica si el estudiante está inscrito en el curso
        if (!$student->courses->contains($courseId)) {
            return redirect()->route('student.cursos.index')->withErrors('No tienes acceso a este curso.');
        }
    
        // Cargar la plantilla
        $templatePath = storage_path('app/public/certificates/cer_.png'); // Asegúrate de que el archivo exista en esta ubicación
    
        // Verificar si la plantilla existe
        if (!file_exists($templatePath)) {
            return redirect()->route('student.cursos.index')->withErrors('La plantilla de certificado no se encontró.');
        }
    
        // Crear una instancia de FPDI
        $pdf = new Fpdi();
        $pdf->AddPage();
        $pdf->SetFont('Arial', 'B', 16);
    
        // Usar la imagen como fondo
        $pdf->Image($templatePath, 0, 0, 210, 297); // Cambiar las dimensiones según sea necesario
    
        // Añadir texto al certificado
        $pdf->SetXY(50, 100);
        $pdf->Write(0, 'Certificado de Finalización');
    
        $pdf->SetXY(50, 110);
        $pdf->Write(0, $student->first_name . ' ' . $student->last_name);
    
        $pdf->SetXY(50, 120);
        $pdf->Write(0, 'Curso: ' . $course->name);
    
        // Salida directa al navegador
        return response()->streamDownload(
            fn () => $pdf->Output('I', 'certificado_' . $student->id . '_' . $course->id . '.pdf'),
            'certificado_' . $student->id . '_' . $course->id . '.pdf'
        );
    }
}