<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Session;
use App\Http\Controllers\API\BaseController as BaseController;
use Illuminate\Http\Request;
use App\Http\Controllers\DateTimeController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use App\Models\Settings;
use App\Models\User;
use App\Models\Shelter;
use App\Models\Rooms;
use App\Models\ResortFeatures;
use App\Models\AdminResortFeatures;
use App\Models\roomNumber;
use App\Models\BusinessDetail;
use App\Models\Country;
use App\Http\Controllers\DateManagerController;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;
use Intervention\Image\ImageManagerStatic as Image;

class Room {

}

class ResortController extends BaseController
{

    protected $user;
    protected $settings;
    public function __construct()
    {
        $this->middleware('business');
    }


    
    public function fetch_country_currency_list(){
        $this->user =  Auth::user();
        $business = $this->user->business_account()->where('business_category', 'Resort')->first();

        if($business){
            // $array_data = array();
            $country = Country::where('name', '!=', $business->country)->get();
            return response_data(true, 200, 'Countries fetched.', ['values' => $country], false, false);
        }else{
            return response_data(false, 422, "Could not fetch country data.", false, false, false);  
        }

    }

    public function index(){
            $this->user =  Auth::user();
            $this->settings = Settings::first();
            $myselfs = User::where('id', $this->user->id)->first();//fetch authenticated user data from users database table
            
            $businesses = $this->user->business_account()->orderBy('created_at', 'desc')->get();
            //$resorts = $this->user->business_account()->resorts()->get();
            $business_single = $this->user->business_account()->where('business_category', 'Resort')->first();
            $country = Country::where('name', $business_single->country)->first();
            return view('home.business.resorts.create_resorts', ['settings' => $this->settings, 
                                                                 'myselfs' => $myselfs, 
                                                                 'businesses' => $businesses,
                                                                 'business' => $business_single->resorts()->get(),
                                                                 'country' => $country]); 
    }

    public function edit_resort_img($id){
        
        $this->user =  Auth::user();
        $this->settings = Settings::first();
        $myselfs = User::where('id', $this->user->id)->first();//fetch authenticated user data from users database table
            
        $business = $this->user->business_account()->orderBy('created_at', 'desc')->get();
        $business_single = $this->user->business_account()->where('business_category', 'Resort')->first();
        // $resort = $business_single->resorts()->get();
        $resorts = $business_single->resorts()->where('id', $id)->get();   
    return view('home.business.resorts.edit_resort_img', ['settings' => $this->settings, 
                                              'myselfs' => $myselfs, 
                                              'businesses' => $business,
                                            //   'resorts' => $resort, 
                                              'resorts2' => $resorts,
                                              'resortImg' => json_decode($resorts[0]->images)
                                               ]);
    
    }




    public function edit_resort_form($id){
       
        $this->user =  Auth::user();
        $this->settings = Settings::first();
        $myselfs = User::where('id', $this->user->id)->first();//fetch authenticated user data from users database table
            
        $business = $this->user->business_account()->orderBy('created_at', 'desc')->get();
        $business_single = $this->user->business_account()->where('business_category', 'Resort')->first();
        // $resort = $business_single->resorts()->get();
        $resorts = $business_single->resorts()->where('id', $id)->get();  

        return view('home.business.resorts.update_resort', ['settings' => $this->settings, 
                                           'myselfs' => $myselfs, 
                                           'businesses' => $business,
                                        //    'resorts' => $resort, 
                                           'resorts2' => $resorts
                                        ]);
    
       
    }
    
    
    
    
    public function edit_resort_features($id){
        
        $this->user =  Auth::user();
        $this->settings = Settings::first();
        $myselfs = User::where('id', $this->user->id)->first();//fetch authenticated user data from users database table
            
        $business = $this->user->business_account()->orderBy('created_at', 'desc')->get();
        $business_single = $this->user->business_account()->where('business_category', 'Resort')->first();
        // $resort = $business_single->resorts()->get();
            $resorts = $business_single->resorts()->where('id', $id)->get(); 
            $features = $business_single->resorts()->where('id', $id)->first()->features()->get();
            $features2 = AdminResortFeatures::orderBy('id', 'desc')->get();
           
            //$array_call = array();
            if(count($features) > 0){
               $array_call = $features;
               $array_list = json_decode($features[0]->features);
            }else{
                $array_call = array();
                $array_list = array();
            }
    
    return view('home.business.resorts.edit_resort_features', ['settings' => $this->settings, 
                                              'myselfs' => $myselfs, 
                                              'businesses' => $business,
                                            //   'resorts' => $resort, 
                                              'resorts2' => $resorts, 
                                              'admin_features' => $features2,
                                              'features' => $array_call,
                                              'feature_list' => $array_list
                                            ]);
    
    
    }
    
