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
use App\Http\Controllers\DateTimeController;
use App\Http\Controllers\AvailabilityController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;
use DateTime;
use \stdClass;

class Event {}
class Result {}

class ReservationController extends BaseController
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function load_admin_room_reservation(Request $request){
        
        $input = $request->all();
    
        $validator = Validator::make($input, [
            'resort_id' => 'required',
            'room_id' => 'required',
        ]);
    
        if($validator->fails()){
            return $this->sendError('Validation Error.', $validator->errors());       
        }
    

        $resort_id = $request->input('resort_id');
        $room_id = $request->input('room_id');
        //$resort_id = $_GET['resort_id'];
        //$room_id = $_GET['room_id'];
        //$start = $_GET['start'];
        //$end = $_GET['end'];
        $type = 'room';
    
        $reservation = Reservations::where(function($p) use($resort_id, $room_id, $type){
            $p->where('shelter_id', '=', $resort_id);
            $p->where('room_id', '=', $room_id);
            $p->where('sub_room_id', '!=', '');
            $p->where('type', '=', $type);
       })->get();//query roomNumber model table
       

$events = array();

date_default_timezone_set("UTC");
$now = new DateTime("now");
$today = $now->setTime(0, 0, 0);

foreach($reservation as $row) {
    $e = new Event();
    $e->id = $row['id'];
    $e->text = $row['name'];
    $e->start = $row['checkin'];
    $e->end = $row['checkout'];
    $e->resource = $row['sub_room_id'];
    $e->bubbleHtml = "Reservation details: <br/>".$e->text;
    
    // additional properties
    $e->status = $row['status'];
    $e->paid = intval($row['paid']);
    $events[] = $e;
}

header('Content-Type: application/json');
echo json_encode($events);
    
    }

public function admin_room_reservation_create(Request $request){
    $input = $request->all();
    
        $validator = Validator::make($input, [
            'resort_id' => 'required',
            'room_id' => 'required',
            'start' => 'required',
            'end' => 'required',
            'sub_room_id' => 'required',
            'customer' => 'nullable',
        ]);
    
        if($validator->fails()){
            return $this->sendError('Validation Error.', $validator->errors());       
        }

        $resort_id = $request->input('resort_id');
        $room_id = $request->input('room_id');
        $sub_room_id = $request->input('sub_room_id');
        $start = $request->input('start');
        $end = $request->input('end');
        $type = 'room';
    
        $reservation = Reservations::where(function($p) use($resort_id, $room_id, $sub_room_id, $type, $start, $end){
            $p->where('shelter_id', '=', $resort_id);
            $p->where('room_id', '=', $room_id);
            $p->where('sub_room_id', '=', $sub_room_id);
            $p->where('type', '=', $type);
            $p->where('paid', '=', 100);
            $p->where('checkin', '=', $start);
            //$p->orWhere('checkin', '<=', $start);
            //$p->where('checkin', '>=', $end);
            //$p->orWhere('checkin', '>=', $start);
            $p->where('checkout', '=', $end);
       })->get();//query roomNumber model table
       
if(count($reservation) > 0){
    return $this->showErrorMsg("There's already a reservation made for this date.", $reservation);
}else{
    $reservation2 = new Reservations;
    $reservation2->shelter_id = $resort_id;
    $reservation2->room_id = $room_id;
    $reservation2->sub_room_id = $sub_room_id;
    $reservation2->type = $type;
    $reservation2->name = $request->input('customer');
    $reservation2->checkin = $start;
    $reservation2->checkout = $end;
    $reservation2->paid = 0;
    $reservation2->status = "New";
    $reservation2->created_by = Auth::user()->id;
    $reservation2->save();

$events = array();

date_default_timezone_set("UTC");
$now = new DateTime("now");
$today = $now->setTime(0, 0, 0);


    $e = new Event();
    $e->id = $reservation2->id;
    $e->text = $reservation2->name;
    $e->start = $reservation2->checkin;
    $e->end = $reservation2->checkout;
    $e->resource = $reservation2->sub_room_id;
    $e->bubbleHtml = "Reservation details: <br/>".$e->text;
    
    // additional properties
    $e->status = $reservation2->status;
    $e->paid = intval($reservation2->paid);
    $events[] = $e;


}

header('Content-Type: application/json');
return $this->sendResponse($events, 'Room booked from'.$e->start.' - '.$e->end);
//echo json_encode($events);
    
}


