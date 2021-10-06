<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\ResearchArea;

class ResearchAreasController extends Controller
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
        $arr['areas'] = ResearchArea::on($this->getDatabase($request))->get();
        // $arr['areas'] = ResearchArea::on('mysql2')->select('id', 'title')->get();
        return view('admin.researchareaindex')->with($arr);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.addresearcharea');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, ResearchArea $area)
    {
        $area->title = $request->title;
        $area->setConnection($this->getDatabase($request))->save();
        return redirect()->route('admin.researcharea.index');
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
    public function edit(Request $request, $id)
    {
        $area = ResearchArea::on($this->getDatabase($request))->find($id);
        return view('admin.editarea', compact('area', 'id'));
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
        $area = ResearchArea::on($this->getDatabase($request))->find($id);
        $area->title = $request->title;
        $area->setConnection($this->getDatabase($request))->save(); 
        return redirect()->route('admin.researcharea.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, $id)
    {
        $area = ResearchArea::on($this->getDatabase($request))->find($id);
        $area->setConnection($this->getDatabase($request))->delete();
        return redirect()->route('admin.researcharea.index');
        
    }
}