    public function create_room_form($id){
        
        $this->user =  Auth::user();
        $this->settings = Settings::first();
        $myselfs = User::where('id', $this->user->id)->first();//fetch authenticated user data from users database table
            
        $business = $this->user->business_account()->orderBy('created_at', 'desc')->get();
        $business_single = $this->user->business_account()->where('business_category', 'Resort')->first();
        // $resort = $business_single->resorts()->get();
        $resorts = $business_single->resorts()->where('id', $id)->get(); 
        $rooms = $business_single->resorts()->where('id', $id)->first()->rooms()->get(); 

            
                return view('home.business.resorts.create_room', ['settings' => $this->settings, 
                                                 'myselfs' => $myselfs, 
                                                 'businesses' => $business,
                                                //  'resorts' => $resort, 
                                                 'resorts2' => $resorts, 
                                                 'rooms' => $rooms]);
    
    
    }
    
    public function update_room_page($resort, $id = NULL){
        $this->user =  Auth::user();
        $this->settings = Settings::first();
        $myselfs = User::where('id', $this->user->id)->first();//fetch authenticated user data from users database table
            
        $business = $this->user->business_account()->orderBy('created_at', 'desc')->get();
        $business_single = $this->user->business_account()->where('business_category', 'Resort')->first();
        // $resort = $business_single->resorts()->get();
        $single_resort = $business_single->resorts()->where('id', $resort)->get(); 
        $room = $single_resort[0]->rooms()->where('id', $id)->get(); 
        
            
                return view('home.business.resorts.update_room', ['settings' => $this->settings, 
                                                 'businesses' => $business,
                                                 'myselfs' => $myselfs, 
                                                 'resorts' => $single_resort, 
                                                 'rooms' => $room]);
    
      
    }
    
    public function edit_room_img($resort, $id = NULL){
    
        
        $this->user =  Auth::user();
        $this->settings = Settings::first();
        $myselfs = User::where('id', $this->user->id)->first();//fetch authenticated user data from users database table
            
        $business = $this->user->business_account()->orderBy('created_at', 'desc')->get();
        $business_single = $this->user->business_account()->where('business_category', 'Resort')->first();
        // $resort = $business_single->resorts()->get();
        $single_resort = $business_single->resorts()->where('id', $resort)->get(); 
        $room = $single_resort[0]->rooms()->where('id', $id)->get(); 
    
            return view('home.business.resorts.edit_room_img', ['settings' => $this->settings, 
                                               'businesses' => $business,
                                               'myselfs' => $myselfs, 
                                               'resorts' => $single_resort, 
                                               'rooms' => $room,
                                               'roomImg' => json_decode($room[0]->images)
                                                 ]);
      
    
    }
    



    public function resort_owner_resort_booking_page($id){
       
            
            $resort = Shelter::where('id', $id)->get(); 
            $users = User::where('user_type', 'member')->orderBy('id', 'desc')->get(); 
            $myself = User::where('id', Auth::user()->id)->get();
            $reservation = Reservations::where('shelter_id', $resort[0]->id)->orderBy('id', 'desc')->get();
            
                return view('home.resort_booking', ['settings' => $settings, 'myselfs' => $myself, 'resorts' => $resort, 'users' => $users, 'reservations' => $reservation]);
    
     
    }
    