public function admin_room_reservation_update(Request $request){
    $input = $request->all();
    
    $validator = Validator::make($input, [
        'id' => 'required',
        'name' => 'nullable',
        'start' => 'required',
        'end' => 'required',
        'sub_room_id' => 'required',
        'status' => 'nullable',
        'paid' => 'nullable',
        'bubble' => 'nullable',
    ]);

    if($validator->fails()){
        return $this->sendError('Validation Error.', $validator->errors());       
    }

    $reservation = Reservations::find($request->input('id'));
    $reservation->name = $request->input('name');
    $reservation->checkin = $request->input('start');
    $reservation->checkout = $request->input('end');
    $reservation->sub_room_id = $request->input('sub_room_id');
    $reservation->status = $request->input('status');
    $reservation->paid = $request->input('paid');
    $reservation->save();


    $e = new Event();
    $e->id = $reservation->id;
    $e->text = $reservation->name;
    $e->start = $reservation->checkin;
    $e->end = $reservation->checkout;
    $e->resource = $reservation->sub_room_id;
    $e->bubbleHtml = "Reservation details: <br/>".$e->text;
    
    // additional properties
    $e->status = $reservation->status;
    $e->paid = intval($reservation->paid);
    $events[] = $e;

    header('Content-Type: application/json');
    echo json_encode($events);
}


public function admin_room_reservation_resize(Request $request){
    $input = $request->all();
    
    $validator = Validator::make($input, [
        'id' => 'required',
        'start' => 'required',
        'end' => 'required',
    ]);

    if($validator->fails()){
        return $this->sendError('Validation Error.', $validator->errors());       
    }
    
    //$json = file_get_contents($input);
    //$params = json_decode($json);

    $reservation = Reservations::find($request->input('id'));
    $reservation->checkin = $request->input('start');
    $reservation->checkout = $request->input('end');
    $reservation->save();

$response = new Result();
$response->result = 'OK';
$response->message = 'Update successful';

header('Content-Type: application/json');
echo json_encode($response);
}


