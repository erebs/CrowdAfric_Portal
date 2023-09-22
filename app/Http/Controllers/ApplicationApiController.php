<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Models\application;
use App\Models\application_document;
use App\Models\funding;
use App\Models\funding_face;
use App\Models\repayment;
use App\Models\campaign;
use App\Models\campaign_category;
use App\Models\User;
use App\Models\local_gov_area;

class ApplicationApiController extends Controller
{
    public function apply_application(Request $req)
    {
        $user=auth()->user()->id;

        $rules = [
                    'campaign_id' => 'required',

                    ];
                
            $validator = Validator::make($req->all(), $rules);  

             if ($validator->fails()) 
                {
                   return response()->json(['message'=>"Validation error",'status_code'=>'00'],400);
                } 
            else 
                {
                    $member=User::where('id',$user)->first();

                   $app=application::create([

                    'user_id'=>$user,
                    'campaign_id'=>$req->campaign_id,
                    'country_id'=>$member->country_id,
                    'state_id'=>$member->state_id,
                    'status'=>'Started',
                    'payment_status'=>'Paid',
                    'amount'=>$req->amount,
                    'payment_date'=>date('Y-m-d'),
                    'reference_id'=>$req->transaction_id

                   ]); 

                     return response()->json([

                            'application_id'=>$app->id,
                            'state_id'=>$member->state_id,
                            'message'=>'Application started successfully',
                            'status_code'=>'01',
                           
                            ],200);
                 }    

     } 


     public function submit_application(Request $req)
    {
        $user=auth()->user()->id;

        $rules = [
                    'application_id' => 'required',
                    'plan' => 'required',
                    'location' => 'required',
                    'address' => 'required',
                    'post' => 'required',
                    'country_id' => 'required',
                    'state_id' => 'required',
                    'nominee1' => 'required',
                    'mobile1' => 'required',
                    'nominee2' => 'required',
                    'mobile2' => 'required',
                    'nominee3' => 'required',
                    'mobile3' => 'required',
                    'nominee4' => 'required',
                    'mobile4' => 'required',
                    'nominee5' => 'required',
                    'mobile5' => 'required',


                    ];
                
            $validator = Validator::make($req->all(), $rules);  

             if ($validator->fails()) 
                {
                   return response()->json(['message'=>"Validation error",'status_code'=>'00'],400);
                } 
            else 
                {

                   $app=application::where('id',$req->application_id)->update([

                    'plan' => $req->plan,
                    'location' => $req->location,
                    'address' => $req->address,
                    'post' => $req->post,
                    //'country_id' => $req->country_id,
                    //'state_id' => $req->state_id,
                    'local_area' => $req->local_area,
                    'plot' => $req->plot,
                    'annual_turnover' => $req->annual_turnover,
                    'nominee1' => $req->nominee1,
                    'mobile1' => $req->mobile1,
                    'nominee2' => $req->nominee2,
                    'mobile2' => $req->mobile2,
                    'nominee3' => $req->nominee3,
                    'mobile3' => $req->mobile3,
                    'nominee4' => $req->nominee4,
                    'mobile4' => $req->mobile4,
                    'nominee5' => $req->nominee5,
                    'mobile5' => $req->mobile5,
                    'status'=>'Submitted',

                   ]); 

                     return response()->json([

                            'message'=>'Application submitted successfully',
                            'status_code'=>'01',
                           
                            ],200);
                 }    

     }  


     public function application_documents(Request $req)
    {
        $user=auth()->user()->id;

        $rules = [
                    'application_id' => 'required',
                    'file' => 'required',
                    'type' => 'required',

                    ];
                
            $validator = Validator::make($req->all(), $rules);  

             if ($validator->fails()) 
                {
                   return response()->json(['message'=>"Validation error",'status_code'=>'00'],400);
                } 
            else 
                {

                      $file = $req->file('file');
                     $new_name = "/application_documents/" . time() . '.' . $file->getClientOriginalExtension();                  
            $file->move(public_path('application_documents'), $new_name);

                   application_document::create([

                    'application_id'=>$req->application_id,
                    'file'=>$new_name,
                    'type'=>$req->type,

                   ]); 

                     return response()->json([

                            'message'=>'Document uploaded successfully',
                            'status_code'=>'01',
                           
                            ],200);
                 }    

     }  



     ///////////////////////////////////


      public function user_applications(Request $req)
    {
        $user=auth()->user()->id;

       //$applications=application::where('user_id',$user)->latest()->get();

         $applications = application::join('campaigns', 'applications.campaign_id', '=', 'campaigns.id')
    ->select('applications.*', 'campaigns.title as campaign')
    ->where('applications.user_id',$user)
    ->latest()
    ->get();



                     return response()->json([

                            'applications'=>$applications,
                           // 'message'=>'Application started successfully',
                            'status_code'=>'01',
                           
                            ],200);
    

     } 

       public function funding_phases($appid)

