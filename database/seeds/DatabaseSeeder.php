<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use App\Course;
use App\Subject;
use App\Tutorial;
use App\Quiz;
use App\Question;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        DB::statement('SET FOREIGN_KEY_CHECKS = 0');

        Course::truncate();
        Subject::truncate();
        Tutorial::truncate();
        Quiz::truncate();
        Question::truncate();

         $this->call([
             CoursesTableSeeder::class,
             SubjectsTableSeeder::class,
             TutorialsTableSeeder::class,
             QuizzesTableSeeder::class,
             QuestionsTableSeeder::class
         ]);

        DB::statement('SET FOREIGN_KEY_CHECKS = 1');
    }
}
