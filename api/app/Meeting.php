<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Meeting extends Model
{
    use SoftDeletes;

    /**
     * The attributes that should be mutated to dates.
     *
     * @var array
     */
    protected $dates = ['deleted_at'];

    protected $fillable = ["general_evaluation"];

    public function user(){
        return $this->belongsTo("App\User");
    }

    public function scores(){
        return $this->hasMany("App\Score");
    }

    public function student(){
        return $this->belongsTo("App\Student");
    }

    public function event(){
        return $this->belongsTo("App\Event");
    }
}
