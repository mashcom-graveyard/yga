<?php

namespace App\Http\Controllers;

use App\Member;
use App\Meal;
use App\Venue;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class MealController extends Controller
{
 
  public function index(){
    
    $year = date("Y");
    $month = date("m");
    $date = date("d");
    $filter=false;
    if(isset($_GET['year']) && isset($_GET['month']) && isset($_GET['day'])){
      $year = $_GET['year'];
      $month= $_GET['month'];
      $date = $_GET['day'];
      $filter = "Filter for $date/$month/$year";
    }
    $meals = \DB::select("
                  SELECT
                    meals.venue_id,
                    meal_types.name as `meal_type`,
                    venues.NAME AS venue,
                    count(*) AS total 
                  FROM
                    meals
                    INNER JOIN venues ON meals.venue_id = venues.id 
                    INNER JOIN meal_types ON meals.meal_id = meal_types.id
                  WHERE
                    YEAR ( meals.created_at ) = ? 
                    AND MONTH ( meals.created_at ) = ? 
                    AND DAY ( meals.created_at )=? 
                  GROUP BY
                     `meal_type`,meals.venue_id,venue 
                  ORDER BY
                    total DESC
    ",array($year,$month,$date));
    
    $breakfast = Meal::whereMealId(1)->count();
    $lunch = Meal::whereMealId(2)->count();
    $supper= Meal::whereMealId(3)->count();
    
    return view("meal.index",array("meals"=>collect($meals),"breakfast"=>$breakfast,"lunch"=>$lunch,"supper"=>$supper,"filter"=>$filter));
  }
 
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