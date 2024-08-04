<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Student;
use App\Models\Course;
use setasign\Fpdi\Fpdi;

class CertificateController extends Controller
{
    public function generateCertificate($studentId, $courseId)
    {
        // Obtener los datos del estudiante y del curso
        $student = Student::findOrFail($studentId);
        $course = Course::findOrFail($courseId);

        // Crear una instancia de FPDI
        $pdf = new Fpdi();
        $pdf->AddPage();
        $pdf->SetFont('Arial', 'B', 16);

        // Establecer la ubicación de la plantilla de certificado
        $pdf->setSourceFile(storage_path('app/templates/certificate_template.pdf'));

        // Importar la primera página de la plantilla
        $tplIdx = $pdf->importPage(1);

        // Usar la plantilla
        $pdf->useTemplate($tplIdx);

        // Agregar contenido al PDF
        $pdf->SetXY(50, 60);
        $pdf->Write(0, 'Certificado');
        $pdf->Ln(20);
        $pdf->Write(0, 'Alumno: ' . $student->first_name . ' ' . $student->last_name);
        $pdf->Ln(10);
        $pdf->Write(0, 'Curso: ' . $course->name);

        // Salida del PDF
        return response($pdf->Output('S'))->header('Content-Type', 'application/pdf');
    }
}
