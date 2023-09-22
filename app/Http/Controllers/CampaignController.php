<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use DB,Auth,Cache;
use App\Models\campaign;
use App\Models\campaign_category;
use App\Models\campaign_gallery;
use Redirect;

class CampaignController extends Controller
{
    public function campaign_categories()
    {
    
       $cat=campaign_category::get();
       $header="Campaign";
        return view('campaign.CampaignCategories',['cat'=>$cat,'header'=>$header]);      
    }

    public function add_campcategory()
    {
       $header="Campaign";
        return view('campaign.AddCategory',['header'=>$header]);      
    }

    public function campcat_add(Request $req)
    {
        $img = $req->file('img');

        if($img=='')
        {
            $new_name="";
        }
        else{
          $image = $req->file('img');
             $new_name = "campaign_category/image/" . time() . '.' . $image->getClientOriginalExtension();
            $image->move(public_path('campaign_category/image'), $new_name);
        }

         $img1 = $req->file('img1');
        
        if($img1=='')
        {
            $new_name1="";
        }
        else{
          $image1 = $req->file('img1');
             $new_name1 = "campaign_category/icon/" . time() . '.' . $image1->getClientOriginalExtension();
            $image1->move(public_path('campaign_category/icon'), $new_name1);
        }


       campaign_category::create([

        'title'=>$req->title,
        'description'=>$req->desc,
        'photo'=>$new_name,
        'icon'=>$new_name1,
        'status'=>'Active',

       ]);   

       $data['success']='Success';
       echo json_encode($data);  
    }


    public function activate_campcat(Request $req)
    {

        $uid=$req->body;
        

        campaign_category::where('id',$uid)->update([

            'status'=>'Active'

            ]);

            $data['success']="success";
            echo json_encode($data);

      } 

       public function block_campcat(Request $req)
    {

        $uid=$req->body;
        

        campaign_category::where('id',$uid)->update([

            'status'=>'Blocked'

            ]);

            $data['success']="success";
            echo json_encode($data);

      }

      public function edit_campcategory($cid)
    {
        $catid=decrypt($cid);
       $cat=campaign_category::where('id',$catid)->first();
       $header="Campaign";
        return view('campaign.EditCampaignCategories',['cat'=>$cat,'header'=>$header]);      
    }

    public function campcat_edit(Request $req)
    {
        $cat=campaign_category::where('id',$req->catid)->first();
        $img = $req->file('img');

        if($img=='')
        {
            $new_name=$cat->photo;
        }
        else{
          $image = $req->file('img');
             $new_name = "campaign_category/image/" . time() . '.' . $image->getClientOriginalExtension();
            $image->move(public_path('campaign_category/image'), $new_name);
        }

         $img1 = $req->file('img1');
        
        if($img1=='')
        {
            $new_name1=$cat->icon;
        }
        else{
          $image1 = $req->file('img1');
             $new_name1 = "campaign_category/icon/" . time() . '.' . $image1->getClientOriginalExtension();
            $image1->move(public_path('campaign_category/icon'), $new_name1);
        }


       campaign_category::where('id',$req->catid)->update([

        'title'=>$req->title,
        'description'=>$req->desc,
        'photo'=>$new_name,
        'icon'=>$new_name1,

       ]);   

       $data['success']='Success';
       echo json_encode($data);  
    }


    //////////////////

    public function campaign()
    {
    
       $camp=campaign::orderBy('cat_id','ASC')->get();
       $header="Campaign";
        return view('campaign.Campaign',['camp'=>$camp,'header'=>$header]);      
    }

    public function add_campaign()
    {
       $cat=campaign_category::where('status','Active')->get();
       $header="Campaign";
        return view('campaign.AddCampaign',['cat'=>$cat,'header'=>$header]);      
    }

