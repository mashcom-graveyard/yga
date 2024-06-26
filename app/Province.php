<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Province extends Model
{
    public $timestamps =false;

    public function province_members(){
        return $this->hasMany('App\Member','province','id');
    }

    public function province_member_count(){
        return $this->province_members()->count();
    }
}
