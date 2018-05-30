<?php

use Illuminate\Database\Seeder;

class QuestionsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \App\Question::insert([
            'question' => 'What is the largest continent in the world?',
            'choices' => 'America, Asia, Europe, Africa'
        ]);

        \App\Question::insert([
            'question' => 'Latitudes move which direction on a map?',
            'choices' => 'East to West, North to South'
        ]);

        \App\Question::insert([
            'question' => 'What is the fastest land animal?',
            'choices' => 'Jaguar, Leopard, Cheetah'
        ]);

        \App\Question::insert([
            'question' => 'The higher you go, the cooler it becomes?',
            'choices' => 'True, False'
        ]);

        \App\Question::insert([
            'question' => 'What is the largest planet in our galaxy?',
            'choices' => 'Earth, Saturn, Jupiter'
        ]);
    }
}
