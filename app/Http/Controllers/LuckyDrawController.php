<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\campaign;
use App\Models\application;
use App\Models\application_document;
use App\Models\funding;
use App\Models\funding_face;
use App\Models\repayment;
use App\Models\lucky_draw;
use App\Models\lucky_draw_item;
use App\Models\country;
use App\Models\notification;

class LuckyDrawController extends Controller
{
   public function lucky_draw_campaigns()
    {
    
       $camp=campaign::get();
       $header="Draw";
        return view('lucky_draw.LuckyDrawCampaigns',['camp'=>$camp,'header'=>$header]);      
    }

     public function lucky_submitted_applications($cid)
    {
        $campid=decrypt($cid);
       $application=application::where('campaign_id',$campid)->where('status', 'Submitted')->get();
       $camp=campaign::select('title','id','cat_id')->where('id',$campid)->first();
       $all_camp=campaign::select('title','id')->where('cat_id',$camp->cat_id)->where('id','!=',$camp->id)->get();
       $header="Draw";
       $lk=lucky_draw_item::where('campaign_id',$campid)->get();
       $con=country::orderBy('name','ASC')->get();
        return view('lucky_draw.LuckyDrawApplication',['application'=>$application,'camp'=>$camp,'all_camp'=>$all_camp,'header'=>$header,'lk'=>$lk,'con'=>$con]);      
    }

      public function lucky_draw_result($cid,$lim)
    {
        $campid=decrypt($cid);
        $litem=lucky_draw_item::where('id',$lim)->first();
       $application=application::where('campaign_id',$campid)->where('status', 'Submitted');
        if($litem->country!='') {
      $application = $application->where('country_id', $litem->country);
        }
        if($litem->state!='') {
      $application = $application->where('state_id', $litem->state);
        }
       $application = $application->inRandomOrder()->limit($litem->winners)->get();


       $luck=lucky_draw::where('lucky_id',$lim)->count();

       if($luck!=0)
       {
            
                lucky_draw::where('lucky_id',$lim)->where('status','!=','Approved')->delete();

       }

       foreach($application as $a)
       {
          lucky_draw::create([

            'lucky_id'=>$lim,
            'campaign_id'=>$a->campaign_id,
            'user_id'=>$a->user_id,
            'application_id'=>$a->id,
            'status'=>0,

          ]);
      }

      $luck_res=lucky_draw::where('lucky_id',$lim)->where('status','!=','Approved')->get();

       $header="Draw";
        return view('lucky_draw.LuckyDrawResult',['luck_res'=>$luck_res,'header'=>$header,'campid'=>$campid,'lim'=>$lim]);      
    }

     public function lucky_users($cid)
    {
        $campid=decrypt($cid);

      $luck_res=lucky_draw::where('campaign_id',$campid)->where('status','Approved')->get();
      $cmp=campaign::select('title')->where('id',$campid)->first();
   
       $header="Draw";
        return view('lucky_draw.LuckyUsers',['luck_res'=>$luck_res,'header'=>$header,'campid'=>$campid,'cmp'=>$cmp]);      
    }

    public function approve_apps(Request $req)
    {
        $lid=$req->body;

       $apps=lucky_draw::where('lucky_id',$lid)->get();

       foreach($apps as $a)
       {
          application::where('id',$a->application_id)->update([

            'status'=>'Approved',
          ]);

          lucky_draw::where('id',$a->id)->update([

            'status'=>'Approved',
          ]);

           // $uid=application::select('user_id')->where('id',$a->id)->first();

            notification::create([

                'title'=>'Application Status',
                'noti_type'=>$a->user_id,
                'campaign'=>$a->campaign_id,
                'noti_date'=>date('Y-m-d'),
                'msg'=>'Your application regarding '. ' ' .  $a->GetCamp->title . ' ' . ' has been Approved',
                'status'=>'Active'

            ]);
      }

$data['success']="success";
echo json_encode($data);     
    }


    public function approved_luckyappdetails($aid)
    {
        $appid=decrypt($aid);
       $application=application::where('id',$appid)->first();
       $docs=application_document::where('application_id',$appid)->get();
       $funds=funding::where('application_id',$appid)->first();
       if($funds)
       {
        $fund=1;
        $fundface=funding_face::where('fund_id',$funds->id)->latest()->get();
        $fundfacesum=funding_face::where('fund_id',$funds->id)->sum('amount');
        $repay=repayment::where('application_id',$appid)->latest()->get();
        $repaysum=repayment::where('application_id',$appid)->where('status','Approved')->sum('amount');
       }
       else
       {
        $fund=0;
        $fundface=0;
        $fundfacesum=0;
        $repay=0;
        $repaysum=0;
       }
       $header="Applications";
        return view('lucky_draw.ApprovedApplicationDetails',['application'=>$application,'header'=>$header,'docs'=>$docs,'funds'=>$funds,'fund'=>$fund,'fundface'=>$fundface,'fundfacesum'=>$fundfacesum,'repay'=>$repay,'repaysum'=>$repaysum]);      
    }


     public function draw_add(Request $req)
    {
      
          lucky_draw_item::create([

            'campaign_id'=>$req->cid,
            'title'=>$req->title,
            'winners'=>$req->winner,
            'country'=>$req->cn,
            'state'=>$req->st,


          ]);

          $data['success']="success";
          echo json_encode($data);
            
    }

     public function get_luckydet(Request $req)
    {
      
          $lk=lucky_draw_item::where('id',$req->cid)->first();

          $output = '';

          $output .= ' 
                            <h5 class="text-muted">Lucky Draw Details</h5>
              <ul class="list-unstyled">

                <li>
    <i class="fa fa-dot-circle" aria-hidden="true" style="font-size: 10px;"></i>  <a class="btn-link text-primary">Title : '.$lk->title.'</a>
                </li>
                <li>
    <i class="fa fa-dot-circle" aria-hidden="true" style="font-size: 10px;"></i>  <a class="btn-link text-primary">No.of Winners : '.$lk->winners.'</a>
                </li>
                ';

                if($lk->country=='')
                {
                    $output .= '<li>
                    <i class="fa fa-dot-circle" aria-hidden="true" style="font-size: 10px;"></i>  <a class="btn-link text-primary">Country : All</a>
                </li>';
                }
                else
                {
                    $output .= '<li>
                    <i class="fa fa-dot-circle" aria-hidden="true" style="font-size: 10px;"></i>  <a class="btn-link text-primary">Country : '.$lk->GetCon->name.'</a>
                </li>';
                }
            if($lk->state=='')
                {
                    $output .= '<li>
                    <i class="fa fa-dot-circle" aria-hidden="true" style="font-size: 10px;"></i>  <a class="btn-link text-primary">State : All states</a>
                </li>';
                }
                else
                {
                    $output .= '<li>
                    <i class="fa fa-dot-circle" aria-hidden="true" style="font-size: 10px;"></i>  <a class="btn-link text-primary">State : '.$lk->GetState->name.'</a>
                </li>';
                }

                
              $output .= ' </ul>';

          echo $output;
            
    }
}
