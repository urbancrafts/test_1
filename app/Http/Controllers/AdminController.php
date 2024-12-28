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
use Illuminate\Support\Facades\Validator;
use App\models\SlideFeatures;
use App\Models\Settings;
use App\Models\User;
use App\Models\Country;
use App\Models\State;
use App\Models\City;
use App\Models\Blog;
use App\Models\NewsLetters;
use App\Models\AdminResortFeatures;
use App\Models\StoreItem;
use App\Models\Shelter;
use App\Models\Services;
use App\Models\Boat;
use App\Models\BusinessDetail;
use App\Models\EmailTemplate;

class AdminController extends BaseController
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    protected $user;
    protected $settings;
    protected $array_val = array('false' => 'false', 'true' => 'true');

    public function __construct()
    {
        $this->middleware('admin');
    }

    public function index()
    {
        //
        $this->user =  Auth::user();
        $this->settings = Settings::first();
        $myselfs = User::where('id', $this->user->id)->first();//fetch authenticated user data from users database table
        // $business = $this->user->business_account()->orderBy('created_at', 'desc')->get();
       
        //$blog = Blog::all();

        return view('home.admin.dashboard', ['settings' => $this->settings, 'myselfs' => $myselfs]);
    }



/****************************************************************
 ***********Content management view rendering methods************
 * *************************************************************/

