<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    //
    protected $fillable = [
        'user_id', 'question_id', 'content',
    ];
    protected $table = 'posts';

    public function user()
    {
        return $this->belongsTo('App\Models\User', 'user_id');
    }
    public function question()
    {
        return $this->belongsTo('App\Models\Question', 'question_id');
    }
}
