<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class CourseSubject extends Model
{
    protected $fillable = ['course_id', 'subject_id'];

    public function course()
    {
        return $this->belongsTo(Course::class);
    }

    public function subject()
    {
        return $this->belongsTo(Subject::class);
    }
}
