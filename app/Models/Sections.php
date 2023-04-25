<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Spatie\Translatable\HasTranslations;
use App\Models\Teachers;

class Sections extends Model
{
    use HasTranslations;
    public $translatable = ['name_section'];
    protected $fillable=['name_section','grade_id','class_id'];

    protected $table = 'sections';
    public $timestamps = true;


    public function Class_Room()
    {
        return $this->belongsTo('App\Models\ClassRoom', 'class_id');
    }

    public function Teachers(){
        return $this->belongsToMany(Teachers::class , 'teachers_sections' , 'section_id' , 'teacher_id');
    }
}
