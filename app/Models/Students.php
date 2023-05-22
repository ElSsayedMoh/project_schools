<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Translatable\HasTranslations;
use Illuminate\Database\Eloquent\SoftDeletes;

class Students extends Model
{
    use HasFactory;
    use HasTranslations;
    use SoftDeletes ;
    public $translatable = ['name'];
    protected $guarded =[];

    public function genders()
    {
        return $this->belongsTo('App\Models\Genders', 'gender_id');
    }

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

    public function nationality()
    {
        return $this->belongsTo('App\Models\Nationalities', 'nationalitie_id');
    }

    public function parents()
    {
        return $this->belongsTo('App\Models\Parents', 'parent_id');
    }

    public function images()
    {
        return $this->morphMany(Image::class, 'imageable');
    }

    public function student_account()
    {
        return $this->hasMany('App\Models\StudentAccount', 'student_id');
    }
}
