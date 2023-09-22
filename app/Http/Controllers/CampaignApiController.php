<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;
use App\Models\campaign;
use App\Models\campaign_category;
use App\Models\application;

class CampaignApiController extends Controller
{
     public function campaign_categories()
        
    {
        $user=auth()->user()->id;
        $camp=campaign_category::where('status','Active')->get();
        $campcnt=campaign::where('status','Active')->count();
        $pending_applications=application::where('user_id',$user)->where('status','Started')->latest()->get();
        return response()->json([

                'categories'=>$camp,
                'active_campaigns'=>$campcnt,
                'pending_applications'=>$pending_applications,
                'message'=>'Success',
                'status_code'=>'01',
               
                ],200);

    }

     public function campaigns($catid)
        
    {
        $user=auth()->user()->id;
        $camp=campaign::where('status','Active')->where('cat_id',$catid)->get();

        return response()->json([

                'campaigns'=>$camp,
                'message'=>'Success',
                'status_code'=>'01',
               
                ],200);

    }
}
