<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use DB,Auth,Cache;
use App\Models\User;
use App\Models\nominee;
use App\Models\application;
use App\Models\contact;

class UserController extends Controller
{
    public function enquiries()
    {
    
       $contact=contact::latest()->get();
          $header="Enquiries";
        return view('users.Enquiries',['contact'=>$contact,'header'=>$header]);      
    }
    public function users()
    {
    
       $users=User::where('status','Active')->latest()->get();
          $header="Users";
        return view('users.Users',['users'=>$users,'header'=>$header]);      
    }

    public function user_applications($uid)
    {
        $userid=decrypt($uid);
       $apps=application::where('user_id',$userid)->latest()->get();
          $header="Users";
        return view('users.UserApplications',['apps'=>$apps,'header'=>$header]);      
    }

     public function blocked_users()
    {
    
       $users=User::where('status','Blocked')->latest()->get();
          $header="Users";
        return view('users.BlockedUsers',['users'=>$users,'header'=>$header]);      
    }

     public function activate_user(Request $req)
    {

        $uid=$req->body;
        

        User::where('id',$uid)->update([

            'status'=>'Active'

            ]);

            $data['success']="success";
            echo json_encode($data);

      } 

       public function block_user(Request $req)
    {
        

        User::where('id',$req->buid)->update([

            'status'=>'Blocked',
            'block_reason'=>$req->reason,
            'blocked_by'=> Auth::guard('admin')->user()->id

            ]);

            $data['success']="success";
            echo json_encode($data);

      }


      public function nominees($userid)
    {

        $uid=decrypt($userid);
    
       $nominees=nominee::where('user_id',$uid)->where('status','!=','Deleted')->oldest()->get();
       $usr=User::select('full_name','phone_number')->where('id',$uid)->first();
          $header="Users";
        return view('users.nominees',['nominees'=>$nominees,'usr'=>$usr,'header'=>$header]);   
       
    } 

    public function activate_nominee(Request $req)
    {

        $uid=$req->body;
        

        nominee::where('id',$uid)->update([

            'status'=>'Active'

            ]);

            $data['success']="success";
            echo json_encode($data);

      } 

       public function block_nominee(Request $req)
    {

        $uid=$req->body;
        

        nominee::where('id',$uid)->update([

            'status'=>'Blocked'

            ]);

            $data['success']="success";
            echo json_encode($data);

      }
}