    public function resort_owner_room_booking_page($resort, $id = NULL){
    
        $this->user =  Auth::user();
        $this->settings = Settings::first();
        $myselfs = User::where('id', $this->user->id)->first();//fetch authenticated user data from users database table
            
        $business = $this->user->business_account()->orderBy('created_at', 'desc')->get();
        $business_single = $this->user->business_account()->where('business_category', 'Resort')->first();
        // $resort = $business_single->resorts()->get();
        $single_resort = $business_single->resorts()->where('id', $resort)->get(); 
        $room = $single_resort[0]->rooms()->where('id', $id)->get(); 
            
            
            
            // $reservation = Reservations::where('room_id', $rooms[0]->id)->orderBy('id', 'desc')->get();
            
                return view('home.business.resorts.room_booking', ['settings' => $this->settings, 
                                                  'businesses' => $business,
                                                  'myselfs' => $myselfs, 
                                                  'resorts' => $single_resort, 
                                                  'rooms' => $room,
                                                //   'reservations' => $reservation
                                                ]);
     
     
    
    }   



    
    
    public function create_new_resort(Request $request){//new resort form request
        $input = $request->all();//form request input handler

        $this->user =  Auth::user();
        $this->settings = Settings::first();
        //$myselfs = User::where('id', $this->user->id)->first();//fetch authenticated user data from users database table
            
        $business_detail = $this->user->business_account()->where('business_category', 'Resort')->first();

        $validator = Validator::make($input, [//input field validator
            'name' => 'required',
            'location' => 'required',
            'address' => 'nullable',
            'desc' => 'nullable',
            'price' => 'nullable',
            'curr' => 'nullable', 
            
            'youtube' => 'nullable',
               
        ]);

        if($validator->fails()){
            return response_data(false, 422, "Sorry a Validation Error Occured", ['errors' => $validator->errors()->all()], false, false);         
        }
        //insert into shelter table model, parse form fields variables
        $create_resort = $business_detail->resorts()->create([
            'name' => $request->name,
            'map_location' => $request->location,
            'address' => $request->address,
            'descr' => $request->desc,
            'price' => $request->price,
            'curr' => $request->curr,
            'youtube' => $request->youtube,
            'user_id' => $this->user->id
        ]);
        

     Storage::makeDirectory('public/img/users/'.$this->user->id.'/business/media/'.$create_resort->id, 0775);

     if($create_resort){
        
        return response_data(true, 200, 'Resort created successfully.', ['values' => $create_resort], false, false);
    }else{
        return response_data(false, 422, "Error occured, please try again later.", false, false, false);  
    }

    }


    public function update_resort_input(Request $request){
        $input = $request->all();

        $this->user =  Auth::user();
        $this->settings = Settings::first();
        //$myselfs = User::where('id', $this->user->id)->first();//fetch authenticated user data from users database table
            
        $business_detail = $this->user->business_account()->where('business_category', 'Resort')->first();
        $validator = Validator::make($input, [
            'resort' => 'required',
            'price' => 'nullable',
            'name' => 'required',
            'location' => 'nullable',
            'address' => 'nullable',
            'desc' => 'nullable',
            'youtube' => 'nullable',
            'curr' => 'nullable',
        ]);
    
        if($validator->fails()){
            return response_data(false, 422, "Sorry a Validation Error Occured", ['errors' => $validator->errors()->all()], false, false);         
        }
    
        
$update_resort = $business_detail->resorts()
                 ->where('id', $request->resort)
                 ->update(['name' => $request->name, 
                           'map_location' => $request->location, 
                           'address' => $request->address, 
                           'descr' => $request->desc, 
                           'price' => $request->price, 
                           'curr' =>  $request->curr,
                           'youtube' => $request->youtube
                          ]);
 

$resort = $business_detail->resorts()->where('id', $request->resort)->first();

if($update_resort){
        
    return response_data(true, 200, 'Resort updated successfully.', ['values' => $resort], false, false);
}else{
    return response_data(false, 422, "Error occured, please try again later.", false, false, false);  
}
    }

