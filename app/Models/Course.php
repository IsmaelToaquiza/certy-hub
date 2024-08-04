<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Course extends Model
{
    use HasFactory;

    protected $table = 'courses';

    protected $fillable = [
        'name',
    ];

    // Relación con Student
    public function students()
    {
        return $this->belongsToMany(Student::class, 'student_course', 'course_id', 'student_id');
    }

    // Relación con Project
    public function projects(): BelongsToMany
    {
        return $this->belongsToMany(Project::class, 'proyectos_cursos', 'id_curso', 'id_proyecto');
    }
}
