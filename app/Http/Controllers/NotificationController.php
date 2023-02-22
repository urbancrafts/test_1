<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Charges;
use App\Models\Content;
use App\Models\Country;
use App\Models\Gallery;
use App\Models\Settings;
use App\Models\Statistic;
use App\Models\SubModule;
use App\Models\Subscription;
use App\Models\Services;
use App\Models\User;
use App\Models\Shelter;
use App\Models\Rooms;
use App\Models\Blog;
use App\Models\Reservations;
use App\Models\StoreCategory;
use App\Models\StoreItem;
use App\Models\Orders;
use App\Models\ServiceBooking;
use App\Models\Debt;
use App\Models\transaction;
use App\Models\review;
use App\Models\Messages;
use App\Models\Notification;
use App\Models\Support;
use App\Models\NewsLetters;
use App\Models\Comment;
use App\Models\ResortFeatures;
use App\Models\SlideFeatures;
use App\Http\Controllers\API\BaseController as BaseController;
use App\Http\Controllers\DateManagerController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\ Mail;
use Intervention\Image\ImageManagerStatic as Image;

class NotificationController extends BaseController
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /******************************************************************
 * ***************** Notification bar and counters*****************
 *****************************************************************/
 public function notification_counter(Request $request){
    $user_id = Auth::user()->id;
    $notes2 = Notification::where(function($p) use($user_id){
        $p->where('user_id', '=', $user_id);
        $p->where('seen', '=', 0);
       })->get();
    
       return $this->sendResponse(count($notes2), 'Notification loaded.'); 
 }
 
 public function notification_bar(Request $request){
  $user_id = Auth::user()->id;
    $tran_counter = Notification::where(function($p) use($user_id){
      $p->where('user_id', '=', $user_id);
      $p->where('note_type', '=', 'Transaction');
      $p->where('seen', '=', 0);   
    })->get();

    $sub_counter = Notification::where(function($p) use($user_id){
      $p->where('user_id', '=', $user_id);
      $p->where('note_type', '=', 'Subscription');
      $p->where('seen', '=', 0);   
    })->get();

    $com_counter = Notification::where(function($p) use($user_id){
      $p->where('user_id', '=', $user_id);
      $p->where('note_type', '=', 'Comment');
      $p->where('seen', '=', 0);   
    })->get();
    
    $notes = Notification::where('user_id', $user_id)->limit(3)->orderBy('id', 'desc')->get();

    $notes_header_counter = Notification::where(function($p) use($user_id){
        $p->where('user_id', '=', $user_id);
        $p->where('seen', '=', 0);
       })->get();

   $note_arr = array('note_count' => count($notes_header_counter),
                     'notification' => $notes,
                     'tranCounter' => count($tran_counter),
                     'subCounter' => count($sub_counter),
                     'comCounter' => count($com_counter));
  /**********************************************************
  foreach($notes as $note){
    if($note->note_type == "Membership Subscription"){
       $header .= "<li>
       <a href='".url('admin/notifications/'.$note->id)."'>
         <i class='fa fa-users text-aqua'></i> ".$note->note_type."
       </a>
     </li>";
    }
    if($note->note_type == "Payment transaction"){
        $header2 .= "<li>
        <a href='".url('admin/notifications/'.$note->id)."'>
          <i class='fa fa-money text-aqua'></i> ".$note->note_type."
        </a>
      </li>";
    } 
    if($note->note_type == "Blog Comment"){
        $header3 .= "<li>
        <a href='".url('admin/notifications/'.$note->id)."'>
          <i class='fa fa-commenting text-aqua'></i> Someone commented on your post
        </a>
      </li>";
    }
  }
    $data = "<li class='header'>You have ".count($notes2)." notifications</li>
              <li>
                <!-- inner menu: contains the actual data -->
                <ul class='menu'>
                  
                  ".$header.$header2.$header3."
                  
                </ul>
                </li>
                <li class='footer'><a href='".url('admin/notifications')."'>View all</a></li>
                ";
***********************************************************/ 
return $this->sendResponse($note_arr, 'Notification bar loaded.');           

 }
 public function msg_note(){
    $user_id = Auth::user()->email;
    $notes2 = Messages::where(function($p) use($user_id){
        $p->where('to_user', '=', $user_id);
        $p->where('read', '=', 0);
       })->get();
    
       return $this->sendResponse(count($notes2), 'New message loaded.'); 
 }
 public function support_note(){
    $notes2 = Support::where('seen', 0)->get();
    return $this->sendResponse(count($notes2), 'New contact us messages loaded.'); 
 }
 public function news_letter_note(){
    $notes2 = NewsLetters::where('status', 1)->get();
    return $this->sendResponse(count($notes2), 'News letters loaded.'); 
 }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
