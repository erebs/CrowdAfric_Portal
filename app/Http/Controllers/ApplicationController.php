<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\application;
use App\Models\application_document;
use App\Models\campaign;
use App\Models\campaign_category;
use App\Models\funding;
use App\Models\funding_face;
use App\Models\repayment;
use App\Models\lucky_draw;
use App\Models\country;
use App\Models\state;
use App\Models\notification;
use DB;
use Auth;
class ApplicationController extends Controller
{
    public function pending_campaigns_applications()
    {
    
       $camp=campaign::get();
       $header="Applications";
        return view('application.PendingApplicationCampaigns',['camp'=>$camp,'header'=>$header]);      
    }

     public function pending_applications($cid)
    {
        $campid=decrypt($cid);
       $application=application::where('campaign_id',$campid)
       ->where(function($q) {
              $q->where('status', 'Started')
              ->orWhere('status', 'Submitted')
              ->orWhere('status', 'On Hold');
          })
       ->get();

       $con=country::orderBy('name','ASC')->get();

       $cnt1=application::where('campaign_id',$campid)->where('status', 'Started')->count();
       $cnt2=application::where('campaign_id',$campid)->where('status', 'Submitted')->count();
       $cnt3=application::where('campaign_id',$campid)->where('status', 'On Hold')->count();
       $camp=campaign::select('title','id','cat_id')->where('id',$campid)->first();
       $all_camp=campaign::select('title','id')->where('cat_id',$camp->cat_id)->where('id','!=',$camp->id)->get();


       $header="Applications";
        return view('application.PendingApplication',['application'=>$application,'header'=>$header,'cnt1'=>$cnt1,'cnt2'=>$cnt2,'cnt3'=>$cnt3,'camp'=>$camp,'all_camp'=>$all_camp,'con'=>$con]);      
    }


    public function get_state(Request $req)
    {
        $cid = $req->cid;
        $states = state::where('country_id', $cid)->get();

        $v = '';
        $val = "Choose..";

         echo "<option value=".$v.">".$val."</option>";

        foreach ($states as $s) {
            
                echo "<option value=" . $s->id . ">" . $s->name . "</option>";
            } 
        }

     public function pending_application_search(Request $req)
    {
        $campid=$req->campid;
       $application=application::where('campaign_id',$req->campid)
       ->where(function($q) {
              $q->where('status', 'Started')
              ->orWhere('status', 'Submitted')
              ->orWhere('status', 'On Hold');
          });
       if(isset($req->country)) {
      $application = $application->where('country_id', $req->country);
        }
        if(isset($req->state)) {
      $application = $application->where('state_id', $req->state);
        }
       $application = $application->get();

       $con=country::orderBy('name','ASC')->get();

       $cnt1=application::where('campaign_id',$campid)->where('status', 'Started');
       if(isset($req->country)) {
      $cnt1 = $cnt1->where('country_id', $req->country);
        }
        if(isset($req->state)) {
      $cnt1 = $cnt1->where('state_id', $req->state);
        }
        $cnt1 = $cnt1->count();


       $cnt2=application::where('campaign_id',$campid)->where('status', 'Submitted');
       if(isset($req->country)) {
      $cnt2 = $cnt2->where('country_id', $req->country);
        }
        if(isset($req->state)) {
      $cnt2 = $cnt2->where('state_id', $req->state);
        }
        $cnt2 = $cnt2->count();


       $cnt3=application::where('campaign_id',$campid)->where('status', 'On Hold');
        if(isset($req->country)) {
      $cnt3 = $cnt3->where('country_id', $req->country);
        }
        if(isset($req->state)) {
      $cnt3 = $cnt3->where('state_id', $req->state);
        }
        $cnt3 = $cnt3->count();

       $camp=campaign::select('title','id','cat_id')->where('id',$campid)->first();
       $all_camp=campaign::select('title','id')->where('cat_id',$camp->cat_id)->where('id','!=',$camp->id)->get();


       $header="Applications";
        return view('application.PendingApplication',['application'=>$application,'header'=>$header,'cnt1'=>$cnt1,'cnt2'=>$cnt2,'cnt3'=>$cnt3,'camp'=>$camp,'all_camp'=>$all_camp,'con'=>$con]);      
    }    
    


