<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class StudentsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \App\Models\Student::create([
            'student_name' => 'Vikas',
            'class_teacher_id' => 1,
            'class' => '10th Grade',
            'admission_date' => now(),
            'yearly_fees' => 1500.00
        ]);
    
        \App\Models\Student::create([
            'student_name' => 'Nilesh',
            'class_teacher_id' => 2,
            'class' => '11th Grade',
            'admission_date' => now(),
            'yearly_fees' => 1600.00
        ]);
    }
}
