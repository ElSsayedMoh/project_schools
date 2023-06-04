<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Attendances extends Model
{
    use HasFactory;
    protected $guarded = [];

    public function students(){
        return $this->belongsTo(Students::class , 'student_id');
    }

    public function grade(){
        return $this->belongsTo(Grade::class , 'grade_id');
    }

    public function section(){
        return $this->belongsTo(Sections::class , 'section_id');
    }
}
