<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Session;
use App\Http\Controllers\API\BaseController as BaseController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use App\Http\Controllers\DateTimeController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Foundation\Auth\AuthenticatesUsers;

class BusinessController extends BaseController
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    protected $user;
    protected $settings;
    public function __construct()
    {
        $this->user = Auth::user();
        $this->settings = Settings::first();
        if($this->user){
        if($this->user->user_type != "Business"){
            
            $error = array("code" => "403",
                   "title" => "Forbidden!",
                   "message" => "You do not have the user privilage to this page! Meanwhile, you can return to index page by clicking",
                   "link" => url('/') );
                   return view('home.error', ['settings' => $this->settings, 'errors' => $error]);    
        }
    }else{
        $error = array("code" => "403",
        "title" => "Forbidden!",
        "message" => "You do not have the user privilage to this page! Meanwhile, you can return to index page by clicking",
        "link" => url('/') );
        return view('home.error', ['settings' => $this->settings, 'errors' => $error]);    

    }
    }

    public function index()
    {
        //

        $business = $this->user->business_account()->get();

        $array_data = array();

        foreach($business as $type){
            $type['business_data'] = $type->business()->get();
            array_push($array_data, $type);
        }
        return view('home.dashboard', ['settings' => $this->settings, 'business_detail' => $array_data, 'blogs' => $blog, 'reservations' => $reservation, 'bookings' => $service_booking, 'transactions' => $transaction, 'orders' => $orders]);
    }

    public function create_resort_form(){
        $business = $this->user->business_account()->get();

        $array_data = array();

        foreach($business as $type){
            $type['business_data'] = $type->business()->get();
            array_push($array_data, $type);
        }
 
        if($array_data['business_category'] == "Resort"){//render resort view if business_category is Resort 
        return view('home.business.dashboard', ['settings' => $this->settings, 'business_detail' => $array_data, 'blogs' => $blog, 'reservations' => $reservation, 'bookings' => $service_booking, 'transactions' => $transaction, 'orders' => $orders]);
        }else{//else 
            $error = array("code" => "403",
            "title" => "Forbidden!",
            "message" => "You do not have the permmision to this page! Meanwhile, you can return to index page by clicking",
            "link" => url('/') );
            return view('home.error', ['settings' => $this->settings, 'errors' => $error]);   
        }
    }

    public function edit_resort_form($resort_id){
       
        $business = $this->user->business_account()->get();

        $array_data = array();

        foreach($business as $type){
            $type['business_data'] = $type->business()->where('id', $resort_id)->get();
            array_push($array_data, $type);
        }
 
        if($array_data['business_category'] == "Resort"){//render resort view if business_category is Resort 
        return view('home.business.dashboard', ['settings' => $this->settings, 'business_detail' => $array_data, 'blogs' => $blog, 'reservations' => $reservation, 'bookings' => $service_booking, 'transactions' => $transaction, 'orders' => $orders]);
        }else{//else 
            $error = array("code" => "403",
            "title" => "Forbidden!",
            "message" => "You do not have the permmision to this page! Meanwhile, you can return to index page by clicking",
            "link" => url('/') );
            return view('home.error', ['settings' => $this->settings, 'errors' => $error]);   
        }

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
