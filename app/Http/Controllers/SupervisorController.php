<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Project;
use DB;

class SupervisorController extends Controller
{
    private $value;
    
    //get selected database for the session
    public function getDatabase(Request $request){
        return $this->value = $request->session()->get('database');
    }

    public function index()
    {
        return view('supervisor.supervisor');
    }

    public function index2(Request $request)
    {
        $data = DB::connection($this->getDatabase($request))->table('project__bids')->select(DB::raw('area as area'), DB:: raw('count(*) as number'))->groupBy('area')->get();

        $array[] = ['Area', 'Number'];
        foreach($data as $key => $value)
        {
            $array[++$key] = [$value->area, $value->number];
        }
        return view('supervisor.supervisor')->with('area', json_encode($array));

        // $arr['projects'] = Project::all();
        // return view('supervisor.supervisor')->with($arr);
    }
}
