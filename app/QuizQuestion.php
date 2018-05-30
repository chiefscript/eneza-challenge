<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class QuizQuestion extends Model
{
    protected $fillable = ['quiz_id', 'question_id'];

    public function quiz()
    {
        return $this->belongsTo(Quiz::class);
    }

    public function question()
    {
        return $this->belongsTo(Question::class);
    }
}
