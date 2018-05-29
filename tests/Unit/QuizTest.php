<?php

namespace Tests\Unit;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class QuizTest extends TestCase
{
    /**
     * A basic test example.
     *
     * @return void
     * @test
     */
    public function can_create_quiz()
    {
        $data = [
            'question' => 'Latitudes move which direction on a map?'
        ];

        $quiz = Quiz::create($data);
        $this->assertEquals('Latitudes move which direction on a map?', $data['question']);

    }
}