    public function camp_add(Request $req)
    {
        $img = $req->file('img');

        if($img=='')
        {
            $new_name="";
        }
        else{
          $image = $req->file('img');
             $new_name = "campaigns/image/" . time() . '.' . $image->getClientOriginalExtension();
            $image->move(public_path('campaigns/image'), $new_name);
        }

         $img1 = $req->file('img1');
        
        if($img1=='')
        {
            $new_name1="";
        }
        else{
          $image1 = $req->file('img1');
             $new_name1 = "campaigns/icon/" . time() . '.' . $image1->getClientOriginalExtension();
            $image1->move(public_path('campaigns/icon'), $new_name1);
        }


       campaign::create([

        'cat_id'=>$req->ct,
        'title'=>$req->title,
        'fee'=>$req->fee,
        'description'=>$req->desc,
        'content1'=>$req->desc1,
        'content2'=>$req->desc2,
        'photo'=>$new_name,
        'icon'=>$new_name1,
        'status'=>'Active',

       ]);   

       $data['success']='Success';
       echo json_encode($data);  
    }

     public function edit_campaign($cid)
    {
        $campid=decrypt($cid);
         $cat=campaign_category::get();
       $camp=campaign::where('id',$campid)->first();
       $header="Campaign";
        return view('campaign.EditCampaign',['camp'=>$camp,'cat'=>$cat,'header'=>$header]);      
    }

    public function camp_edit(Request $req)
    {
        $camp=campaign::where('id',$req->campid)->first();
        $img = $req->file('img');

        if($img=='')
        {
            $new_name=$camp->photo;
        }
        else{
          $image = $req->file('img');
             $new_name = "campaigns/image/" . time() . '.' . $image->getClientOriginalExtension();
            $image->move(public_path('campaigns/image'), $new_name);
        }

         $img1 = $req->file('img1');
        
        if($img1=='')
        {
            $new_name1=$camp->icon;
        }
        else{
          $image1 = $req->file('img1');
             $new_name1 = "campaigns/icon/" . time() . '.' . $image1->getClientOriginalExtension();
            $image1->move(public_path('campaigns/icon'), $new_name1);
        }


       campaign::where('id',$req->campid)->update([

         'cat_id'=>$req->ct,
        'title'=>$req->title,
        'fee'=>$req->fee,
        'description'=>$req->desc,
        'content1'=>$req->desc1,
        'content2'=>$req->desc2,
        'photo'=>$new_name,
        'icon'=>$new_name1,

       ]);   

       $data['success']='Success';
       echo json_encode($data);  
    }

    public function camp_status(Request $req)
    {
        

       campaign::where('id',$req->body1)->update([

         'status'=>$req->body,

       ]);   

       $data['success']='Success';
       echo json_encode($data);  
    }

///////////////////////////////////////////


public function campaign_gallery($cid)
    {
        $campid=decrypt($cid);
       $gallery=campaign_gallery::where('camp_id',$campid)->get();
        $camdet=campaign::select('title')->where('id',$campid)->first();
       $header="Campaign";
        return view('campaign.CampaignGallery',['gallery'=>$gallery,'campid'=>$campid,'camdet'=>$camdet,'header'=>$header]);      
    }

    public function camp_imageadd(Request $req)
    {
       
        // $img = $req->file('img');

        // if($img=='')
        // {
        //     $new_name='';
        // }
        // else{
        //   $image = $req->file('img');
        //      $new_name = "campaign_gallery/" . time() . '.' . $image->getClientOriginalExtension();
        //     $image->move(public_path('campaign_gallery'), $new_name);
        // }


        if ($req->hasFile('pdf_file')) {
            $files = $req->file('pdf_file');

            foreach ($files as $file) {
                // Validate and store each uploaded file
                
             $new_name = "campaign_gallery/" . time() . '.' . $file->getClientOriginalExtension();
            $file->move(public_path('campaign_gallery'), $new_name);
            


       campaign_gallery::create([

         'camp_id'=>$req->bid1,
        'file'=>$new_name,

       ]);

       } 
       }  

return Redirect::back();
    }

     public function delete_campgal(Request $req)
    {

        $uid=$req->body;
        

        campaign_gallery::where('id',$uid)->delete();

            $data['success']="success";
            echo json_encode($data);

      } 



}
