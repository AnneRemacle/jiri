<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Event extends Model
{
    use SoftDeletes;

    protected $dates = ['deleted_at'];

    protected $fillable = ["course_name", "academic_year", "exam_session"];

    public function user(){
        return $this->belongsTo("App\User");
    }
}
