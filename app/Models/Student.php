<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Student extends Model
{
    use HasFactory;

    public function studentProfile(){
        return $this->hasOne(
            StudentProfile::class, // Related Model
            'student_id', // Foreign_id (Student Profile or Related Model)
            'id' // Local_id (Student Model / Current Model)
        );
    }

    public function classes(){
        return $this->belongsToMany(
            Classes::class,
            'student_classes',
            'student_id',
            'class_id'
        );
    }
}
