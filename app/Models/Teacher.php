<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Student;

class Teacher extends Model
{
    use HasFactory;
    protected $fillable = ['teacher_name'];

    public function students()
    {
        return $this->hasMany(Student::class, 'class_teacher_id');
    }
}
