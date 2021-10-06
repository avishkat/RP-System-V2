<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\ResearchArea;
use App\Project;
use App\Constraint;
use App\Supervisor;
use App\FinalizedProject;

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
    public function index(Request $request)
    {
        $arr['projects'] = FinalizedProject::on($this->getDatabase($request))->get();
        return view('admin.finalprojects')->with($arr);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.addproject');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, Project $project)
    {
        $projects = Project::on($this->getDatabase($request))->get();
        $row = count($projects)+1;
        if($row < 10){
            $project->tempid = "TMP".'-'."00".$row;
        }
        elseif ($row >= 10 && $row <= 99) {
            $project->tempid = "TMP".'-'."0".$row;
        }
        elseif ($row > 99) {
            $project->tempid = "TMP".'-'.$row;
        }

        $project->title = $request->title;
        $project->area = $request->area;
        $project->abstract = $request->abstract;
        $project->keywords = $request->keywords;
        $project->references = $request->references;
        $project->supervisor = $request->supervisor;
        $project->cosupervisor = $request->cosupervisor;
        $project->bids = 0;
        $project->status = "open";
        $project->setConnection($this->getDatabase($request))->save();
        return redirect()->route('admin.projects.index');

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request, $id)
    {
        $database = $this->getDatabase($request);

        $supervisor = Supervisor::select('name')->where('id', $id)->first();

        $projects = Project::on($this->getDatabase($request))->where('supervisor', $supervisor->name)->get();
        return view('admin.projectspersup', compact('projects','database'));
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
}
