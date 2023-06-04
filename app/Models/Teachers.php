<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Translatable\HasTranslations;
use App\Models\Sections;
use Illuminate\Foundation\Auth\User as Authenticatable;

class Teachers extends Authenticatable
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
        return $this->belongsToMany(Sections::class , 'teachers_sections' , 'teacher_id', 'section_id' );
    }

}