   public function update_resort_img(Request $request){
       $input = $request->all();//form request input handler

        $this->user =  Auth::user();
        $this->settings = Settings::first();
        //$myselfs = User::where('id', $this->user->id)->first();//fetch authenticated user data from users database table
            
        $business_detail = $this->user->business_account()->where('business_category', 'Resort')->first();
    $validator = Validator::make($input, [
        'resort' => 'required',
        'img_1' => 'required|image|mimes:jpeg,png,jpg,gif|max:6144',
    ]);

    if($validator->fails()){
        return response_data(false, 422, "Sorry a Validation Error Occured", ['errors' => $validator->errors()->all()], false, false);      
    }
    
    $resort = $business_detail->resorts()->where('id', $request->resort)->first();
    //$resort = Shelter::where('id', $request->input('resort'))->get();

    if($request->hasFile('img_1')){
        //get filename with the extension
        $fileNameWithExt = $request->file('img_1')->getClientOriginalName();
        //get just filename
        $filename = pathinfo($fileNameWithExt, PATHINFO_FILENAME);
        //get just ext
        $extension = $request->file('img_1')->getClientOriginalExtension();
        //filename to store
        $fileNameToStore = str_replace(' ', '_', $filename).'_'.time().'.'.$extension;
        
        $path = $request->file('img_1')->storeAs('public/img/users/'.$this->user->id.'/business/media/'.$resort->id, $fileNameToStore);

        
        }else{
        $fileNameToStore = "";
        }

    

          $dir = asset('storage/img/users/'.$this->user->id.'/business/media/'.$resort->id);
        
        if ($resort->images) {

            $getServerImg = json_decode($resort->images, true);

            $getServerImg[] = $dir.'/'.$fileNameToStore;

        } else {

            $getServerImg = array();

            $getServerImg[] = $dir.'/'.$fileNameToStore;

        }



        $update_resort_img = $business_detail->resorts()->where('id', $request->resort)->update([
            'img_1' => $getServerImg[0],
            'images' => json_encode($getServerImg)
        ]);

    $fetch_resort = $business_detail->resorts()->where('id', $request->resort)->first();
        if($update_resort_img){
        
            return response_data(true, 200, 'Resort image uploaded successfully.', ['values' => $fetch_resort], false, false);
        }else{
            return response_data(false, 422, "Error occured, please try again later.", false, false, false);  
        }

   }


   public function remove_resort_img(Request $request){

    $input = $request->all();
    
    $validator = Validator::make($input, [
        'resort' => 'required',
        'key_num' => 'required',
    ]);

    //$id = Input::get('resort'); 

    //$arrID = Input::get('arrID');



    $resort = Shelter::where('id', $request->input('resort'))->get();

    $getServerImg = json_decode($resort[0]->images, true);



    unset($getServerImg[$request->input('key_num')]);



    $update = Shelter::where('id', $request->input('resort'))->update([

        'images' => json_encode($getServerImg)

    ]);



    if ($update) {

        return $this->sendResponse($update, 'Image removed succesfully.');

    }

}


