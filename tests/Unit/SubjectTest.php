<?php

namespace Tests\Unit;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class SubjectTest extends TestCase
{
    /**
     * A basic test example.
     *
     * @return void
     * @test
     */
    public function can_create_subject()
    {
        $data = [
            'name' => 'Mathematics'
        ];

        $subject = Subject::create($data);
        $this->assertEquals('Mathematics', $data['name']);

    }
}
