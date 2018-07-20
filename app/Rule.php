<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Rule extends Model
{

    public function sport_rule(){
        return $this->hasOne('App\Sport','id','sport_id');
    }
}