//customers reservation post method
public function post_reservation(Request $request){
    $input = $request->all();

    $validator = Validator::make($input, [
        'resort' => 'nullable',
        'room' => 'nullable',
        'name' => 'nullable',
        'phone' => 'nullable',
        'email' => 'nullable',
        'id-no' => 'nullable',
        'curr' => 'nullable',
        'price' => 'nullable',
        'type' => 'nullable',
        'check_in_date' => 'nullable',
        'check_out_date' => 'nullable',
        'adults_capacity' => 'nullable',
        'max_child' => 'nullable',  
        'poster' => 'nullable',
        'qnty' => 'nullable',
    ]);

    if($validator->fails()){
        return $this->sendError('Validation Error.', $validator->errors());       
    }



    $checkin = $request->input('check_in_date');
    $checkout = $request->input('check_out_date');

    $date_count = DateManagerController::time_diff($checkin, $checkout)->days;
 
      $type = $request->input('type');
      $resort = $request->input('resort');
      $room = $request->input('room');
      $qnty = $request->input('qnty');

      $check = Reservations::where(function($p) use($type, $resort, $room){
        $p->where('shelter_id', '=', $resort);
        $p->where('room_id', '=', $room);
        $p->where('type', '=', $type);
        $p->where('paid', '=', 100);
       })->get();

    /************************************************************* 
       $check2 = Reservations::where(function($p) use($type, $resort, $room){
        $p->where('shelter_id', '=', $resort);
        $p->where('room_id', '=', $room);
        $p->where('type', '=', $type);
        $p->where('paid', '=', 1);
       })->get();
    **************************************************************/
    
       
       
    
    if($type == "room"){
    
    
    //check reservation date validation
    if(AvailabilityController::check_reservation_by_sub_rooms($room, $qnty, $checkin, $checkout) === false){
    return $this->showErrorMsg('Invalid', 'Fully booked from '.$checkin.' - '.$checkout.'.');//return json response 
    }else{
 $sub_room_id =  AvailabilityController::check_reservation_by_sub_rooms($room, $qnty, $checkin, $checkout);
        if(Auth::user()){
  $settings = Settings::where('id', 1)->get();//query the settings table to get discount field

    $discount = $settings[0]->memb_discount;
    $percent = 100;
    $split = $request->input('price') * $date_count / $percent;
    $sum = $split * $discount;

    $booking = new Reservations;
    $booking->shelter_id = $request->input('resort');
    $booking->room_id = $request->input('room'); 
    $booking->sub_room_id = $sub_room_id; 
    $booking->user_id = Auth::user()->id;
    $booking->type = $request->input('type');
    $booking->name = $request->input('name');
    $booking->phone = $request->input('phone');
    $booking->email = $request->input('email');
    $booking->id_no = $request->input('id-no');
    $booking->checkin = $request->input('check_in_date');
    $booking->checkout = $request->input('check_out_date');
    if($date_count > 1){
        $booking->duration = $date_count.' days';
    }else{
        $booking->duration = $date_count.' day';
    }
    $booking->adults = $request->input('adults_capacity');
    $booking->children = $request->input('max_child');
    if(Auth::user()->dues == 1){
     $booking->member = "yes";
     $booking->curr = $request->input('curr');
     $booking->price = $request->input('price') * $date_count - $sum;
     $booking->discount = $sum;
    }else{
    $booking->curr = $request->input('curr');
    $booking->price = $request->input('price') * $date_count ;   
    }
    $booking->created_by = $request->input('poster');
    $booking->save();

    }else{

        $booking = new Reservations;
        $booking->shelter_id = $request->input('resort');
        $booking->room_id = $request->input('room'); 
        $booking->sub_room_id = $sub_room_id; 
        $booking->type = $request->input('type');
        $booking->name = $request->input('name');
        $booking->phone = $request->input('phone');
        $booking->email = $request->input('email');
        $booking->id_no = $request->input('id-no');
        $booking->checkin = $request->input('check_in_date');
        $booking->checkout = $request->input('check_out_date');
        if($date_count > 1){
            $booking->duration = $date_count.' days';
        }else{
            $booking->duration = $date_count.' day';
        }
        $booking->adults = $request->input('adults_capacity');
        $booking->children = $request->input('max_child');
        $booking->curr = $request->input('curr');
        $booking->price = $request->input('price') * $date_count;
        
        $booking->save();

          }

        }

    }else if($type == "resort"){

        if(AvailabilityController::check_reservation_by_resort($resort, $checkin, $checkout) == false){
            return $this->showErrorMsg('Invalid', 'No booking available under this category.');//return json response 
            }else{
         
                if(Auth::user()){
          $settings = Settings::where('id', 1)->get();//query the settings table to get discount field
        
            $discount = $settings[0]->memb_discount;
            $percent = 100;
            $split = $request->input('price') * $date_count / $percent;
            $sum = $split * $discount;
        
            $booking = new Reservations;
            $booking->shelter_id = $request->input('resort');
            $booking->room_id = $request->input('room'); 
            $booking->user_id = Auth::user()->id;
            $booking->type = $request->input('type');
            $booking->name = $request->input('name');
            $booking->phone = $request->input('phone');
            $booking->email = $request->input('email');
            $booking->id_no = $request->input('id-no');
            $booking->checkin = $request->input('check_in_date');
            $booking->checkout = $request->input('check_out_date');
            if($date_count > 1){
                $booking->duration = $date_count.' days';
            }else{
                $booking->duration = $date_count.' day';
            }
            $booking->adults = $request->input('adults_capacity');
            $booking->children = $request->input('max_child');
            if(Auth::user()->dues == 1){
             $booking->member = "yes";
             $booking->curr = $request->input('curr');
             $booking->price = $request->input('price') * $date_count - $sum;
             $booking->discount = $sum;
            }else{
            $booking->curr = $request->input('curr');
            $booking->price = $request->input('price') * $date_count ;   
            }
            $booking->created_by = $request->input('poster');
            $booking->save();
        
            }else{
        
                $booking = new Reservations;
                $booking->shelter_id = $request->input('resort');
                $booking->room_id = $request->input('room'); 
                $booking->sub_room_id = $sub_room_id; 
                $booking->type = $request->input('type');
                $booking->name = $request->input('name');
                $booking->phone = $request->input('phone');
                $booking->email = $request->input('email');
                $booking->id_no = $request->input('id-no');
                $booking->checkin = $request->input('check_in_date');
                $booking->checkout = $request->input('check_out_date');
                if($date_count > 1){
                    $booking->duration = $date_count.' days';
                }else{
                    $booking->duration = $date_count.' day';
                }
                $booking->adults = $request->input('adults_capacity');
                $booking->children = $request->input('max_child');
                $booking->curr = $request->input('curr');
                $booking->price = $request->input('price') * $date_count;
                
                $booking->save();
        
            }
    }
}
    return $this->sendResponse($booking, 'Reservation made, please make your payment now.'); 

}

