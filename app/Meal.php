<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Meal extends Model
{
   public function consumer(){
     return $this->hasOne('App\Member','id','member_id');
   }
  
  public function venue(){
     return $this->hasOne('App\Venue','id','venue_id');
  }
  
  

}