public function settings(){
               
    $this->user =  Auth::user();
    $this->settings = Settings::first();
    $myselfs = User::where('id', $this->user->id)->first();//fetch authenticated user data from users database table
    // $business = $this->user->business_account()->orderBy('created_at', 'desc')->get();
        
    return view('home.admin.info', ['settings' => $this->settings, 'myselfs' => $myselfs]);
            
    
    }


    public function news_letter(){
       
        $this->user =  Auth::user();
        $this->settings = Settings::first();
        $myselfs = User::where('id', $this->user->id)->first();//fetch authenticated user data from users database table
            
            $news_letters = NewsLetters::orderBy('id', 'desc')->get(); 
           
    return view('home.admin.news-letter', ['settings' => $this->settings, 'myselfs' => $myselfs, 'news_letters' => $news_letters]);
    
              
    }


    public function index_slider(){
        $this->user =  Auth::user();
        $this->settings = Settings::first();
        $myselfs = User::where('id', $this->user->id)->first();//fetch authenticated user data from users database table
        
    $slide = SlideFeatures::orderBy('updated_at', 'desc')->get();
            
    return view('home.admin.index_slider', ['settings' => $this->settings, 'myselfs' => $myselfs, 'slides' => $slide]);
    
    }


    public function edit_contents(){
      
        $this->user =  Auth::user();
        $this->settings = Settings::first();
        $myselfs = User::where('id', $this->user->id)->first();//fetch authenticated user data from users database table
        
    return view('home.admin.content', ['settings' => $this->settings, 'myselfs' => $myselfs, 'contents' => $contents, 'contents2' => $contents2]);
           
    }

    public function mail_template(){
        $this->user =  Auth::user();
        $this->settings = Settings::first();
        $myselfs = User::where('id', $this->user->id)->first();//fetch authenticated user data from users database table
        
        $mail_template = EmailTemplate::orderBy('updated_at', 'desc')->get();

    return view('home.admin.mail_template', ['settings' => $this->settings, 'myselfs' => $myselfs, 'templates' => $mail_template]);
    }

    
    public function upload_site_logo(Request $request){

        $input = $request->all();
    
        $validator = Validator::make($input, [
            'logo' => 'nullable|image|mimes:png|max:1999',
            'icon' => 'nullable|image|mimes:png|max:1999', 
                
        ]);
    
        if($validator->fails()){
            return response_data(false, 422, "Sorry a Validation Error Occured", ['errors' => $validator->errors()->all()], false, false);                
        }

        if($request->hasFile('logo')){
            //get filename with the extension
            $fileNameWithExt = $request->file('logo')->getClientOriginalName();
            //get just filename
            $filename = pathinfo($fileNameWithExt, PATHINFO_FILENAME);
            //get just ext
            $extension = $request->file('logo')->getClientOriginalExtension();
            //filename to store
            $fileNameToStore = $filename.'_'.time().'.'.$extension;
            $path = $request->file('logo')->storeAs('public/img/site_logo', $fileNameToStore);
    
            }else{
            $fileNameToStore = "";
            }
    
            if($request->hasFile('icon')){
                //get filename with the extension
                $fileNameWithExt = $request->file('icon')->getClientOriginalName();
                //get just filename
                $filename = pathinfo($fileNameWithExt, PATHINFO_FILENAME);
                //get just ext
                $extension = $request->file('icon')->getClientOriginalExtension();
                //filename to store
                $fileNameToStore2 = $filename.'_'.time().'.'.$extension;
                $path = $request->file('icon')->storeAs('public/img/site_icon', $fileNameToStore2);
        
                }else{
                $fileNameToStore2 = "";
                }

                if($fileNameToStore != ""){
                    $dir = asset('storage/img/site_logo');
                    $getServerImg = $dir.'/'.$fileNameToStore;
                    $settings = Settings::first()->update([
                       'logo' => $getServerImg
                    ]);
                }
                if($fileNameToStore2 !=""){
                    $dir2 = asset('storage/img/site_icon');
                    $getServerImg2 = $dir2.'/'.$fileNameToStore2;
                    $settings = Settings::first()->update([
                        'icon' => $getServerImg2
                     ]);
                }

                if($settings){
        
                    return response_data(true, 200, 'Site logo and icon uploaded successfully.', false, false, false);
                }else{
                    return response_data(false, 422, "Error occured, please try again later.", false, false, false);  
                }       
                

    }

    public function update_settings(Request $request){

        $input = $request->all();
    
        $validator = Validator::make($input, [
            'curr' => 'nullable',
            'lang' => 'nullable',
            'tel' => 'nullable',
            'mobile' => 'nullable',
            'email' => 'nullable',
            'address' => 'nullable',
            'payment-type' => 'nullable',
            'discount' => 'nullable',
            'credit' => 'nullable',
            'mem_fee' => 'nullable',
            'fb' => 'nullable',
            'insta' => 'nullable',
            'twitter' => 'nullable',
            'site-name' => 'nullable',
            
            
                
        ]);
    
        if($validator->fails()){
            return response_data(false, 422, "Sorry a Validation Error Occured", ['errors' => $validator->errors()->all()], false, false);                      
        }
    
        
        
                        $settings = Settings::first()->update([

                        'curr' => $request->curr,
                        'language' => $request->lang,
                        'tel' => $request->tel,
                        'mobile' => $request->mobile,
                        'email' => $request->email,
                        'address' => $request->address,
                        'payment_type' => $request->payment_type,
                        'memb_discount' => $request->discount,
                        'memb_debt_capacity' => $request->credit,
                        'membership_fee' => $request->mem_fee,
                        'facebook' => $request->fb,
                        'instagram' => $request->insta,
                        'twitter' => $request->twitter, 
                        'site_name' => $request->site_name
                        ]);
               
    if($settings){
        
    return response_data(true, 200, 'Site settings updated.', false, false, false);
    }else{
    return response_data(false, 422, "Error occured, please try again later.", false, false, false);  
    }                      
    
    }

    public function load_slider_category(Request $request){
        $input = $request->all();
    
        $validator = Validator::make($input, [
            'category' => 'required',
        ]);
    
        if($validator->fails()){
            return response_data(false, 422, "Sorry a Validation Error Occured", ['errors' => $validator->errors()->all()], false, false);                            
        }
    


        $data = "";
        if($request->category == "Shop"){
         $store = StoreItem::orderBy('id', 'desc')->get();
         if(count($store) > 0){
         foreach($store as $service){
            $data .= "<li class='item'>
                          
            <div class='product-img'>
              <img src='".$service->img_1."' alt='".$service->item_name."'>
            </div>
            <div class='product-info'>
              <a href='#' class='product-title'>".$service->item_name."
                </a>
              
                  
               <a href='#' class='fa fa-plus del-btn' onclick='addServiceSlide(this)' data-id='".$service->id."' data-cat='".$request->category."' data-name='".$service->item_name."' title='Add ".$service->item_name."'>Add</a>
               <span class='label label-warning pull-right'>
                
                    Shop
                
                </span>
            </div>
          </li>";
        }
        return response_data(true, 200, 'Shop items fetched.', ['values' => $data], false, false);
    }else{
        return response_data(false, 422, "There's no shop item list available.", false, false, false);  
    }
        }else if($request->category == "Resort"){
        $resort = Shelter::orderBy('id', 'desc')->get();
        if(count($resort) > 0){
        foreach($resort as $service){
            $data .= "<li class='item'>
                          
            <div class='product-img'>
              <img src='".$service->img_1."' alt='".$service->name."'>
            </div>
            <div class='product-info'>
              <a href='#' class='product-title'>".$service->name." - ".$service->business_detail()->get()[0]->business_name."
                </a>
              
                  
               <a href='#' class='fa fa-plus del-btn' onclick='addServiceSlide(this)' data-id='".$service->id."' data-cat='".$request->category."' data-name='".$service->name."' title='Add ".$service->name."'>Add</a>
               <span class='label label-warning pull-right'>
                
                    Subscribed(". $service->business_detail()->get()[0]->subscribed .")
                
                </span>
            </div>
          </li>";
        }
        return response_data(true, 200, 'Resort contents list fetched.', ['values' => $data], false, false);
    }else{
        return response_data(false, 422, "There's no resort content list available.", false, false, false);  
    }
        }else if($request->category == "Others"){
        $services = Services::orderBy('id', 'desc')->get();
        if(count($services) > 0){
        foreach($services as $service){
         $data .= "<li class='item'>
                       
         <div class='product-img'>
           <img src='".$service->img_1."' alt='".$service->title."'>
         </div>
         <div class='product-info'>
           <a href='#' class='product-title'>".$service->title." - ".$service->business_detail()->get()[0]->business_name."
             </a>
           
               
            <a href='#' class='fa fa-plus del-btn' onclick='addServiceSlide(this)' data-id='".$service->id."' data-cat='".$request->category."' data-name='".$service->title."' title='Add ".$service->title."'>Add</a>
            <span class='label label-warning pull-right'>
             
            Subscribed(". $service->business_detail()->get()[0]->subscribed .")
             
             </span>
         </div>
       </li>";
        }
        return response_data(true, 200, 'Other services list fetched.', ['values' => $data], false, false);
    }else{
        return response_data(false, 422, "There's no service list available.", false, false, false);  
    }
        }else if($request->category == "Boat"){
    
            $boat = Boat::orderBy('id', 'desc')->get();
        if(count($boat) > 0){
        foreach($boat as $service){
         $data .= "<li class='item'>
                       
         <div class='product-img'>
           <img src='".$service->img_1."' alt='".$service->model."'>
         </div>
         <div class='product-info'>
           <a href='#' class='product-title'>".$service->model." - ".$service->business_detail()->get()[0]->business_name."
             </a>
           
               
            <a href='#' class='fa fa-plus del-btn' onclick='addServiceSlide(this)' data-id='".$service->id."' data-cat='".$request->category."' data-name='".$service->model."' title='Add ".$service->model."'>Add</a>
            <span class='label label-warning pull-right'>
             
            Subscribed(". $service->business_detail()->get()[0]->subscribed .")
             
             </span>
         </div>
       </li>";
    
        }
        return response_data(true, 200, 'Boat list fetched.', ['values' => $data], false, false);
    }else{
        return response_data(false, 422, "There's no boat list available.", false, false, false);  
    }

    }

    
        
    
         
    }

    public function add_to_slide(Request $request){
        $input = $request->all();
    
        $validator = Validator::make($input, [
            'category' => 'required',
            'id' => 'required',
        ]);
    
        if($validator->fails()){
            return response_data(false, 422, "Sorry a Validation Error Occured", ['errors' => $validator->errors()->all()], false, false);                                 
        }
        
        $id = $request->input('id');
        $cat = $request->input('category');
    
        $slide = SlideFeatures::where(function($p) use($id, $cat){
            $p->where('ref_id', '=', $id);
            $p->where('category', '=', $cat);
       })->get();
    
       if(count($slide) > 0){
        return response_data(false, 422, $slide[0]->name.' is already added to the slide', false, false, false);
               
       }else{
         if($cat == "Shop"){
            $store = StoreItem::where('id', $id)->get();
    
            $img = $store[0]->img_1;
    
            $url = url('shop/'.$store[0]->category.'/'.$store[0]->id);
            
            $new_slide = new SlideFeatures;
            $new_slide->ref_id = $store[0]->id;
            $new_slide->category = $cat;
            $new_slide->name = $store[0]->item_name;
            $new_slide->img_url = $img;
            $new_slide->url = $url;
            $new_slide->save();
         }else if($cat == "Resort"){
             $resort = Shelter::where('id', $id)->get();
            
             $img = $resort[0]->img_1;
    
             $url = url('resorts/resort/'.$resort[0]->id);
    
            $new_slide = new SlideFeatures;
            $new_slide->ref_id = $resort[0]->id;
            $new_slide->category = $cat;
            $new_slide->name = $resort[0]->name;
            $new_slide->img_url = $img;
            $new_slide->url = $url;
            $new_slide->save();
         }else if($cat == "Others"){
             $services = Services::where('id', $id)->get();
             
             $img = $services[0]->img_1;
    
             $url = url('services/service/'.$services[0]->id);
    
            $new_slide = new SlideFeatures;
            $new_slide->ref_id = $services[0]->id;
            $new_slide->category = $cat;
            $new_slide->name = $services[0]->title;
            $new_slide->img_url = $img;
            $new_slide->url = $url;
            $new_slide->save();
         }else if($cat == "Boat"){
            $services = Boat::where('id', $id)->get();
             
            $img = $services[0]->img_1;
    
            $url = url('boats/boat/'.$services[0]->id);
    
           $new_slide = new SlideFeatures;
           $new_slide->ref_id = $services[0]->id;
           $new_slide->category = $cat;
           $new_slide->name = $services[0]->title;
           $new_slide->img_url = $img;
           $new_slide->url = $url;
           $new_slide->save();
         }
         return response_data(true, 200, $new_slide->name.' added to the slide succesfully.', ['values' => $new_slide], false, false);
         
       }
    
        
    }


    public function update_index_slide(Request $request){
        $service  = SlideFeatures::where('id', $request->input('uid'))->update(['updated' => 1]);
        return $this->sendResponse($service, 'Service updated succesfully.'); 
}


    public function delete_service_slide($id){
        $slide = SlideFeatures::find($id);
        $slide->delete();
        return response_data(true, 200, ' Slide deleted.', false, false, false);
        
    }


    public function create_user(Request $request){
        $input = $request->all();
    
        $validator = Validator::make($input, [
            'name' => 'required',
            'email' => 'required',
            'phone' => 'required',
            'admin-type' => 'required',
            'pass' => 'required',
                
        ]);
    
        if($validator->fails()){
            return $this->sendError('Validation Error.', $validator->errors());       
        }
        
        
        $user = new User;
    
        $user->name = $request->input('name');
        $user->phone = $request->input('phone');
        $user->email = $request->input('email');
        $user->password = bcrypt($request->input('pass'));
        $user->role = $request->input('admin-type');
        $user->user_type = 'admin';
        $user->admin = Auth::user()->id;
        $user->save();
    
        Storage::makeDirectory('public/img/users/'.$user->id, 0775);
        Storage::makeDirectory('public/img/users/'.$user->id.'/profile', 0775);
        Storage::makeDirectory('public/img/users/'.$user->id.'/blog', 0775);
    
        return $this->sendResponse($user, $user->name.' account created succesfully.'); 
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