    {
        $appdet=application::where('id',$appid)->first();
        

        if($appdet->status=='Approved')
        {
            $fund=funding::where('application_id',$appid)->first();
            if($fund)
            {
                $application = application::join('campaigns', 'applications.campaign_id', '=', 'campaigns.id')
                ->select('applications.campaign_id', 'campaigns.title as campaign')
                ->where('applications.id',$appid)
                ->first();
              $fund_face=funding_face::where('fund_id',$fund->id)->where('status','Approved')->latest()->get();  
               return response()->json([

                            'application'=>$application,
                            'fund_details'=>$fund,
                            'fund_phases'=>$fund_face,
                            //'message'=>'Application started successfully',
                            'status_code'=>'01',
                           
                            ],200);
            }
            else
            {
               return response()->json([

                            'message'=>'Fund generation pending',
                            'status_code'=>'00',
                           
                            ],400); 
            }

          
           
        }
        else
        {
            return response()->json([

                           'message'=>'Approval Pending',
                            'status_code'=>'00',
                           
                            ],400);  
        }
        
        
    }



      public function repayments($appid)

    {
        $appdet=application::where('id',$appid)->first();
        // $fund=funding::where('application_id',$appid)->first();
        // $mem=User::where('id',$appdet->user_id)->first();

        
        // if($fund)
        // {
        //   $repay=repayment::where('application_id',$appid)->where('status','Approved')->latest()->get();
        //   $application = application::join('campaigns', 'applications.campaign_id', '=', 'campaigns.id')
        //         ->select('applications.campaign_id', 'campaigns.title as campaign')
        //         ->where('applications.id',$appid)
        //         ->first();
        //   return view('member.repaymentstatus',['appdet'=>$appdet,'repay'=>$repay,'fund'=>$fund,'mem'=>$mem]);  
        // }
        // else
        // {
        //     return view('member.approval_pending',['appdet'=>$appdet]);   
        // }


        if($appdet->status=='Approved')
        {
            $fund=funding::where('application_id',$appid)->first();
            if($fund)
            {
                $application = application::join('campaigns', 'applications.campaign_id', '=', 'campaigns.id')
                ->select('applications.campaign_id', 'campaigns.title as campaign')
                ->where('applications.id',$appid)
                ->first();
              $repay=repayment::where('application_id',$appid)->where('status','Approved')->latest()->get(); 
               return response()->json([

                            'application'=>$application,
                            'fund_details'=>$fund,
                            'repayments'=>$repay,
                            //'message'=>'Application started successfully',
                            'status_code'=>'01',
                           
                            ],200);
            }
            else
            {
               return response()->json([

                            'message'=>'Fund generation pending',
                            'status_code'=>'00',
                           
                            ],400); 
            }

          
           
        }
        else
        {
            return response()->json([

                           'message'=>'Approval Pending',
                            'status_code'=>'00',
                           
                            ],400);  
        }
        
        
    }


    ////////////////

     public function search_items(Request $req)
    {
        $cat = $req->item;
       $categories = campaign_category::where('title', 'like', '%' . $cat . '%')->orderBy('title','ASC')->get();
       $campaigns = campaign::where('title', 'like', '%' . $cat . '%')->orderBy('title','ASC')->get();

       return response()->json([

                           'categories'=>$categories,
                           'campaigns'=>$campaigns,
                            'status_code'=>'01',
                           
                            ],200);  


    }

     public function local_gov_areas()
    {
        $user=auth()->user()->id;
        $member=User::where('id',$user)->first();
        $local_gov_areas=local_gov_area::where('state_id',$member->state_id)->where('status','Active')->get();

       return response()->json([

                           'local_gov_areas'=>$local_gov_areas,
                            'status_code'=>'01',
                           
                            ],200);  


    }

    public function view_documents($appid)
    {
        $user=auth()->user()->id;
        $documents=application_document::where('application_id',$appid)->get();

       return response()->json([

                           'documents'=>$documents,
                            'status_code'=>'01',
                           
                            ],200);  


    }

        public function delete_document($docid)
    {
        $user=auth()->user()->id;
        application_document::where('id',$docid)->delete();

       return response()->json([

                           'message'=>'Document deleted successfully',
                            'status_code'=>'01',
                           
                            ],200);  


    }

    public function submit_repayment(Request $req)

    {  
            //$repay=repayment::where('id',$repayid)->first();

                   repayment::where('id',$req->repayment_id)->update([

                    'pay_status'=>'Paid',
                    'paid_amount'=>$req->amount,
                    'paid_at'=>date('Y-m-d'),
                    'reference_id'=>$req->reference_id,
                    'payment_approval'=>'Pending',
                    

                   ]);
                  
        return response()->json([

                           'message'=>'Repayment submitted successfully',
                            'status_code'=>'01',
                           
                            ],200); 
        
        
    }


         public function delete_account()
    {
        $user=auth()->user()->id;
        $member=User::where('id',$user)->first();
        
        User::where('id',$user)->update([

            'phone_number'=>$member->phone_number.'00',
            'email_id'=>$member->email_id.'00',
            'status'=>'Deleted',
        ]);

       return response()->json([

                           'message'=>'Account deleted successfully',
                            'status_code'=>'01',
                           
                            ],200);  


    }




}
