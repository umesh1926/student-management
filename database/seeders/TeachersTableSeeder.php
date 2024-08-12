<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class TeachersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \App\Models\Teacher::create(['teacher_name' => 'Sujeet Chate']);
        \App\Models\Teacher::create(['teacher_name' => 'Pradip Jha']);
    }
}
