<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use DB;
use App\Models\User;
use App\Models\nominee;
use App\Models\campaign;
use App\Models\campaign_category;
use App\Models\application;
use App\Models\application_document;
use App\Models\notification;
use App\Models\funding;
use App\Models\funding_face;
use App\Models\repayment;
use App\Models\contact;
use App\Models\country;
use App\Models\state;
use App\Models\local_gov_area;
class MemberController extends Controller
{
    public function home($mid)

    {
        $camp_cat=campaign_category::where('status','Active')->get();
        $campcnt=campaign::where('status','Active')->count();
        $app=application::where('user_id',$mid)->where('status','Started')->latest()->get();
        return view('member.home',['camp_cat'=>$camp_cat,'mid'=>$mid,'app'=>$app,'campcnt'=>$campcnt]);
    }

    public function countries()

    {
        $cont=country::where('status','Active')->orderBy('name','ASC')->get();
        return view('member.countries',['cont'=>$cont]);
    }

     public function get_cont(Request $req)
    {
        $cn = $req->cn;
        $cont = country::where('name', 'like', '%' . $cn . '%')->orderBy('name','ASC')->get();

   
            $output = '';
           
            foreach($cont as $c)
            {
                
                $output .= '
                <h6 class="suggestion-name" onclick="GetCon('.$c->id.',\'' . $c->name . '\','.$c->mobile_code.')">  <a style="color:grey !important;text-decoration: none;">'.$c->name.'</a></h6>
                    <hr> 
               ';

            }
            echo $output;
    }

     public function country_codes()

    {
        $cont=country::where('status','Active')->orderBy('name','ASC')->get();
        return view('member.country_codes',['cont'=>$cont]);
    }

     public function get_contcode(Request $req)
    {
        $cn = $req->cn;
        $cont = country::where('name', 'like', '%' . $cn . '%')->orWhere('mobile_code', 'like', '%' . $cn . '%')->orderBy('name','ASC')->get();

   
            $output = '';
           
            foreach($cont as $c)
            {
                
                $output .= '
                <h6 class="suggestion-name" onclick="GetCon('.$c->id.',\'' . $c->name . '\','.$c->mobile_code.')">  <a style="color:grey !important;text-decoration: none;">( + '.$c->mobile_code.' ) - '.$c->name.'</a></h6>
                    <hr> 
               ';

            }
            echo $output;
    }

    public function states($cid)

    {
        $st=state::where('country_id',$cid)->where('status','Active')->orderBy('name','ASC')->get();
        return view('member.states',['st'=>$st,'cid'=>$cid]);
    }

    public function get_st(Request $req)
    {
        $cn = $req->cn;
        $st= $req->st;
        $stat = state::where('country_id',$cn)->where('name', 'like', '%' . $st . '%')->orderBy('name','ASC')->get();

   
            $output = '';
           
            foreach($stat as $c)
            {
                
                $output .= '
                <h6 class="suggestion-name" onclick="GetState('.$c->id.',\'' . $c->name . '\')">  <a style="color:grey !important;text-decoration: none;">'.$c->name.'</a></h6>
                    <hr> 
               ';

            }
            echo $output;
    }

     public function search($mid)

    {
        $camp_cat=campaign_category::where('status','Active')->orderBy('title','ASC')->get();
        $camp=campaign::where('status','Active')->orderBy('title','ASC')->get();
        return view('member.search',['camp_cat'=>$camp_cat,'mid'=>$mid,'camp'=>$camp]);
    }


    public function get_cat(Request $req)
    {
        $cat = $req->cat;
       $camp_cats = campaign_category::where('title', 'like', '%' . $cat . '%')->orderBy('title','ASC')->get();
       $camp = campaign::where('title', 'like', '%' . $cat . '%')->orderBy('title','ASC')->get();


   
            $output = '';

           if(sizeof($camp_cats))
           {
           $output .= '<h5 class="suggestion-name">* categories</h5>';
            foreach($camp_cats as $c)
            {
             
                $img=url($c->icon);
                $output .= '
                <h6 class="suggestion-name"><img style="width:25px;" src='.$img.'> &nbsp&nbsp   <a href="/member/campaigns/'.$c->id.'/'.$req->mid.'" style="color:grey !important;text-decoration: none;">'.$c->title.'</a></h6>
                    <hr> 
               ';

            }
            }
            if(sizeof($camp))
           {

$output .= '<h5 class="suggestion-name">* Campaigns</h5>';
             foreach($camp as $cm)
            {
             
                $img1=url($cm->icon);
                $output .= '
                <h6 class="suggestion-name"><img style="width:25px;" src='.$img1.'> &nbsp&nbsp   <a href="/member/campaigns-select/'.$cm->cat_id.'/'.$req->mid.'/'.$cm->id.'" style="color:grey !important;text-decoration: none;">'.$cm->title.'</a></h6>
                    <hr> 
               ';

            }
        }
            
            echo $output;
    }


