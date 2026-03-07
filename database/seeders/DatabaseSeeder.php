<?php

namespace Database\Seeders;

use App\Models\Classes;
use App\Models\Student;
use App\Models\StudentClass;
use App\Models\StudentProfile;
use App\Models\Teacher;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // 1. Pehle Teachers banao (5)
        $teachers = Teacher::factory(5)->create();

        // 2. Classes banao (10) — har class ko existing teacher milega
        $classes = Classes::factory(10)
            ->recycle($teachers)
            ->create();

        // 3. Students banao (20)
        $students = Student::factory(20)->create();

        // 4. Har student ka ek Profile banao (1:1)
        $students->each(function ($student) {
            StudentProfile::factory()->create([
                'student_id' => $student->id,
            ]);
        });

        // 5. Students ko Classes mein enroll karo (M:M) — StudentClass factory se
        $students->each(function ($student) use ($classes) {
            $randomClasses = $classes->random(rand(1, 3));

            $randomClasses->each(function ($class) use ($student) {
                // Duplicate enrollment check
                $alreadyEnrolled = StudentClass::where('student_id', $student->id)
                    ->where('class_id', $class->id)
                    ->exists();

                if (!$alreadyEnrolled) {
                    StudentClass::factory()->create([
                        'student_id' => $student->id,
                        'class_id'   => $class->id,
                    ]);
                }
            });
        });
    }
}
