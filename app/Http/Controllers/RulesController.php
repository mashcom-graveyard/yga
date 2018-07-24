<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Sport;
use App\Venue;
use App\Rule;
use App\Category;
use App\Designation;

class RulesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $sports = Sport::orderBy('name', 'ASC')->get();
        $venues = Venue::orderBy('name', 'ASC')->get();
        $rules = Rule::with('sport_rule')->get();
        $categories = Category::orderBy('name', 'ASC')->get();

        return view('rule.index', ['categories' => $categories, 'rules' => $rules, 'sports' => $sports, 'venues' => $venues]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $rule = Rule::find($id);
        $sports = Sport::orderBy('name', 'ASC')->get();
        $venues = Venue::orderBy('name', 'ASC')->get();
        $rules = Rule::with('sport_rule')->get();
        $categories = Category::orderBy('name', 'ASC')->get();

        return view('rule.edit', ['rule' => $rule, 'categories' => $categories, 'rules' => $rules, 'sports' => $sports, 'venues' => $venues]);
    }


    public function settings(){
        $designations = Designation::orderBy('name','ASC')->get();
        return view('rule.transport',['designations'=>$designations]);
    }
    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $male_rules_json = [
            'venue' => $request->male_venue,
            'village' => $request->male_village,
        ];
        $female_rules_json = [
            'venue' => $request->female_venue,
            'village' => $request->female_village,
        ];


        $rules = Rule::find($id);
        /* $rules->category = $request->category;
         $rules->sport_id = $request->sport;*/
        $rules->male = json_encode($male_rules_json);
        $rules->female = json_encode($female_rules_json);
        if ($rules->save()) {
            return back()->with('success', 'Allocation Captured Successfully');

        }
        return back()->withErrors(['Error capturing details']);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $rule = Rule::whereId($id)->first();
        if($rule->delete()){
            return back()->with('success','Record deleted successfully');
        }
        return back()->withErrors(['Record failed to delete']);
    }
}
