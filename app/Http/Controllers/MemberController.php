<?php

namespace App\Http\Controllers;

use App\Designation;
use App\Member;
use App\Sport;
use App\Province;
use App\Zone;
use App\Jobs\GenerateAccreditationCards;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Intervention\Image\Facades\Image;

class MemberController extends Controller
{


    public function index()
    {

        $provinces = Province::all();


        if (!empty($_GET['q'])) {
            $members = $this->search($_GET['q']);
            return view('members', ['members' => $members, 'provinces' => $provinces]);

        }

        if (!empty($_GET['province_filter'])) {
            $province_id = $_GET['province_filter'];
            $members = Member::with('member_designation', 'member_sport', 'member_province')->where('province', $province_id)->orderBy('id', 'DESC')->paginate(30);

        } else {
            if (Auth::user()->access_level == 1) {

                $members = Member::with('member_designation', 'member_sport', 'member_province')->orderBy('id', 'DESC')->paginate(30);
            } else {
                $members = Member::with('member_designation', 'member_sport', 'member_province')->whereProvince(Auth::user()->province_id)->orderBy('id', 'DESC')->paginate(30);
            }

        }


        return view('members', ['members' => $members, 'provinces' => $provinces]);
    }


    public function search($search_value)
    {
        $columns = ['firstname', 'surname', 'national_id'];


        if (Auth::user()->access_level == 1) {
            $query = Member::with('member_designation', 'member_sport', 'member_province')->where('firstname', 'like', '%' . $search_value . '%')->orWhere('surname', 'like', '%' . $search_value . '%')->orWhere('national_id', 'like', '%' . $search_value . '%')->paginate(30);
        } else {
            $query = Member::with('member_designation', 'member_sport', 'member_province')->whereProvinceId(Auth::check()->province_id)->where('firstname', 'like', '%' . $search_value . '%')->orWhere('surname', 'like', '%' . $search_value . '%')->orWhere('national_id', 'like', '%' . $search_value . '%')->paginate(30);
        }

        return $query;
    }

    function create()
    {
        $designations = Designation::orderBy('name','ASC')->get();
        $provinces = Province::orderBy('name','ASC')->get();
        $sports = Sport::orderBy('name','ASC')->get();
        return view('welcome', ['designation' => $designations, 'provinces' => $provinces, 'sports' => $sports]);
    }


    function generatePass($id)
    {

        $member = Member::with('member_designation', 'member_province', 'member_sport')->whereId($id)->get();
        $zones = Zone::all();
        //$member = Member::with('member_designation', 'member_province','member_sport')->find($id);
        // dd($member);
        return view('passcard', ['members' => $member,'designation_zones'=>$zones]);
    }


    public function generateProvinceSportCards($province, $sport)
    {
        $zones = Zone::all();
        $member = Member::with('member_designation', 'member_province', 'member_sport')->whereProvince($province)->whereSport($sport)->get();
        return view('passcard', ['members' => $member,'designation_zones'=>$zones]);

    }

    public function destroy($id,Request $request)
    {


        $member = Member::whereProvince(Auth::user()->province_id)->whereId($id)->first();
        if($member->delete()){
            return back()->with('success','Record deleted successfully');
        }
        return back()->withErrors(['Record failed to delete']);
    }

    function show($id)
    {
        $member = Member::find($id);
        $provinces = Province::all();
        $sports = Sport::all();
        $designations = Designation::all();
        return view('single_member', ['member' => $member, 'designation' => $designations, 'provinces' => $provinces, 'sports' => $sports]);
    }

