<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Designation;
use App\Zone;

class DesignationsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $designations = Designation::with('designation_members')->get();
        $zones = Zone::all();

        return view('designation.index', ['designations' => $designations, 'zones' => $zones]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {

    }

    public function zoneUpdate(Request $request)
    {

        $designation = Designation::find($request->id);
        if (isset($request->zone)) {
            $designation->zone_access = implode($request->zone, ",");
        } else {
            $designation->zone_access = '';
        }


        if ($designation->save()) {
            return back()->with('success', 'Designation Access Zone Successfully');

        }
        return back()->withErrors(['Error capturing access zone details']);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|unique:designations',
        ]);

        $designation = new Designation();
        $designation->name = $request->name;
        if ($designation->save()) {
            return back()->with(['success', 'designation Captured Successfully']);

        }
        return back()->withErrors(['Error capturing details']);
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
        //
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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
