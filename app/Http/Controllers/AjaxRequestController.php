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
use App\Models\Boat;
use App\Models\ShoppingCart;
use App\Http\Controllers\API\BaseController as BaseController;
use App\Http\Controllers\DateManagerController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\ Mail;
use Intervention\Image\ImageManagerStatic as Image;
class AjaxRequestController extends BaseController
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


    public function load_resort_rooms(Request $request){
        $input = $request->all();

        $validator = Validator::make($input, [
            'resort' => 'required',
        ]);

        if($validator->fails()){
            return $this->sendError('Validation Error.', $validator->errors());       
        }
        
        
        $data = '';
        $rooms = Rooms::where('shelter_id', $request->input('resort'))->get();
        
        if(count($rooms) > 0){
        foreach($rooms as $room){
              $data .= '<option value="'.$room->id.'">'.$room->room_no.'</option>';
        }
        return $this->sendResponse($data, 'Rooms data fetched.');
        }else{
            $data .= '<option value="">No data fetched</option>';
          return $this->showErrorMsg('This resort does not have any room data uploaded yet.', $data);
        }
        
    }


    public function load_resort_location_search(Request $request){
        $input = $request->all();

        $validator = Validator::make($input, [
            'location' => 'required',
        ]);

        if($validator->fails()){
            return $this->sendError('Validation Error.', $validator->errors());       
        }
        
        
        $data = '';
        $resorts = Shelter::where('location', $request->input('location'))->get();
        if(count($resorts) > 0){
        foreach($resorts as $resort){
              $data .= '<option value="'.$resort->id.'">'.$resort->name.'</option>';
        }
        return $this->sendResponse($data, 'Resort data fetched.');
      }else{
        $data .= '<option value="">No data fetched</option>';
        return $this->showErrorMsg('No resort under this location yet.', $data);//return json response     
      }
        
    }

    public static function room_search($resort_id, $location, $resort){
        $result = '';
        $rooms = Rooms::where('shelter_id', $resort_id)->orderBy('id', 'desc')->get();
            foreach($rooms as $room){
                $result .= "<tr class='hb-form-field location-class'> 
                             <td><a href='".url('resorts/resort/'.$room->shelter_id.'/'.$room->id)."'><img src='".asset('storage/img/resorts/'.$room->shelter_id.'/rooms/'.$room->id.'/'.$room->img_1)."' width='300' height='200' /></a></td><td><a href='".url('resorts/resort/'.$room->shelter_id.'/'.$room->id)."'>".$room->room_no."</a> | <span class='fa fa-home'>".$resort."</span></td><td>Location: ".$location."</td>
                             </tr>";
            }
        return $result;
     
    }

    public function post_check_availability(Request $request){
        $input = $request->all();

        $validator = Validator::make($input, [
            'location' => 'required',
            'search-option' => 'required',
        ]);

        if($validator->fails()){
            return $this->sendError('Validation Error.', $validator->errors());       
        }
        
        if($request->input('search-option') == 'Resort'){
            $resorts = Shelter::where('location', 'LIKE', '%'.$request->input('location').'%')->get();
            if(count($resorts) > 0){ 
            return $this->sendResponse($resorts, 'Resort location fetched.');
        }else{
            return $this->showErrorMsg("Error", "There are no resorts found within this location");//return json response  
        }
        }else if($request->input('search-option') == 'Boat'){
             
            $boats = Boat::where('location', 'LIKE', '%'.$request->input('location').'%')->orderBy('id', 'desc')->get();
            
            if(count($boats) > 0){
            
            return $this->sendResponse($boats, 'Boat location fetched.');
        }else{
            return $this->showErrorMsg("Error", "There are no boats found within this location");//return json response  
        }
        }else if($request->input('search-option') == 'Others'){
            
            $location = $request->input('location');
            $services = Services::where('location', 'LIKE', '%'.$location.'%')->orderBy('id', 'desc')->get();//query roomNumber model table

            //$services = Services::where('location', 'LIKE', '%'.$request->input('location').'%')->orderBy('id', 'desc')->get();
            
            if(count($services) > 0){
            
            return $this->sendResponse($services, 'Boats location fetched.');
        }else{
            return $this->showErrorMsg('Error', 'There are no services found under this location.');//return json response  
        }
        }
        
        
    }


    public function make_blog_post(Request $request){
        $input = $request->all();

        $validator = Validator::make($input, [
            'uid' => 'required',
            'category' => 'nullable',
            'poster-name' => 'required',
            'title' => 'required',
            'blog-content' => 'required',
            'blog-file' => 'image|nullable|max:6999',  
        ]);

        //handle file upload
        if($request->hasFile('blog-file')){
            //get filename with the extension
            $fileNameWithExt = $request->file('blog-file')->getClientOriginalName();
            //get just filename
            $filename = pathinfo($fileNameWithExt, PATHINFO_FILENAME);
            //get just ext
            $extension = $request->file('blog-file')->getClientOriginalExtension();
            //filename to store
            $fileNameToStore = $filename.'_'.time().'.'.$extension;
            $path = $request->file('blog-file')->storeAs('public/img/users/'.Auth::user()->id.'/blog', $fileNameToStore);
    
            }else{
            $fileNameToStore = "";
            }

    
            $blog = new Blog;
            $blog->user_id = $request->input('uid');
            $blog->category = $request->input('category');
            $blog->name = $request->input('poster-name');
            $blog->title = $request->input('title');
            $blog->cnt = $request->input('blog-content');
            $blog->media = $fileNameToStore;
            $blog->save();
   
            return $this->sendResponse($blog, 'Blog created succesfully.'); 
    }

    

/**************************************************************** 
public function resort_image_upload(Request $request){
    $input = $request->all();

        $validator = Validator::make($input, [
            'resort' => 'required',
            'resort-img1' => 'image|nullable|max:6999',
            'resort-img2' => 'image|nullable|max:6999', 
            'resort-img3' => 'image|nullable|max:6999',  
            'resort-img4' => 'image|nullable|max:6999',    
        ]);
  
        if($validator->fails()){
            return $this->sendError('Validation Error.', $validator->errors());       
        }

         //handle file upload
         Storage::makeDirectory('public/img/resort/'.$request->input('resort'), 0775);
         Storage::makeDirectory('public/img/resort/'.$request->input('resort').'/images', 0775);
         Storage::makeDirectory('public/img/resort/'.$request->input('resort').'/rooms', 0775);
         
         if($request->hasFile('resort-img1')){
             //get filename with the extension
             $fileNameWithExt = $request->file('resort-img1')->getClientOriginalName();
             //get just filename
             $filename = pathinfo($fileNameWithExt, PATHINFO_FILENAME);
             //get just ext
             $extension = $request->file('resort-img1')->getClientOriginalExtension();
             //filename to store
             $fileNameToStore = $filename.'_'.time().'.'.$extension;
             $path = $request->file('resort-img1')->storeAs('public/img/resort/'.$request->input('resort').'/images', $fileNameToStore);
     
             }else{
             $fileNameToStore = "";
             }
 
             if($request->hasFile('resort-img2')){
                 //get filename with the extension
                 $fileNameWithExt = $request->file('resort-img2')->getClientOriginalName();
                 //get just filename
                 $filename = pathinfo($fileNameWithExt, PATHINFO_FILENAME);
                 //get just ext
                 $extension = $request->file('resort-img2')->getClientOriginalExtension();
                 //filename to store
                 $fileNameToStore2 = $filename.'_'.time().'.'.$extension;
                 $path = $request->file('resort-img2')->storeAs('public/img/resort/'.$request->input('resort').'/images', $fileNameToStore2);
         
                 }else{
                 $fileNameToStore2 = "";
                 }
 
                 if($request->hasFile('resort-img3')){
                     //get filename with the extension
                     $fileNameWithExt = $request->file('resort-img3')->getClientOriginalName();
                     //get just filename
                     $filename = pathinfo($fileNameWithExt, PATHINFO_FILENAME);
                     //get just ext
                     $extension = $request->file('resort-img3')->getClientOriginalExtension();
                     //filename to store
                     $fileNameToStore3 = $filename.'_'.time().'.'.$extension;
                     $path = $request->file('resort-img3')->storeAs('public/img/resort/'.$request->input('resort').'/images', $fileNameToStore3);
             
                     }else{
                     $fileNameToStore3 = "";
                     }
 
                     if($request->hasFile('resort-img4')){
                         //get filename with the extension
                         $fileNameWithExt = $request->file('resort-img4')->getClientOriginalName();
                         //get just filename
                         $filename = pathinfo($fileNameWithExt, PATHINFO_FILENAME);
                         //get just ext
                         $extension = $request->file('resort-img4')->getClientOriginalExtension();
                         //filename to store
                         $fileNameToStore4 = $filename.'_'.time().'.'.$extension;
                         $path = $request->file('resort-img4')->storeAs('public/img/resort/'.$request->input('resort').'/images', $fileNameToStore4);
                 
                         }else{
                         $fileNameToStore4 = "";
                         }
                         
                         $resort = Shelter::find($request->input('resort'));
                         $resort->img_1 = $fileNameToStore;
                         $resort->img_2 = $fileNameToStore2;
                         $resort->img_3 = $fileNameToStore3;
                         $resort->img_4 = $fileNameToStore4;
                         $resort->save();
                         return $this->sendResponse($resort, 'Resort image upload succesful.');

}

****************************************************************/

