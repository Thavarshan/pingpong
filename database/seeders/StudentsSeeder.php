<?php

namespace Database\Seeders;

use App\Models\Student;
use Illuminate\Database\Seeder;

class StudentsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $students = json_decode(file_get_contents(
            resource_path('data/students.json')
        ), true);

        foreach ($students as $student) {
            Student::create([
                'name' => $student['name'],
                'email' => $student['email'],
                'birthday' => $student['birthday'],
            ]);
        }
    }
}
