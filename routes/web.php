<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\CampaignController;
use App\Http\Controllers\AddOnController;
use App\Http\Controllers\NotificationController;
use App\Http\Controllers\ApplicationController;
use App\Http\Controllers\LuckyDrawController;
use App\Http\Controllers\SubAdminController;
use App\Http\Controllers\MemberController;
use App\Http\Controllers\PaymentController;

Route::get('/', [AdminController::class, 'home']);
Route::get('/CrowdAfrik-Admin', [AdminController::class, 'home'])->name('admin.home');
Route::get('/forgot-password', [AdminController::class, 'forgot_password']);
Route::post('/AdminMailChk' , [AdminController::class, 'admin_mail_chk']);
Route::get('/admin-password-reset/{tk}/{em}', [AdminController::class, 'admin_password_reset']);
Route::post('/adminpsw-reset' , [AdminController::class, 'adminpsw_reset']);
Route::post('/AdminLogin' , [AdminController::class, 'login'])->name('admin.login');

Route::middleware(['AdminLoginCheck','PreventBack'])->group(function () {

  Route::get('/admin-dashboard', [AdminController::class, 'dashboard'])->name('admin.dashboard');
  Route::get('/admin-logout', [AdminController::class, 'logout'])->name('admin.logout');
  Route::get('/change-password', [AdminController::class, 'change_password']);
  Route::post('/password-update', [AdminController::class, 'password_update']);
  Route::get('/admin-profile', [AdminController::class, 'admin_profile']);
  Route::get('/edit-admin-profile', [AdminController::class, 'edit_admin_profile']);
  Route::post('/admin-profile-update', [AdminController::class, 'admin_profile_update']);


  Route::get('/users', [UserController::class, 'users']);
  Route::post('/activate-user', [UserController::class, 'activate_user']);
  Route::get('/user-applications/{uid}', [UserController::class, 'user_applications']);
  Route::post('/block-user', [UserController::class, 'block_user']);
  Route::get('/blocked-users', [UserController::class, 'blocked_users']);

  Route::get('/nominees/{uid}', [UserController::class, 'nominees']);
  Route::post('/activate-nominee', [UserController::class, 'activate_nominee']);
  Route::post('/block-nominee', [UserController::class, 'block_nominee']);


  Route::get('/campaign-categories', [CampaignController::class, 'campaign_categories']);
  Route::get('/add-campcategory', [CampaignController::class, 'add_campcategory']);
  Route::post('/campcat-add', [CampaignController::class, 'campcat_add']);
  Route::post('/activate-campcat', [CampaignController::class, 'activate_campcat']);
  Route::post('/block-campcat', [CampaignController::class, 'block_campcat']);
  Route::get('/edit-campcategory/{cid}', [CampaignController::class, 'edit_campcategory']);
  Route::post('/campcat-edit', [CampaignController::class, 'campcat_edit']);

  Route::get('/campaign', [CampaignController::class, 'campaign']);
  Route::get('/add-campaign', [CampaignController::class, 'add_campaign']);
  Route::post('/camp-add', [CampaignController::class, 'camp_add']);
  Route::get('/edit-campaign/{cid}', [CampaignController::class, 'edit_campaign']);
  Route::post('/camp-edit', [CampaignController::class, 'camp_edit']);
  Route::post('/camp-status', [CampaignController::class, 'camp_status']);

  Route::get('/campaign-gallery/{cid}', [CampaignController::class, 'campaign_gallery']);
   Route::post('/camp-imageadd', [CampaignController::class, 'camp_imageadd']);
   Route::post('/delete-campgal', [CampaignController::class, 'delete_campgal']);

  Route::get('/countries', [AddOnController::class, 'countries']);
  Route::post('/country-add', [AddOnController::class, 'country_add']);
  Route::post('/country-edit', [AddOnController::class, 'country_edit']);
  Route::post('/activate-country', [AddOnController::class, 'activate_country']);
  Route::post('/block-country', [AddOnController::class, 'block_country']);
  Route::get('/country-users/{cid}', [AddOnController::class, 'country_users']);

  Route::get('/states', [AddOnController::class, 'states']);
  Route::post('/state-add', [AddOnController::class, 'state_add']);
  Route::post('/state-edit', [AddOnController::class, 'state_edit']);
  Route::post('/activate-state', [AddOnController::class, 'activate_state']);
  Route::post('/block-state', [AddOnController::class, 'block_state']);
  Route::get('/state-users/{cid}', [AddOnController::class, 'state_users']);

  Route::get('/local-areas/{sid}', [AddOnController::class, 'local_areas']);
  Route::post('/area-add', [AddOnController::class, 'area_add']);
  Route::post('/area-edit', [AddOnController::class, 'area_edit']);
  Route::post('/activate-area', [AddOnController::class, 'activate_area']);
  Route::post('/block-area', [AddOnController::class, 'block_area']);
  Route::get('/area-users/{cid}', [AddOnController::class, 'area_users']);

  Route::get('/notifications', [NotificationController::class, 'notifications']);
  Route::get('/add-notification', [NotificationController::class, 'add_notification']);
  Route::post('/notification-add', [NotificationController::class, 'notification_add']);
  Route::get('/edit-notification/{nid}', [NotificationController::class, 'edit_notification']);
  Route::post('/notification-update', [NotificationController::class, 'notification_update']);
  Route::post('/delete-notification', [NotificationController::class, 'delete_notification']);
  Route::post('/noti-status', [NotificationController::class, 'noti_status']);

   Route::get('/completed-notifications', [NotificationController::class, 'completed_notifications']);

   Route::get('/pending-campaigns-applications', [ApplicationController::class, 'pending_campaigns_applications']);
   Route::get('/pending-applications/{cid}', [ApplicationController::class, 'pending_applications']);
   Route::get('/pending-appdetails/{cid}', [ApplicationController::class, 'pending_appdetails']);
   Route::post('/application-status', [ApplicationController::class, 'application_status']);
   Route::post('/get-state', [ApplicationController::class, 'get_state']);
   Route::post('/pending-applications-search', [ApplicationController::class, 'pending_application_search']);
   Route::post('/application-special', [ApplicationController::class, 'application_special']);
   Route::post('/reject-appreason', [ApplicationController::class, 'reject_appreason']);

   Route::get('/rejected-campaigns-applications', [ApplicationController::class, 'rejected_campaigns_applications']);
   Route::get('/rejected-applications/{cid}', [ApplicationController::class, 'rejected_applications']);
   Route::post('/rejected-application-search', [ApplicationController::class, 'rejected_application_search']);
   Route::get('/rejected-appdetails/{cid}', [ApplicationController::class, 'rejected_appdetails']);

  Route::get('/cancelled-campaigns-applications', [ApplicationController::class, 'cancelled_campaigns_applications']);
   Route::get('/cancelled-applications/{cid}', [ApplicationController::class, 'cancelled_applications']);
   Route::post('/cancelled-application-search', [ApplicationController::class, 'cancelled_application_search']);
   Route::get('/cancelled-appdetails/{cid}', [ApplicationController::class, 'cancelled_appdetails']);


   Route::get('/approved-campaigns-applications', [ApplicationController::class, 'approved_campaigns_applications']);
   Route::get('/approved-applications/{cid}', [ApplicationController::class, 'approved_applications']);
      Route::post('/approved-application-search', [ApplicationController::class, 'approved_application_search']);
   Route::get('/approved-appdetails/{cid}', [ApplicationController::class, 'approved_appdetails']);

   Route::get('/special-campaigns-applications', [ApplicationController::class, 'special_campaigns_applications']);
    Route::get('/special-applications/{cid}', [ApplicationController::class, 'special_applications']);
  Route::post('/special-application-search', [ApplicationController::class, 'special_application_search']);

  Route::get('/repayment-pending', [ApplicationController::class, 'repayment_pending']);
  Route::get('/repayment-approval-pending', [ApplicationController::class, 'repayment_approval_pending']);
  Route::get('/expired-repayments', [ApplicationController::class, 'expired_repayments']);

   Route::post('/fund-add', [ApplicationController::class, 'fund_add']);
   Route::post('/fund-update', [ApplicationController::class, 'fund_update']);

   Route::post('/fundface-add', [ApplicationController::class, 'fundface_add']);
   Route::post('/fundface-delete', [ApplicationController::class, 'fundface_delete']);
    Route::post('/fundface-status', [ApplicationController::class, 'fundface_status']);

  Route::post('/repayment-add', [ApplicationController::class, 'repayment_add']);
  Route::post('/repay-delete', [ApplicationController::class, 'repay_delete']);
  Route::post('/repay-status', [ApplicationController::class, 'repay_status']); 
   Route::post('/repay-approval', [ApplicationController::class, 'repay_approval']);
   Route::post('/reject-repay', [ApplicationController::class, 'reject_repay']);  


   Route::get('/completed-campaigns-applications', [ApplicationController::class, 'completed_campaigns_applications']);
   Route::get('/completed-applications/{cid}', [ApplicationController::class, 'completed_applications']);
   Route::post('/completed-application-search', [ApplicationController::class, 'completed_application_search']);
   Route::get('/completed-appdetails/{cid}', [ApplicationController::class, 'completed_appdetails']);



  Route::post('/approve-apps', [LuckyDrawController::class, 'approve_apps']);
  Route::get('/approved-luckyappdetails/{cid}', [LuckyDrawController::class, 'approved_luckyappdetails']);


    Route::get('/admins', [SubAdminController::class, 'admins']);
  Route::get('/add-admin', [SubAdminController::class, 'add_admin']);
  Route::post('/admin-add', [SubAdminController::class, 'admin_add']);
  Route::get('/edit-admin/{cid}', [SubAdminController::class, 'edit_admin']);
  Route::post('/admin-edit', [SubAdminController::class, 'admin_edit']);
  //Route::post('/camp-status', [SubAdminController::class, 'camp_status']);

     Route::get('/lucky-draw-campaigns', [LuckyDrawController::class, 'lucky_draw_campaigns']);
   Route::get('/lucky-submitted-applications/{cid}', [LuckyDrawController::class, 'lucky_submitted_applications']);
   Route::get('/lucky-draw-result/{cid}/{nm}', [LuckyDrawController::class, 'lucky_draw_result']);
   Route::get('/lucky-users/{cid}', [LuckyDrawController::class, 'lucky_users']);
     Route::post('/draw-add', [LuckyDrawController::class, 'draw_add']);

       Route::post('/get-luckydet', [LuckyDrawController::class, 'get_luckydet']);

       Route::get('/enquiries', [UserController::class, 'enquiries']); 
   


    
});


    Route::get('/member/home/{mid}', [MemberController::class, 'home']);
    Route::get('/member/campaigns/{catid}/{mid}', [MemberController::class, 'campaigns']);
    Route::get('/member/campaigns-select/{catid}/{mid}/{campid}', [MemberController::class, 'campaigns_select']);
    Route::post('/member/get-camps', [MemberController::class, 'get_camp']);

    Route::get('/member/app-payment/{mid}', [MemberController::class, 'app_payment']);


    Route::get('/member/fundingform/{cid}/{mid}', [MemberController::class, 'fundingform']);
    Route::post('/member/cancel-application', [MemberController::class, 'cancel_application']);
    Route::post('/member/submit-application', [MemberController::class, 'submit_application']);
    Route::get('/member/form-success/{mid}', [MemberController::class, 'form_success']);


    Route::get('/member/profile/{mid}', [MemberController::class, 'profile']);
    Route::get('/member/funding-campaigns/{mid}', [MemberController::class, 'funding_campaigns']);
    Route::get('/member/repayment-campaigns/{mid}', [MemberController::class, 'repayment_campaigns']);
    Route::get('/member/aboutus/{mid}', [MemberController::class, 'aboutus']);
    Route::get('/member/terms/{mid}', [MemberController::class, 'terms']);
    Route::get('/member/contact/{mid}', [MemberController::class, 'contact']);
    Route::get('/member/help/{mid}', [MemberController::class, 'help']);
    Route::get('/member/faq/{mid}', [MemberController::class, 'faq']);
    Route::get('/member/privacy_policy/{mid}', [MemberController::class, 'privacy_policy']);
    Route::get('/member/personaldetails/{mid}', [MemberController::class, 'personaldetails']);
    Route::post('/member/personaldet-update', [MemberController::class, 'personaldet_update']);

    Route::get('/member/bankdetail/{mid}', [MemberController::class, 'bankdetail']);
    Route::post('/member/bankdet-update', [MemberController::class, 'bankdet_update']);


    Route::get('/member/nominees/{mid}', [MemberController::class, 'nominees']);
    Route::post('/member/add-nominee', [MemberController::class, 'add_nominee']);
    Route::post('/member/edit-nominee', [MemberController::class, 'edit_nominee']);

    Route::get('/member/notifications/{mid}', [MemberController::class, 'notifications']);
    Route::get('/member/noti-ios/{mid}', [MemberController::class, 'noti_ios']);

    Route::get('/member/search/{mid}', [MemberController::class, 'search']);
    Route::post('/member/get-cat', [MemberController::class, 'get_cat']);

     Route::get('/member/applicationstatus/{appid}', [MemberController::class, 'applicationstatus']);
     Route::get('/member/repaystatus/{appid}', [MemberController::class, 'repaystatus']);   
    Route::get('/member/repay-payment', [MemberController::class, 'repay_payment']);

    Route::post('/member/contact-request', [MemberController::class, 'contact_request']);

     Route::get('/member/countries', [MemberController::class, 'countries']);
     Route::post('/member/get-cont', [MemberController::class, 'get_cont']);
      Route::get('/member/states/{cid}', [MemberController::class, 'states']);
      Route::post('/member/get-st', [MemberController::class, 'get_st']);

       Route::get('/member/country-codes', [MemberController::class, 'country_codes']);
     Route::post('/member/get-contcode', [MemberController::class, 'get_contcode']);


// Route::get('/pay', [PaymentController::class, 'pay']);
// Route::post('/processPayment', [PaymentController::class, 'processPayment']);
//Route::get('/application-payment', [PaymentController::class, 'application-payment']);

   

