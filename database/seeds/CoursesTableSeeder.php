<?php

use Illuminate\Database\Seeder;

class CoursesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $courses = ['Primary', 'Secondary', 'Level 1', 'Level 2', 'Beginner', 'Advanced'];

        foreach ($courses as $course) {
            \App\Course::firstOrCreate(['name' => $course]);
        }
    }
}
