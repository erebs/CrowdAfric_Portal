<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use DB,Auth,Cache;
use App\Models\state;
use App\Models\country;
use App\Models\local_gov_area;
use App\Models\User;

class AddOnController extends Controller
{
    public function country_users($cid)
    {
    $con=decrypt($cid);
    $cn=country::where('id',$con)->first();
    $users=User::where('country_id',$con)->where('status','Active')->get();
       $header="Addon";
        return view('addon.CountryUsers',['users'=>$users,'header'=>$header,'cn'=>$cn]);      
    }

    public function state_users($cid)
    {
    $st=decrypt($cid);
    $state=state::where('id',$st)->first();
    $users=User::where('state_id',$st)->where('status','Active')->get();
       $header="Addon";
        return view('addon.StateUsers',['users'=>$users,'header'=>$header,'state'=>$state]);      
    }
   public function countries()
    {
    
       $con=country::get();
       $header="Addon";
        return view('addon.Countries',['con'=>$con,'header'=>$header]);      
    }

    public function country_add(Request $req)
    {
       
       if(country::where('name',$req->cn)->exists())
       {
        $data['err']='Already exists';
       }
       else
       {
        country::create([

        'name'=>$req->cn,
        'code'=>$req->cncode,
        'mobile_code'=>$req->mcode,
        'status'=>'Active',

       ]);   

       $data['success']='Success';
       }
       
       echo json_encode($data);  
    }

    public function country_edit(Request $req)
    {
       
       if(country::where('name',$req->cn1)->where('id','!=',$req->conid)->exists())
       {
        $data['err']='Already exists';
       }
       else
       {
        country::where('id',$req->conid)->update([

        'name'=>$req->cn1,
        'code'=>$req->cncode1,
        'mobile_code'=>$req->mcode1,

       ]); 

     User::where('country_id',$req->conid)->update([

        'code'=>$req->cncode1,

       ]);  

       $data['success']='Success';
       }
       
       echo json_encode($data);  
    }

     public function activate_country(Request $req)
    {
      
        country::where('id',$req->body)->update([

        'status'=>'Active',

       ]);   

       $data['success']='Success';
       echo json_encode($data);  
    }

      public function block_country(Request $req)
    {
      
        country::where('id',$req->body)->update([

        'status'=>'Blocked',

       ]);   

       $data['success']='Success';
       echo json_encode($data);  
    }

    public function states()
    {
        $con=country::get();
       $st=state::orderBy('country_id','ASC')->get();
       $header="Addon";
        return view('addon.States',['st'=>$st,'header'=>$header,'con'=>$con]);      
    }

        public function state_add(Request $req)
    {
       
       if(state::where('name',$req->stt)->exists())
       {
        $data['err']='Already exists';
       }
       else
       {
        state::create([

        'country_id'=>$req->cn,
        'name'=>$req->stt,
        'status'=>'Active',

       ]);   

       $data['success']='Success';
       }
       
       echo json_encode($data);  
    }

    public function state_edit(Request $req)
    {
       
       if(state::where('name',$req->stt1)->where('id','!=',$req->stid)->exists())
       {
        $data['err']='Already exists';
       }
       else
       {
        state::where('id',$req->stid)->update([

        'country_id'=>$req->cn1,
        'name'=>$req->stt1,

       ]);   

       $data['success']='Success';
       }
       
       echo json_encode($data);  
    }

         public function activate_state(Request $req)
    {
      
        state::where('id',$req->body)->update([

        'status'=>'Active',

       ]);   

       $data['success']='Success';
       echo json_encode($data);  
    }

      public function block_state(Request $req)
    {
      
        state::where('id',$req->body)->update([

        'status'=>'Blocked',

       ]);   

       $data['success']='Success';
       echo json_encode($data);  
    }

    /////////////////


    public function local_areas($sid)
    {
       $stateid=decrypt($sid);
       $local_area=local_gov_area::where('state_id',$stateid)->orderBy('state_id','ASC')->get();
        $st=state::where('id',$stateid)->first();
       $header="Addon";
        return view('addon.LocalAreas',['header'=>$header,'local_area'=>$local_area,'st'=>$st]);      
    }

        public function area_add(Request $req)
    {
       
       if(local_gov_area::where('name',$req->area)->exists())
       {
        $data['err']='Already exists';
       }
       else
       {
        local_gov_area::create([

        'state_id'=>$req->st,
        'name'=>$req->area,
        'status'=>'Active',

       ]);   

       $data['success']='Success';
       }
       
       echo json_encode($data);  
    }

    public function area_edit(Request $req)
    {
       
       if(local_gov_area::where('name',$req->area)->where('id','!=',$req->stid)->exists())
       {
        $data['err']='Already exists';
       }
       else
       {
        local_gov_area::where('id',$req->stid)->update([

        'name'=>$req->area1,

       ]);   

       $data['success']='Success';
       }
       
       echo json_encode($data);  
    }

         public function activate_area(Request $req)
    {
      
        local_gov_area::where('id',$req->body)->update([

        'status'=>'Active',

       ]);   

       $data['success']='Success';
       echo json_encode($data);  
    }

      public function block_area(Request $req)
    {
      
        local_gov_area::where('id',$req->body)->update([

        'status'=>'Blocked',

       ]);   

       $data['success']='Success';
       echo json_encode($data);  
    }
}
