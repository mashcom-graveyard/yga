<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Designation;
use App\Member;
use App\Sport;
use App\Province;
use App\Venue;
use App\Rule;
use App\Category;
use App\Zone;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('home');
    }

    public function dashboard()
    {


        $member_count = Member::count();

        $allocations_count = Rule::count();
        $designation_count = Designation::count();
        $province_count = Province::count();
        $venue_count = Venue::count();
        $sport_count = Sport::count();


        return view('home', [
            'member_count' => $member_count,
            'designation_count' => $designation_count,
            'province_count' => $province_count,
            'venue_count' => $venue_count,
            'sport_count' => $sport_count,
            'allocations_count' => $allocations_count
        ]);
    }


    public function update(Request $request)
    {


        $TargetModel = null;
        $validate = null;
        switch ($request->section) {
            case "sport":
                $validate = "sports";
                $TargetModel = Sport::find($request->id);
                break;


            case "designation":
                $validate = "designations";
                $TargetModel = Designation::find($request->id);
                break;

            case "province":
                $validate = "provinces";
                $TargetModel = Province::find($request->id);
                break;
            case "category":
                $validate = "categories";
                $TargetModel = Category::find($request->id);
                break;

            case "venue":
                $validate = "venues";
                $TargetModel = Venue::find($request->id);
                break;
            case "zone":
                $validate = "zones";
                $TargetModel = Zone::find($request->id);
                break;
        }
        $request->validate([
            'name' => "required|unique:$validate",
        ]);

        $TargetModel->name = $request->name;

        if ($TargetModel->save()) {
            return back()->with(['success', 'Update Successful']);

        }
        return back()->withErrors(['Error capturing update']);
    }

    public function ruleExists($sport_id, $category_id)
    {

        return Rule::where('sport_id', $sport_id)->where('category', $category_id)->exists();
    }

    public function getRule($sport_id, $category_id)
    {
        return Rule::where('sport_id', $sport_id)->where('category', $category_id)->toJson();
    }

    public function saveRules(Request $request)
    {
        if ($this->ruleExists($request->sport, $request->category)) {
            return back()->withErrors(['Rule for ' . Category::find($request->category)->name . " " . Sport::find($request->sport)->name . ' already exists']);
        }

        $male_rules_json = [
            'venue' => $request->male_venue,
            'village' => $request->male_village,
        ];
        $female_rules_json = [
            'venue' => $request->female_venue,
            'village' => $request->female_village,
        ];


        $rules = new Rule();
        $rules->category = $request->category;
        $rules->sport_id = $request->sport;
        $rules->male = json_encode($male_rules_json);
        $rules->female = json_encode($female_rules_json);
        if ($rules->save()) {
            return back()->with('success', 'Access Rule Captured Successfully');

        }
        return back()->withErrors(['Error capturing details']);
    }
}
