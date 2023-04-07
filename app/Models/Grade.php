<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\App;
use Spatie\Translatable\HasTranslations;

class Grade extends Model 
{
    use HasFactory;
    use HasTranslations;

    // public $translatedAttributes = ['name'];
    public $translatable = ['name'];

    protected $fillable = ['name', 'Notes'];
    protected $table = 'Grades';
    public $timestamp = true;

    public function ClassRoom(){
        return $this->hasMany(App\Models\ClassRoom::class);
    }

    public function Sections()
    {
        return $this->hasMany('App\Models\Sections', 'grade_id');
    }

}