    public function campaigns($catid,$mid)

    {
        $camp=campaign::where('cat_id',$catid)->where('status','Active')->get();
        $camp_cat=campaign_category::where('id',$catid)->first();
        $mem=User::where('id',$mid)->first();
        return view('member.category',['camp'=>$camp,'mid'=>$mid,'camp_cat'=>$camp_cat,'mem'=>$mem]);
    }

    public function campaigns_select($catid,$mid,$campid)

    {
        $camp=campaign::where('cat_id',$catid)->where('status','Active')->get();
        $campdet=campaign::where('id',$campid)->first();
        $camp_cat=campaign_category::where('id',$catid)->first();
        $mem=User::where('id',$mid)->first();
        return view('member.category_campaign',['camp'=>$camp,'mid'=>$mid,'camp_cat'=>$camp_cat,'mem'=>$mem,'campdet'=>$campdet]);
    }

    public function get_camp(Request $req)
    {
        $cid = $req->cid;
        $camp = campaign::where('id', $cid)->first();
     
        $img=url($camp->photo);
            $output = '';
           
            
                $output .= ' 
                <div class="col-lg-12">
                <div class="content-on-click-dv ">
                    <h6 class="head-textonclick mb-0">'.$camp->title.'</h6>
                    <br><h6 class="head-textonclick mb-0"><img style="border-radius: 10px;" src='.$img.'></h6>
                    <p class="text-on-click-content">'.$camp->description.'</p>
                    '.$camp->content1.'
                    <h3 class="text-on-click-content">Application Processing Fee : ₦ '.$camp->fee.'</h3>
                </div>
            </div>
            
            <div class="col-lg-12 mt-2">
                <div class="apply-btn-category">
                    <h5 class="btn finish-application-btn primary-bg text-white mb-0" data-toggle="modal" data-target="#modal-fullscreen" style="background-color:red;color:white;">Proceed to application processing fee</h5>
                </div>
            </div>
            </div>
            <br><br>
            ';
            
            echo $output;
    }

     public function app_payment(Request $request,$mid)

    {
        if($request->status=='successful')
        {
            
            $parts = explode("-", $request->tx_ref);
            $uid = $parts[0];
            $camp = $parts[1]; 
            $member=User::where('id',$mid)->first();
            $campdet=campaign::where('id',$camp)->first();

                   application::create([

                    'user_id'=>$mid,
                    'campaign_id'=>$camp,
                    'country_id'=>$member->country_id,
                    'state_id'=>$member->state_id,
                    'status'=>'Started',
                    'payment_status'=>'Paid',
                    'amount'=>$campdet->fee,
                    'payment_date'=>date('Y-m-d'),
                    'reference_id'=>$request->transaction_id

                   ]);
                  
        return view('member.paymentsuccess',['mid'=>$mid,'cid'=>$camp]);
        }
        else
        {

            $parts = explode("-", $request->tx_ref);
            $uid = $parts[0];
            $camp = $parts[1]; 
            $campaign=campaign::select('cat_id','id')->where('id',$camp)->first();
          return view('member.paymentfailed',['mid'=>$mid,'campaign'=>$campaign]);  
        }
        
    }

     public function fundingform($cid,$mid)

    {
        $nom=nominee::where('user_id',$mid)->where('status','Active')->get();
        $nmcnt=nominee::where('user_id',$mid)->where('status','Active')->count();
        $user_det=User::select('state_id')->where('id',$mid)->first();
        $local_area=local_gov_area::where('state_id',$user_det->state_id)->where('status','Active')->orderBy('name','ASC')->get();
        $appid=application::select('id','campaign_id')->where('user_id',$mid)->where('campaign_id',$cid)->orderBy('id','DESC')->limit(1)->first(); 
        return view('member.fundingform',['mid'=>$mid,'cid'=>$cid,'nom'=>$nom,'nmcnt'=>$nmcnt,'appid'=>$appid,'local_area'=>$local_area]);
    }

    public function cancel_application(Request $req)

    {
        application::where('id',$req->appid)->update([

                    'block_reason' => $req->reas,
                    'status'=>'Cancelled',

                   ]);

       $data['success']="success";
        echo json_encode($data);
    }

     public function submit_application(Request $req)

