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
use App\Models\Settings;
use App\Models\User;
use App\Models\BusinessDetail;
use App\Models\Country;
use App\Models\State;
use App\Models\City;
use App\Models\Blog;

use Validator;

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
        $this->middleware('business');
    }


    


    public function business_verification_form(){
        
        $this->user =  Auth::user();
        $this->settings = Settings::first();
        $myselfs = User::where('id', $this->user->id)->first();//fetch authenticated user data from users database table
            
            $business = $this->user->business_account()->orderBy('created_at', 'desc')->get();
            return view('home.business.verification_form', ['settings' => $this->settings, 'myselfs' => $myselfs, 'businesses' => $business]); 
         
    }

    public function upload_business_verification(Request $request){
        $this->user =  Auth::user();
        $validator = Validator::make($request->all(), [
            'owner_first_name' => 'required|string',
            'owner_last_name' => 'required|string',
            'business_name' => 'required|string',
            'category' => 'required|string',
            'email' => 'required|string|email|max:255',
            'phone' => 'required|string',
            'country' => 'required|integer',
            'state' => 'required|integer',
            'city' => 'required|integer',
            'zip_code' => 'nullable|string',
            'address' => 'required|string',
            'reg_number' => 'required|string',
            'document' => 'required|file|mimes:pdf,jpeg,png,jpg|max:6144',
            'logo' => 'nullable|image|mimes:jpeg,png,jpg,gif,webp|max:6144',
            
            //'image' => 'array',
            //'image.*' => 'nullable|image|mimes:jpeg,png,jpg,gif,webp|max:6144',
        ]);
         //check if there's validation error 
        if ($validator->fails()) {
            return response_data(false, 422, "Sorry a Validation Error Occured", ['errors' => $validator->errors()->all()], false, false);
        }

        $country = Country::where('id', $request->country)->first();
        $state = $country->state()->where('id', $request->state)->first();
        $city = $state->city()->where('id', $request->city)->first();

        //$business_detail = BusinessDetail::where('business_name')->orWhere('registration_number', $request->reg_number)
        $check_business_details = $this->user->business_account()
                                    ->where('business_name', $request->business_name)
                                        ->where('registration_number', $request->reg_number)
                                            ->orWhere('business_category', $request->category)->get();
        if(count($check_business_details) > 0){
            return response_data(false, 422, "Business info already used for this category by you.", false, false, false);
        }else{

            if($request->hasFile('document')){
                //get filename with the extension
                $fileNameWithExt = $request->file('document')->getClientOriginalName();
                //get just filename
                $filename = pathinfo($fileNameWithExt, PATHINFO_FILENAME);
                //get just ext
                $extension = $request->file('document')->getClientOriginalExtension();
                //filename to store
                $fileNameToStore = str_replace(' ', '_', $filename).'_'.time().'.'.$extension;
                
                $path = $request->file('document')->storeAs('public/img/users/'.$this->user->id.'/business/document', $fileNameToStore);
                
                
                }else{
                $fileNameToStore = "";
                }

                if($request->hasFile('logo')){
                    //get filename with the extension
                    $fileNameWithExt = $request->file('logo')->getClientOriginalName();
                    //get just filename
                    $filename = pathinfo($fileNameWithExt, PATHINFO_FILENAME);
                    //get just ext
                    $extension = $request->file('logo')->getClientOriginalExtension();
                    //filename to store
                    $fileNameToStore_2 = str_replace(' ', '_', $filename).'_'.time().'.'.$extension;
                    
                    $path = $request->file('logo')->storeAs('public/img/users/'.$this->user->id.'/business/media', $fileNameToStore_2);

                    
                    }else{
                    $fileNameToStore_2 = "";
                    }
        
                if($fileNameToStore != ""){
                $dir = asset('storage/img/users/'.$this->user->id.'/business/document');
                //$getServerImg = array();
        
                $getServerImg = $dir.'/'.$fileNameToStore;
                }else{
                $getServerImg = "";
                }
                /*************This block is for logo media string*******************/

                if($fileNameToStore_2 != ""){
                $dir2 = asset('storage/img/users/'.$this->user->id.'/business/media');
                
                //$getServerImg2 = array();
                $getServerImg2 = $dir2.'/'.$fileNameToStore_2;
                }else{
                $getServerImg2 = "";
                }

        $business_detail = $this->user->business_account()->create([
            'owner_first_name' => $request->owner_first_name,
            'owner_last_name' => $request->owner_last_name,
            'business_name' => $request->business_name,
            'email' => $request->email,
            'phone' => $request->phone,
            'country' => $country->name,
            'state' => $state->name,
            'city' => $city->name,
            'address' => $request->address,
            'zip_code' => $request->zip_code,
            'business_category' => $request->category,
            'registration_number' => $request->reg_number,
            'document_url' => $getServerImg,
            'logo_url' => $getServerImg2,
            'referrer_code' => $this->user->referrer_code
                           ]);

            $this->user->update([
                'is_business_verified' => true
            ]);
          
            if($business_detail){
                return response_data(true, 200, 'Business details successfully uploaded.', ['values' => $business_detail], false, false);
            }else{
                return response_data(false, 422, "Could not create business information at this time, please try again later.", false, false, false);  
            }
                        
                }
    }

    public function index()
    {
        //

        $this->user =  Auth::user();
        $this->settings = Settings::first();
        $myselfs = User::where('id', $this->user->id)->first();//fetch authenticated user data from users database table
        $business = $this->user->business_account()->orderBy('created_at', 'desc')->get();
       
        //$blog = Blog::all();

        return view('home.business.dashboard', ['settings' => $this->settings, 'myselfs' => $myselfs, 'businesses' => $business, ]);
    }

    

    public function create_resort_form(){
        $business = $this->user->business_account()->get();

        $array_data = array();

        foreach($business as $type){
            $type['business_data'] = $type->business()->get();
            array_push($array_data, $type);
        }
 
        if($array_data['business_category'] == "Resort"){//render resort view if business_category is Resort 
        return view('home.business.resorts.create_resorts', ['settings' => $this->settings, 'business_detail' => $array_data, 'blogs' => $blog, 'reservations' => $reservation, 'bookings' => $service_booking, 'transactions' => $transaction, 'orders' => $orders]);
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
        return view('home.business.resorts.update_resort', ['settings' => $this->settings, 'business_detail' => $array_data, 'blogs' => $blog, 'reservations' => $reservation, 'bookings' => $service_booking, 'transactions' => $transaction, 'orders' => $orders]);
        }else{//else 
            $error = array("code" => "403",
            "title" => "Forbidden!",
            "message" => "You do not have the permmision to this page! Meanwhile, you can return to index page by clicking",
            "link" => url('/') );
            return view('home.error', ['settings' => $this->settings, 'errors' => $error]);   
        }

    }

    public function create_room_form($resort_id){
    
        $business = $this->user->business_account()->get();

        $array_data = array();

        foreach($business as $type){
            $type['business_data'] = $type->business()->where('id', $resort_id)->get();
            array_push($array_data, $type);
        }
 
        if($array_data['business_category'] == "Resort"){//render resort view if business_category is Resort 
        return view('home.business.resorts.create_room', ['settings' => $this->settings, 'business_detail' => $array_data, 'blogs' => $blog, 'reservations' => $reservation, 'bookings' => $service_booking, 'transactions' => $transaction, 'orders' => $orders]);
        }else{//else 
            $error = array("code" => "403",
            "title" => "Forbidden!",
            "message" => "You do not have the permmision to this page! Meanwhile, you can return to index page by clicking",
            "link" => url('/') );
            return view('home.error', ['settings' => $this->settings, 'errors' => $error]);   
        }

    }

    public function edit_room_form($resort_id, $room_id = null){
        $business = $this->user->business_account()->get();

        $array_data = array();

        foreach($business as $type){
            $type['resort_data'] = $type->business()->where('id', $resort_id)->get();
            $type['single_room_data'] = $type->business()->where('id', $resort_id)->first()->rooms()->whare('id', $room_id)->get();
            array_push($array_data, $type);
        }
 
        if($array_data['business_category'] == "Resort"){//render resort view if business_category is Resort 
        return view('home.business.resorts.create_room', ['settings' => $this->settings, 'business_detail' => $array_data, 'blogs' => $blog, 'reservations' => $reservation, 'bookings' => $service_booking, 'transactions' => $transaction, 'orders' => $orders]);
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