//customers service booking post method
public function post_service_booking(Request $request){
    $input = $request->all();

    $validator = Validator::make($input, [
        'service' => 'nullable',
        'name' => 'nullable',
        'phone' => 'nullable',
        'email' => 'nullable',
        'id-no' => 'nullable',
        'curr' => 'nullable',
        'price' => 'nullable',
        'type' => 'nullable',
        'duration' => 'nullable',
        'booking_date' => 'nullable',
        'poster' => 'nullable',
    ]);

    if($validator->fails()){
        return $this->sendError('Validation Error.', $validator->errors());       
    }

    
    $booking = new ServiceBooking;
    
    $service_id = $request->input('service');
    $date = $request->input('booking_date');

    $checkBooking = ServiceBooking::where(function($p) use($service_id, $date){
        $p->where('service_id', '=', $service_id);
        $p->where('booked_date', '=', $date);
        $p->where('paid', '=', 1);
       })->get();
       

    if(count($checkBooking) > 0){
        return $this->showErrorMsg('Invalid', 'sorry this '.$checkBooking[0]->type.' is already booked for this date, you can choose another service from the list.');//return json response  
    }else{
    if(Auth::user()){
    $settings = Settings::where('id', 1)->get();//query the settings table to get discount field
    
    $discount = $settings[0]->memb_discount;
    $percent = 100;
    $split = $request->input('price') * $request->input('duration') / $percent;
    $sum = $split * $discount;

    $booking->service_id = $request->input('service');
    $booking->user_id = Auth::user()->id;
    $booking->type = $request->input('type');
    $booking->name = $request->input('name');
    $booking->phone = $request->input('phone');
    $booking->email = $request->input('email');
    $booking->id_no = $request->input('id-no');
    $booking->duration = $request->input('duration');
    $booking->booked_date = $request->input('booking_date');

    if(Auth::user()->dues == 1){
     $booking->member = "yes";
     $booking->curr = $request->input('curr');
     $booking->price = $request->input('price') * $request->input('duration') - $sum;
     $booking->discount = $sum;
    }else{
    $booking->curr = $request->input('curr');
    $booking->price = $request->input('price') * $request->input('duration');   
    }
    $booking->created_by = $request->input('poster');
    $booking->save();

    }else{
        
        $price = $request->input('price') * $request->input('duration');

        $booking->service_id = $request->input('service');
        $booking->type = $request->input('type');
        $booking->name = $request->input('name');
        $booking->phone = $request->input('phone');
        $booking->email = $request->input('email');
        $booking->id_no = $request->input('id-no');
        $booking->duration = $request->input('duration');
        $booking->booked_date = $request->input('booking_date');
        $booking->curr = $request->input('curr');
        $booking->price = $price;
        $booking->save();

    }
}
    return $this->sendResponse($booking, 'Service booked, please make your payment now.'); 


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
