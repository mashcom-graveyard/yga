<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Venue;
use App\Sport;
use App\Rule;
use function MongoDB\BSON\toJSON;

class VenueController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        $venues = Venue::all();

        return view('venue.index', ['venues' => $venues]);
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|unique:venues',
        ]);

        $venues = new Venue();
        $venues->name = $request->name;
        if ($venues->save()) {
            return back()->with(['success', 'Access Rule Captured Successfully']);

        }
        return back()->withErrors(['Error capturing details']);
    }


    public function rules($id)
    {
        $sports = Sport::all();
        $venue = Venue::find($id);
        return view('venue_rules', ['sports' => $sports, 'venue' => $venue]);
    }

    public function saveRules(Request $request, $venue_id)
    {

        // dd($request->sport_allowed);
        //dd($request->sport_allowed->toJSON());
        $rules_json = [
            'sport_rule' => $request->sport_rule,
            'gender_rule' => $request->gender_rule,
            'sport_allowed_rule' => $request->sport_allowed
        ];

        //dd(json_encode($rules_json));
        $rules = Venue::find($venue_id);
        $rules->access_rules = json_encode($rules_json);
        //$rules->rules = json_encode($rules_json);
        if ($rules->save()) {
            return back()->with('success', 'Access Rule Captured Successfully');

        }
        return back()->withErrors(['Error capturing details']);
    }
}
