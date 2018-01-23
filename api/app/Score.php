<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Score extends Model
{
    use SoftDeletes;

    /**
     * The attributes that should be mutated to dates.
     *
     * @var array
     */
    protected $dates = ['deleted_at'];

    protected $fillable = ["score","comment"];

    public function meeting(){
        return $this->belongsTo("App\Meeting");
    }

    public function implementation(){
        return $this->belongsTo("App\Implementation");
    }
}
