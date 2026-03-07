<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class StudentProfile extends Model
{
    use HasFactory;
    
    public function student(){
        return $this->belongsTo(
            Student::class,  // Related Model
            'student_id',    // Foreign Key (apni table mein - student_profiles.student_id)
            'id'             // Owner Key (doosri table mein - students.id)
        );
    }
}
