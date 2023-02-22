<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Settings;
use App\Models\User;
use App\Models\Shelter;
use App\Models\Rooms;
use App\Models\ResortFeatures;
use App\Models\AdminResortFeatures;
use App\Models\roomNumber;
use App\Models\Reservations;
use App\Models\Services;
use App\Models\ServiceBooking;
use App\Http\Controllers\API\BaseController as BaseController;
use App\Http\Controllers\DateManagerController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;
use DateTime;
use \stdClass;

class AvailabilityController extends BaseController
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public static function check_sub_room($room_id){
       $sub_room = roomNumber::where('room_id', $room_id)->get();
       return $sub_room;// return query array data
    }

    public static function check_reservation_by_sub_rooms($room_id, $qnty, $checkin, $checkout){
        date_default_timezone_set("UTC");
        $now = new DateTime("now");
        $today = $now->setTime(0, 0, 0);
       
        $start = date('Y-m-d', strtotime($checkin));
        $end = date('Y-m-d', strtotime($checkout));

       $reservation =  Reservations::where(function($p) use($room_id, $start, $end){
          $p->where('room_id', '=', $room_id);
            $p->where('type', '=', 'room');
             $p->where('checkin', '=', $start);
              $p->where('checkout', '=', $end);
              $p->where('paid', '=', 100);
              $p->orWhere('checkin', '>', $start);
              $p->where('checkin', '<', $end);
              $p->orWhere('checkin', '<', $start);
              $p->where('checkout', '>', $end);
               
              })->get();

       $sub_room = self::check_sub_room($room_id);//call check_sub_room method
       if($qnty <= count($reservation)){
       $sum = $qnty - $reservation + 1;
       return $sub_room[$sum]->id;//return a single array id value
       }else{
        return false;
       }

    }

    public static function check_reservation_by_resort($resort_id, $checkin, $checkout){
        date_default_timezone_set("UTC");
        $now = new DateTime("now");
        $today = $now->setTime(0, 0, 0);
       
       $reservation =  Reservations::where(function($p) use($resort_id, $checkin, $checkout){
          $p->where('shelter_id', '=', $resort_id);
            $p->where('type', '=', 'resort');
             $p->where('checkin', '=', $checkin);
              $p->where('checkout', '=', $checkout);
               $p->where('paid', '=', 100);
              })->get();

       //$sub_room = self::check_sub_room($room_id);//call check_sub_room method
       if(count($reservation) > 0){
       //$sum = $qnty - $reservation + 1;
       return true;//return true statement
       }else{
        return false;
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
