<?php

namespace App\Http\Controllers\Supervisor;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Supervisor;

class SupervisorsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('supervisor.setprofile');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, Supervisor $supervisor)
    {
        $image = $request->file('image');
        $imageName = time().'.'.$image->extension();
        $image->move(public_path('images'),$imageName);

        $supervisor->name = $request->name;
        $supervisor->designation = $request->designation;
        $supervisor->email = $request->email;
        $supervisor->area = $request->area;
        $supervisor->department = $request->department;
        $supervisor->linkedin = $request->linkedin;
        $supervisor->gscholar = $request->scholar;
        $supervisor->staffprofile = $request->staff;
        $supervisor->image = $imageName;
        $supervisor->save();
        return view('supervisor.supervisorprofile');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $supervisor = Supervisor::find($id);
        return view('supervisor.editprofile', compact('supervisor', 'id'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'designation' => 'required',
            'email' => 'required',
            'department' => 'required',
            'area' => 'required',
            'linkedin' => 'required',
            'scholar' => 'required',
            'staff' => 'required',
            'image' => 'required',
        ]);

        $image = $request->file('image');
        $imageName = time().'.'.$image->extension();
        $image->move(public_path('images'),$imageName);

        $supervisor = Supervisor::find($id);

        $supervisor->name = $request->name; 
        $supervisor->designation = $request->designation;
        $supervisor->email = $request->input('email');
        $supervisor->department = $request->department;
        $supervisor->area = $request->input('area');
        $supervisor->linkedin = $request->input('linkedin');
        $supervisor->gscholar = $request->input('scholar');
        $supervisor->staffprofile = $request->input('staff');
        $supervisor->image = $imageName;
        $supervisor->save();
        return view('supervisor.supervisorprofile');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
