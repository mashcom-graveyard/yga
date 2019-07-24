<?php

namespace App\Http\Controllers;

use App\Member;
use App\Meal;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class MealController extends Controller
{
 
  public function store(Request $request){
    
    $request->validate([
            'member_id' => 'required|integer',
            'meal_id' => 'required|integer',
            'venue_id'=>'required|integer'
    ]);
    
    if($this->meal_exists($request->member_id,$request->meal_id)){
      return json_encode(array("status"=>false,"message"=>"meal already saved"));
    }
    
    $meal = new Meal();
    $meal->member_id = $request->member_id;
    $meal->meal_id = $request->meal_id;
    $meal->venue_id = $request->venue_id;
    if($meal->save()){
      return json_encode(array("status"=>true,"member_id"=>$request->member_id,"meal_id"=>$request->meal_id));
    }
    return json_encode(array("status"=>false,"message"=>"meal could not be captured"));
  }
  
  private function meal_exists($member_id,$meal_id){
    $meal = Meal::whereMemberId($member_id)->whereMealId($meal_id)->first();
    if($meal==null){
      return false;
    }
    return true;
  }
}