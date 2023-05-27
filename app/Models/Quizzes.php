<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Translatable\HasTranslations;

class Quizzes extends Model
{
    use HasFactory;
    use HasTranslations;

    protected $guarded = [];
    public $translatable = ['name'];
    
    public function grades()
    {
        return $this->belongsTo('App\Models\Grade', 'grade_id');
    }

    public function class_rooms()
    {
        return $this->belongsTo('App\Models\ClassRoom', 'classroom_id');
    }

    public function sections()
    {
        return $this->belongsTo('App\Models\Sections', 'section_id');
    }

    public function teacher()
    {
        return $this->belongsTo('App\Models\Teachers', 'teacher_id');
    }

    public function subjects()
    {
        return $this->belongsTo('App\Models\Subject', 'subject_id');
    }
}
