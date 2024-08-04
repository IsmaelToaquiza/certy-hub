<?php

// app/Models/Project.php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Project extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'description',
    ];

    public function students()
    {
        return $this->belongsToMany(Student::class, 'project_student', 'project_id', 'student_id');
    }

    public function courses()
    {
        return $this->belongsToMany(Course::class, 'project_course', 'project_id', 'course_id');
    }
    public function users()
    {
        return $this->belongsToMany(User::class, 'project_user', 'project_id', 'user_id');
    }
}