    public function pending_appdetails($aid)
    {
        $appid=decrypt($aid);
       $application=application::where('id',$appid)->first();
       $docs=application_document::where('application_id',$appid)->get();

       $header="Applications";
        return view('application.PendingApplicationDetails',['application'=>$application,'header'=>$header,'docs'=>$docs]);      
    }

    public function application_status(Request $req)
    {

       $application=application::where('id',$req->appid)->update([

        'status'=>$req->st,

       ]);



    lucky_draw::where('application_id',$req->appid)->update([

        'status'=>$req->st,
        //'is_special'=>0,

       ]);

    $uid=application::select('user_id','campaign_id')->where('id',$req->appid)->first();

    notification::create([

        'title'=>'Application Status',
        'noti_type'=>$uid->user_id,
        'campaign'=>$uid->campaign_id,
        'noti_date'=>date('Y-m-d'),
        'msg'=>'Your application regarding '. ' ' .  $uid->GetCamp->title . ' ' . ' has been' . ' ' . $req->st,
        'status'=>'Active'

    ]);



       $data['success']="success";
       echo json_encode($data);
      
    }

       public function application_special(Request $req)
    {

       $application=application::where('id',$req->appid)->update([

        'status'=>$req->st,
        'is_special'=>1,

       ]);

    lucky_draw::where('application_id',$req->appid)->update([

        'status'=>$req->st,

       ]);

      $uid=application::select('user_id','campaign_id')->where('id',$req->appid)->first();

    notification::create([

        'title'=>'Application Status',
        'noti_type'=>$uid->user_id,
        'campaign'=>$uid->campaign_id,
        'noti_date'=>date('Y-m-d'),
        'msg'=>'Your application regarding '. ' ' .  $uid->GetCamp->title . ' ' . ' has been Approved and makes Spacial' ,
        'status'=>'Active'

    ]);



       $data['success']="success";
       echo json_encode($data);
      
    }

        public function reject_appreason(Request $req)
    {

       $application=application::where('id',$req->appid)->update([

        'status'=>'Rejected',
        'block_reason'=>$req->reason,
        'blocked_by'=>Auth::guard('admin')->user()->id,
        'is_special'=>1,

       ]);

    lucky_draw::where('application_id',$req->appid)->update([

        'status'=>$req->st,

       ]);

     $uid=application::select('user_id','campaign_id')->where('id',$req->appid)->first();

    notification::create([

        'title'=>'Application Status',
        'noti_type'=>$uid->user_id,
        'campaign'=>$uid->campaign_id,
        'noti_date'=>date('Y-m-d'),
        'msg'=>'Your application regarding '. ' ' .  $uid->GetCamp->title . ' ' . ' has been Rejected' ,
        'status'=>'Active'

    ]);



       $data['success']="success";
       echo json_encode($data);
      
    }


    ///////////////////////


        public function rejected_campaigns_applications()
    {
    
       $camp=campaign::get();
       $header="Applications";
        return view('application.RejectedApplicationCampaigns',['camp'=>$camp,'header'=>$header]);      
    }

     public function rejected_applications($cid)
    {
        $campid=decrypt($cid);
       $application=application::where('campaign_id',$campid)->where('status','Rejected')->get();
       $camp=campaign::select('title','id','cat_id')->where('id',$campid)->first();
       $all_camp=campaign::select('title','id')->where('cat_id',$camp->cat_id)->where('id','!=',$camp->id)->get();

 $con=country::orderBy('name','ASC')->get();
       $header="Applications";
        return view('application.RejectedApplication',['application'=>$application,'header'=>$header,'camp'=>$camp,'all_camp'=>$all_camp,'con'=>$con]);      
    }

      public function rejected_application_search(Request $req)
    {
        $campid=$req->campid;
       $application=application::where('campaign_id',$req->campid)->where('status','Rejected');
       
       if(isset($req->country)) {
      $application = $application->where('country_id', $req->country);
        }
        if(isset($req->state)) {
      $application = $application->where('state_id', $req->state);
        }
       $application = $application->get();

       $con=country::orderBy('name','ASC')->get();


       $camp=campaign::select('title','id','cat_id')->where('id',$campid)->first();
       $all_camp=campaign::select('title','id')->where('cat_id',$camp->cat_id)->where('id','!=',$camp->id)->get();


       $header="Applications";
        return view('application.RejectedApplication',['application'=>$application,'header'=>$header,'camp'=>$camp,'all_camp'=>$all_camp,'con'=>$con]);      
    }


