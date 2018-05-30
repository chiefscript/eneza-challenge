<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Subject extends Model
{
    use SoftDeletes;

    protected $fillable = ['name'];

    public function tutorials()
    {
        return $this->hasMany(SubjectTutorial::class);
    }
}
