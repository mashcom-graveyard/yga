<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Designation extends Model
{
    public $timestamps =false;

    public function designation_members(){
        return $this->hasMany('App\Member','designation','id');
    }
}
