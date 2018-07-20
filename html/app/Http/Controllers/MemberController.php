<?php

namespace App\Http\Controllers;

use App\Designation;
use App\Member;
use App\Province;
use Illuminate\Http\Request;

class MemberController extends Controller
{


    public function index()
    {
        if (!empty($_GET['province_filter'])) {
            $province_id = $_GET['province_filter'];
            $members = Member::with('member_designation', 'member_province')->where('province',$province_id)->paginate(30);

        } else {
            $members = Member::with('member_designation', 'member_province')->paginate(30);
        }

        $provinces = Province::all();

        return view('members', ['members' => $members, 'provinces' => $provinces]);
    }


    function create()
    {
        $designations = Designation::all();
        $provinces = Province::all();
        return view('welcome', ['designation' => $designations, 'provinces' => $provinces]);
    }

    function show($id)
    {
        $member = Member::find($id);
        $provinces = Province::all();
        $designations = Designation::all();
        return view('edit', ['member' => $member, 'designation' => $designations, 'provinces' => $provinces]);
    }

    function update(Request $request, $id)
    {

        $request->validate([
            'province' => 'required',
            'firstname' => array('required', 'regex:/^([a-zA-Z\' ]+)$/'),
            'surname' => array('required', 'regex:/^([a-zA-Z\' ]+)$/'),
            'designation' => 'required',
            'national_id' => array(
                'required',
                'regex: [^\\d{2}-?\\d{6,7}-?[A-Za-z]{1}-?\\d{2}$]'
            ),
            'email' => 'email:unique:members',
            'address' => 'required|max:255',
            'telephone' => 'max:25',
            'mobile' => 'max:25',
            'dob' => 'required|date',
            'sport' => 'required',
            'gender' => 'required',
            'theme' => 'required'

        ]);


        $member = Member::find($id);

        $member->province = $request->province;
        $member->firstname = $request->firstname;
        $member->surname = $request->surname;
        $member->designation = $request->designation;
        $member->national_id = $request->national_id;
        $member->email = $request->email;
        $member->address = $request->address;
        $member->telephone = $request->telephone;
        $member->mobile = $request->mobile;
        $member->dob = $request->dob;
        $member->sport = $request->sport;
        $member->gender = $request->gender;
        $member->theme = $request->theme;
        $member->barcode = $this->generateBarcodeNumber();


        if ($member->saveOrFail()) {
            return redirect('members')->with(['success', 'Details Captured Successfully']);

        }
        return back()->withErrors(['Error capturing details']);
    }

    function edit($id)
    {
        $member = Member::find($id);
        $designations = Designation::all();
        $provinces = Province::all();
        return view('edit', ['member' => $member, 'designation' => $designations, 'provinces' => $provinces]);
    }

    function store(Request $request, $id = null)
    {

        $request->validate([
            'province' => 'required',
            'firstname' => array('required', 'regex:/^([a-zA-Z\' ]+)$/'),
            'surname' => array('required', 'regex:/^([a-zA-Z\' ]+)$/'),
            'designation' => 'required',
            'national_id' => array(
                'required',
                'unique:members',
                'regex: [^\\d{2}-?\\d{6,7}-?[A-Za-z]{1}-?\\d{2}$]'
            ),
            'email' => 'email:unique:members',
            'address' => 'required|max:255',
            'telephone' => 'max:25',
            'mobile' => 'max:25',
            'dob' => 'required|date',
            'sport' => 'required',
            'gender' => 'required',
            'theme' => 'required'

        ]);


        $member = new Member();
        $member->province = $request->province;
        $member->firstname = $request->firstname;
        $member->surname = $request->surname;
        $member->designation = $request->designation;
        $member->national_id = $request->national_id;
        $member->email = $request->email;
        $member->address = $request->address;
        $member->telephone = $request->telephone;
        $member->mobile = $request->mobile;
        $member->dob = $request->dob;
        $member->sport = $request->sport;
        $member->gender = $request->gender;
        $member->theme = $request->theme;
        $member->barcode = $this->generateBarcodeNumber();


        if ($member->saveOrFail()) {
            return redirect('member')->with(['success', 'Details Captured Successfully']);

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
