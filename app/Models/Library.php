<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Library extends Model
{
    use HasFactory;
    protected $guarded = [];

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
}
