<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class feeInvoice extends Model
{
    use HasFactory;
    protected $guarded = [];

    public function student(){
        return $this->belongsTo(Students::class , 'student_id');
    }

    public function fees(){
        return $this->belongsTo(Fees::class , 'fee_id');
    }

    public function grade(){
        return $this->belongsTo(Grade::class , 'grade_id');
    }

    public function classroom(){
        return $this->belongsTo(ClassRoom::class , 'classroom_id');
    }
}