    public function rejected_appdetails($aid)
    {
        $appid=decrypt($aid);
       $application=application::where('id',$appid)->first();
       $docs=application_document::where('application_id',$appid)->get();

       $header="Applications";
        return view('application.RejectedApplicationDetails',['application'=>$application,'header'=>$header,'docs'=>$docs]);      
    }


    ////////////////////////


        public function cancelled_campaigns_applications()
    {
    
       $camp=campaign::get();
       $header="Applications";
        return view('application.CancelledApplicationCampaigns',['camp'=>$camp,'header'=>$header]);      
    }

     public function cancelled_applications($cid)
    {
        $campid=decrypt($cid);
       $application=application::where('campaign_id',$campid)->where('status','Cancelled')->get();
       $camp=campaign::select('title','id','cat_id')->where('id',$campid)->first();
       $all_camp=campaign::select('title','id')->where('cat_id',$camp->cat_id)->where('id','!=',$camp->id)->get();

        $con=country::orderBy('name','ASC')->get();
       $header="Applications";
        return view('application.CancelledApplication',['application'=>$application,'header'=>$header,'camp'=>$camp,'all_camp'=>$all_camp,'con'=>$con]);      
    }

      public function cancelled_application_search(Request $req)
    {
        $campid=$req->campid;
       $application=application::where('campaign_id',$req->campid)->where('status','Cancelled');
       
       if(isset($req->country)) {
      $application = $application->where('country_id', $req->country);
        }
        if(isset($req->state)) {
      $application = $application->where('state_id', $req->state);
        }
       $application = $application->get();

       $con=country::orderBy('name','ASC')->get();


       $camp=campaign::select('title','id','cat_id')->where('id',$campid)->first();
       $all_camp=campaign::select('title','id')->where('cat_id',$camp->cat_id)->where('id','!=',$camp->id)->get();


       $header="Applications";
        return view('application.CancelledApplication',['application'=>$application,'header'=>$header,'camp'=>$camp,'all_camp'=>$all_camp,'con'=>$con]);      
    }


    public function cancelled_appdetails($aid)
    {
        $appid=decrypt($aid);
       $application=application::where('id',$appid)->first();
       $docs=application_document::where('application_id',$appid)->get();

       $header="Applications";
        return view('application.CancelledApplicationDetails',['application'=>$application,'header'=>$header,'docs'=>$docs]);      
    }


    ////////////////////////



     public function approved_campaigns_applications()
    {
    
       $camp=campaign::get();
       $header="Applications";
        return view('application.ApprovedApplicationCampaigns',['camp'=>$camp,'header'=>$header]);      
    }

     public function approved_applications($cid)
    {
        $campid=decrypt($cid);
       $application=application::where('campaign_id',$campid)->where('status','Approved')->get();
       $camp=campaign::select('title','id','cat_id')->where('id',$campid)->first();
       $all_camp=campaign::select('title','id')->where('cat_id',$camp->cat_id)->where('id','!=',$camp->id)->get();
        $con=country::orderBy('name','ASC')->get();

       $header="Applications";
        return view('application.ApprovedApplication',['application'=>$application,'header'=>$header,'camp'=>$camp,'all_camp'=>$all_camp,'con'=>$con]);      
    }

    public function approved_application_search(Request $req)
    {
        $campid=$req->campid;
       $application=application::where('campaign_id',$req->campid)->where('status','Approved');
       
       if(isset($req->country)) {
      $application = $application->where('country_id', $req->country);
        }
        if(isset($req->state)) {
      $application = $application->where('state_id', $req->state);
        }
       $application = $application->get();

       $con=country::orderBy('name','ASC')->get();


       $camp=campaign::select('title','id','cat_id')->where('id',$campid)->first();
       $all_camp=campaign::select('title','id')->where('cat_id',$camp->cat_id)->where('id','!=',$camp->id)->get();


       $header="Applications";
        return view('application.ApprovedApplication',['application'=>$application,'header'=>$header,'camp'=>$camp,'all_camp'=>$all_camp,'con'=>$con]);      
    }

