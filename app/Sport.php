<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Sport extends Model
{
    public $timestamps =false;

    public function sport_members(){
    	return $this->hasMany('\App\Member','sport','id');
    }
}