   public function update_resort_features(Request $request){
    //$input = $request->all();

    $input = $request->all();

    $this->user =  Auth::user();
    $this->settings = Settings::first();
        //$myselfs = User::where('id', $this->user->id)->first();//fetch authenticated user data from users database table
            
    $business_detail = $this->user->business_account()->where('business_category', 'Resort')->first();
    
    
    $validator = Validator::make($input, [
        'resort' => 'required',
        'feature' => 'required',
        'feature_price' => 'required',
        'feature_duration' => 'required',
    ]);

    if($validator->fails()){
        return response_data(false, 422, "Sorry a Validation Error Occured", ['errors' => $validator->errors()->all()], false, false);     
    }

   
   $resort = $business_detail->resorts()->where('id', $request->resort)->first();

    foreach($request->feature as $key => $feature ){
        
    $check_feature = $resort->features()->where('features', $feature)->first();

    if( $check_feature ){
                    $update_feature = $resort->features()
                    ->where('features', $feature)
                           ->update(['curr' => $resort->curr,
                                     'price' => $request->feature_price[$key],
                                     'duration' => $request->feature_duration[$key]
                                     ]);
                }else{
                  $add_feature = $resort->features()
                      ->create(['features' => $feature,
                                'curr' => $resort->curr,
                                'price' => $request->feature_price[$key],
                                'duration' => $request->feature_duration[$key]
                   ]);
                }

    }

     
    $fetch_features = $resort->features()->orderBy('created_at', 'desc')->get();
    if(isset($add_feature)){
        return response_data(true, 200, 'Resort features added successfully.', ['values' => $fetch_features], false, false);
    } else if(isset($update_feature)){
        return response_data(true, 200, 'Resort features updated successfully.', ['values' => $fetch_features], false, false);
    }else{
        return response_data(false, 422, "Error occured, please try again later.", false, false, false);  
    }
        
     
    
   }


   public function remove_resort_user_feature(Request $request){
    $input = $request->all();

    $input = $request->all();

    $this->user =  Auth::user();
    $this->settings = Settings::first();
        //$myselfs = User::where('id', $this->user->id)->first();//fetch authenticated user data from users database table
            
    $business_detail = $this->user->business_account()->where('business_category', 'Resort')->first();
    
    $validator = Validator::make($input, [
        'resort' => 'required|integer',
        'feature_id' => 'required|integer',
    ]);

    if($validator->fails()){
        return response_data(false, 422, "Sorry a Validation Error Occured", ['errors' => $validator->errors()->all()], false, false);         
    }

    $resort = $business_detail->resorts()->where('id', $request->resort)->first();

    $resort_feature = $resort->features()->where('id', $request->feature_id)->first();

    if($resort_feature){
     $delete_feature = $resort->features()->where('id', $request->feature_id)->delete();
     return response_data(true, 200, 'Resort feature deleted successfully.', false, false, false);
    }else{
    return response_data(false, 422, "Error occured, please try again later.", false, false, false);  
    }

    
   }


    




    public function upload_rooms_info(Request $request){
        $input = $request->all();

        $this->user =  Auth::user();
        $this->settings = Settings::first();
        //$myselfs = User::where('id', $this->user->id)->first();//fetch authenticated user data from users database table
            
        $business_detail = $this->user->business_account()->where('business_category', 'Resort')->first();
    
        $validator = Validator::make($input, [
            'resort' => 'required',
            'type' => 'required',
            'name' => 'required',
            'price' => 'nullable',
            'desc' => 'required',
            'qnty' => 'required',
            'capacity' => 'required',
            'location' => 'nullable',
              
        ]);
    
        if($validator->fails()){
            return response_data(false, 422, "Sorry a Validation Error Occured", ['errors' => $validator->errors()->all()], false, false);         
        }

        $resort = $business_detail->resorts()->where('id', $request->resort)->first();

        $check_room = $resort->rooms()->where('room_name', $request->name)->get();

        if(count($check_room) > 0){
            return response_data(false, 422, "Name entered already exists, please check your list.", false, false, false);
        }else{
                    $create_room = $resort->rooms()->
                                 create(['room_name' => $request->name,
                                         'type' => $request->type,
                                         'descr' => $request->desc,
                                         'available_number' => $request->qnty,
                                         'capacity' => $request->capacity,
                                         'price' => $request->price,
                                         'curr' => $resort->curr
                                         ]);

Storage::makeDirectory('public/img/users/'.$this->user->id.'/business/media/'.$resort->id.'/rooms/'.$create_room->id, 0775);

    if($create_room){
        
        return response_data(true, 200, 'Room created successfully.', ['values' => $create_room], false, false);
    }else{
        return response_data(false, 422, "Error occured, please try again later.", false, false, false);  
    }
        }
     
    
    }