public function load_index_blog(Request $request){
    if($request->input('action') == "callRoomLoader"){
       $blogs = Blog::orderBy('id', 'desc')->limit(3)->get();

       $blog_data = '';

       if(count($blogs) > 0){
        foreach($blogs as $blog){
    $blog_data .= "<div class='column-item style-1'>
    <div class='post-inner'>
    <div class='post-thumbnail'>
    <a href='".url('blog/'.$blog->id)."'>
    <img width='500' height='560' src='".asset('storage/img/users/'.$blog->user_id.'/blog/'.$blog->media)."' class='attachment-foxuries-post-grid size-foxuries-post-grid wp-post-image' alt='' /> </a>
    </div>
    <div class='entry-content'>
    <h3 class='entry-title'><a href='".url('blog/'.$blog->id)."' rel='bookmark'>".$blog->title."</a></h3> <div class='entry-meta'>
    <span class='posted-on'>On <a href='#' rel='bookmark'><time class='updated' datetime='".$blog->create_at."'>".$blog->create_at."</time></a></span> </div>
    <div class='entry-summary-hide'>
    <p class='post-excerpt'>".$blog->cnt."</p>
    <a class='read-more-post' href='".url('blog/'.$blog->id)."'><i class='foxuries-icon-long-arrow-right'></i><span>Read More</span></a>
    </div>
    </div>
    </div>
    </div>";

        }
        return $this->sendResponse($blog_data, 'Index blog data loaded.');
       }else{
        return $this->showErrorMsg('Error', '<h3 align="center">There is no blog data available to load</h3>');//return json response     
       }
    }
}





public function room_image_upload(Request $request){

}



public function post_service(Request $request){
    $input = $request->all();

    $validator = Validator::make($input, [
        'curr' => 'nullable',
        'category' => 'required',
        'name' => 'required',
        'price' => 'nullable',
        'location' => 'nullable',
        'desc' => 'nullable',
        'img_1' => 'required|image|mimes:jpeg,png,jpg,gif|max:6144',
        'img_2' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:6144',
        'img_3' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:6144',
        'img_4' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:6144',
            
    ]);

    if($validator->fails()){
        return $this->sendError('Validation Error.', $validator->errors());       
    }


    
    if($request->hasFile('img_1')){
        //get filename with the extension
        $fileNameWithExt = $request->file('img_1')->getClientOriginalName();
        //get just filename
        $filename = pathinfo($fileNameWithExt, PATHINFO_FILENAME);
        //get just ext
        $extension = $request->file('img_1')->getClientOriginalExtension();
        //filename to store
        $fileNameToStore = $filename.'_'.time().'.'.$extension;
        $path = $request->file('img_1')->storeAs('public/img/services', $fileNameToStore);

        }else{
        $fileNameToStore = "";
        }

        if($request->hasFile('img_2')){
            //get filename with the extension
            $fileNameWithExt = $request->file('img_2')->getClientOriginalName();
            //get just filename
            $filename = pathinfo($fileNameWithExt, PATHINFO_FILENAME);
            //get just ext
            $extension = $request->file('img_2')->getClientOriginalExtension();
            //filename to store
            $fileNameToStore2 = $filename.'_'.time().'.'.$extension;
            $path = $request->file('img_2')->storeAs('public/img/services', $fileNameToStore2);
    
            }else{
            $fileNameToStore2 = "";
            }

            if($request->hasFile('img_3')){
                //get filename with the extension
                $fileNameWithExt = $request->file('img_3')->getClientOriginalName();
                //get just filename
                $filename = pathinfo($fileNameWithExt, PATHINFO_FILENAME);
                //get just ext
                $extension = $request->file('img_3')->getClientOriginalExtension();
                //filename to store
                $fileNameToStore3 = $filename.'_'.time().'.'.$extension;
                $path = $request->file('img_3')->storeAs('public/img/services', $fileNameToStore3);
        
                }else{
                $fileNameToStore3 = "";
                }

                if($request->hasFile('img_4')){
                    //get filename with the extension
                    $fileNameWithExt = $request->file('img_4')->getClientOriginalName();
                    //get just filename
                    $filename = pathinfo($fileNameWithExt, PATHINFO_FILENAME);
                    //get just ext
                    $extension = $request->file('img_4')->getClientOriginalExtension();
                    //filename to store
                    $fileNameToStore4 = $filename.'_'.time().'.'.$extension;
                    $path = $request->file('img_4')->storeAs('public/img/services', $fileNameToStore4);
            
                    }else{
                    $fileNameToStore4 = "";
                    }

                    $service = new Services;
                    $service->category = $request->input('category');
                    $service->title = $request->input('name');
                    $service->about = $request->input('desc');
                    $service->curr = $request->input('curr');
                    $service->price = $request->input('price');
                    $service->img = $fileNameToStore;
                    $service->img_2 = $fileNameToStore2;
                    $service->img_3 = $fileNameToStore3;
                    $service->img_4 = $fileNameToStore4;
                    $service->location = $request->input('location');
                    $service->created_by = Auth::user()->id;
                    $service->save();
                    return $this->sendResponse($service, 'Service created succesfully.');  
}


public function update_index_slide(Request $request){
          $service  = SlideFeatures::where('id', $request->input('uid'))->update(['updated' => 1]);
          return $this->sendResponse($service, 'Service updated succesfully.'); 
}

public function load_content(Request $request){
    $input = $request->all();

    $validator = Validator::make($input, [
        'cntName' => 'required',
            
    ]);

    if($validator->fails()){
        return $this->sendError('Validation Error.', $validator->errors());       
    }

    $content = Content::where('name', $request->input('cntName'))->get();
    return $this->sendResponse($content, 'Content value loaded succesfully.');  

}

public function create_content_name(Request $request){
    $input = $request->all();

    $validator = Validator::make($input, [
        'cnt-name' => 'required',
        
    ]);

    if($validator->fails()){
        return $this->sendError('Validation Error.', $validator->errors());       
    }

    $content = new Content;
    $content->name = $request->input('cnt-name');
    $content->save();

    return $this->sendResponse($content, 'Content Name Created.');  

}

