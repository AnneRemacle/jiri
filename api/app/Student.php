<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Student extends Model
{
    use SoftDeletes;

    /**
     * The attributes that should be mutated to dates.
     *
     * @var array
     */
    protected $dates = ['deleted_at'];

    protected $fillable = ["name","email","photo"];

    public function implementations(){
        return $this->hasMany("App\Implementation");
    }

    public function meetings(){
        return $this->hasMany("App\Meeting");
    }

    public function performances(){
        return $this->hasMany("App\Performance");
    }
}
