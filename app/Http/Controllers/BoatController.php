<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Session;
use App\Http\Controllers\API\BaseController as BaseController;
use Illuminate\Http\Request;
use App\Http\Controllers\DateTimeController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use App\Models\User;
use App\Models\Settings;
use App\Models\Boat;
use App\Models\BoatCategory;
use App\Models\BusinessDetail;
use App\Models\Country;
use App\Http\Controllers\DateManagerController;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\ Mail;
use Intervention\Image\ImageManagerStatic as Image;

class BoatController extends BaseController
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

    
    public function index(){
       
        $this->user =  Auth::user();
        $this->settings = Settings::first();
        $myselfs = User::where('id', $this->user->id)->first();//fetch authenticated user data from users database table
        
        $businesses = $this->user->business_account()->orderBy('created_at', 'desc')->get();

        $business_single = $this->user->business_account()->where('business_category', 'Boat')->first();
        $boat_category = BoatCategory::orderBy('id', 'desc')->get();
        $country = Country::where('name', $business_single->country)->first();

        return view('home.business.boats.create_boat_services', ['settings' => $this->settings, 
                                                    'myselfs' => $myselfs, 
                                                    'businesses' => $businesses,
                                                    'business' => $business_single->boats()->get(),
                                                    'categories' => $boat_category,
                                                    'country' => $country
                                                    ]);
    
    }
    
    public function edit_boat_services($id){
        if(Auth::user()){
            if( Auth::user()->user_type == "admin" || Auth::user()->role == 1 || Auth::user()->user_type == "boat_owner" || Auth::user()->privilege == "boat_owner" || Auth::user()->privilege_2 == "boat_owner"){
                $s_id = 1;
              $status = 1;
            $settings = Settings::where(function($p) use($s_id, $status){
                $p->where('id', '=', $s_id);
                $p->where('status', '=', $status);
           })->get();
        
                //$boat_category = BoatCategory::orderBy('id', 'desc')->get();
                $boat = Boat::where('id', $id)->get();
                $resort = Shelter::orderBy('id', 'desc')->get(); 
                $myself = User::where('id', Auth::user()->id)->get();
                    return view('home.edit_boat', ['settings' => $settings, 'myselfs' => $myself, 'resorts' => $resort, 'boats' => $boat]);
        }else{
            $settings = Settings::where('id', 1)->get();
                    $error = array("code" => "403",
                                   "title" => "Forbidden!",
                                   "message" => "You do not have the server privilage to this page! Be warned to avoid being disabled by the admin. Meanwhile, you can return to index page by clicking",
                                   "link" => url('/') );
                                   return view('home.error', ['settings' => $settings, 'errors' => $error]);    
        }
                }else{
                    $settings = Settings::where('id', 1)->get();
                    $error = array("code" => "403",
                                   "title" => "Forbidden!",
                                   "message" => "You do not have the server privilage to this page! Be warned to avoid being disabled by the admin. Meanwhile, you can return to index page by clicking",
                                   "link" => url('/') );
                                   return view('home.error', ['settings' => $settings, 'errors' => $error]); 
        
                }   
    }
    
    
    public function edit_boat_img($id){
        
        $this->user =  Auth::user();
        $this->settings = Settings::first();
        $myselfs = User::where('id', $this->user->id)->first();//fetch authenticated user data from users database table
        
        $businesses = $this->user->business_account()->orderBy('created_at', 'desc')->get();

        $business_single = $this->user->business_account()->where('business_category', 'Boat')->first();
        

        
                //$boat_category = BoatCategory::orderBy('id', 'desc')->get();
                $boat = $business_single->boats()->where('id', $id)->get();
               
                
                    return view('home.business.boats.edit_boat_img', ['settings' => $this->settings, 
                                                      'myselfs' => $myselfs, 
                                                      'businesses' => $businesses,
                                                      'boats' => $boat,
                                                      'boatimages' => json_decode($boat[0]->images)]);
        
    }
    
    
    public function boat_bookings($id){
        if(Auth::user()){
            if( Auth::user()->user_type == "admin" || Auth::user()->role == 1 || Auth::user()->user_type == "boat_owner" || Auth::user()->privilege == "boat_owner" || Auth::user()->privilege_2 == "boat_owner"){
                $s_id = 1;
              $status = 1;
            $settings = Settings::where(function($p) use($s_id, $status){
                $p->where('id', '=', $s_id);
                $p->where('status', '=', $status);
           })->get();
        
                //$boat_category = BoatCategory::orderBy('id', 'desc')->get();
                $boat = Boat::where('id', $id)->get();
                $resort = Shelter::orderBy('id', 'desc')->get(); 
                $myself = User::where('id', Auth::user()->id)->get();
                    return view('home.boat_bookings', ['settings' => $settings, 'myselfs' => $myself, 'resorts' => $resort, 'boats' => $boat]);
        }else{
            $settings = Settings::where('id', 1)->get();
                    $error = array("code" => "403",
                                   "title" => "Forbidden!",
                                   "message" => "You do not have the server privilage to this page! Be warned to avoid being disabled by the admin. Meanwhile, you can return to index page by clicking",
                                   "link" => url('/') );
                                   return view('home.error', ['settings' => $settings, 'errors' => $error]);    
        }
                }else{
                    $settings = Settings::where('id', 1)->get();
                    $error = array("code" => "403",
                                   "title" => "Forbidden!",
                                   "message" => "You do not have the server privilage to this page! Be warned to avoid being disabled by the admin. Meanwhile, you can return to index page by clicking",
                                   "link" => url('/') );
                                   return view('home.error', ['settings' => $settings, 'errors' => $error]); 
        
                }   
    }
    
    


    

   

   public function create_new_boat(Request $request){
    $input = $request->all();
    
        $this->user =  Auth::user();
        $this->settings = Settings::first();
        $myselfs = User::where('id', $this->user->id)->first();//fetch authenticated user data from users database table
        
        $businesses = $this->user->business_account()->orderBy('created_at', 'desc')->get();

        $business_single = $this->user->business_account()->where('business_category', 'Boat')->first();
        // $boat_category = BoatCategory::orderBy('id', 'desc')->get();

    $validator = Validator::make($input, [
        'category' => 'required',
        'registration' => 'required',
        'model' => 'required',
        'capacity' => 'required',
        'curr' => 'required',
        'price' => 'required',
        'location' => 'required',
        'youtube' => 'nullable',
        'address' => 'nullable',
        'desc' => 'nullable',
        
          
    ]);

    if($validator->fails()){
        return $this->sendError('Validation Error.', $validator->errors());       
    }
    
    $check_boat = $business_single->boats()->where('registration', $request->registration)->get();

    if(count($check_boat) > 0){
        return response_data(false, 422, "You've already created a boat data with this registration number(".$request->registration.").", false, false, false);  
    }else{
    $create_boat = $business_single->boats()->create([
        'category' => $request->category,
        'registration' => $request->registration,
        'model' => $request->model,
        'passenger_capacity' => $request->capacity,
        'about' => $request->desc,
        'curr' => $request->curr,
        'price' => $request->price,
        'map_location' => $request->location,
        'address' => $request->address,
        'youtube' => $request->youtube
    ]);

    

    if($create_boat){
        
        return response_data(true, 200, $create_boat->model.' boat data created successfully.', ['values' => $create_boat], false, false);
    }else{
        return response_data(false, 422, "Error occured, please try again later.", false, false, false);  
    }

    }
   }



   public function update_boat_img(Request $request){
    $input = $request->all();
    
    $validator = Validator::make($input, [
        'boat' => 'required',
        'img_1' => 'required|image|mimes:jpeg,png,jpg,gif|max:6144',
    ]);

    if($validator->fails()){
        return $this->sendError('Validation Error.', $validator->errors());       
    }

    $boat = Boat::where('id', $request->input('boat'))->get();

    if($request->hasFile('img_1')){
        //get filename with the extension
        $fileNameWithExt = $request->file('img_1')->getClientOriginalName();
        //get just filename
        $filename = pathinfo($fileNameWithExt, PATHINFO_FILENAME);
        //get just ext
        $extension = $request->file('img_1')->getClientOriginalExtension();
        //filename to store
        $fileNameToStore = str_replace(' ', '_', $filename).'_'.time().'.'.$extension;
        $image = $request->file('img_1');

        $destinationPath = public_path('storage/img/boat/'.$request->input('boat'));

        $image->move($destinationPath, $fileNameToStore);
        //$orgImgPath = $destinationPath.'/'.$fileNameToStore;
        //$thumbPath = $destinationPath.'/'.$fileNameToStore;
        //shell_exec("convert $orgImgPath -resize 200x200\! $thumbPath");

        /*****************************************
        $img = Image::make($image->path());
        $img->resize(100, 100, function ($constraint) {
            $constraint->aspectRatio();
        })->save('public/img/resorts/'.$resort->id.'/images/'.$fileNameToStore);
        *****************************************/
        }else{
        $fileNameToStore = "";
        }

        $dir = asset('storage/img/boat/'.$boat[0]->id);
        
        if ($boat[0]->images) {

            $getServerImg = json_decode($boat[0]->images, true);

            $getServerImg[] = $dir.'/'.$fileNameToStore;

        } else {

            $getServerImg = array();

            $getServerImg[] = $dir.'/'.$fileNameToStore;

        }



        $update_boat_img = Boat::where('id', $request->input('boat'))->update([
            'img_1' => $getServerImg[0],
            'images' => json_encode($getServerImg)
        ]);

    if($update_boat_img){
     //Redirect::url('admin/edit_resort_img/'.$resort[0]->id);
     return $this->sendResponse($update_boat_img, 'Image uploaded succesfully.');
    }

   }


   public function remove_boat_img(Request $request){

    $input = $request->all();
    
    $validator = Validator::make($input, [
        'boat' => 'required',
        'key_num' => 'required',
    ]);

    //$id = Input::get('resort'); 

    //$arrID = Input::get('arrID');



    $boat = Boat::where('id', $request->input('boat'))->get();

    $getServerImg = json_decode($boat[0]->images, true);



    unset($getServerImg[$request->input('key_num')]);



    $update = Boat::where('id', $request->input('boat'))->update([

        'images' => json_encode($getServerImg)

    ]);



    if ($update) {

        return $this->sendResponse($update, 'Image removed succesfully.');

    }


}



public function update_boat(Request $request){
    $input = $request->all();

    $validator = Validator::make($input, [
        'boat' => 'required',
        'price' => 'nullable',
        'model' => 'required',
        'location' => 'nullable',
        'address' => 'nullable',
        'desc' => 'nullable',
        'youtube' => 'nullable',
        'curr' => 'nullable',
    ]);

    if($validator->fails()){
        return $this->sendError('Validation Error.', $validator->errors());       
    }

    
$boat = Boat::where('id', $request->input('boat'))->update(['title' => $request->input('model'), 
                                                               'location' => $request->input('location'), 
                                                               'address' => $request->input('address'), 
                                                               'about' => $request->input('desc'), 
                                                               'price' => $request->input('price'), 
                                                               'curr' =>  $request->input('curr'),
                                                               'youtube' => $request->input('youtube')]);
if($boat){                 
return $this->sendResponse($boat, 'boat info updated succesful.'); 
} 
}

public function delete_boat(Request $request){
    $boat = Boat::find($request->input('id'));
    $boat->delete();
    return $this->sendResponse($boat, ' deleted.'); 
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