public function update_content(Request $request){
    $input = $request->all();

    $validator = Validator::make($input, [
        'cnt-id' => 'required',
        'content-name' => 'required',
        'desc' => 'required',
        'img_1' => 'image|nullable|max:6999',
        
            
    ]);

    if($validator->fails()){
        return $this->sendError('Validation Error.', $validator->errors());       
    }


    
    if($request->hasFile('img_1')){
        //get filename with the extension
        $fileNameWithExt = $request->file('img_1')->getClientOriginalName();
        //get just filename
        $filename = pathinfo($fileNameWithExt, PATHINFO_FILENAME);
        //get just ext
        $extension = $request->file('img_1')->getClientOriginalExtension();
        //filename to store
        $fileNameToStore = $filename.'_'.time().'.'.$extension;
        $path = $request->file('img_1')->storeAs('public/img/content', $fileNameToStore);

        }else{
        $fileNameToStore = "";
        }

        

                    $content = Content::find($request->input('cnt-id'));
                    $content->value = $request->input('desc');
                    $content->save();
                    return $this->sendResponse($content, 'Content updated.');  
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


public function upload_profile_image(Request $request){
    
    $input = $request->all();

    $validator = Validator::make($input, [
        'p_img' => 'image|required|max:1999', 
        'user_id' => 'required',
            
    ]);

    if($validator->fails()){
        return $this->sendError('Validation Error.', $validator->errors());       
    }

    if($request->hasFile('p_img')){
        //get filename with the extension
        $fileNameWithExt = $request->file('p_img')->getClientOriginalName();
        //get just filename
        $filename = pathinfo($fileNameWithExt, PATHINFO_FILENAME);
        //get just ext
        $extension = $request->file('p_img')->getClientOriginalExtension();
        //filename to store
        $fileNameToStore = $filename.'_'.time().'.'.$extension;
        $path = $request->file('p_img')->storeAs('public/img/users/'.$request->input('user_id').'/profile', $fileNameToStore);

        }else{
        $fileNameToStore = "";
        }

        $user = User::where('id', $request->input('user_id'))->update(['img' => $fileNameToStore]);

        return $this->sendResponse($user, 'Uploaded.');

}

public function profile_update_upload(Request $request){
    
    $input = $request->all();

    $validator = Validator::make($input, [
        'user_id' => 'required',
        'p_name' => 'required',
        'p_email' => 'required',
        'p_number' => 'required',
        'about' => 'nullable',
        'occupation' => 'nullable',
        'position' => 'nullable', 
        'status' => 'nullable',
        'privilege' => 'nullable', 
    ]);

    if($validator->fails()){
        return $this->sendError('Validation Error.', $validator->errors());       
    }

    $privilege_1 = '';
    $privilege_2 = '';

    //$privilege_1 = array_splice($request->input('privilege'),0);
    //$privilege_2 = array_splice($request->input('privilege'),1);
    if($request->input('privilege') != ""){
    foreach($request->input('privilege') as $privilege){
        if($privilege == "resort_owner"){
        $privilege_1 .= $privilege;
        }
        if($privilege == "boat_owner"){
        $privilege_2 .= $privilege;
        }
    }
}

    $user = User::where('id', $request->input('user_id'))->update(['name' => $request->input('p_name'), 'phone' => $request->input('p_number'), 'email' => $request->input('p_email'), 'about' => $request->input('about'), 'profession' => $request->input('occupation'), 'privilege' => $privilege_1, 'privilege_2' => $privilege_2, 'position' => $request->input('position'), 'isActive' => $request->input('status')]);

return $this->sendResponse($user, 'Profile updated succesfully.');  
}

public function profile_change_password(Request $request){
    $input = $request->all();

    $validator = Validator::make($input, [
        'old_pass' => 'required',
        'new_pass' => 'required',
        'c_pass' => 'required',   
    ]);

    if($validator->fails()){
        return $this->sendError('Validation Error.', $validator->errors());       
    }
    $uid = Auth::user()->id;//create var for user auth
    $old_pass = $request->input('old_pass');//encrypt old_pass variable
    $new_pass = bcrypt($request->input('new_pass'));//encrypt new_pass variable
    $credential = ['id' => $uid, 'password' => $old_pass];//create an array of both uid and password fields
    /************************************************************
    $user1 = User::where(function($p) use($uid, $old_pass){
        $p->where('id', '=', $uid);
        $p->where('password', '=', $old_pass);
        
   })->get();//query user model table
****************************************************************/
   if(Auth::attempt($credential)){//check if record is greater than zero(0)
    $user = User::where('id', $uid)->update(['password' => $new_pass]);//update user password field
    return $this->sendResponse($user, 'Your password is changed succesfully.'); 
    }else{
        return $this->showErrorMsg('Error', 'Old password entry is incorrect');//return json response  
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
        'status' => 'nullable',
        'logo' => 'image|nullable|max:1999',
        'icon' => 'image|nullable|max:1999', 
            
    ]);

    if($validator->fails()){
        return $this->sendError('Validation Error.', $validator->errors());       
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

                    $settings = Settings::find(1);
                    $settings->curr = $request->input('curr');
                    if($fileNameToStore != ""){
                        $settings->logo = $fileNameToStore;   
                    }
                    if($fileNameToStore2 !=""){
                        $settings->icon = $fileNameToStore2;
                    }
                    $settings->language = $request->input('lang');
                    $settings->tel = $request->input('tel');
                    $settings->mobile = $request->input('mobile');
                    $settings->email = $request->input('email');
                    $settings->mobile = $request->input('mobile');
                    $settings->email = $request->input('email');
                    $settings->address = $request->input('address');
                    $settings->payment_type = $request->input('payment-type');
                    $settings->memb_discount = $request->input('discount');
                    $settings->memb_debt_capacity = $request->input('credit');
                    $settings->membership_fee = $request->input('mem_fee');
                    $settings->facebook = $request->input('fb');
                    $settings->instagram = $request->input('insta');
                    $settings->twitter = $request->input('email');
                    $settings->number_of_resort = $request->input('no_of_resort');
                    $settings->number_of_staff = $request->input('no_of_staff');
                    $settings->number_of_bars = $request->input('no_of_bar');
                    $settings->number_of_pool = $request->input('no_of_pool');
                    $settings->site_name = $request->input('site-name');
                    $settings->status = $request->input('status');
                    $settings->save();
                    return $this->sendResponse($settings, 'Site settings updated.');  

}

public function delete_user(Request $request){
    $user = User::find($request->input('uid'));
    $user->delete();
    return $this->sendResponse($user, 'User deleted.');  
}

public function delete_service(Request $request){
    $services = Services::find($request->input('uid'));
    $services->delete();
    return $this->sendResponse($services, 'Service deleted.');
}

public function delete_service_slide(Request $request){
    $services = SlideFeatures::find($request->input('uid'));
    $services->delete();
    return $this->sendResponse($services, 'Service deleted.');
}





public function load_blog_page(Request $request){
    $input = $request->all();

    $validator = Validator::make($input, [
        'record_per_page' => 'required',
        'start' => 'required',
        'action' => 'required',
    ]);

    if($validator->fails()){
        return $this->sendError('Validation Error.', $validator->errors());       
    }
      
    $data = '';
    $img = '';
    $verify_img = '';
    $status = '';
    $dataArr = array();
    $blogs = Blog::orderBy('id', 'desc')->limit($request->input('record_per_page'),$request->input('start'))->get();

    foreach($blogs as $blog){
        if($blog->media != ""){
          $img .= "<img width='1000' height='565' src='".asset('storage/img/users/'.$blog->id.'/blog/'.$blog->media)."' class='attachment-post-thumbnail size-post-thumbnail wp-post-image' />";
        }
        $data .= "<article id='post-29' class='post-29 post type-post status-publish format-standard has-post-thumbnail hentry category-apartment category-vacation tag-accommodation tag-apartment tag-hotel tag-reservation tag-resort tag-travel'>
        ".$img."
        <header class='entry-header'>
        <h2 class='alpha entry-title'><a href='".url('blog/'.$blog->id)."' rel='bookmark'>".$blog->title."</a></h2> <div class='entry-meta'>
        <span class='posted-on'>On <a href='#' rel='bookmark'><time class='entry-date published' datetime='".$blog->created_at."'>".$blog->created_at."</time><time class='updated' datetime='".$blog->updated_at."'>".$blog->updated_at."</time></a></span> <span class='post-author'>Posted by <a href='".url('users/profile/'.$blog->user_id)."' rel='author'>".$blog->name."</a></span></div>
        </header>
        <div class='entry-content'>
        ".$blog->cnt."<span class='more-link-wrap'> <a href='".url('blog/'.$blog->id)."'>Read More </a></span>
        </div>
        </article>";
    }

    return $this->sendResponse($data, 'Blog loaded.'); 
}

public function create_shop_category(Request $request){
    $input = $request->all();

    $validator = Validator::make($input, [
        'category-name' => 'required',
    ]);

    if($validator->fails()){
        return $this->sendError('Validation Error.', $validator->errors());       
    } 
    
    $shopCategory = new StoreCategory;
    $shopCategory->category = $request->input('category-name');
    $shopCategory->save();

    return $this->sendResponse($shopCategory, 'Shop category created.'); 

}

public function create_shop(Request $request){
    $input = $request->all();

    $validator = Validator::make($input, [
        'curr' => 'nullable',
        'category' => 'required',
        'name' => 'required',
        'price' => 'nullable',
        'desc' => 'nullable',
        'img_1' => 'image|nullable|max:8999',
        'img_2' => 'image|nullable|max:8999',
        'img_3' => 'image|nullable|max:8999',
        'img_4' => 'image|nullable|max:8999',
            
    ]);

    if($validator->fails()){
        return $this->sendError('Validation Error.', $validator->errors());       
    }


    
    if($request->hasFile('img_1')){
        //get filename with the extension
        $fileNameWithExt = $request->file('img_1')->getClientOriginalName();
        //get just filename
        $filename = pathinfo($fileNameWithExt, PATHINFO_FILENAME);
        //get just ext
        $extension = $request->file('img_1')->getClientOriginalExtension();
        //filename to store
        $fileNameToStore = $filename.'_'.time().'.'.$extension;
        $path = $request->file('img_1')->storeAs('public/img/shop', $fileNameToStore);

        }else{
        $fileNameToStore = "";
        }

        if($request->hasFile('img_2')){
            //get filename with the extension
            $fileNameWithExt = $request->file('img_2')->getClientOriginalName();
            //get just filename
            $filename = pathinfo($fileNameWithExt, PATHINFO_FILENAME);
            //get just ext
            $extension = $request->file('img_2')->getClientOriginalExtension();
            //filename to store
            $fileNameToStore2 = $filename.'_'.time().'.'.$extension;
            $path = $request->file('img_2')->storeAs('public/img/shop', $fileNameToStore2);
    
            }else{
            $fileNameToStore2 = "";
            }

        if($request->hasFile('img_3')){
            //get filename with the extension
            $fileNameWithExt = $request->file('img_3')->getClientOriginalName();
            //get just filename
            $filename = pathinfo($fileNameWithExt, PATHINFO_FILENAME);
            //get just ext
            $extension = $request->file('img_3')->getClientOriginalExtension();
            //filename to store
            $fileNameToStore3 = $filename.'_'.time().'.'.$extension;
            $path = $request->file('img_3')->storeAs('public/img/shop', $fileNameToStore3);
    
            }else{
            $fileNameToStore3 = "";
            }
        
            if($request->hasFile('img_4')){
                //get filename with the extension
                $fileNameWithExt = $request->file('img_4')->getClientOriginalName();
                //get just filename
                $filename = pathinfo($fileNameWithExt, PATHINFO_FILENAME);
                //get just ext
                $extension = $request->file('img_4')->getClientOriginalExtension();
                //filename to store
                $fileNameToStore4 = $filename.'_'.time().'.'.$extension;
                $path = $request->file('img_4')->storeAs('public/img/shop', $fileNameToStore4);
        
                }else{
                $fileNameToStore4 = "";
                }

            

                    $shop = new StoreItem;
                    $shop->category = $request->input('category');
                    $shop->item_name = $request->input('name');
                    $shop->price = $request->input('price');
                    $shop->curr = $request->input('curr');
                    $shop->desc = $request->input('desc');
                    $shop->img_1 = $fileNameToStore;
                    $shop->img_2 = $fileNameToStore2;
                    $shop->img_3 = $fileNameToStore3;
                    $shop->img_4 = $fileNameToStore4;
                    $shop->save();
                    return $this->sendResponse($shop, $shop->item_name.' created succesfully.'); 
}

public function delete_shop_item(Request $request){
    $shop = StoreItem::find($request->input('uid'));
    $shop->delete();
    return $this->sendResponse($shop, $shop->item_name.' deleted.'); 

}

public function post_shop_order(Request $request){
    $input = $request->all();

    $validator = Validator::make($input, [
        'item-id' => 'required',
        'item-name' => 'required',
        'name' => 'required',
        'phone' => 'required',
        'email' => 'nullable',
        'curr' => 'required',
        'price' => 'nullable',
        'qnty' => 'required',
            
    ]);

    if($validator->fails()){
        return $this->sendError('Validation Error.', $validator->errors());       
    }

    $order = new Orders;
    if(Auth::user()){
    $order->user_id = Auth::user()->id;
    }
    $order->item_id = $request->input('item-id');
    $order->item_name = $request->input('item-name');
    $order->name = $request->input('name');
    $order->phone = $request->input('phone');
    $order->email = $request->input('email');
    $order->curr = $request->input('curr');
    $order->unit_price = $request->input('price');
    $order->qnty = $request->input('qnty');
    $order->save();
    
    return $this->sendResponse($order, ' Your order was posted succesful.'); 
    
}




public function post_member_credit(Request $request){
    $input = $request->all();

    $validator = Validator::make($input, [
        'curr' => 'nullable',
        'users' => 'nullable',
        'amount' => 'nullable',
        'date' => 'nullable',
        'desc' => 'nullable',
    ]);

    if($validator->fails()){
        return $this->showErrorMsg('Validation Error.', $validator->errors());       
    }

    $uid = $request->input('users');//set user query param1
    $user_type = 'member';//set user query param3
    $user = User::where(function($p) use($uid, $user_type){
        $p->where('id', '=', $uid);
        $p->where('user_type', '=', $user_type);
        
   })->get();//query user model table

   if($user[0]->dues == 1){
    $user_name = $user[0]->name;//get index data field name
 
    $user_id = $user[0]->id;//set debt query param1
    $settles = 0;//set debt query param2
    $debts = Debt::where(function($p) use($user_id, $settles){
        $p->where('user_id', '=', $user_id);
        $p->where('settled', '=', $settles);
   })->get();//query Debt model table

   if(count($debts) > 0){
       foreach($debts as $debt){
        $max_fund = $debt->max_available_fund;
       }
       if($request->input('amount') > $max_fund){//check if amount input is greater than max_available_fund
        return $this->sendResponse($max_fund, $user_name.' is only eligible to obtain '.$debts[0]->curr.$max_fund.' credit debt, please ask member to settle his/her debts.');
       }else{//else create new data insertion query
           $newDebt = new Debt;//create a new instance of the Debt model
           $newDebt->user_id = $user[0]->id;
           $newDebt->user_name = $user_name;
           $newDebt->curr = $request->input('curr');
           $newDebt->amount = $request->input('amount');
           $newDebt->date = $request->input('date');
           $newDebt->descr = $request->input('desc');
           $newDebt->max_available_fund = $max_fund - $request->input('amount');
           $newDebt->created_by = Auth::user()->id;
           $newDebt->save();
           return $this->sendResponse($newDebt, $newDebt->curr.$newDebt->amount.' credit record created for '.$newDebt->user_name);//return json response
       }
   
   }else{
    if(count($user) > 0){
        $settings = Settings::where('id', 1)->get();//query Settings model table
        $debt_range = $settings[0]->memb_debt_capacity;
        if($request->input('amount') > $debt_range){//check if amount input is greater than max_available_fund
            return $this->sendResponse($debt_range, 'There is no members credit limit set yet by the admin on the site settings <br /> page or that the amount entered is greater than the credit limit.');
           }else{//else create new data insertion query
               $newDebt = new Debt;//create a new instance of the Debt model
               $newDebt->user_id = $user[0]->id;
               $newDebt->user_name = $user_name;
               $newDebt->curr = $request->input('curr');
               $newDebt->amount = $request->input('amount');
               $newDebt->date = $request->input('date');
               $newDebt->descr = $request->input('desc');
               $newDebt->max_available_fund = $debt_range - $request->input('amount');
               $newDebt->created_by = Auth::user()->id;
               $newDebt->save();
               return $this->sendResponse($newDebt, $newDebt->curr.$newDebt->amount.' credit record created for '.$newDebt->user_name);//return json response
           }
    }else{
        return $this->showErrorMsg('Error', 'This member does not exist in the database');//return json response  
    }
    
   }

   }else{
    return $this->showErrorMsg('Error', $user[0]->name.' is not an active member');//return json response   
   }

}

public function update_debt(Request $request){
    $newDebt = Debt::find($request->input('uid'));
    $newDebt->settled = 1;
    $newDebt->save();
    return $this->sendResponse($newDebt, 'Credit record updated.');//return json response  
}

public function load_debt_note(Request $request){

if(Auth::user()){
    $user_id = Auth::user()->id;//set debt query param1
    $settles = 0;//set debt query param2
    $debts = Debt::where(function($p) use($user_id, $settles){
        $p->where('user_id', '=', $user_id);
        $p->where('settled', '=', $settles);
   })->get();//query Debt model table
   return $this->sendResponse(count($debts), 'debt notification loaded.');//return json response  
}

}

public function update_reservation_resources(Request $request){
    $reservation = Reservations::where('id', $request->input('uid'))->get();//query reservation table model
    if($reservation[0]->type == 'resort'){
    $resort = Shelter::find($reservation[0]->shelter_id);//update shelter(resort) table
    $resort->available = 0;//set value to 0
    $resort->save();//save


    $room = DB::table('rooms')->where('shelter_id', $reservation[0]->shelter_id)->update(['available' => 0]);

    }else if($reservation[0]->type == 'room'){
        $room = Rooms::find($reservation[0]->room_id);//update room table
        $room->available = 0;//set value to 0
        $room->save();//save
    }
   $update_reservation = Reservations::find($request->input('uid'));//update reservations table model
   $update_reservation->approved = 1;
   $update_reservation->save();
   return $this->sendResponse($update_reservation, 'Reservation updated.');//return json response  

}

public function update_reservation_availability(Request $request){
$reservation = Reservations::where('id', $request->input('uid'))->get();
if($reservation[0]->type == 'resort'){
    $resort = Shelter::find($reservation[0]->shelter_id);//update shelter(resort) table
    $resort->available = 1;//set value to 0
    $resort->save();//save


    $room = DB::table('rooms')->where('shelter_id', $reservation[0]->shelter_id)->update(['available' => 1]);

    }else if($reservation[0]->type == 'room'){
        $room = Rooms::find($reservation[0]->room_id);//update room table
        $room->available = 1;//set value to 0
        $room->save();//save
    }
    return $this->sendResponse($reservation, 'Reservation availability updated.');
}


public function update_booking_approval(Request $request){
$check = ServiceBooking::where('id', $request->input('uid'))->get();

$service = Services::find($check[0]->service_id);
$service->available = 0;
$service->save();

$booking = ServiceBooking::find($request->input('uid'));
$booking->approved = 1;
$booking->save();

return $this->sendResponse($service.$booking, 'Booking updated.');//return json response
}

public function update_booking_availability(Request $request){
    $check = ServiceBooking::where('id', $request->input('uid'))->get();
    
    $service = Services::find($check[0]->service_id);
    $service->available = 1;
    $service->save();
    return $this->sendResponse($service, 'Booking availability updated.');   
}


public function load_shop_data(Request $request){
    $input = $request->all();
            
    $validator = Validator::make($input, [
        'record_per_page' => 'required',
        'start' => 'required',
        'action' => 'required',
    ]);

    if($validator->fails()){
        return $this->sendError('Validation Error.', $validator->errors());       
    }
      
    
    
    $selectShops = StoreItem::where('status', 1)->orderBy('id', 'desc')->limit($request->input('record_per_page'),$request->input('start'))->get();

    if(count($selectShops) > 0){
        
        return $this->sendResponse($selectShops, 'shop data loaded succesfully.');
    }else{
     return $this->showErrorMsg('No shop data fetched', $selectShops);
    }

}

public function load_shop_category(Request $request){
  
    $shops = StoreItem::where('category', $request->input('shopCat'))->get();
     
    if(count($shops) > 0){
    
    return $this->sendResponse($shops, $request->input('shopCat').' category items loaded succesfully.');
}else{
    return $this->showErrorMsg('No data fetched', 'Error');
}
    
}


public function add_to_cart(Request $request){
    $input = $request->all();
            
    $validator = Validator::make($input, [
        'pid' => 'required',
        'uid' => 'nullable',
        'qnty' => 'required',
        //'action' => 'required',
    ]);

    if($validator->fails()){
        return $this->sendError('Validation Error.', $validator->errors());       
    }  
    
    $check_shop = StoreItem::where('id', $request->input('pid'))->get();
    $check_cart = ShoppingCart::where('pid', $request->input('pid'))->get();
    if(Auth::user()){
     $uid = Auth::user()->id;
     $ip = preg_replace('#[^0-9.:]#', '', getenv('REMOTE_ADDR'));
    }else{
      $uid = '';
      $ip = preg_replace('#[^0-9.:]#', '', getenv('REMOTE_ADDR'));
    }

    if(count($check_cart) > 0){
        return $this->showErrorMsg('Item is already added to the cart!', 'Error'); 
    }else{
        $insertItem = new ShoppingCart;
        $insertItem->user_id = $uid;
        $insertItem->ip = $ip;
        $insertItem->pid = $check_shop[0]->id;
        $insertItem->qnty = $request->input('qnty');
        $insertItem->currency = $check_shop[0]->curr;
        $insertItem->unit_price = $check_shop[0]->price;
        if($request->input('qnty') == $check_shop[0]->discount_number || $request->input('qnty') > $check_shop[0]->discount_number && $check_shop[0]->discount_opt == 1){
         $total = $insertItem->unit_price * $request->input('qnty');
         $discount = $total / 100 * $check_shop[0]->discount_percent;
         $insertItem->discount = $discount;
        }
        $insertItem->details = $check_shop;
        $insertItem->time_added = time();
        $insertItem->save();

        $count_cart = ShoppingCart::where('ip', $insertItem->ip)->get();
        return $this->sendResponse($count_cart, $check_shop[0]->item_name.' added to cart.');
    }

}


public function count_cart_item(Request $request){
    $input = $request->all();
            
    $validator = Validator::make($input, [
        'actionEvent' => 'nullable',
        //'action' => 'required',
    ]);

    if($validator->fails()){
        return $this->sendError('Validation Error.', $validator->errors());       
    } 
    
    $ip = preg_replace('#[^0-9.:]#', '', getenv('REMOTE_ADDR'));

    $count_cart = ShoppingCart::where('ip', $ip)->get();
    if(count($count_cart) > 0){
    return $this->sendResponse($count_cart, 'cart loaded.');
    }else{
        return $this->showErrorMsg('Empty cart', 'Error'); 
    }

}



public function load_resort_data(Request $request){


    $input = $request->all();
            
                $validator = Validator::make($input, [
                    'record_per_page' => 'required',
                    'start' => 'required',
                    'action' => 'required',
                ]);
            
                if($validator->fails()){
                    return $this->sendError('Validation Error.', $validator->errors());       
                }
                  
                
                
                $resorts = Shelter::orderBy('id', 'desc')->limit($request->input('record_per_page'),$request->input('start'))->get();

                if(count($resorts) > 0){
                    
                    return $this->sendResponse($resorts, 'Resort data loaded succesfully.');
                }else{
                 return $this->showErrorMsg('No resort data fetched', $resorts);
                }
}


public static function servicePrice($curr,$price,$duration){//make servicePrice a static method
    $str = '';
    if ($price != ""){
       $str .=" <div class='price'>
        <span class='title-price'>Price</span>
        <span class='price_value price_min'>".$curr.$price."</span>
        <span class='unit'>".$duration."</span>
        </div>";
          }
    return $str;

}
public function load_boat_data(Request $request){
    $input = $request->all();
            
                $validator = Validator::make($input, [
                    'record_per_page' => 'required',
                    'start' => 'required',
                    'action' => 'required',
                ]);
            
                if($validator->fails()){
                    return $this->sendError('Validation Error.', $validator->errors());       
                }
                  
                
                $boats = Boat::orderBy('id', 'desc')->limit($request->input('record_per_page'),$request->input('start'))->get();

                if(count($boats) > 0){
                    
                    return $this->sendResponse($boats, 'Boat data loaded succesfully.');
                }else{
                 return $this->showErrorMsg('No boat data fetched', $boats);
                }
}


public function load_boat_category(Request $request){
    $input = $request->all();
            
                $validator = Validator::make($input, [
                    'boatCat' => 'required',
                    //'start' => 'required',
                    //'action' => 'required',
                ]);
            
                if($validator->fails()){
                    return $this->sendError('Validation Error.', $validator->errors());       
                }
                  
                
                $boats = Boat::where('category', $request->input('boatCat'))->orderBy('id', 'desc')->get();

                if(count($boats) > 0){
                    
                    return $this->sendResponse($boats, $request->input('boatCat').' category loaded succesfully.');
                }else{
                 return $this->showErrorMsg('No boat data fetched', $boats);
                }
}


public function load_service_data(Request $request){

    $input = $request->all();
            
                $validator = Validator::make($input, [
                    'record_per_page' => 'required',
                    'start' => 'required',
                    'action' => 'required',
                ]);
            
                if($validator->fails()){
                    return $this->sendError('Validation Error.', $validator->errors());       
                }
                  
                $subscribed = 1;
                $services = Services::where(function($p) use($subscribed){
                    //$p->where('subscribed', '=', $subscribed);
                    $p->where('sub_exp', '>', time());
               })->orderBy('id', 'desc')->limit($request->input('record_per_page'),$request->input('start'))->get();

                //$services = Services::orderBy('id', 'desc')->limit($request->input('record_per_page'),$request->input('start'))->get();

                if(count($services) > 0){
                    
                    return $this->sendResponse($services, 'Service data loaded succesfully.');
                }else{
                 return $this->showErrorMsg('No service data fetched', $services);
                }

}

public function load_service_category(Request $request){

    $input = $request->all();
            
    $validator = Validator::make($input, [
        'serviceCat' => 'required',
    ]);

    if($validator->fails()){
        return $this->sendError('Validation Error.', $validator->errors());       
    }
      

    $subscribed = 1;
    $category = $request->input('serviceCat');
    $services = Services::where(function($p) use($subscribed, $category){
                    $p->where('category', '=', $category);
                    //$p->where('subscribed', '=', $subscribed);
                    $p->where('sub_exp', '>', time());
               })->orderBy('id', 'desc')->get();
    
    //$services = Services::where('category', $request->input('serviceCategory'))->orderBy()->get();

    if(count($services) > 0){
        
        return $this->sendResponse($services, 'Service data loaded succesfully.');
    }else{
     return $this->showErrorMsg('No service data fetched', $services);
    }   

}




public static function blogUserImage($id){
    $user = User::where('id', $id)->get();
    if($user[0]->img != ""){
  
return "<img class='img-circle' src='".asset('storage/img/users/'.$user[0]->id.'/profile/'.$user[0]->img)."' alt='".$user[0]->name."'>";
  
    }else{
return "<img class='img-circle' src='".asset('storage/img/users/default.png')."' alt='".$user[0]->name."'>";
    }
}

public static function blogMediaFile($id){
     $blog = Blog::where('id', $id)->get();

     if(preg_match("/\.(jpg|png|gif)$/i", $blog[0]->media)){
      return "<img class='img-fluid pad' src='".asset('storage/img/users/'.$blog[0]->user_id.'/blog/'.$blog[0]->media)."' alt='".$blog[0]->media."'>";
    }else if(preg_match("/\.(mp4|avi|mkv|3gp|webm|vob|flv)$/i",  $blog[0]->media)){
      return "<video class='img-fluid pad' src='".asset('storage/img/users/'.$blog[0]->user_id.'/blog/'.$blog[0]->media)."' controls='control'> </video>";
    }
    
}

public static function delComment($id){
    $del = '';
    if($id == Auth::user()->id){
        $del .= "<a href='#' onClick='deleteComment(this.id)' id='comment_del_".$id."' feed='".$id."' class='fas fa-trash float-right' title='Delete this comment'></a>";
    }
    return $del;
}

public static function homeBlogComment($id){

    $comments = Comment::where('blog_id', $id)->get();

    $commentData = "";

    foreach($comments as $comment){
      $commentData .= "<div class='card-comment' >
      <!-- User image -->
      ".self::blogUserImage($comment->uid)."

      <div class='comment-text'>
            <span class='username'>
            <a href='".url('users/profile')."/".$comment->uid."'>".$comment->name."</a>
            ".self::delComment($comment->uid)."
            <span class='text-muted float-right'>".$comment->created_at."</span>
              </span><!-- /.username -->
        ".$comment->cnt."
      </div>
      <!-- /.comment-text -->
    </div>";
    }
    return $commentData;
}

public static function countComment($id){
    $comment = Comment::where('blog_id', $id)->get();
    if(count($comment) > 1){
        return count($comment).' comments';//count comments
    }else{
        return count($comment).' comment';//count comments
    }
    
}

public function load_home_blog(Request $request){
    $input = $request->all();

    $validator = Validator::make($input, [
        'record_per_page' => 'required',
        'start' => 'required',
        'action' => 'required',
    ]);

    if($validator->fails()){
        return $this->sendError('Validation Error.', $validator->errors());       
    }
      
    $data = '';
    $file = '';
    
    $blogs = Blog::orderBy('id', 'desc')->limit($request->input('record_per_page'),$request->input('start'))->get();

   foreach($blogs as $blog){
    
    $data .= "<div class='col-md-12' id='home-blog-".$blog->id."'>
                  <!-- Box Comment -->
                  <div class='card card-widget'>
                    <div class='card-header'>
                      <div class='user-block'>

                        ".self::blogUserImage($blog->user_id)."
                       
                        <span class='username'><a href='".url('users/profile')."/".$blog->user_id."'>".$blog->name."</a></span>
                        <span class='description'>Shared publicly - ".$blog->created_at."</span>
                      </div>
                      <!-- /.user-block -->
                      <div class='card-tools'>
                      
                      <button type='button' class='btn btn-tool' data-card-widget='collapse'>
                        <i class='fas fa-minus'></i>
                      </button>
                      <button type='button' class='btn btn-tool' data-card-widget='remove'>
                        <i class='fas fa-times'></i>
                      </button>
                    </div>
                      <!-- /.box-tools -->
                    </div>
                    <!-- /.box-header -->
                    <div class='card-body'>
                      ".self::blogMediaFile($blog->id)."
        
                      ".$blog->cnt."
                      <a href='http://www.facebook.com/sharer.php?u=".url('blog/'.$blog->id)."#post-".$blog->id."' class='btn btn-default btn-xs' target='_blank' title='Share this post on facebook'><i class='fa fa-facebook-square share-fb'></i> Share</a>
                      <a href='http://twitter.com/home?status=".url('blog/'.$blog->id)."#post-".$blog->id."' class='btn btn-default btn-xs' target='_blank' title='Share this post on twitter'><i class='fa fa-twitter share-twitter'></i> Share</a>
                      <a href='https://api.whatsapp.com/send?text=".url('blog/'.$blog->id)."#post-".$blog->id."' class='btn btn-default btn-xs' target='_blank' title='Share this post on whatsapp'><i class='fa fa-whatsapp share-whatsapp'></i> Share</a>
                      <span class='float-right text-muted'>".self::countComment($blog->id)."</span>
                    </div>
                    <!-- /.box-body -->
                    <div id='blog_comment_".$blog->id."' class='card-footer card-comments'>


                      
                      ".self::homeBlogComment($blog->id)."
                      
                      <!-- /.box-comment -->
                      
                    </div>
                    <!-- /.box-footer -->
                    <div class='card-footer'>
                     
                        
                        <!-- .img-push is used to add margin to elements next to floating images -->
                        <div class='img-push'>
                       
                          <input type='text' id='comment_field_".$blog->id."' class='form-control form-control-sm' placeholder='Press enter to post comment' onkeyup='makeComment(this.id, ".$blog->id.")'>
                       
                          </div>
                     
                    </div>
                    <!-- /.box-footer -->
                  </div>
                  <!-- /.box -->
                </div>
                ";
   }
                return $this->sendResponse($data, 'Blog data loaded succesfully.');
            }



public function load_profile_blog(Request $request){
                $input = $request->all();
            
                $validator = Validator::make($input, [
                    'record_per_page' => 'required',
                    'start' => 'required',
                    'user_id' => 'required',
                    'action' => 'required',
                ]);
            
                if($validator->fails()){
                    return $this->sendError('Validation Error.', $validator->errors());       
                }
                  
                $data = '';
                $file = '';
                
                $blogs = Blog::where('user_id', $request->input('user_id'))->orderBy('id', 'desc')->limit($request->input('record_per_page'),$request->input('start'))->get();
            
               foreach($blogs as $blog){
                
                $data .= "<div class='col-md-12 post' id='home-blog-".$blog->id."'>
                              <!-- Box Comment -->
                              <div class='card card-widget'>
                                <div class='card-header'>
                                  <div class='user-block'>
            
                                    ".self::blogUserImage($blog->user_id)."
                                   
                                    <span class='username'><a href='".url('users/profile')."/".$blog->user_id."'>".$blog->name."</a></span>
                                    <span class='description'>Shared publicly - ".$blog->created_at."</span>
                                  </div>
                                  <!-- /.user-block -->
                                  <div class='card-tools'>
                                  <button type='button' class='btn btn-tool' data-card-widget='collapse'>
                                  <i class='fas fa-minus'></i>
                                </button>
                                <button type='button' class='btn btn-tool' data-card-widget='remove'>
                                  <i class='fas fa-times'></i>
                                </button>
                                  </div>
                                  <!-- /.box-tools -->
                                </div>
                                <!-- /.box-header -->
                                <div class='card-body'>
                                  ".self::blogMediaFile($blog->id)."
                    
                                  ".$blog->cnt."
                                  <a href='http://www.facebook.com/sharer.php?u=".url('blog/'.$blog->id)."#post-".$blog->id."' class='btn btn-default btn-xs' target='_blank' title='Share this post on facebook'><i class='fa fa-facebook-square share-fb'></i> Share</a>
                                  <a href='http://twitter.com/home?status=".url('blog/'.$blog->id)."#post-".$blog->id."' class='btn btn-default btn-xs' target='_blank' title='Share this post on twitter'><i class='fa fa-twitter share-twitter'></i> Share</a>
                                  <a href='https://api.whatsapp.com/send?text=".url('blog/'.$blog->id)."#post-".$blog->id."' class='btn btn-default btn-xs' target='_blank' title='Share this post on whatsapp'><i class='fa fa-whatsapp share-whatsapp'></i> Share</a>
                                  <span class='float-right text-muted'>".self::countComment($blog->id)."</span>
                                </div>
                                <!-- /.box-body -->
                                <div id='blog_comment_".$blog->id."' class='card-footer card-comments'>
            
            
                                  
                                  ".self::homeBlogComment($blog->id)."
                                  
                                  <!-- /.box-comment -->
                                  
                                </div>
                                <!-- /.box-footer -->
                                <div class='card-footer'>
                                 
                                    
                                    <!-- .img-push is used to add margin to elements next to floating images -->
                                    <div class='img-push'>
                                   
                                      <input type='text' id='comment_field_".$blog->id."' class='form-control input-sm' placeholder='Press enter to post comment' onkeyup='makeComment(this.id, ".$blog->id.")'>
                                   
                                      </div>
                                 
                                </div>
                                <!-- /.box-footer -->
                              </div>
                              <!-- /.box -->
                            </div>
                            ";
               }
                            return $this->sendResponse($data, 'Blog data loaded succesfully.');
                        }


public function post_blog_comment(Request $request){
    $input = $request->all();

    $validator = Validator::make($input, [
        'comment' => 'required',
        'blog-id' => 'required',
    ]);


    if($validator->fails()){
        return $this->showErrorMsg('Validation Error', $validator->errors());//return json response          
    }
     $uid = Auth::user()->id;
     $blog_id = $request->input('blog-id');
     $cnt = $request->input('comment');
    $comments = Comment::where(function($p) use($blog_id, $uid, $cnt){
        $p->where('blog_id', '=', $blog_id);
        $p->where('uid', '=', $uid);
        $p->where('cnt', '=', $cnt);
   })->get();
   
   if(count($comments) > 0){

   }else{
    $blog = Blog::where('id', $blog_id)->get();
    $users = User::where('id', $blog[0]->user_id)->get();
    $post = new Comment;
    $post->blog_id = $request->input('blog-id');
    $post->uid = Auth::user()->id;
    $post->name = Auth::user()->name;
    $post->cnt = $request->input('comment');
    $post->save();

    if(Auth::user()->id != $blog[0]->user_id){
    $notification = new Notification;
    $notification->user_id = $blog[0]->user_id;
    $notification->note_type = "Blog Comment";
    
    if($users[0]->user_type == "admin"){
        $notification->msg = "<a href='".url('admin_dashboard/'.$blog[0]->user_id)."#home-blog-".$blog[0]->user_id."' class='fa fa-commenting-o'>".$post->name." commented on your blog title(".$blog[0]->title.").</a>";
    }else{
        $notification->msg = "<a href='".url('member_dashboard/'.$blog[0]->user_id)."#home-blog-".$blog[0]->user_id."' class='fa fa-commenting-o'>".$post->name." commented on your blog title(".$blog[0]->title.").</a>";
    }
    $notification->save();
    }
    return $this->sendResponse(self::homeBlogComment($post->blog_id), 'Comment create succesfully');

   }
    
} 


public function post_review(Request $request){
    $input = $request->all();

    $validator = Validator::make($input, [
        'comment' => 'required',
        'user_id' => 'nullable',
        'name' => 'required',
        'email' => 'required',
        'phone' => 'nullable',
        'profile_img' => 'nullable',
        'page_id' => 'required',
        'type' => 'required',
    ]);

    if($validator->fails()){
        return $this->sendError('Validation Error.', $validator->errors());       
    }
    $email = $request->input('email');
    $resort_id = $request->input('page_id');
    $name = $request->input('name');
    $phone = $request->input('phone');
    $reservation = Reservations::where(function($p) use($resort_id, $name, $phone, $email){
        $p->where('shelter_id', '=' , $resort_id);
        $p->where('name', '=' , $name);
        $p->where('phone', '=' , $phone);
        $p->where('email', '=' , $email);
        $p->where('paid', '=', 1);
    })->get();

    if(count($reservation) > 0){
   $review = new review;
   $review->rev_id = $request->input('page_id');
   $review->type = $request->input('type');
   $review->user_id = $request->input('user_id');
   $review->name = $request->input('name');
   $review->email = $request->input('email');
   $review->phone = $request->input('phone');
   $review->profile_img = $request->input('profile_img');
   $review->content = $request->input('comment');
   $review->save();
    }else{
    return $this->showErrorMsg('error.', 'You cannot comment on this resort at this time!');//return json response     
    }
   return $this->sendResponse($review, 'Review posted successfull');

}

public function news_letter_sub(Request $request){
    $input = $request->all();

    $validator = Validator::make($input, [
        'email' => 'required|email',
    ]);

    if($validator->fails()){
        return $this->showErrorMsg('Validation Error.', $validator->errors());//return json response   
        
    }
    $email = $request->input('email');
    $check = NewsLetters::where(function($p) use($email){
        $p->where('email', '=' , $email);
        $p->where('status', '=', 1);
    })->get();

    if(count($check) > 0){
        return $this->showErrorMsg('Error', 'Email already subscribed');//return json response   
    }else{
    $news_letters = new NewsLetters;
    $news_letters->email = $request->input('email');
    $news_letters->save();
    }
    return $this->sendResponse($news_letters, 'Mail subscription succesful.');
}

public function post_contact_message(Request $request){
    $input = $request->all();

    $validator = Validator::make($input, [
        'name' => 'required',
        'email' => 'required',
        'phone' => 'required',
        'subject' => 'required',
        'message' => 'required',
    ]);

    if($validator->fails()){
        return $this->sendError('Validation Error.', $validator->errors());       
    } 

      

    $support = new Support;
    $support->name = $request->input('name');
    $support->email = $request->input('email');
    $support->phone = $request->input('phone');
    $support->subject = $request->input('subject');
    $support->message = $request->input('message');
    $support->save();

    
     $s_id = 1;
      $status = 1;
      $settings = Settings::where(function($p) use($s_id, $status){
        $p->where('id', '=', $s_id);
        $p->where('status', '=', $status);
       })->get();

    $receipient = $settings[0]->email;
    $subject = $support->subject;
    $from = $support->email;
    Mail :: raw ($request->get('message'), function ($message) use ($receipient, $from, $subject)
    {
        // to to destination, subject to subject
        $message->from($from);
        $message->to($receipient)->subject($subject);
    });
   

    return $this->sendResponse($support, 'Contact message sent succesfully.');

}


public function send_news_letter(Request $request){
    $input = $request->all();

    $validator = Validator::make($input, [
        'subject' => 'required',
        'message' => 'required',
    ]);

    if($validator->fails()){
        return $this->sendError('Validation Error.', $validator->errors());       
    }

    $news_letters = NewsLetters::where('status', 1)->get(); 

      $s_id = 1;
      $status = 1;
      $settings = Settings::where(function($p) use($s_id, $status){
        $p->where('id', '=', $s_id);
        $p->where('status', '=', $status);
       })->get();

    $from = $settings[0]->email;
    $subject = $request->input('subject');
    

    foreach($news_letters as $news){
        $receipient = $news->email;
       
        Mail :: raw ($request->get('message'), function ($message) use ($receipient, $from, $subject)
    {
        // to to destination, subject to subject
        $message->from($from);
        $message->to($receipient)->subject($subject);
    });

    }
    return $this->sendResponse($request, 'News letter mail sent succesfully.'); 
}


public function reply_contact_msg(Request $request){
    $input = $request->all();

    $validator = Validator::make($input, [
        'receipient' => 'required',
        'sender' => 'nullable',
        'sender-name' => 'required',
        'subject' => 'required',
        'message' => 'required',
        'attachment' => 'nullable',
    ]);

    if($validator->fails()){
        return $this->sendError('Validation Error.', $validator->errors());       
    }

    $receipient = $request->input('receipient');
    $from = $request->input('sender');
    $name = $request->input('sender-name');
    $subject = $request->input('subject');

    
    Mail :: raw ($request->get('message'), function ($message) use ($receipient, $from, $subject, $name)
    {
        // to to destination, subject to subject
        $message->from($from);
        $message->to($receipient)->subject($subject.'-'.$name);
    });

    return $this->sendResponse($request, 'Mail sent succesfully.'); 

}

public function message_user_type(Request $request){//
    $input = $request->all();

    $validator = Validator::make($input, [
        'user_type' => 'required',
    ]);

    if($validator->fails()){
        return $this->sendError('Validation Error.', $validator->errors());       
    }
       $data = '';
    if($request->input('user_type') == "all"){
        $users = User::orderBy('id', 'desc')->get();
        
        foreach($users as $user){
            $data .= "<option value='".$user->email."'>".$user->name."</option>";
        }
        return $this->sendResponse($data, 'Users loaded according to types and privileges.'); 
    }else{
        $user_type = $request->input('user_type');
        $users = User::where(function($p) use($user_type){
            $p->where('user_type', '=', $user_type);
            $p->orWhere('privilege', '=', $user_type);
       })->get();

       foreach($users as $user){
        $data .= "<option value='".$user->email."'>".$user->name."</option>";
    }
    return $this->sendResponse($data, 'Users loaded according to types and privileges.'); 
    }

    
}


public function post_msg(Request $request){
    $input = $request->all();

    $validator = Validator::make($input, [
        'receipient' => 'required',
        'sender' => 'nullable',
        'sender-name' => 'required',
        'subject' => 'required',
        'message' => 'required',
        'attachment' => 'nullable',
    ]);

    if($validator->fails()){
        return $this->sendError('Validation Error.', $validator->errors());       
    }

    

    foreach($request->input('receipient') as $receipient){
       
        $messages = new Messages;
        $messages->from_user = $request->input('sender');
        $messages->from_name = $request->input('sender-name');
        $messages->to_user = $receipient;
        $messages->subject = $request->input('subject');
        $messages->msg = $request->input('message');
        $messages->save();
   
    $from = $request->input('sender');
    $subject = $request->input('subject');

    Mail :: raw ($request->get('message'), function ($msg) use ($receipient, $from, $subject)
    {
        // to to destination, subject to subject
        $msg->from($from);
        $msg->to($receipient)->subject($subject);
    });
    

    }

    return $this->sendResponse($messages, 'Message sent succesfully.');

}


public function load_slider_category(Request $request){
    $input = $request->all();

    $validator = Validator::make($input, [
        'category' => 'required',
    ]);

    if($validator->fails()){
        return $this->sendError('Validation Error.', $validator->errors());       
    }

    $data = "";
    if($request->input('category') == "Shop"){
     $store = StoreItem::orderBy('id', 'desc')->get();
     foreach($store as $service){
        $data .= "<li class='item'>
                      
        <div class='product-img'>
          <img src='".$service->img_1."' alt='".$service->item_name."'>
        </div>
        <div class='product-info'>
          <a href='#' class='product-title'>".$service->item_name."
            <span class='label label-warning pull-right'>
            
                Shop
            
            </span></a>
          
              
           <a href='#' class='fa fa-plus del-btn' onclick='addServiceSlide(this)' data-id='".$service->id."' data-cat='".$request->input('category')."' title='Add ".$service->item_name."'>Add to slide</a>
           
        </div>
      </li>";
    }

    }else if($request->input('category') == "Resort"){
    $resort = Shelter::orderBy('id', 'desc')->get();
    foreach($resort as $service){
        $data .= "<li class='item'>
                      
        <div class='product-img'>
          <img src='".$service->img_1."' alt='".$service->name."'>
        </div>
        <div class='product-info'>
          <a href='#' class='product-title'>".$service->name."
            <span class='label label-warning pull-right'>
            
                Resort
            
            </span></a>
          
              
           <a href='#' class='fa fa-plus del-btn' onclick='addServiceSlide(this)' data-id='".$service->id."' data-cat='".$request->input('category')."' title='Add ".$service->name."'>Add to slide</a>
           
        </div>
      </li>";
    }

    }else if($request->input('category') == "Others"){
    $services = Services::orderBy('id', 'desc')->get();
    
    foreach($services as $service){
     $data .= "<li class='item'>
                   
     <div class='product-img'>
       <img src='".$service->img_1."' alt='".$service->title."'>
     </div>
     <div class='product-info'>
       <a href='#' class='product-title'>".$service->title."
         <span class='label label-warning pull-right'>
         
             ".$service->category."
         
         </span></a>
       
           
        <a href='#' class='fa fa-plus del-btn' onclick='addServiceSlide(this)' data-id='".$service->id."' data-cat='".$request->input('category')."' title='Add ".$service->title."'>Add to slide</a>
        
     </div>
   </li>";
    }

    }else if($request->input('category') == "Boat"){

        $services = Boat::orderBy('id', 'desc')->get();
    
    foreach($services as $service){
     $data .= "<li class='item'>
                   
     <div class='product-img'>
       <img src='".$service->img_1."' alt='".$service->title."'>
     </div>
     <div class='product-info'>
       <a href='#' class='product-title'>".$service->title."
         <span class='label label-warning pull-right'>
         
             ".$service->category."
         
         </span></a>
       
           
        <a href='#' class='fa fa-plus del-btn' onclick='addServiceSlide(this)' data-id='".$service->id."' data-cat='".$request->input('category')."' title='Add ".$service->title."'>Add to slide</a>
        
     </div>
   </li>";

    }
}
    return $this->sendResponse($data, 'Slide content loaded.'); 
}


public function add_to_slide(Request $request){
    $input = $request->all();

    $validator = Validator::make($input, [
        'category' => 'required',
        'id' => 'required',
    ]);

    if($validator->fails()){
        return $this->showErrorMsg('Validation Error.', $validator->errors());       
    }
    
    $id = $request->input('id');
    $cat = $request->input('category');

    $slide = SlideFeatures::where(function($p) use($id, $cat){
        $p->where('ref_id', '=', $id);
        $p->where('category', '=', $cat);
   })->get();

   if(count($slide) > 0){
    return $this->showErrorMsg($slide[0]->name.' is already added to the slide', $slide);       
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

     return $this->sendResponse($new_slide, 'Added succesfully'); 
   }

    
}


################################################################
###########  This block contains payment processor #############
################## and the transaction records #################
################################################################
public function create_transaction_record(Request $request){
    $input = $request->all();

    $validator = Validator::make($input, [
        'trn_type' => 'required',
        'trn_id' => 'required',
        'ref_id' => 'required',
        'gateway' => 'required',
        'name' => 'required',
        'email' => 'required',
        'phone' => 'required',
        'user_id' => 'nullable',
        'curr' => 'required',
        'amount' => 'required',
        'status' => 'required',
        'msg' => 'nullable',
    ]);

    if($validator->fails()){
        return $this->showErrorMsg('Validation Error.', $validator->errors());       
    }

      $s_id = 1;
      $status = 1;
      $settings = Settings::where(function($p) use($s_id, $status){
        $p->where('id', '=', $s_id);
        $p->where('status', '=', $status);
       })->get();

    if($request->input('trn_type') == "resort" || $request->input('trn_type') == "room"){
     $reservation = Reservations::where('id', $request->input('trn_id'))->get();
     $resort = Shelter::where('id', $reservation[0]->shelter_id)->get();
     $room = Rooms::where('id', $reservation[0]->room_id)->get();
     $creator = User::where('id', $resort[0]->created_by)->get();
    }else if($request->input('trn_type') == "Boat" || $request->input('trn_type') == "Yacht"){
        $booking = ServiceBooking::where('id', $request->input('trn_id'))->get();
        $services = Services::where('id', $booking[0]->service_id)->get();
        $creator = User::where('id', $services[0]->created_by)->get();
    }

    $transaction = new transaction;
    $transaction->type = $request->input('trn_type');
    $transaction->t_id = $request->input('trn_id');
    $transaction->ref_id = $request->input('ref_id');
    $transaction->gateway = $request->input('gateway');
    $transaction->name = $request->input('name');
    $transaction->email = $request->input('email');
    $transaction->phone = $request->input('phone');
    if(Auth::user()){
    $transaction->user_id = $request->input('user_id');
    }
    $transaction->curr = $request->input('curr');
    $transaction->amount = $request->input('amount');
    $transaction->status = $request->input('status');
    $transaction->msg = $request->input('msg');
    $transaction->save();

    if($transaction->type == "resort" || $transaction->type == "room"){
        $update = Reservations::where('id', $transaction->t_id)->update(['paid' => 1]);
    }else if($transaction->type == "Boat" || $transaction->type == "Yacht"){
        $update = ServiceBooking::where('id', $transaction->t_id)->update(['paid' => 1]);
    }

    $notification = new Notification;
    $notification->user_id = $creator[0]->id;
    $notification->note_type = "Payment Transaction";
    if($transaction->type == "resort"){
    $subject = "Resort Reservation (".$resort[0]->name.")";
    $notification->msg = "Name: ".$transaction->name."<br>Email: ".$transaction->email."<br> Phone: ".$transaction->phone."<br> Transaction Type: Resort Reservation (".$resort[0]->name.") <br> From ".$reservation[0]->checkin." To ".$reservation[0]->checkout." <br> Amount Paid: ".$transaction->curr.$transaction->amount." <br> Transaction Ref No: ".$transaction->ref_id."<br> Gateway: ".$transaction->gateway."<br> Platform: ".$settings[0]->site_name;
    }else if($transaction->type == "room"){
        $subject = "Room Reservation (".$room[0]->room_no.")";
        $notification->msg = "Name: ".$transaction->name."<br>Email: ".$transaction->email."<br> Phone: ".$transaction->phone."<br> Transaction Type: Room Reservation (".$room[0]->room_no.") <br> From ".$reservation[0]->checkin." To ".$reservation[0]->checkout." <br> Amount Paid: ".$transaction->curr.$transaction->amount." <br> Transaction Ref No: ".$transaction->ref_id."<br> Gateway: ".$transaction->gateway."<br> Platform: ".$settings[0]->site_name;
    }else if($transaction->type == "Boat"){
        $subject = "Boat Booking (".$services[0]->title.")";
        $notification->msg = "Name: ".$transaction->name."<br>Email: ".$transaction->email."<br> Phone: ".$transaction->phone."<br> Transaction Type: Boat Booking (".$services[0]->title.")  <br> Booked date".$booking[0]->booked_dat.", Duration ".$booking[0]->duration." <br> Amount Paid: ".$transaction->curr.$transaction->amount." <br> Transaction Ref No: ".$transaction->ref_id."<br> Gateway: ".$transaction->gateway."<br> Platform: ".$settings[0]->site_name;
    }else if($transaction->type == "Yacht"){
        $subject = "Yacht Booking (".$services[0]->title.")";
        $notification->msg = "Name: ".$transaction->name."<br>Email: ".$transaction->email."<br> Phone: ".$transaction->phone."<br> Transaction Type: Yacht Booking (".$services[0]->title.") <br> Booked date".$booking[0]->booked_dat.", Duration ".$booking[0]->duration." <br> Amount Paid: ".$transaction->curr.$transaction->amount." <br> Transaction Ref No: ".$transaction->ref_id."<br> Gateway: ".$transaction->gateway."<br> Platform: ".$settings[0]->site_name;
    }

    $notification->save();

    $receipient = $creator[0]->email;
    $from = $settings[0]->email;
    $customer_email = $transaction->email;

    Mail :: raw ($notification->msg, function ($message) use ($receipient, $from, $customer_email, $subject)
    {
        // to to destination, subject to subject
        $message->from($from);
        $message->to($receipient,$customer_email)->subject($subject);
    });

    return $this->sendResponse($transaction, 'Transaction record created.'); 
}

public function create_subscription_transaction_record(Request $request){
  
    $input = $request->all();

    $validator = Validator::make($input, [
        'trn_type' => 'required',
        'ref_id' => 'required',
        'gateway' => 'required',
        'name' => 'required',
        'email' => 'required',
        'phone' => 'required',
        'user_id' => 'nullable',
        'curr' => 'required',
        'amount' => 'required',
        'status' => 'required',
        'msg' => 'nullable',
    ]);

    if($validator->fails()){
        return $this->showErrorMsg('Validation Error.', $validator->errors());       
    }

      $s_id = 1;
      $status = 1;
      $settings = Settings::where(function($p) use($s_id, $status){
        $p->where('id', '=', $s_id);
        $p->where('status', '=', $status);
       })->get();

   

    $transaction = new transaction;
    $transaction->type = $request->input('trn_type');
   
    $transaction->ref_id = $request->input('ref_id');
    $transaction->gateway = $request->input('gateway');
    $transaction->name = $request->input('name');
    $transaction->email = $request->input('email');
    $transaction->phone = $request->input('phone');
    if(Auth::user()){
    $transaction->user_id = $request->input('user_id');
    }
    $transaction->curr = $request->input('curr');
    $transaction->amount = $request->input('amount');
    $transaction->status = $request->input('status');
    $transaction->msg = $request->input('msg');
    $transaction->save();

    $notification = new Notification;
    $notification->user_id = $transaction->user_id;
    $notification->note_type = "Membership Subscription";
    $notification->msg = "Name: ".$transaction->name."<br>Email: ".$transaction->email."<br> Phone: ".$transaction->phone."<br> Transaction Type: Membership Subscription <br> Duration:  <br> Amount Paid: ".$transaction->curr.$transaction->amount." <br> Transaction Ref No: ".$transaction->ref_id."<br> Gateway: ".$transaction->gateway."<br> Platform: ".$settings[0]->site_name;
    $notification->save();


    $day = 86400;//calculate day by seconds
    $week = $day * 7;//calculate week by days
    $months = round($week * 4);//calculate month by weeks
    $exp_time = time() + 1 * $months;//calculate year by months

    $subCheck = Subscription::where('user_id', $transaction->user_id)->get();
    if(count($subCheck) > 0){
    $subscription = Subscription::where('user_id', $transaction->user_id)->update(['exp' => $exp_time, 'status' => 1]);
    }else{
    $subscription = new Subscription;
    $subscription->user_id = $transaction->user_id;
    $subscription->module = "Membership Subscription";
    $subscription->duration = '12 months';
    $subscription->exp = $exp_time;
    $subscription->status = 1;
    $subscription->save();
    }
    $user = User::where('id', $transaction->user_id)->update(['dues' => 1]);

    $subject = "Membership Subscription";
    $receipient = $transaction->email;
    $from = $settings[0]->email;
    
    Mail :: raw ($notification->msg, function ($message) use ($receipient, $from, $subject)
    {
        // to to destination, subject to subject
        $message->from($from);
        $message->to($receipient)->subject($subject);
    });

    return $this->sendResponse($transaction, 'Transaction record created.'); 
    
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
