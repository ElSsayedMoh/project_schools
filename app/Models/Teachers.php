<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Translatable\HasTranslations;
use App\Models\Sections;


class Teachers extends Model
{
    use HasFactory;
    use HasTranslations;
    public $table = "teachers";
    protected $guarded = [];
    public $translatable = ['name' , 'address'];

    
    public function specializations()
    {
        return $this->belongsTo('App\Models\Specializations', 'specialization_id');
    }

    // علاقة بين المعلمين والانواع لجلب جنس المعلم
    public function genders()
    {
        return $this->belongsTo('App\Models\Genders', 'gender_id');
    }

    public function Sections(){
        return $this->belongsToMany(Sections::class , 'teachers_sections' , 'section_id' , 'teacher_id');
    }

}