    {
        $app=application::where('id',$req->appid)->update([

                    'plan' => $req->plan,
                    'location' => $req->location,
                    'address' => $req->address,
                    'post' => $req->post,
                    // 'country_id' => $req->country_id,
                    // 'state_id' => $req->state_id,
                    'local_area' => $req->local_area,
                    'plot' => $req->plot,
                    'annual_turnover' => $req->annual_turnover,
                    'nominee1' => $req->n1,
                    'mobile1' => $req->m1,
                    'nominee2' => $req->n2,
                    'mobile2' => $req->m2,
                    'nominee3' => $req->n3,
                    'mobile3' => $req->m3,
                    'nominee4' => $req->n4,
                    'mobile4' => $req->m4,
                    'nominee5' => $req->n5,
                    'mobile5' => $req->m5,
                    'status'=>'Submitted',

                   ]);

         $img = $req->file('img');
            if($img!='')
            {
             $img = $req->file('img');
                     $new_name = "/application_documents/" . time() . '.' . $img->getClientOriginalExtension();                  
            $img->move(public_path('application_documents'), $new_name);

                   application_document::create([

                    'application_id'=>$req->appid,
                    'file'=>$new_name,

                   ]);   
            }
            

             

       $data['success']="success";
        echo json_encode($data);
    }

    public function form_success($mid)

    {
        
        return view('member.form-success',['mid'=>$mid]);
    }







    public function profile($mid)

    {
        $member=User::where('id',$mid)->first();
        $apps=application::where('user_id',$mid)->latest()->get();
        $repay=repayment::where('user_id',$mid)->where('status','Approved')->where('pay_status','Pending')->latest()->get();
        return view('member.profile',['member'=>$member,'apps'=>$apps,'repay'=>$repay]);
    }

        public function aboutus($mid)

    {
        return view('member.aboutus',['mid'=>$mid]);
    }

      public function contact($mid)

    {
        return view('member.contact',['mid'=>$mid]);
    }


      public function contact_request(Request $req)

    {
        contact::create([

            'user_id'=>$req->userid,
            'subject'=>$req->subject,
            'msg'=>$req->msg,

        ]);

        $data['success']="success";
        echo json_encode($data);
        
    }

      public function faq($mid)

    {
        return view('member.faq',['mid'=>$mid]);
    }

      public function help($mid)

    {
        return view('member.help',['mid'=>$mid]);
    }

    public function privacy_policy($mid)

    {
        return view('member.privacy_policy',['mid'=>$mid]);
    }

        public function terms($mid)

    {
        return view('member.terms',['mid'=>$mid]);
    }

        public function personaldetails($mid)

    {
        $member=user::where('id',$mid)->first();
        return view('member.personaldetails',['mid'=>$mid,'member'=>$member]);
    }

      public function personaldet_update(Request $req)

    {
        user::where('id',$req->userid)->update([

            'age'=>$req->age,
            'town'=>$req->town,
            'post_code'=>$req->postcode,
            'community'=>$req->community,
            'address'=>$req->address,

        ]);

        $data['success']="success";
        echo json_encode($data);
        
    }



        public function bankdetail($mid)

    {
        $member=user::where('id',$mid)->first();
        return view('member.bankdetail',['mid'=>$mid,'member'=>$member]);
    }

          public function bankdet_update(Request $req)

    {
        user::where('id',$req->userid)->update([

            'acc_num'=>$req->acc_num,
            'acc_name'=>$req->acc_name,
            'acc_branch'=>$req->acc_branch,
            'ifsc_code'=>$req->ifsc_code,

        ]);

        $data['success']="success";
        echo json_encode($data);
        
    }



      public function nominees($mid)

    {
        if(nominee::where('user_id',$mid)->exists())
        {
              $nom=nominee::where('user_id',$mid)->get();
           return view('member.edit_nominees',['mid'=>$mid,'nom'=>$nom]);
             
        }
        else
        {
            return view('member.nominees',['mid'=>$mid]);
        }
       
    }

         public function add_nominee(Request $req)

    {
        nominee::create([

            'name'=>$req->n1,
            'mobile'=>$req->m1,
            'status'=>'Active',
            'user_id'=>$req->userid,

        ]);

        nominee::create([

            'name'=>$req->n2,
            'mobile'=>$req->m2,
            'status'=>'Active',
            'user_id'=>$req->userid,

        ]);

        nominee::create([

            'name'=>$req->n3,
            'mobile'=>$req->m3,
            'status'=>'Active',
            'user_id'=>$req->userid,

        ]);

        nominee::create([

            'name'=>$req->n4,
            'mobile'=>$req->m4,
            'status'=>'Active',
            'user_id'=>$req->userid,

        ]);

        nominee::create([

            'name'=>$req->n5,
            'mobile'=>$req->m5,
            'status'=>'Active',
            'user_id'=>$req->userid,

        ]);

        $data['success']="success";
        echo json_encode($data);
        
    }

