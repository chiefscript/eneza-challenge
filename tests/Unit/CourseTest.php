<?php

namespace Tests\Unit;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class CourseTest extends TestCase
{
    /**
     * A basic test example.
     *
     * @return void
     */
    /** @test */
    public function can_create_course()
    {
        $data = [
            'name' => 'Primary'
        ];

        $course = Course::create($data);
        $this->assertEquals('Primary', $data['name']);

    }

    public function can_delete_course()
    {
        $course = Course::find(1);
        $delete = $course->delete();

        $this->assertEquals(1, $delete);
    }
}
