<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Translatable\HasTranslations;

class Fees extends Model
{
    use HasFactory;
    use HasTranslations ;

    public $translatable = ['title'];
    protected $fillable = ['title', 'amount', 'grade_id', 'classroom_id', 'description', 'year'];

    public function grades(){
        return $this->belongsTo(Grade::class , 'grade_id');
    }

    public function classroom(){
        return $this->belongsTo(ClassRoom::class , 'classroom_id');
    }
}