    public function update_rooms_info(Request $request){
        $input = $request->all();
    
        $this->user =  Auth::user();
        $this->settings = Settings::first();
        //$myselfs = User::where('id', $this->user->id)->first();//fetch authenticated user data from users database table
            
        $business_detail = $this->user->business_account()->where('business_category', 'Resort')->first();

        $validator = Validator::make($input, [
            'resort' => 'required',
            'room' => 'required',
            'name' => 'required',
            'type' => 'required',
            'price' => 'required',
            'desc' => 'required',
            'qnty' => 'required',
            'capacity' => 'required',
            //'location' => 'nullable',    
        ]);
    
        if($validator->fails()){
            return response_data(false, 422, "Sorry a Validation Error Occured", ['errors' => $validator->errors()->all()], false, false);         
        }
    
        $resort = $business_detail->resorts()->where('id', $request->resort)->first();

        $check_room = $resort->rooms()->where('id', $request->room)->get();

        if(count($check_room) > 0){
            $update_room = $resort->rooms()
                   ->where('id', $request->room)
                               ->update(['room_name' => $request->name,
                                         'type' => $request->type,
                                         'descr' => $request->desc,
                                         'available_number' => $request->qnty,
                                         'capacity' => $request->capacity,
                                         'price' => $request->price,
                                         'curr' => $resort->curr
                                         ]);
   
    $fetch_room_data = $resort->rooms()->where('id', $request->room)->first();
    if($update_room){
        
        return response_data(true, 200, 'Room info updated successfully.', ['values' => $fetch_room_data], false, false);
    }else{
        return response_data(false, 422, "Error occured, please try again later.", false, false, false);  
    }  
        }else{
            return response_data(false, 422, "Error: there's a problem with this request.", false, false, false);  
        }

    }



public function update_resort_room_img(Request $request){
 
    $input = $request->all();
    
    $this->user =  Auth::user();
    $this->settings = Settings::first();
        //$myselfs = User::where('id', $this->user->id)->first();//fetch authenticated user data from users database table
            
    $business_detail = $this->user->business_account()->where('business_category', 'Resort')->first();

        $validator = Validator::make($input, [
            'resort' => 'required',
            'room' => 'required',
            
            'img_1' => 'required|image|mimes:jpeg,png,jpg,gif|max:6144',
               
        ]);
    
        if($validator->fails()){
            return response_data(false, 422, "Sorry a Validation Error Occured", ['errors' => $validator->errors()->all()], false, false);         
        }

        $resort = $business_detail->resorts()->where('id', $request->resort)->first();

        $rooms = $resort->rooms()->where('id', $request->room)->get();

    if(count($rooms) > 0){

    if($request->hasFile('img_1')){

    
        //get filename with the extension
        $fileNameWithExt = $request->file('img_1')->getClientOriginalName();
        //get just filename
        $filename = pathinfo($fileNameWithExt, PATHINFO_FILENAME);
        //get just ext
        $extension = $request->file('img_1')->getClientOriginalExtension();
        //filename to store
        $fileNameToStore = str_replace(' ', '_', $filename).'_'.time().'.'.$extension;
        $path = $request->file('img_1')->storeAs('public/img/users/'.$this->user->id.'/business/media/'.$rooms[0]->resort_id.'/rooms/'.$rooms[0]->id, $fileNameToStore);

        }else{
        $fileNameToStore = "";
        }

        
    
        $dir = asset('storage/img/users/'.$this->user->id.'/business/media/'.$rooms[0]->resort_id.'/rooms/'.$rooms[0]->id);
        
        if ($rooms[0]->images) {

            $getServerImg = json_decode($rooms[0]->images, true);

            $getServerImg[] = $dir.'/'.$fileNameToStore;

        } else {

            $getServerImg = array();

            $getServerImg[] = $dir.'/'.$fileNameToStore;

        }


        
        $update_room_img = $resort->rooms()
                   ->where('id', $request->room)
                               ->update([
                                        'img_1' => $getServerImg[0],
                                        'images' => json_encode($getServerImg)
                                         ]);
        
 

    if($update_room_img){
        
        return response_data(true, 200, 'Room images uploaded successfully.', false, false, false);
    }else{
        return response_data(false, 422, "Error occured, please try again later.", false, false, false);  
    }  

    }else{

        return response_data(false, 422, "Error: there's a problem with this request.", false, false, false);  

    }
    
}


public function remove_resort_room_img(Request $request){

    $input = $request->all();

    $this->user =  Auth::user();
    $this->settings = Settings::first();
        //$myselfs = User::where('id', $this->user->id)->first();//fetch authenticated user data from users database table
            
    $business_detail = $this->user->business_account()->where('business_category', 'Resort')->first();
    $validator = Validator::make($input, [
        'resort' => 'required',
        'room' => 'required',
        'key_num' => 'required',
    ]);

    //$id = Input::get('resort'); 

    //$arrID = Input::get('arrID');
    if($validator->fails()){
        return response_data(false, 422, "Sorry a Validation Error Occured", ['errors' => $validator->errors()->all()], false, false);         
    }

    $resort = $business_detail->resorts()->where('id', $request->resort)->first();

    $rooms = $resort->rooms()->where('id', $request->room)->get();

    

    $getServerImg = json_decode($rooms[0]->images, true);



    unset($getServerImg[$request->input('key_num')]);



    $update = $resort->rooms()->where('id', $request->room)->update([

        'images' => json_encode($getServerImg)

    ]);



    if($update){
        
        return response_data(true, 200, 'Room image removed successfully.', false, false, false);
    }else{
        return response_data(false, 422, "Error occured, please try again later.", false, false, false);  
    }  

}


//



