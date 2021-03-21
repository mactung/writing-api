<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Question extends Model
{
    //
    protected $fillable = [
        'title', 'description', 'level',
    ];
    public function posts()
    {
        return $this->hasMany('App\Models\Post', 'question_id', 'id');
    }
}
