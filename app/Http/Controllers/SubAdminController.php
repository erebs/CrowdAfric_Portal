<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\admin_detail;

class SubAdminController extends Controller
{
    public function admins()
    {
    
       $adm=admin_detail::where('is_superadmin',0)->get();
       $header="Addon";
        return view('admins.Admins',['adm'=>$adm,'header'=>$header]);      
    }

    public function add_admin()
    {
       $header="Addon";
        return view('admins.AddAdmin',['header'=>$header]);      
    }

    public function admin_add(Request $req)
    {

       if(admin_detail::where('username',$req->uname)->exists())
       {
        $data['err']='err';
       }
       else
       {
       admin_detail::create([

        'name'=>$req->name,
        'mobile'=>$req->mobile,
        'mail_id'=>$req->mail,
        'username'=>$req->uname,
        'description'=>$req->desc,
        'password'=>bcrypt($req->pass),
        'status'=>'Active',
        'is_superadmin'=>0,

       ]);   

       $data['success']='Success';
   }
       echo json_encode($data);  
    }

    public function edit_admin($cid)
    {
        $aid=decrypt($cid);
       $adm=admin_detail::where('id',$aid)->first();
       $header="Addon";
        return view('admins.EditAdmin',['adm'=>$adm,'header'=>$header]);      
    }

     public function admin_edit(Request $req)
    {

       if(admin_detail::where('username',$req->uname)->where('id','!=',$req->aid)->exists())
       {
        $data['err']='err';
       }
       else
       {
       admin_detail::where('id',$req->aid)->update([

        'name'=>$req->name,
        'mobile'=>$req->mobile,
        'mail_id'=>$req->mail,
        'username'=>$req->uname,
        'description'=>$req->desc,
        'status'=>$req->st
        ,

       ]);   

       $data['success']='Success';
   }
       echo json_encode($data);  
    }
}