    public function approved_appdetails($aid)
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
        return view('application.ApprovedApplicationDetails',['application'=>$application,'header'=>$header,'docs'=>$docs,'funds'=>$funds,'fund'=>$fund,'fundface'=>$fundface,'fundfacesum'=>$fundfacesum,'repay'=>$repay,'repaysum'=>$repaysum]);      
    }

    public function fund_add(Request $req)
    {

       funding::create([

        'user_id'=>$req->user_id,
        'application_id'=>$req->appid,
        'amount'=>$req->amount,
        'month'=>$req->month,
        'month_interest'=>$req->interest,
        'total_interest'=>$req->tot_interest,
        'total_amount'=>$req->tot_amount,
        'status'=>'Pending'

       ]);

       $data['success']="success";
       echo json_encode($data);
      
    }

     public function fund_update(Request $req)
    {

       funding::where('id',$req->fid)->update([

        'amount'=>$req->amount1,
        'month'=>$req->month1,
        'month_interest'=>$req->interest1,
        'total_interest'=>$req->tot_interest1,
        'total_amount'=>$req->tot_amount1,
        'status'=>$req->fstat,

       ]);

       $data['success']="success";
       echo json_encode($data);
      
    }

        public function fundface_add(Request $req)
    {

       funding_face::create([

        'fund_id'=>$req->fid,
        'title'=>$req->ftitle,
        'amount'=>$req->famount,
        'date'=>$req->fdate,
        'status'=>'Pending'

       ]);

       $data['success']="success";
       echo json_encode($data);
      
    }

       public function fundface_delete(Request $req)
    {

       funding_face::where('id',$req->fundfaceid)->delete();

       $data['success']="success";
       echo json_encode($data);
      
    }

    public function fundface_status(Request $req)
    {

       funding_face::where('id',$req->fid)->update([

        'status'=>$req->st,

       ]);

       $fund_face=funding_face::select('fund_id')->where('id',$req->fid)->first();
       $fund=funding::select('user_id','application_id')->where('id',$fund_face->fund_id)->first();
       $camp=application::select('campaign_id')->where('id',$fund->application_id)->first();

    notification::create([

        'title'=>'Funding Phase',
        'noti_type'=>$fund->user_id,
        'campaign'=>$camp->campaign_id,
        'noti_date'=>date('Y-m-d'),
        'msg'=>'New funding regarding '. ' ' .  $camp->GetCamp->title . ' ' . ' has been' . ' ' . $req->st,
        'status'=>'Active'

    ]);

       $data['success']="success";
       echo json_encode($data);
      
    }

    ////////////////////////


      public function repayment_add(Request $req)
    {

       repayment::create([

        'user_id'=>$req->user_id,
        'application_id'=>$req->appid,
        'amount'=>$req->ramount,
        'due_date'=>$req->rdate,
        'fine'=>$req->fine,
        'status'=>'Pending',
        'pay_status'=>'Pending'

       ]);

       $data['success']="success";
       echo json_encode($data);
      
    }

           public function repay_delete(Request $req)
    {

       repayment::where('id',$req->repayid)->delete();

       $data['success']="success";
       echo json_encode($data);
      
    }

    public function repay_status(Request $req)
    {

       repayment::where('id',$req->rid)->update([

        'status'=>$req->st,

       ]);

       $repay=repayment::select('user_id','application_id')->where('id',$req->rid)->first();
       $camp=application::select('campaign_id')->where('id',$repay->application_id)->first();

    notification::create([

        'title'=>'Repayment',
        'noti_type'=>$repay->user_id,
        'campaign'=>$camp->campaign_id,
        'noti_date'=>date('Y-m-d'),
        'msg'=>'New repayment regarding '. ' ' .  $camp->GetCamp->title . ' ' . ' has been' . ' ' . $req->st,
        'status'=>'Active'

    ]);

       $data['success']="success";
       echo json_encode($data);
      
    }

        public function repay_approval(Request $req)
    {

       repayment::where('id',$req->pid)->update([

        'payment_approval'=>$req->st,

       ]);

       $data['success']="success";
       echo json_encode($data);
      
    }

      public function reject_repay(Request $req)
    {

       repayment::where('id',$req->pid)->update([

        'payment_approval'=>'Rejected',
        'rejection_reason'=>$req->reason1,
        'rejected_by'=>Auth::guard('admin')->user()->id,

       ]);

       $data['success']="success";
       echo json_encode($data);
      
    }


     ////////////////////////



     public function completed_campaigns_applications()
    {
    
       $camp=campaign::get();
       $header="Applications";
        return view('application.CompletedApplicationCampaigns',['camp'=>$camp,'header'=>$header]);      
    }

     public function completed_applications($cid)
    {
        $campid=decrypt($cid);
       $application=application::where('campaign_id',$campid)->where('status','Completed')->get();
       $camp=campaign::select('title','id','cat_id')->where('id',$campid)->first();
       $all_camp=campaign::select('title','id')->where('cat_id',$camp->cat_id)->where('id','!=',$camp->id)->get();
 $con=country::orderBy('name','ASC')->get();

       $header="Applications";
        return view('application.CompletedApplication',['application'=>$application,'header'=>$header,'camp'=>$camp,'all_camp'=>$all_camp,'con'=>$con]);      
    }

     public function completed_application_search(Request $req)
    {
        $campid=$req->campid;
       $application=application::where('campaign_id',$req->campid)->where('status','Completed');
       
       if(isset($req->country)) {
      $application = $application->where('country_id', $req->country);
        }
        if(isset($req->state)) {
      $application = $application->where('state_id', $req->state);
        }
       $application = $application->get();

       $con=country::orderBy('name','ASC')->get();


       $camp=campaign::select('title','id','cat_id')->where('id',$campid)->first();
       $all_camp=campaign::select('title','id')->where('cat_id',$camp->cat_id)->where('id','!=',$camp->id)->get();


       $header="Applications";
        return view('application.CompletedApplication',['application'=>$application,'header'=>$header,'camp'=>$camp,'all_camp'=>$all_camp,'con'=>$con]);      
    }

    public function completed_appdetails($aid)
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
        return view('application.CompletedApplicationDetails',['application'=>$application,'header'=>$header,'docs'=>$docs,'funds'=>$funds,'fund'=>$fund,'fundface'=>$fundface,'fundfacesum'=>$fundfacesum,'repay'=>$repay,'repaysum'=>$repaysum]);      
    }

    /////////////////////////////

         public function special_campaigns_applications()
    {
    
       $camp=campaign::get();
       $header="Applications";
        return view('application.SpecialApplicationCampaigns',['camp'=>$camp,'header'=>$header]);      
    }

     public function special_applications($cid)
    {
        $campid=decrypt($cid);
       $application=application::where('campaign_id',$campid)->where('status','Special')->get();
       $camp=campaign::select('title','id','cat_id')->where('id',$campid)->first();
       $all_camp=campaign::select('title','id')->where('cat_id',$camp->cat_id)->where('id','!=',$camp->id)->get();

 $con=country::orderBy('name','ASC')->get();
       $header="Applications";
        return view('application.SpecialApplication',['application'=>$application,'header'=>$header,'camp'=>$camp,'all_camp'=>$all_camp,'con'=>$con]);      
    }

     public function special_application_search(Request $req)
    {
        $campid=$req->campid;
       $application=application::where('campaign_id',$req->campid)->where('status','Special');
       
       if(isset($req->country)) {
      $application = $application->where('country_id', $req->country);
        }
        if(isset($req->state)) {
      $application = $application->where('state_id', $req->state);
        }
       $application = $application->get();

       $con=country::orderBy('name','ASC')->get();


       $camp=campaign::select('title','id','cat_id')->where('id',$campid)->first();
       $all_camp=campaign::select('title','id')->where('cat_id',$camp->cat_id)->where('id','!=',$camp->id)->get();


       $header="Applications";
        return view('application.SpecialApplication',['application'=>$application,'header'=>$header,'camp'=>$camp,'all_camp'=>$all_camp,'con'=>$con]);      
    }

    //////////////////////////////////////


     public function repayment_pending()
    {
        $dt=date('Y-m-d');
       $repay=repayment::where('pay_status','Pending')->where('due_date','>=',$dt)->orderBy('due_date','ASC')->get();
       $header="Repayments";
        return view('application.PendingRepayments',['repay'=>$repay,'header'=>$header]);      
    }

     public function repayment_approval_pending()
    {
    
        $dt=date('Y-m-d');
        $repay=repayment::where('pay_status','Paid')->where('payment_approval','Pending')->orderBy('paid_at','ASC')->get();
       $header="Repayments";
        return view('application.ApprovalPendingRepayments',['repay'=>$repay,'header'=>$header]);      
    }

     public function expired_repayments()
    {
    
        $dt=date('Y-m-d');
        $repay=repayment::where('pay_status','Pending')->where('due_date','<',$dt)->orderBy('due_date','ASC')->get();
       $header="Repayments";
        return view('application.ExpiredRepayments',['repay'=>$repay,'header'=>$header]);      
    }



}
