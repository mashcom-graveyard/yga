<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Province;
use App\Sport;
use App\Member;
class ReportsController extends Controller
{
    public function master(){
        return view('report.index');
    }

    public function getList(){
    
    	return view('report.list');
    }
}
