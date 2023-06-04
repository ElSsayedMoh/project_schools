<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Translatable\HasTranslations;
use Illuminate\Foundation\Auth\User as Authenticatable;


class Parents extends Authenticatable
{
    use HasFactory;
    use HasTranslations;

    public $table = 'parents';
    public $translatable = ['name_father' , 'name_mother' , 'job_father' , 'job_mother'];
    protected $guarded = [];
    public $timestamps = true;
}
