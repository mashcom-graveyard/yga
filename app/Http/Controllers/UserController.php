<?php

namespace App\Http\Controllers;

use App\Province;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{


    public function index()
    {
        $provinces = Province::all();
        if (Auth::user()->access_level == 1) {
            $users = User::with('user_province')->paginate(25);
        } elseif (Auth::user()->access_level == 3) {
            $users = User::with('user_province')->where('province_id',Auth::user()->province_id)->paginate(25);
        } else {
            return "Access Denied";
        }


        return view('users', ['users' => $users, 'provinces' => $provinces]);
    }

    public function create()
    {
        $provinces = Province::all();
        return view('users.create', ['provinces' => $provinces]);
    }

    public function toggleStatus($id)
    {

        $user = User::find($id);

        $new_status = null;
        if ($user->is_active == 0) {
            $new_status = 1;
        }
        if ($user->is_active == 1) {
            $new_status = 0;
        }

        $user->is_active = $new_status;

        if ($user->save()) {
            return redirect('/users')->with(['success' => 'User Account Status Updated Successfully']);
        }
        return back()->withErrors(['Error updating. Please try again']);
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:6',
            'province' => 'required|string',
            'access_level' => 'required'
        ]);


        $user = new User();
        $user->name = $request->name;
        $user->email = $request->email;
        $user->password = Hash::make($request->password);
        $user->province_id = $request->province;
        $user->access_level = $request->access_level;

        if ($user->save()) {
            return redirect('/users')->with(['success' => 'User Account Created Successfully']);
        }
        return back()->withErrors(['Error creating account.Please try again']);
    }


    public function changePassword(Request $request){


        $this->validate($request,[
            'password'=>'required|confirmed|min:6'
        ]);

        $user = User::find(Auth::user()->id);
        $user->password = Hash::make($request->password);
        if($user->save()){
            return redirect('/dashboard')->with('success','Password Updated successfully');
        }
        return back()->withErrors(['Password failed to update']);
    }
}
