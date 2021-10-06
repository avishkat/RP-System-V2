<?php

namespace App\Http\Controllers\Student;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\ResearchGroup;
use Illuminate\Support\Facades\Mail;
use App\Mail\RegistrationMail;

class ResearchGroupsController extends Controller
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
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('student.teamreg');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, ResearchGroup $researchgroup)
    {
        $researchgroups = ResearchGroup::on($this->getDatabase($request))->get();
        $row = count($researchgroups)+1;
        if($row < 10){
            $researchgroup->groupid = date('Y').'-'."00".$row;
        }
        elseif ($row >= 10 && $row <= 99) {
            $researchgroup->groupid = date('Y').'-'."0".$row;
        }
        elseif ($row > 99) {
            $researchgroup->groupid = date('Y').'-'.$row;
        }

        if(!$request->image1 == null){
            $image1 = $request->file('image1');
            $imageName1 = time().'.'.$image1->extension();
            $image1->move(public_path('images'),$imageName1);
            $researchgroup->image1 = $imageName1;
        }

        if(!$request->image2 == null){
            $image2 = $request->file('image2');
            $imageName2 = time().'.'.$image2->extension();
            $image2->move(public_path('images'),$imageName2); 
            $researchgroup->image2 = $imageName2;
        }

        if(!$request->image3 == null){
            $image3 = $request->file('image3');
            $imageName3 = time().'.'.$image3->extension();
            $image3->move(public_path('images'),$imageName3);
            $researchgroup->image3 = $imageName3;
        }

        if(!$request->image4 == null){
            $image4 = $request->file('image4');
            $imageName4 = time().'.'.$image4->extension();
            $image4->move(public_path('images'),$imageName4);
            $researchgroup->image4 = $imageName4;
        }
        
        $researchgroup->member1 = $request->name1;
        $researchgroup->reg1 = $request->reg1;
        $researchgroup->phone1 = $request->phone1;
        $researchgroup->email1 = $request->email1;
        $researchgroup->spec1 = $request->area1;
        $researchgroup->gpa1 = $request->gpa1;
        $researchgroup->member2 = $request->name2;
        $researchgroup->reg2 = $request->reg2;
        $researchgroup->phone2 = $request->phone2;
        $researchgroup->email2 = $request->email2;
        $researchgroup->spec2 = $request->area2;
        $researchgroup->gpa2 = $request->gpa2;
        $researchgroup->member3 = $request->name3;
        $researchgroup->reg3 = $request->reg3;
        $researchgroup->phone3 = $request->phone3;
        $researchgroup->email3 = $request->email3;
        $researchgroup->spec3 = $request->area3;
        $researchgroup->gpa3 = $request->gpa3;
        $researchgroup->member4 = $request->name4;
        $researchgroup->reg4 = $request->reg4;
        $researchgroup->phone4 = $request->phone4;
        $researchgroup->email4 = $request->email4;
        $researchgroup->spec4 = $request->area4;
        $researchgroup->gpa4 = $request->gpa4;
        $researchgroup->status = "Tentative";
        $researchgroup->researchid = "";
        $researchgroup->setConnection($this->getDatabase($request))->save();

        //send email to group members
        $details = [
            'greeting' => 'Dear Student,',
            'body1' => 'Your group has been successfully registered for the Research Project module. Your group ID is '.$researchgroup->groupid,
            'body2' => 'Please click on the following link to get yourself registered in the Research Project System.'.'http://127.0.0.1:8000',
            
        ];

        if(!$request->email2 == null){
            Mail::to($request->email2)->send(new RegistrationMail($details));
        }
        
        if(!$request->email3 == null){
            Mail::to($request->email3)->send(new RegistrationMail($details));
        }

        if(!$request->email4 == null){
            Mail::to($request->email4)->send(new RegistrationMail($details));
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

    public function filter(Request $request)
    {
      $slcrecom = $request->input("slcrecom");
      $arrayLayout = array('student.teamreg','student.teamreg2','student.teamreg3','student.teamreg4' );

      return view($arrayLayout[$slcrecom]);
    }
}
