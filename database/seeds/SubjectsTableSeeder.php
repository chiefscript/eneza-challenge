<?php

use Illuminate\Database\Seeder;

class SubjectsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $subjects = ['English', 'Mathematics', 'Science', 'Social Studies', 'Swahili'];

        foreach ($subjects as $subject) {
            \App\Subject::firstOrCreate(['name' => $subject]);
        }
    }
}
