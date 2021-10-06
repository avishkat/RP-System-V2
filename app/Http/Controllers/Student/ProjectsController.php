<?php

namespace App\Http\Controllers\Student;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Project;
use App\User;
use App\ResearchArea;

class ProjectsController extends Controller
{
    private $value;

    public function __construct()
    {
        $this->middleware('auth');
    }

    //get selected database for the session
    public function getDatabase(Request $request){
        return $this->value = $request->session()->get('database');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // $arr['projects'] = Project::all();
        // return view('student.projectindex')->with($arr);
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
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request)
    {
        $database = $this->getDatabase($request);

        $project = Project::on($database)->where('id', $request->id)->first();
        return view('student.projectshow', compact('project','database'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
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
        //
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

    public function showSupProject(Request $request)
    {
        $supervisor = User::select('name')->where('id', $request->id)->first();

        $projects = Project::on($this->getDatabase($request))->where('supervisor', $supervisor->name)->get();
        return view('student.projectlist', ['projects' => $projects]);
    }

    public function showAreaProject(Request $request)
    {
        $area = ResearchArea::select('title')->where('id', $request->id)->first();

        $projects = Project::on($this->getDatabase($request))->where('area', $area->title)->get();
        return view('student.projectlistarea', ['projects' => $projects]);
    }
}
