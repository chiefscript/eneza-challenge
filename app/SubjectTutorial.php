<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class SubjectTutorial extends Model
{
    protected $fillable = ['subject_id', 'tutorial_id'];

    public function subject()
    {
        return $this->belongsTo(Subject::class);
    }

    public function tutorial()
    {
        return $this->belongsTo(Tutorial::class);
    }
}
