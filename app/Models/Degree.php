<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Degree extends Model
{
    use HasFactory;
    protected $guarded = [];
    public $timestamp = true;

    public function student(){
        return $this->belongsTo(Students::class, 'student_id');
    }

    public function quizze()
    {
        return $this->belongsTo('App\Models\Quizzes', 'quizzes_id');
    }
}
