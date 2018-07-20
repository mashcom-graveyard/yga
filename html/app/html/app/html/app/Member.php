<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Member extends Model
{
    function member_designation(){
        return $this->hasOne('App\Designation','id','designation');
    }

    function member_province(){
        return $this->hasOne('App\Province','id','province');
    }
}