    public function delete_resort($id){
        $this->user =  Auth::user();
        $this->settings = Settings::first();
        $business_detail = $this->user->business_account()->where('business_category', 'Resort')->first();
        $delete_resort = $business_detail->resorts()->find($id);

        $delete_resort->delete();
       
        if($delete_resort){
        
            return response_data(true, 200, 'Resort deleted successfully.', false, false, false);
        }else{
            return response_data(false, 422, "Error occured, please try again later.", false, false, false);  
        }  
    }
    
    public function delete_room(Request $request){
      $room = Rooms::find($request->input('uid'));
      $room->delete();
      return $this->sendResponse($room, 'room deleted.');
    }


    public function sub_room_create(Request $request){
        $input = $request->all();
    
        $this->user =  Auth::user();
        $this->settings = Settings::first();
        //$myselfs = User::where('id', $this->user->id)->first();//fetch authenticated user data from users database table
            
        $business_detail = $this->user->business_account()->where('business_category', 'Resort')->first();

        $validator = Validator::make($input, [
            'resort_id' => 'required',
            'room_id' => 'required',
            'room' => 'required', 
            'capacity' => 'nullable',    
        ]);
    
        if($validator->fails()){
            return $this->sendError('Validation Error.', $validator->errors());       
        }
    $resort_id = $request->input('resort_id');
    $room_id = $request->input('room_id');
    $room = $request->input('room');

    $resort = $business_detail->resorts()->where('id', $request->resort_id)->first();

        $check_room = $resort->rooms()->where('id', $request->room_id)->first();

    $checkRoom = $check_room->room_numbers()->where(function($p) use($room_id, $room){
        $p->where('room_id', '=', $room_id);
        $p->where('name', '=', $room);
   })->get();//query roomNumber model table
   if(count($checkRoom) > 0){
    return response_data(false, 422, $checkRoom[0]->number." already exist on the list.", false, false, false);      
   }else{
    $subRoom = $check_room->room_numbers()->create([
        
        'name' => $request->input('room'),
        'capacity' => $request->input('capacity'),
        'status' => 'Ready'
    ]);
    

   if($subRoom){
        
    return response_data(true, 200, 'Room number added successfully.', ['values' => $subRoom], false, false);
}else{
    return response_data(false, 422, "Error occured, please try again later.", false, false, false);  
}  

   }
    

    }


