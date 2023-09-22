<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\notification;
use App\Models\User;
class NotificationController extends Controller
{
    public function notifications()
    {
    
       $noti=notification::where('status','Active')->get();
       $header="Noti";
        return view('notification.Notification',['noti'=>$noti,'header'=>$header]);      
    }

    public function add_notification()
    {

       $header="Noti";
       $usr=User::where('status','Active')->orderBy('full_name','ASC')->get();
        return view('notification.AddNotification',['header'=>$header,'usr'=>$usr]);      
    }

        public function notification_add(Request $req)
    {
        notification::create([

        'title'=>$req->title,
        'noti_type'=>$req->type,
        'noti_date'=>$req->dt,
        'msg'=>$req->desc,
        'status'=>'Active',

       ]);   

       $data['success']='Success';
       echo json_encode($data);
      
    }

     public function edit_notification($notid)
    {
        $nid=decrypt($notid);
       $header="Noti";
       $usr=User::where('status','Active')->orderBy('full_name','ASC')->get();
        $noti=notification::where('id',$nid)->first();
        return view('notification.EditNotification',['header'=>$header,'usr'=>$usr,'noti'=>$noti]);      
    }

      public function notification_update(Request $req)
    {
        notification::where('id',$req->notid)->update([

        'title'=>$req->title,
        'noti_type'=>$req->type,
        'noti_date'=>$req->dt,
        'msg'=>$req->desc,
       ]);   

       $data['success']='Success';
       echo json_encode($data);
      
    }

     public function delete_notification(Request $req)
    {
        notification::where('id',$req->body)->delete();
       $data['success']='Success';
       echo json_encode($data);
      
    }

        public function noti_status(Request $req)
    {
        

       notification::where('id',$req->body1)->update([

         'status'=>$req->body,

       ]);   

       $data['success']='Success';
       echo json_encode($data);  
    }


    public function completed_notifications()
    {
    
       $noti=notification::where('status','Completed')->get();
       $header="Noti";
        return view('notification.CompletedNotification',['noti'=>$noti,'header'=>$header]);      
    }



     public function notifications_list()
        
    {
        $user=auth()->user()->id;
        $noti=notification::where('status','Active')->where('noti_type','All')->orwhere('noti_type',$user)->get();

        return response()->json([

                'notifications'=>$noti,
                'message'=>'Success',
                'status_code'=>'01',
               
                ],200);

    }
}