    function update(Request $request, $id)
    {
               $national_id = strtoupper(trim($request->national_id));
        $request->national_id = preg_replace("^\\s^", "", $national_id);
        $request->firstname = trim($request->firstname);
        $request->surname = trim($request->surname);
        $request->email = trim($request->email);
        $request->mobile = preg_replace("^\\s^", "", $request->mobile);

        $request->validate([
            'province' => 'required',
            'image' => 'nullable|mimes:jpeg,png,jpg,gif,svg|max:4048',
            'firstname' => array('required', 'regex:/^([a-zA-Z\' ]+)$/'),
            'surname' => array('required', 'regex:/^([a-zA-Z\' ]+)$/'),
            'designation' => 'required',
            'national_id' => array(
                'required',
                'unique:members,national_id,' . $request->id,
                'regex: [^\\d{2}-?\\d{6,7}-?[A-Za-z]{1}-?\\d{2}$]'
            ),
            'email' => 'nullable|email|unique:members,email,' . $request->id,
            'address' => 'max:255',
            'telephone' => 'nullable|numeric|digits_between:5,15',
            'mobile' => 'required|numeric|digits_between:6,16',
            'year'=>'required',
            'month'=>'required|digits_between:1,12',
            'day'=>'required|digits_between:1,31',
            'sport' => 'required',
            'gender' => 'required'

        ]);




        if ($request->image != null) {
            $imageName = sha1(time()) . '.' . $request->image->getClientOriginalExtension();
            $path = public_path('images/' . $imageName);
            $img = Image::make($request->image->getRealPath());
            $img->resize(300, null, function ($constraint) {
                $constraint->aspectRatio();
            });
            $img->save($path);
        }

        $date_of_birth = $request->year."-".$request->month."-".$request->day;

        $member = Member::find($id);

        $member->province = $request->province;
        if ($request->image != null) {
            $member->image = $imageName;
        }
        $member->firstname = ucfirst($request->firstname);
        $member->surname = ucfirst($request->surname);
        $member->designation = $request->designation;
        $member->national_id = $request->national_id;
        $member->email = $request->email;
        $member->address = $request->address;
        $member->telephone = $request->telephone;
        $member->mobile = $request->mobile;
        $member->dob = $date_of_birth;
        $member->sport = $request->sport;
        $member->gender = $request->gender;
        $member->theme = $request->theme;
        $member->barcode = $this->generateBarcodeNumber();


        if ($member->saveOrFail()) {
             GenerateAccreditationCards::dispatch($request->province,$request->sport)->delay(now()->addMinutes(5));
            return back()->with('success', 'Record Updated Successfully');

        }
        return back()->withErrors(['Error capturing details']);
    }

    function edit($id)
    {
        $member = Member::with('member_designation', 'member_sport', 'member_province')->find($id);
        $designations = Designation::all();
        $provinces = Province::all();
        $sports = Sport::all();
        return view('edit', ['member' => $member, 'designation' => $designations, 'provinces' => $provinces, 'sports' => $sports]);
    }

    function store(Request $request, $id = null)
    {
        $request->validate([
            'image' => 'required|mimes:jpeg,png,jpg,gif,svg|max:4048',
            'province' => 'required',
            'firstname' => array('required', 'regex:/^([a-zA-Z\' ]+)$/'),
            'surname' => array('required', 'regex:/^([a-zA-Z\' ]+)$/'),
            'designation' => 'required',
            'national_id' => array(
                'required',
                'unique:members',
                'regex: [^\\d{2}-?\\d{6,7}-?[A-Za-z]{1}-?\\d{2}$]'
            ),
            'email' => 'nullable|email|unique:members',
            'address' => 'required|max:255',
            'telephone' => 'nullable|numeric|digits_between:5,15',
            'mobile' => 'required|numeric|digits_between:6,16',
           'year'=>'required',
            'month'=>'required|digits_between:1,12',
            'day'=>'required|digits_between:1,31',
            'sport' => 'required',
            'gender' => 'required',

        ]);

        $imageName = sha1(time()) . '.' . $request->image->getClientOriginalExtension();
        $path = public_path('images/' . $imageName);
        $img = Image::make($request->image->getRealPath());
        $img->resize(300, null, function ($constraint) {
            $constraint->aspectRatio();
        });

        $img->save($path);

        $national_id = strtoupper(trim($request->national_id));
        $request->national_id = preg_replace("^\\s^", "", $national_id);
        $request->firstname = trim($request->firstname);
        $request->surname = trim($request->surname);
        $request->email = trim($request->email);
        $request->mobile = preg_replace("^\\s^", "", $request->mobile);

        $date_of_birth = $request->year."-".$request->month."-".$request->day;
        $member = new Member();

        $member->province = $request->province;
        $member->image = $imageName;
        $member->firstname = ucfirst($request->firstname);
        $member->surname = ucfirst($request->surname);
        $member->designation = $request->designation;
        $member->national_id = $request->national_id;
        $member->email = $request->email;
        $member->address = $request->address;
        $member->telephone = $request->telephone;
        $member->mobile = $request->mobile;
        $member->dob = $date_of_birth;
        $member->sport = $request->sport;
        $member->gender = $request->gender;
        $member->theme = $request->theme;
        $member->barcode = $this->generateBarcodeNumber();


        if ($member->saveOrFail()) {
            GenerateAccreditationCards::dispatch($request->province,$request->sport)->delay(now()->addMinutes(5));
            return back()->with('success', 'Details Captured Successfully');

        }
        return back()->withErrors(['Error capturing details']);
    }


    function generateBarcodeNumber()
    {
        $number = mt_rand(1000000000, 9999999999); // better than rand()

        // call the same function if the barcode exists already
        if ($this->barcodeNumberExists($number)) {
            return $this->generateBarcodeNumber();
        }

        // otherwise, it's valid and can be used
        return $number;
    }

    function barcodeNumberExists($number)
    {
        // query the database and return a boolean
        // for instance, it might look like this in Laravel
        return Member::whereBarcode($number)->exists();
    }

    function nationIdExists($id_num)
    {
        return Member::whereNationaId($id_num)->exists();
    }


}