    public function sub_room(Request $request){
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
    
//$json = file_get_contents('php://input');
//$params = json_decode($json);

//$resort_id = isset($params->resort_id) ? $params->resort_id : '0';
//$room_id = isset($params->room_id) ? $params->room_id : '0';

        $this->user =  Auth::user();
        $this->settings = Settings::first();
        //$myselfs = User::where('id', $this->user->id)->first();//fetch authenticated user data from users database table
            
        $business_detail = $this->user->business_account()->where('business_category', 'Resort')->first();


        $resort = $business_detail->resorts()->where('id', $resort_id)->first();

        $check_room = $resort->rooms()->where('id', $room_id)->first();

    $checkRoom = $check_room->room_numbers()->get();//query roomNumber model table

//     $checkRoom = roomNumber::where(function($p) use($resort_id, $room_id){
//         $p->where('resort_id', '=', $resort_id);
//         $p->where('room_id', '=', $room_id);
        
//    })->get();//query roomNumber model table
   //if(count($checkRoom) > 0){
    //return $this->sendResponse($checkRoom, 'sub rooms fetched.');
       
   //}else{
    //return $this->showErrorMsg(' No room created for this category yet', $checkRoom);   
   //}
   //$json = file_get_contents('php://input');
   //$params = json_decode($json);
   
   //$resort = $params->resort_id;
   //$room = $params->room_id;
   //$capacity = isset($params->capacity) ? $params->capacity : '0';
   
   //$stmt = $db->prepare("SELECT * FROM room_numbers WHERE resort_id = :resort AND room_id = :room ORDER BY name");
   //$stmt->bindParam(':resort', $resort_id); 
   //$stmt->bindParam(':room', $room_id); 
   //$stmt->bindParam(':capacity', $capacity); 
   //$stmt->execute();
   //$rooms = $stmt->fetchAll();
   
   
   
   $result = array();
   
   foreach($checkRoom as $room) {
     $r = new Room();
     $r->id = $room['id'];
     $r->name = $room['name'];
     $r->capacity = intval($room['capacity']);
     $r->status = $room['status'];
     $result[] = $r;
   }
   
   header('Content-Type: application/json');
   echo json_encode($result);
    }
    
   public function sub_room_delete(Request $request){
    $input = $request->all();
    
    $validator = Validator::make($input, [
        'room_id' => 'required',   
    ]);

    if($validator->fails()){
        return $this->sendError('Validation Error.', $validator->errors());       
    }

    $room_id = $request->input('room_id');

    $updateRoom = roomNumber::find($room_id);//query roomNumber model table
    $updateRoom->delete();

header('Content-Type: application/json');
echo json_encode($updateRoom->id);
   }

   public function sub_room_update(Request $request){
        $input = $request->all();
    
        $validator = Validator::make($input, [
            'room_id' => 'required',   
            'capacity' => 'nullable',
            'name' => 'nullable',
            'status' => 'nullable', 
        ]);
    
        if($validator->fails()){
            return $this->sendError('Validation Error.', $validator->errors());       
        }

        $room_id = $request->input('room_id');

        $updateRoom = roomNumber::find($room_id);//query roomNumber model table
   
   
        $updateRoom->name = $request->input('name');
        $updateRoom->capacity = $request->input('capacity');
        $updateRoom->status = $request->input('status');
        $updateRoom->save();
 
   header('Content-Type: application/json');
   echo json_encode($updateRoom);
    
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
   

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
