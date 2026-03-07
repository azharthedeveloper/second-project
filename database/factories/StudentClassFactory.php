<?php

namespace Database\Factories;

use App\Models\Classes;
use App\Models\Student;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\StudentClass>
 */
class StudentClassFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'student_id'  => Student::factory(),
            'class_id'    => Classes::factory(),
            'enrolled_at' => fake()->dateTimeBetween('-1 year', 'now'),
        ];
    }
}
