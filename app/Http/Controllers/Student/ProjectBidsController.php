<?php

namespace App\Http\Controllers\Student;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Project_Bid;
use App\ResearchGroup;
use App\Project;
use App\User;
use App\Notifications\NewBid;
use Illuminate\Support\Facades\Mail;
use App\Mail\NewBidMail;

class ProjectBidsController extends Controller
{
    private $value;

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
        // $arr['projects'] = Project_Bid::all();
        // return view('student.student')->with($arr);
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
    public function store(Request $request, Project_Bid $projectbid)
    {
        $file = $request->file('qualification');
        $filename = time().'.'.$file->getClientOriginalExtension();
        $file->move('storage/',$filename);

        $rgroup = ResearchGroup::on($this->getDatabase($request))->select('groupid')->where('member1', $request->teamleader)->first();

        $projectbid->researchid = $request->projectid;
        $projectbid->groupid = $rgroup->groupid;
        $projectbid->supervisor = $request->supervisor;
        $projectbid->area = $request->area;
        $projectbid->preference = $request->preference;
        $projectbid->qualifications = $filename;
        $projectbid->status = "Voted";
        $projectbid->setConnection($this->getDatabase($request))->save();
        
        //update number of bids
        $project = Project::on($this->getDatabase($request))->where('tempid', $request->projectid)->first();

        $newbids = 0;
        $newbids = $project->bids + 1;
        $project->bids = $newbids;
        $project->setConnection($this->getDatabase($request))->save();

        //send email notification to supervisor
        $supemails = User::select('email')->where('name', $request->supervisor)->get();
        $bids = Project_Bid::on($this->getDatabase($request))->select('id')->where('groupid', $rgroup->groupid)->orderBy('id', 'desc')->take(1)->get();
        $bidid = 0;
        if(count($bids)){
            foreach($bids as $bid){
                $bidid = $bid->id;
            }
        }

        $details = [
            'greeting' => 'Dear Supervisor,',
            'body1' => 'A new bid has been placed on the project '.$request->projectid.' by group '.$rgroup->groupid.'.',
            'body2' => 'Please click on the following link to view the bid.',
            'link' => 'http://127.0.0.1:8000',
            'bidid' => $bidid

        ];

        if(count($supemails)){
            foreach($supemails as $supemail){
                Mail::to($supemail->email)->send(new NewBidMail($details));
            }
        }

        return view('student.studentprofile');
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
