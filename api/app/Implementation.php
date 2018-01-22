<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Implementation extends Model
{
    use SoftDeletes;

    /**
     * The attributes that should be mutated to dates.
     *
     * @var array
     */
    protected $dates = ['deleted_at'];

    protected $fillable = ["url_repo", "url_project"];

    public function project(){
        return $this->belongsTo("App\Project");
    }

    public function event(){
        return $this->belongsTo("App\Event");
    }

    public function student(){
        return $this->belongsTo("App\Student");
    }
}