     public function edit_nominee(Request $req)

    {
        nominee::where('id',$req->nid1)->update([

            'name'=>$req->n1,
            'mobile'=>$req->m1,
            'status'=>'Active',
            'user_id'=>$req->userid,

        ]);

        nominee::where('id',$req->nid2)->update([

            'name'=>$req->n2,
            'mobile'=>$req->m2,
            'status'=>'Active',
            'user_id'=>$req->userid,

        ]);

        nominee::where('id',$req->nid3)->update([

            'name'=>$req->n3,
            'mobile'=>$req->m3,
            'status'=>'Active',
            'user_id'=>$req->userid,

        ]);

        nominee::where('id',$req->nid4)->update([

            'name'=>$req->n4,
            'mobile'=>$req->m4,
            'status'=>'Active',
            'user_id'=>$req->userid,

        ]);

        nominee::where('id',$req->nid5)->update([

            'name'=>$req->n5,
            'mobile'=>$req->m5,
            'status'=>'Active',
            'user_id'=>$req->userid,

        ]);

        $data['success']="success";
        echo json_encode($data);
        
    }

public function notifications($mid)

    {
        $noti=notification::where('status','Active')->where('noti_type', $mid)->orwhere('noti_type','all')->get();
        return view('member.notification',['noti'=>$noti]);
    }

    public function noti_ios($mid)

    {
        $noti=notification::where('status','Active')->where('noti_type', $mid)->orwhere('noti_type','all')->get();
        return view('member.noti_ios',['noti'=>$noti]);
    }



        public function applicationstatus($appid)

    {
        $appdet=application::where('id',$appid)->first();
        $fund=funding::where('application_id',$appid)->first();
        if($fund)
        {
          $fund_face=funding_face::where('fund_id',$fund->id)->where('status','Approved')->latest()->get();
          $fcnt=1;
          return view('member.applicationstatus',['appdet'=>$appdet,'fund_face'=>$fund_face,'fund'=>$fund,'fcnt'=>$fcnt]);  
        }
        else
        {
            return view('member.approval_pending',['appdet'=>$appdet]);   
        }
        
        
    }

     public function repaystatus($appid)

    {
        $appdet=application::where('id',$appid)->first();
        $fund=funding::where('application_id',$appid)->first();
        $mem=User::where('id',$appdet->user_id)->first();

        
        if($fund)
        {
          $repay=repayment::where('application_id',$appid)->where('status','Approved')->latest()->get();
          return view('member.repaymentstatus',['appdet'=>$appdet,'repay'=>$repay,'fund'=>$fund,'mem'=>$mem]);  
        }
        else
        {
            return view('member.approval_pending',['appdet'=>$appdet]);   
        }
        
        
    }

     public function repay_payment(Request $request)

    {
        if($request->status=='successful')
        {
            
            $parts = explode("-", $request->tx_ref);
            $uid = $parts[0];
            $repayid = $parts[1]; 
            $repay=repayment::where('id',$repayid)->first();

                   repayment::where('id',$repayid)->update([

                    'pay_status'=>'Paid',
                    'paid_amount'=>$repay->amount,
                    'paid_at'=>date('Y-m-d'),
                    'reference_id'=>$request->transaction_id,
                    'payment_approval'=>'Pending',
                    

                   ]);
                  
        return view('member.repaymentsuccess');
        }
        else
        {

            $parts = explode("-", $request->tx_ref);
            $uid = $parts[0];
            $camp = $parts[1]; 
          return view('member.repaymentfailed');  
        }
        
    }




    ///////////////////////////

    public function funding_campaigns($mid)

    {
        $member=User::where('id',$mid)->first();
        $apps=application::where('user_id',$mid)->latest()->get();
        //$repay=repayment::where('user_id',$mid)->where('status','Approved')->where('pay_status','Pending')->latest()->get();
        return view('member.funding_campaigns',['member'=>$member,'apps'=>$apps]);
    }

        public function repayment_campaigns($mid)

    {
        $member=User::where('id',$mid)->first();
        $apps=application::where('user_id',$mid)->latest()->get();
        $repay=repayment::where('user_id',$mid)->where('status','Approved')->where('pay_status','Pending')->latest()->get();
        return view('member.repayment_campaigns',['member'=>$member,'apps'=>$apps,'repay'=>$repay]);
    }



}
