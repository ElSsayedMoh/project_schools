<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
// use App\Models\Students;

class Promotion extends Model
{
    use HasFactory;
    protected $guarded=[];

    public function student(){
        return $this->belongsTo(Students::class , 'student_id');
    }

    public function previous_grade(){
        return $this->belongsTo(Grade::class , 'from_grade');
    }

    public function previous_classroom(){
        return $this->belongsTo(ClassRoom::class , 'from_classroom');
    }

    public function previous_section(){
        return $this->belongsTo(Sections::class , 'from_section');
    }

    public function present_grade(){
        return $this->belongsTo(Grade::class , 'to_grade');
    }

    public function present_classroom(){
        return $this->belongsTo(ClassRoom::class , 'to_classroom');
    }

    public function present_section(){
        return $this->belongsTo(Sections::class , 'to_section');
    }


}
