<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class SubjectQuiz extends Model
{
    protected $fillable = ['subject_id', 'quiz_id'];

    public function subject()
    {
        return $this->belongsTo(Subject::class);
    }

    public function quiz()
    {
        return $this->belongsTo(Quiz::class);
    }
}
