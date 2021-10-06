<?php

namespace App\Http\Controllers\Supervisor;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Project_Bid;
use App\ResearchGroup;
use App\Project;
use App\User;
use App\FinalizedProject;
use Illuminate\Support\Facades\Mail;
use App\Mail\BidResponseMail;

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
    public function index(Request $request)
    {
        $database = $this->getDatabase($request);

        $bids = Project_Bid::on($database)->get();
        return view('supervisor.bids', compact('bids','database'));
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
    public function show(Request $request, $id)
    {
        $database = $this->getDatabase($request);

        $bid = Project_Bid::on($database)->where('id', $id)->first();
        return view('supervisor.bidshow', compact('bid','database'));
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
    public function update(Request $request, $id, FinalizedProject $finalproject)
    {
        $database = $this->getDatabase($request);

        $bid = Project_Bid::on($this->getDatabase($request))->find($id);

        if($request->status == "Accepted"){
            //change the status of the bid
            $bid->status = $request->status; 
            $bid->setConnection($this->getDatabase($request))->save();

            //update research group projectid and status
            $group = ResearchGroup::on($this->getDatabase($request))->where('groupid', $request->group)->first();

            $group->researchid = $request->project;
            $group->status = "Accepted"; 
            $group->setConnection($this->getDatabase($request))->save();

            //update project status
            $project = Project::on($this->getDatabase($request))->where('tempid', $request->project)->first();

            $project->status = "Closed"; 
            $project->setConnection($this->getDatabase($request))->save();

            //save to finalized project
            $projects = FinalizedProject::on($this->getDatabase($request))->get();
            $row = count($projects)+1;
            if($row < 10){
                $finalproject->projectid = "RP".'-'.date('Y').'-'."00".$row;
            }
            elseif ($row >= 10 && $row <= 99) {
                $finalproject->projectid = "RP".'-'.date('Y').'-'."0".$row;
            }
            elseif ($row > 99) {
                $finalproject->projectid = "RP".'-'.date('Y').'-'.$row;
            }
            
            $finalproject->topic = $project->title;
            $finalproject->area = $project->area;
            $finalproject->supervisor = $project->supervisor;
            $finalproject->cosupervisor = $project->cosupervisor;
            $finalproject->groupid = $request->group;

            $finalproject->setConnection($this->getDatabase($request))->save();

            //send mail to team leader
            $group = ResearchGroup::on($this->getDatabase($request))->where('groupid', $request->group)->first();
            $leaders = User::where('name', $group->member1)->get();
            $details = [
                'greeting' => 'Dear Student,',
                'body1' => 'Your vote for project '.$request->project.' has been accepted by '.$project->supervisor.'.',
                'body2' => 'Updated ID of the finalized project is '.$finalproject->projectid.'.',
                'feedback' => ''
            ];
    
            if(count($leaders)){
                foreach($leaders as $leader){
                    Mail::to($leader->email)->send(new BidResponseMail($details));
                }
            }
        }
        elseif($request->status == "Declined"){
            //change the status of the bid
            $bid->status = $request->status;
            $bid->comments = $request->comment; 
            $bid->setConnection($this->getDatabase($request))->save();

            //send mail to team leader
            $project = Project::on($this->getDatabase($request))->where('tempid', $request->project)->first();
            $group = ResearchGroup::on($this->getDatabase($request))->where('groupid', $request->group)->first();
            $leaders = User::where('name', $group->member1)->get();

            $details = [
                'greeting' => 'Dear Student,',
                'body1' => 'Your vote for project '.$request->project.' has been declined by '.$project->supervisor.'.',
                'body2' => 'Metioned below is a feedback given to you by '.$project->supervisor.'.',
                'feedback' => $request->comment
            ];
    
            if(count($leaders)){
                foreach($leaders as $leader){
                    Mail::to($leader->email)->send(new BidResponseMail($details));
                }
            }
        }

        return view('supervisor.supervisorprofile', compact('database'));
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

    public function bidsByProject(Request $request){
        $bids = Project_Bid::setConnection($this->getDatabase($request))->where('researchid', $request->id)->get();
        return view('supervisor.bidsperproject', ['bids' => $bids]);
    }
}
