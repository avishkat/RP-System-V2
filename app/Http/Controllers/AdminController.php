<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\Role;
use App\ResearchGroup;
use Illuminate\Support\Facades\Mail;
use App\Mail\RoleAssignMail;
use DB;

class AdminController extends Controller
{
    private $value;

    //get selected database for the session
    public function getDatabase(Request $request){
        return $this->value = $request->session()->get('database');
    }

    public function index(Request $request)
    {
        $data = ResearchGroup::on($this->getDatabase($request))->select(DB::raw('status as status'), DB:: raw('count(*) as number'))->groupBy('status')->get();

        $array[] = ['Status', 'Number'];
        foreach($data as $key => $value)
        {
            $array[++$key] = [$value->status, $value->number];
        }

        return view('admin.admin')->with('status', json_encode($array));
    }

    public function displayUsers()
    {
        $users = User::with('roles')->get();

        return view('admin.addrole', ['users' => $users]);
    }

    public function giveAdmin($userId)
    {
        $user = User::where('id', $userId)->firstOrFail();

        $adminRole = Role::where('name', 'admin')->firstOrFail();
        $studentRole = Role::where('name', 'student')->firstOrFail();

        $user->roles()->attach($adminRole->id);
        $user->roles()->detach($studentRole->id);

        //send email to admin
        $details = [
            'greeting' => 'Dear '.$user->name.',',
            'body1' => 'You have been given admin level access in the Research Project System.',
            'body2' => ''
        ];

        if(!$user->email == null){
            Mail::to($user->email)->send(new RoleAssignMail($details));
        }

        return redirect('/admin/userpermission');
    }

    public function removeAdmin($userId)
    {
        $user = User::where('id', $userId)->firstOrFail();

        $adminRole = Role::where('name', 'admin')->firstOrFail();

        $user->roles()->detach($adminRole->id);

        //send email to admin
        $details = [
            'greeting' => 'Dear '.$user->name.',',
            'body1' => 'You have been removed from admin level access in the Research Project System.',
            'body2' => ''
        ];

        if(!$user->email == null){
            Mail::to($user->email)->send(new RoleAssignMail($details));
        }

        return redirect('/admin/userpermission');
    }

    public function giveSupervisor($userId)
    {
        $user = User::where('id', $userId)->firstOrFail();

        $supervisorRole = Role::where('name', 'supervisor')->firstOrFail();
        $studentRole = Role::where('name', 'student')->firstOrFail();

        $user->roles()->attach($supervisorRole->id);
        $user->roles()->detach($studentRole->id);

        //send email to supervisor
        $details = [
            'greeting' => 'Dear '.$user->name.',',
            'body1' => 'You have been given supervisor level access in the Research Project System.',
            'body2' => 'You can now publish projects.'
        ];

        if(!$user->email == null){
            Mail::to($user->email)->send(new RoleAssignMail($details));
        }

        return redirect('/admin/userpermission');
    }

    public function removeSupervisor($userId)
    {
        $user = User::where('id', $userId)->firstOrFail();

        $supervisorRole = Role::where('name', 'supervisor')->firstOrFail();
        $studentRole = Role::where('name', 'student')->firstOrFail();

        $user->roles()->detach($supervisorRole->id);
        $user->roles()->attach($studentRole->id);

        //send email to supervisor
        $details = [
            'greeting' => 'Dear '.$user->name.',',
            'body1' => 'You have been removed from supervisor level access in the Research Project System.',
            'body2' => ''
        ];

        if(!$user->email == null){
            Mail::to($user->email)->send(new RoleAssignMail($details));
        }

        return redirect('/admin/userpermission');
    }
}
