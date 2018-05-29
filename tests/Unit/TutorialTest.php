<?php

namespace Tests\Unit;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class TutorialTest extends TestCase
{
    /**
     * A basic test example.
     *
     * @return void
     * @test
     */
    public function can_create_tutorial()
    {
        $data = [
            'content' => 'Test content'
        ];

        $tutorial = Tutorial::create($data);
        $this->assertEquals('Test content', $data['content']);

    }
}
