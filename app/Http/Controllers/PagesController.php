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
use App\Models\ServiceCategory;
use App\Models\User;
use App\Models\Shelter;
use App\Models\Rooms;
use App\Models\Blog;
use App\Models\StoreItem;
use App\Models\StoreCategory;
use App\Models\Reservations;
use App\Models\Debt;
use App\Models\ServiceBooking;
use App\Models\Visited;
use App\Models\SiteActivity;
use App\Models\transaction;
use App\Models\review;
use App\Models\Messages;
use App\Models\NewsLetters;
use App\Models\Notification;
use App\Models\Support;
use App\Models\Orders;
use App\Models\Comment;
use App\Models\ResortFeatures;
use App\Models\AdminResortFeatures;
use App\Models\SlideFeatures;
use App\Models\Boat;
use App\Models\BoatCategory;
use App\Models\PageBanner;
use App\Models\ShoppingCart;
use App\Http\Controllers\API\BaseController as BaseController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
class PagesController extends BaseController
{

    public function __construct(){
         //Buffering the output
      $s_id = 1;
      $status = 1;
    $settings = Settings::where(function($p) use($s_id, $status){
        $p->where('id', '=', $s_id);
        $p->where('status', '=', $status);
   })->get();

if(count($settings) > 0){
   ob_start();  
   
   //Getting configuration details 
   system('ipconfig /all');  
   
   //Storing output in a variable 
   $configdata=ob_get_contents();  
   
   // Clear the buffer  
   ob_clean();  
   
   //Extract only the physical address or Mac address from the output
   $mac = "Physical";  
   $pmac = strpos($configdata, $mac);
   
   // Get Physical Address  
   $macaddr=substr($configdata,($pmac+36),17);  

        $guest_ip = preg_replace('#[^0-9.:]#', '', getenv('REMOTE_ADDR'));
        
        $browser = $_SERVER['HTTP_USER_AGENT'];
        
        $url = $_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI'];

        $visited = Visited::where('ip', $guest_ip)->get();

        if(count($visited) < 1){
            $insert_visit = new Visited;
            $insert_visit->ip = $guest_ip;
            $insert_visit->mac_address = $macaddr;
            $insert_visit->user_agent = $browser;
            $insert_visit->save();
        }else{
            $site_activity = SiteActivity::where(function($p) use($guest_ip, $macaddr, $browser, $url){
                $p->where('ip', '=', $guest_ip);
                $p->where('mac_address', '=', $macaddr);
                $p->where('user_agent', '=', $browser);
                $p->where('url', '=', $url);
           })->get(); 
            if(count($site_activity) < 1){
                $activity = new SiteActivity;
                if(Auth::user()){
                $activity->user = Auth::user()->name;
                }
                $activity->ip = $guest_ip;
                $activity->mac_address = $macaddr;
                $activity->user_agent = $browser;
                $activity->url = $url;
                $activity->save();
            }else{
                $activity = SiteActivity::where('id', $site_activity[0]->id)->update(['mac_address' => $macaddr, 'user_agent' => $browser, 'url' => $url]);    
            }
        }
    
   }else{
       exit();
   }

    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {   //run 4 queries from database tables
        $s_id = 1;
      $status = 1;
      $settings = Settings::where(function($p) use($s_id, $status){
        $p->where('id', '=', $s_id);
        $p->where('status', '=', $status);
       })->get();
        
        $content = Content::all();

        $services = SlideFeatures::orderBy('updated_at', 'desc')->get();

        $resort = Shelter::all();
        $blog = Blog::orderBy('id', 'desc')->get();

        $room = Rooms::orderBy('id', 'desc')->get();
    return view('pages.index', ['settings' => $settings, 'contents' => $content, 'services' => $services, 'resorts' => $resort, 'blogs' => $blog, 'rooms' => $room]);
    }

    public function signup_members(){
        if(!Auth::user()){
            $s_id = 1;
            $status = 1;
          $settings = Settings::where(function($p) use($s_id, $status){
              $p->where('id', '=', $s_id);
              $p->where('status', '=', $status);
         })->get();
        
        $content = Content::all();

        $services = Services::all();
        
        $resort = Shelter::all();
        $blog = Blog::orderBy('id', 'desc')->get();
    return view('auth.signup', ['settings' => $settings, 'contents' => $content, 'services' => $services, 'resorts' => $resort, 'blogs' => $blog]);
        }else{
            if(Auth::user()->user_type == 'admin'){
                return redirect('admin_dashboard/'.Auth::user()->id)->with('success', Auth::user()->name.', your are welcome back.');
            }else if(Auth::user()->user_type == 'member'){
                return redirect('member_dashboard/'.Auth::user()->id)->with('success', Auth::user()->name.', your are welcome back.');
            }
        }    
}

    public function resorts(){
        $s_id = 1;
      $status = 1;
       $settings = Settings::where(function($p) use($s_id, $status){
        $p->where('id', '=', $s_id);
        $p->where('status', '=', $status);
        })->get();
        
        $content = Content::all();

        $services = Services::all();
        
        $resort = Shelter::all();
        $blog = Blog::orderBy('id', 'desc')->get();
    return view('pages.resorts', ['settings' => $settings, 'contents' => $content, 'services' => $services, 'resorts' => $resort, 'blogs' => $blog]);
    }


    public function resort($id){
        $s_id = 1;
      $status = 1;
    $settings = Settings::where(function($p) use($s_id, $status){
        $p->where('id', '=', $s_id);
        $p->where('status', '=', $status);
   })->get();
        //$content = Content::all();

        $resort = Shelter::where('id', $id)->get();

        $rooms = Rooms::where('shelter_id', $id)->get();
        

        $features = ResortFeatures::where('resort_id', $id)->get();
        
        $type = "resort";

        $reviews = review::where(function($p) use($id, $type){
             $p->where('rev_id', '=', $id);
             $p->where('type', '=', $type);
        })->get();

        if(count($features) > 0){
            $array_call = $features;
            $array_list = json_decode($features[0]->features);
         }else{
             $array_call = array();
             $array_list = array();
         }

    return view('pages.resort', ['settings' => $settings, 
                                 //'contents' => $content, 
                                 'resorts' => $resort,
                                 'resortImages' => json_decode($resort[0]->images),
                                 'rooms' => $rooms, 
                                 'reviews' => $reviews, 
                                 'features' => $array_call,
                                 'feature_list' => $array_list
                                  ]);
    }

    public function rooms($resort_id, $id = null){
        $s_id = 1;
      $status = 1;
       $settings = Settings::where(function($p) use($s_id, $status){
        $p->where('id', '=', $s_id);
        $p->where('status', '=', $status);
        })->get();
        
        $content = Content::all();

        $services = Services::all();
        
        $resort = Shelter::where('id', $resort_id)->get();

        $rooms = Rooms::where('id', $id)->get();
        $blog = Blog::orderBy('id', 'desc')->get();
    return view('pages.room', ['settings' => $settings, 
                               //'contents' => $content, 
                               'services' => $services, 
                               'resorts2' => $resort, 
                               'rooms' => $rooms,
                               'roomImages' => json_decode($rooms[0]->images) 
                               ]);
    }

   
    

    


    public function contact(){
        $s_id = 1;
        $status = 1;
       $settings = Settings::where(function($p) use($s_id, $status){
        $p->where('id', '=', $s_id);
        $p->where('status', '=', $status);
   })->get();
        
        $content = Content::all();

        $services = Services::all();

        $resort = Shelter::all();
        $blog = Blog::orderBy('id', 'desc')->get(); 
    return view('pages.contact', ['settings' => $settings, 'contents' => $content, 'services' => $services, 'resorts' => $resort, 'blogs' => $blog]);
    }

    public function about_us(){
        $s_id = 1;
      $status = 1;
       $settings = Settings::where(function($p) use($s_id, $status){
        $p->where('id', '=', $s_id);
        $p->where('status', '=', $status);
   })->get();
        
        $content = Content::all();

        $services = Services::all();
        
        $service_yacht = Services::where('category', 'Yacht')->get();
        $service_boat = Services::where('category', 'Boat')->get();

        $resort = Shelter::all(); 
        $blog = Blog::orderBy('id', 'desc')->get();
        $user = User::where('user_type', 'member')->get();

        return view('pages.about', ['settings' => $settings, 'contents' => $content, 'services' => $services, 'resorts' => $resort, 'blogs' => $blog, 'members' => $user, 'boat' => $service_boat, 'yacht' => $service_yacht]);
    }



    public function blog(){
        $s_id = 1;
      $status = 1;
       $settings = Settings::where(function($p) use($s_id, $status){
        $p->where('id', '=', $s_id);
        $p->where('status', '=', $status);
   })->get();
        
        $content = Content::all();

        $services = Services::all();

        $resort = Shelter::all(); 
        $blog = Blog::orderBy('id', 'desc')->get();
        return view('pages.blog', ['settings' => $settings, 'contents' => $content, 'services' => $services, 'resorts' => $resort, 'blogs' => $blog]);  
    }

    public function blog_detail($id){
        if($id != ""){
            $s_id = 1;
            $status = 1;
          $settings = Settings::where(function($p) use($s_id, $status){
              $p->where('id', '=', $s_id);
              $p->where('status', '=', $status);
         })->get();
        
        $content = Content::all();

        $services = Services::all();

        $resort = Shelter::all(); 
        $blog = Blog::where('id', $id)->get();

        $blog2 = Blog::where('id', '!=', $id)->orderBy('id','desc')->limit(3)->get();
        
        $comment = Comment::where('blog_id', $blog[0]->id)->orderBy('id', 'desc')->get();
        
        $userComment = User::all();
        return view('pages.blog-detail', ['settings' => $settings, 'contents' => $content, 'services' => $services, 'resorts' => $resort, 'blogs' => $blog, 'comments' => $comment, 'users' => $userComment, 'blogs2' => $blog2]); 
           }
    }

public function blog_category($cat){
    if($cat != ""){
        $s_id = 1;
        $status = 1;
      $settings = Settings::where(function($p) use($s_id, $status){
          $p->where('id', '=', $s_id);
          $p->where('status', '=', $status);
     })->get();
    
    $content = Content::all();

    $services = Services::all();

    $resort = Shelter::all(); 
    $blog = Blog::where('category', $cat)->orderBy('id','desc')->get();
    $blog2 = Blog::where('category', '!=', $cat)->orderBy('id','desc')->limit(3)->get();
    return view('pages.blog', ['settings' => $settings, 'contents' => $content, 'services' => $services, 'resorts' => $resort, 'blogs' => $blog, 'blogs2' => $blog2]); 
       }   
}



/************************************************
 * ***** Boat landing page views methods ********
 * *********************************************/
public function boat_page(){
    $s_id = 1;
    $status = 1;
  $settings = Settings::where(function($p) use($s_id, $status){
      $p->where('id', '=', $s_id);
      $p->where('status', '=', $status);
 })->get();
      
  
  $boats = Boat::all();
  $page_banner = PageBanner::where('page_name', 'boats')->get();
  $boatCategory = BoatCategory::all();
  
  return view('pages.boat', ['settings' => $settings, 'page_banner' => $page_banner, 'categories' => $boatCategory, 'boats' => $boats]);    
}


public function boat_single($id){
    $s_id = 1;
    $status = 1;
  $settings = Settings::where(function($p) use($s_id, $status){
      $p->where('id', '=', $s_id);
      $p->where('status', '=', $status);
 })->get();
     
  $boat_single = Boat::where('id', $id)->get();
  
  $boats = Boat::where('category', $boat_single[0]->category);

  $type = "boat";

  $reviews = review::where(function($p) use($id, $type){
       $p->where('rev_id', '=', $id);
       $p->where('type', '=', $type);
  })->get();

  return view('pages.boat_single', ['settings' => $settings, 
                                   'boat_singles' => $boat_single,
                                   'boatImages' => json_decode($boat_single[0]->images),
                                   'boats' => $boats,
                                   'reviews' => $reviews
                                   ]);    
}


public function shop(){
    $s_id = 1;
      $status = 1;
    $settings = Settings::where(function($p) use($s_id, $status){
        $p->where('id', '=', $s_id);
        $p->where('status', '=', $status);
   })->get();
        
    
    $shopCategory = StoreCategory::all();
    $shop = StoreItem::where('status', 1)->orderBy('id', 'desc')->get();
    return view('pages.shop', ['settings' => $settings, 
                                'shops' => $shop, 
                                'categories' => $shopCategory]);  
}


public function shop_item($cat, $id = null){
    $s_id = 1;
      $status = 1;
    $settings = Settings::where(function($p) use($s_id, $status){
        $p->where('id', '=', $s_id);
        $p->where('status', '=', $status);
   })->get();
        

    $shopCategory = StoreCategory::all();

    $shop = StoreItem::where(function($p) use($id){
        $p->where('id', '=', $id);
        $p->where('status', '=', 1);
   })->get();//query user model table

   $shop_param = $shop[0]->created_by;
   $shops = StoreItem::where(function($p) use($shop_param){
    $p->where('status', '=', 1);
    $p->where('created_by', '=', $shop_param);
})->get();//query user model table
    return view('pages.shop_single', ['settings' => $settings,   
                                     'shops' => $shop,
                                     'shops2' => $shops,
                                     'categories' => $shopCategory,
                                     'shopImg' => json_decode($shop[0]->images)]);  
}


public function shop_cart(){
    $s_id = 1;
      $status = 1;
    $settings = Settings::where(function($p) use($s_id, $status){
        $p->where('id', '=', $s_id);
        $p->where('status', '=', $status);
   })->get();

    $guest_ip = preg_replace('#[^0-9.:]#', '', getenv('REMOTE_ADDR'));

    if(Auth::user()){
     $cart = ShoppingCart::where('user_id', Auth::user()->id)->get();
    }else{
      $cart = ShoppingCart::where('ip', $guest_ip)->get();
    }


    return view('pages.shopping_cart', ['settings' => $settings,   
                                        'carts' => $cart]);  


}

public function shop_checkout(){
    $s_id = 1;
      $status = 1;
    $settings = Settings::where(function($p) use($s_id, $status){
        $p->where('id', '=', $s_id);
        $p->where('status', '=', $status);
   })->get();

    $guest_ip = preg_replace('#[^0-9.:]#', '', getenv('REMOTE_ADDR'));

    if(Auth::user()){
     $cart = ShoppingCart::where('user_id', Auth::user()->id)->get();
    }else{
      $cart = ShoppingCart::where('ip', $guest_ip)->get();
    }


    return view('pages.shop_checkout', ['settings' => $settings,   
                                        'carts' => $cart]); 

}


    public function services(){
        $s_id = 1;
        $status = 1;
      $settings = Settings::where(function($p) use($s_id, $status){
          $p->where('id', '=', $s_id);
          $p->where('status', '=', $status);
     })->get();

     $services = Services::all();
     $category = ServiceCategory::all();
     $page_banner = PageBanner::where('page_name', 'services')->get();
     return view('pages.services', ['settings' => $settings, 
                                     'services' => $services, 
                                     'categories' => $category,
                                     'page_banner' => $page_banner
                                    ]);

     }


    public function service($id){
        $s_id = 1;
        $status = 1;
      $settings = Settings::where(function($p) use($s_id, $status){
          $p->where('id', '=', $s_id);
          $p->where('status', '=', $status);
     })->get();

            
            $services = Services::where('id', $id)->get();

            $services2 = Services::where('created_by', $services[0]->created_by)->get();
            
            return view('pages.service', ['settings' => $settings,
                        'services' => $services, 
                        'servicesImg' => json_decode($services[0]->images),
                        'services2' => $services2
                         ]);
         
    }


public function service_booking_payment($id){
    $s_id = 1;
    $status = 1;
  $settings = Settings::where(function($p) use($s_id, $status){
      $p->where('id', '=', $s_id);
      $p->where('status', '=', $status);
 })->get();


 $booking = ServiceBooking::where('id', $id)->get();
 $blog = Blog::orderBy('id', 'desc')->get();
 $services = Services::where('id', $booking[0]->service_id)->get();
 return view('pages.service_payment', ['settings' => $settings, 'bookings' => $booking, 'services' => $services, 'blogs' => $blog]);

}

public function reservation_payment($id){
    $s_id = 1;
    $status = 1;
  $settings = Settings::where(function($p) use($s_id, $status){
      $p->where('id', '=', $s_id);
      $p->where('status', '=', $status);
 })->get();


 $booking = Reservations::where('id', $id)->get();
 $resort = Shelter::where('id', $booking[0]->shelter_id)->get();
 $room = Rooms::where('id', $booking[0]->room_id)->get();
 $blog = Blog::orderBy('id', 'desc')->get();
 return view('pages.reservation_payment', ['settings' => $settings, 'bookings' => $booking, 'resorts' => $resort, 'rooms' => $room, 'blogs' => $blog]);
}

    
    
public function member($id){
        if(Auth::user()){
            if(Auth::user()->user_type == "member" || Auth::user()->user_type == "boat_owner" || Auth::user()->user_type == "resort_owner"){
            $s_id = 1;
            $status = 1;
          $settings = Settings::where(function($p) use($s_id, $status){
              $p->where('id', '=', $s_id);
              $p->where('status', '=', $status);
         })->get();
        $content = Content::all();
        $services = Services::all();
        $resort = Shelter::orderBy('id', 'desc')->get();
        $blog = Blog::all();
        $myself = User::where('id', Auth::user()->id)->get();
        $mem = User::where('user_type', 'member')->get();
        $user = User::all();
       
        return view('home.member_dashboard', ['settings' => $settings, 'contents' => $content, 'services' => $services, 'resorts' => $resort, 'blogs' => $blog, 'members' => $mem, 'users' => $user, 'myselfs' => $myself]);
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

public function dashboard(){
  if(Auth::user()){
   if(Auth::user()->user_type == "admin" || Auth::user()->role == 1){
            $s_id = 1;
            $status = 1;
          $settings = Settings::where(function($p) use($s_id, $status){
              $p->where('id', '=', $s_id);
              $p->where('status', '=', $status);
         })->get();
        $content = Content::all();
        $services = Services::all();
        $resort = Shelter::orderBy('id', 'desc')->get();
        $blog = Blog::all();
        $myself = User::where('id', Auth::user()->id)->get();
        $mem = User::where('user_type', 'member')->get();
        $user = User::all();
        $orders = Orders::all();
        $reservation = Reservations::where('approved', 0)->get();
        $service_booking = ServiceBooking::where('approved', 0)->get();
        $visited = Visited::all();
        $transaction = transaction::all();
            return view('home.member_dashboard', ['settings' => $settings, 'myselfs' => $myself, 'contents' => $content, 'services' => $services, 'resorts' => $resort, 'blogs' => $blog, 'members' => $mem, 'users' => $user, 'reservations' => $reservation, 'bookings' => $service_booking, 'visited' => $visited, 'transactions' => $transaction, 'orders' => $orders]);
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

/****************************************************************
 * **************Resort manager view rendering methods***********
 * *************************************************************/
public function create_resort(){
    if(Auth::user()){
        if(Auth::user()->user_type == "admin" || Auth::user()->role == 1 || Auth::user()->user_type == "resort_owner" || Auth::user()->privilege == "resort_owner"){
        $s_id = 1;
      $status = 1;
    $settings = Settings::where(function($p) use($s_id, $status){
        $p->where('id', '=', $s_id);
        $p->where('status', '=', $status);
   })->get();
        $resort = Shelter::orderBy('id', 'desc')->get(); 
        $myself = User::where('id', Auth::user()->id)->get();
        $features = AdminResortFeatures::orderBy('id', 'desc')->get();
        return view('home.resorts', ['settings' => $settings, 'myselfs' => $myself, 'resorts' => $resort, 'features' => $features]);
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

public function update_resort($id){
    if(Auth::user()){
        if(Auth::user()->user_type == "admin" || Auth::user()->role == 1 || Auth::user()->user_type == "resort_owner"){
        $s_id = 1;
      $status = 1;
    $settings = Settings::where(function($p) use($s_id, $status){
        $p->where('id', '=', $s_id);
        $p->where('status', '=', $status);
   })->get();
        $resort = Shelter::orderBy('id', 'desc')->get(); 
        $resorts = Shelter::where('id', $id)->get(); 
        $myself = User::where('id', Auth::user()->id)->get();
        $features = ResortFeatures::where('resort_id', $id)->get();
        $features2 = AdminResortFeatures::orderBy('id', 'desc')->get();
            return view('home.update_resort', ['settings' => $settings, 'myselfs' => $myself, 'resorts' => $resort, 'resorts2' => $resorts, 'features' => $features, 'admin_features' => $features2]);
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


public function edit_resort_img($id){
    if(Auth::user()){
        if(Auth::user()->user_type == "admin" || Auth::user()->role == 1 || Auth::user()->user_type == "resort_owner"){
        $s_id = 1;
      $status = 1;
    $settings = Settings::where(function($p) use($s_id, $status){
        $p->where('id', '=', $s_id);
        $p->where('status', '=', $status);
   })->get();
       
        $resort = Shelter::orderBy('id', 'desc')->get(); 
        $resorts = Shelter::where('id', $id)->get(); 
        $myself = User::where('id', Auth::user()->id)->get();

                       
    return view('home.edit_resort_img', ['settings' => $settings, 
                                          'myselfs' => $myself, 
                                          'resorts' => $resort, 
                                          'resorts2' => $resorts,
                                          'resortImg' => json_decode($resorts[0]->images)
                                           ]);
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

public function edit_resort_features($id){
    if(Auth::user()){
        if(Auth::user()->user_type == "admin" || Auth::user()->role == 1 || Auth::user()->user_type == "resort_owner"){
        $s_id = 1;
      $status = 1;
    $settings = Settings::where(function($p) use($s_id, $status){
        $p->where('id', '=', $s_id);
        $p->where('status', '=', $status);
   })->get();
        $resort = Shelter::orderBy('id', 'desc')->get(); 
        $resorts = Shelter::where('id', $id)->get(); 
        $myself = User::where('id', Auth::user()->id)->get();
        $features = ResortFeatures::where('resort_id', $id)->get();
        $features2 = AdminResortFeatures::orderBy('id', 'desc')->get();
       
        //$array_call = array();
        if(count($features) > 0){
           $array_call = $features;
           $array_list = json_decode($features[0]->features);
        }else{
            $array_call = array();
            $array_list = array();
        }

        
        
        /********************************************************** 
        $array = array('admin_features' => $features2,
                       'resort_features' => ''//$array_call
                         );
        *********************************************************/
return view('home.edit_resort_features', ['settings' => $settings, 
                                          'myselfs' => $myself, 
                                          'resorts' => $resort, 
                                          'resorts2' => $resorts, 
                                          'admin_features' => $features2,
                                          'features' => $array_call,
                                          'feature_list' => $array_list
                                        ]);

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

public function create_room($id){
    if(Auth::user()){
        if(Auth::user()->user_type == "admin" || Auth::user()->role == 1 || Auth::user()->user_type == "resort_owner"){
        $s_id = 1;
      $status = 1;
    $settings = Settings::where(function($p) use($s_id, $status){
        $p->where('id', '=', $s_id);
        $p->where('status', '=', $status);
   })->get();
        $resort = Shelter::orderBy('id', 'desc')->get(); 
        $rooms = Rooms::where('shelter_id', $id)->orderBy('id', 'desc')->get(); 
        $resorts = Shelter::where('id', $id)->get(); 
        $myself = User::where('id', Auth::user()->id)->get();
            return view('home.create_room', ['settings' => $settings, 'myselfs' => $myself, 'resorts' => $resort, 'resorts2' => $resorts, 'rooms' => $rooms]);
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

public function update_room_page($resort, $id = NULL){
    if(Auth::user()){
        if(Auth::user()->user_type == "admin" || Auth::user()->role == 1 || Auth::user()->user_type == "resort_owner"){
        $s_id = 1;
      $status = 1;
    $settings = Settings::where(function($p) use($s_id, $status){
        $p->where('id', '=', $s_id);
        $p->where('status', '=', $status);
   })->get();
        $resort = Shelter::where('id', $resort)->get(); 
        $single = Rooms::where('id', $id)->get(); 
        $myself = User::where('id', Auth::user()->id)->get();
            return view('home.update_room', ['settings' => $settings, 'myselfs' => $myself, 'resorts' => $resort, 'rooms' => $single]);
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

public function edit_room_img($resort, $id = NULL){

    if(Auth::user()){
        if(Auth::user()->user_type == "admin" || Auth::user()->role == 1 || Auth::user()->user_type == "resort_owner"){
        $s_id = 1;
      $status = 1;
    $settings = Settings::where(function($p) use($s_id, $status){
        $p->where('id', '=', $s_id);
        $p->where('status', '=', $status);
   })->get();
        $resort = Shelter::where('id', $resort)->get(); 
        $single = Rooms::where('id', $id)->get(); 
        $myself = User::where('id', Auth::user()->id)->get();

        return view('home.edit_room_img', ['settings' => $settings, 
                                           'myselfs' => $myself, 
                                           'resorts' => $resort, 
                                           'rooms' => $single,
                                           'roomImg' => json_decode($single[0]->images)
                                             ]);
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


/****************************************************************
 * **************Shop manager view rendering methods*************
 * *************************************************************/
public function admin_store(){
    if(Auth::user()){
        
        $s_id = 1;
      $status = 1;
    $settings = Settings::where(function($p) use($s_id, $status){
        $p->where('id', '=', $s_id);
        $p->where('status', '=', $status);
   })->get();
        $resort = Shelter::orderBy('id', 'desc')->get(); 
        $store = StoreItem::orderBy('id', 'desc')->get(); 
        $category = storeCategory::orderBy('id', 'desc')->get();
        $myself = User::where('id', Auth::user()->id)->get();
            return view('home.create_shop', ['settings' => $settings, 'myselfs' => $myself, 'stores' => $store, 'categories' => $category, 'resorts' => $resort]);

        }else{
            $settings = Settings::where('id', 1)->get();
            $error = array("code" => "403",
                           "title" => "Forbidden!",
                           "message" => "You do not have the server privilage to this page! Be warned to avoid being disabled by the admin. Meanwhile, you can return to index page by clicking",
                           "link" => url('/') );
                           return view('home.error', ['settings' => $settings, 'errors' => $error]); 

        }  
}




public function edit_shop_img($id){
    if(Auth::user()){
   
        $s_id = 1;
      $status = 1;
    $settings = Settings::where(function($p) use($s_id, $status){
        $p->where('id', '=', $s_id);
        $p->where('status', '=', $status);
   })->get();
        //$service_category = ServiceCategory::orderBy('id', 'desc')->get();
        $shop = StoreItem::where('id', $id)->get();
        $resort = Shelter::orderBy('id', 'desc')->get(); 
        $myself = User::where('id', Auth::user()->id)->get();
            return view('home.edit_shop_img', ['settings' => $settings, 
                                                'myselfs' => $myself, 
                                                'shops' => $shop, 
                                                'shopImages' => json_decode($shop[0]->images), 
                                                'resorts' => $resort]);

        }else{
            $settings = Settings::where('id', 1)->get();
            $error = array("code" => "403",
                           "title" => "Forbidden!",
                           "message" => "You do not have the server privilage to this page! Be warned to avoid being disabled by the admin. Meanwhile, you can return to index page by clicking",
                           "link" => url('/') );
                           return view('home.error', ['settings' => $settings, 'errors' => $error]); 

        }   
}



public function edit_shop($id){
    if(Auth::user()){
   
        $s_id = 1;
      $status = 1;
    $settings = Settings::where(function($p) use($s_id, $status){
        $p->where('id', '=', $s_id);
        $p->where('status', '=', $status);
   })->get();
        //$service_category = ServiceCategory::orderBy('id', 'desc')->get();
        $shop = StoreItem::where('id', $id)->get();
        $resort = Shelter::orderBy('id', 'desc')->get(); 
        $myself = User::where('id', Auth::user()->id)->get();
            return view('home.edit_shop', [ 'settings' => $settings, 
                                            'myselfs' => $myself, 
                                            'shops' => $shop, 
                                            'resorts' => $resort]);

        }else{
            $settings = Settings::where('id', 1)->get();
            $error = array("code" => "403",
                           "title" => "Forbidden!",
                           "message" => "You do not have the server privilage to this page! Be warned to avoid being disabled by the admin. Meanwhile, you can return to index page by clicking",
                           "link" => url('/') );
                           return view('home.error', ['settings' => $settings, 'errors' => $error]); 

        }   
}



public function edit_discount_settings($id){
    if(Auth::user()){
   
        $s_id = 1;
      $status = 1;
    $settings = Settings::where(function($p) use($s_id, $status){
        $p->where('id', '=', $s_id);
        $p->where('status', '=', $status);
   })->get();
        //$service_category = ServiceCategory::orderBy('id', 'desc')->get();
        $shop = StoreItem::where('id', $id)->get();
        $resort = Shelter::orderBy('id', 'desc')->get(); 
        $myself = User::where('id', Auth::user()->id)->get();
            return view('home.edit_discount_settings', [ 'settings' => $settings, 
                                            'myselfs' => $myself, 
                                            'shops' => $shop, 
                                            'resorts' => $resort]);

        }else{
            $settings = Settings::where('id', 1)->get();
            $error = array("code" => "403",
                           "title" => "Forbidden!",
                           "message" => "You do not have the server privilage to this page! Be warned to avoid being disabled by the admin. Meanwhile, you can return to index page by clicking",
                           "link" => url('/') );
                           return view('home.error', ['settings' => $settings, 'errors' => $error]); 

        }     
}


public function edit_delivery_settings($id){
    if(Auth::user()){
   
        $s_id = 1;
      $status = 1;
    $settings = Settings::where(function($p) use($s_id, $status){
        $p->where('id', '=', $s_id);
        $p->where('status', '=', $status);
   })->get();
        //$service_category = ServiceCategory::orderBy('id', 'desc')->get();
        $shop = StoreItem::where('id', $id)->get();
        $resort = Shelter::orderBy('id', 'desc')->get(); 
        $myself = User::where('id', Auth::user()->id)->get();
            return view('home.edit_delivery_settings', [ 'settings' => $settings, 
                                            'myselfs' => $myself, 
                                            'shops' => $shop, 
                                            'resorts' => $resort]);

        }else{
            $settings = Settings::where('id', 1)->get();
            $error = array("code" => "403",
                           "title" => "Forbidden!",
                           "message" => "You do not have the server privilage to this page! Be warned to avoid being disabled by the admin. Meanwhile, you can return to index page by clicking",
                           "link" => url('/') );
                           return view('home.error', ['settings' => $settings, 'errors' => $error]); 

        }     
}


/****************************************************************
 * **********Content manager view rendering methods**************
 * *************************************************************/

public function index_slider(){
    if(Auth::user()){
        if( Auth::user()->user_type == "admin" || Auth::user()->role == 1){
        $s_id = 1;
      $status = 1;
    $settings = Settings::where(function($p) use($s_id, $status){
        $p->where('id', '=', $s_id);
        $p->where('status', '=', $status);
   })->get();
        $resort = Shelter::orderBy('id', 'desc')->get(); 
        $slide = SlideFeatures::orderBy('updated_at', 'desc')->get();
        $myself = User::where('id', Auth::user()->id)->get();
            return view('home.index_slider', ['settings' => $settings, 'myselfs' => $myself, 'resorts' => $resort, 'slides' => $slide]);
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



/*********************************************************
 **************Boat service view rendering****************
 ********************************************************/

public function boat_services(){
    if(Auth::user()){
    if( Auth::user()->user_type == "admin" || Auth::user()->role == 1 || Auth::user()->user_type == "boat_owner" || Auth::user()->privilege == "boat_owner" || Auth::user()->privilege_2 == "boat_owner"){
        $s_id = 1;
      $status = 1;
    $settings = Settings::where(function($p) use($s_id, $status){
        $p->where('id', '=', $s_id);
        $p->where('status', '=', $status);
   })->get();

        $boat_category = BoatCategory::orderBy('id', 'desc')->get();
        $boat = Boat::orderBy('id', 'desc')->get();
        $resort = Shelter::orderBy('id', 'desc')->get(); 
        $myself = User::where('id', Auth::user()->id)->get();
            return view('home.create_boat_services', ['settings' => $settings, 'myselfs' => $myself, 'resorts' => $resort, 'boats' => $boat, 'categories' => $boat_category]);
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
                return view('home.edit_boat_img', ['settings' => $settings, 
                                                  'myselfs' => $myself, 
                                                  'resorts' => $resort, 
                                                  'boats' => $boat,
                                                  'boatimages' => json_decode($boat[0]->images)]);
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


/******************************************************************
 ********************Services view rendering***********************
 *****************************************************************/


public function create_services(){
    if(Auth::user()){
    if( Auth::user()->role == 1 || Auth::user()->user_type == "admin" || Auth::user()->user_type == "boat_owner" || Auth::user()->user_type == "yacht_owner"){
        $s_id = 1;
      $status = 1;
    $settings = Settings::where(function($p) use($s_id, $status){
        $p->where('id', '=', $s_id);
        $p->where('status', '=', $status);
   })->get();
        $service_category = ServiceCategory::orderBy('id', 'desc')->get();
        $services = Services::orderBy('id', 'desc')->get();
        $resort = Shelter::orderBy('id', 'desc')->get(); 
        $myself = User::where('id', Auth::user()->id)->get();
            return view('home.create_services', ['settings' => $settings, 'myselfs' => $myself, 'services' => $services, 'serviceCategories' => $service_category, 'resorts' => $resort]);
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


public function edit_service_img($id){
    if(Auth::user()){
    if( Auth::user()->role == 1 || Auth::user()->user_type == "admin" || Auth::user()->user_type == "boat_owner" || Auth::user()->user_type == "yacht_owner"){
        $s_id = 1;
      $status = 1;
    $settings = Settings::where(function($p) use($s_id, $status){
        $p->where('id', '=', $s_id);
        $p->where('status', '=', $status);
   })->get();
        //$service_category = ServiceCategory::orderBy('id', 'desc')->get();
        $services = Services::where('id', $id)->get();
        $resort = Shelter::orderBy('id', 'desc')->get(); 
        $myself = User::where('id', Auth::user()->id)->get();
            return view('home.edit_service_img', ['settings' => $settings, 
                                                 'myselfs' => $myself, 
                                                 'services' => $services, 
                                                 'serviceImages' => json_decode($services[0]->images), 
                                                 'resorts' => $resort]);
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



public function edit_service($id){
    if(Auth::user()){
        if( Auth::user()->role == 1 || Auth::user()->user_type == "admin" || Auth::user()->user_type == "boat_owner" || Auth::user()->user_type == "yacht_owner"){
            $s_id = 1;
          $status = 1;
        $settings = Settings::where(function($p) use($s_id, $status){
            $p->where('id', '=', $s_id);
            $p->where('status', '=', $status);
       })->get();
            //$service_category = ServiceCategory::orderBy('id', 'desc')->get();
            $services = Services::where('id', $id)->get();
            $resort = Shelter::orderBy('id', 'desc')->get(); 
            $myself = User::where('id', Auth::user()->id)->get();
                return view('home.edit_service', ['settings' => $settings, 
                                                     'myselfs' => $myself, 
                                                     'services' => $services, 
                                                     'serviceImages' => json_decode($services[0]->images), 
                                                     'resorts' => $resort]);
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



public function service_admin_booking_entry($id){
    if(Auth::user()){
        if( Auth::user()->role == 1 || Auth::user()->user_type == "admin" || Auth::user()->user_type == "boat_owner" || Auth::user()->user_type == "yacht_owner"){
            $s_id = 1;
          $status = 1;
        $settings = Settings::where(function($p) use($s_id, $status){
            $p->where('id', '=', $s_id);
            $p->where('status', '=', $status);
       })->get();
            //$service_category = ServiceCategory::orderBy('id', 'desc')->get();
            $services = Services::where('id', $id)->get();
            $resort = Shelter::orderBy('id', 'desc')->get(); 
            $myself = User::where('id', Auth::user()->id)->get();
                return view('home.service_bookings', ['settings' => $settings, 
                                                     'myselfs' => $myself, 
                                                     'services' => $services, 
                                                     'serviceImages' => json_decode($services[0]->images), 
                                                     'resorts' => $resort]);
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



public function edit_contents(){

    if(Auth::user()){
        if(Auth::user()->user_type == "admin" || Auth::user()->role == 1){
        $s_id = 1;
      $status = 1;
    $settings = Settings::where(function($p) use($s_id, $status){
        $p->where('id', '=', $s_id);
        $p->where('status', '=', $status);
   })->get();
        $contents = Content::all(); 
        $resort = Shelter::orderBy('id', 'desc')->get(); 
        $myself = User::where('id', Auth::user()->id)->get();
        if(isset($_GET['cnt_name'])){
            $contents2 = Content::where('name', $_GET['cnt_name'])->get();
            return view('home.content', ['settings' => $settings, 'myselfs' => $myself, 'contents' => $contents, 'contents2' => $contents2, 'resorts' => $resort]);
        }
            return view('home.content', ['settings' => $settings, 'myselfs' => $myself, 'contents' => $contents, 'resorts' => $resort]);
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

public function users(){

    if(Auth::user() && Auth::user()->user_type == "admin" && Auth::user()->role == 1){
        $s_id = 1;
      $status = 1;
    $settings = Settings::where(function($p) use($s_id, $status){
        $p->where('id', '=', $s_id);
        $p->where('status', '=', $status);
   })->get();
        $resort = Shelter::orderBy('id', 'desc')->get(); 
        $users = User::orderBy('id', 'desc')->get(); 
        $myself = User::where('id', Auth::user()->id)->get();
            return view('home.users', ['settings' => $settings, 'myselfs' => $myself, 'users' => $users, 'resorts' => $resort]);
        }else{
            $settings = Settings::where('id', 1)->get();
            $error = array("code" => "403",
                           "title" => "Forbidden!",
                           "message" => "You do not have the server privilage to this page! Be warned to avoid being disabled by the admin. Meanwhile, you can return to index page by clicking",
                           "link" => url('/') );
                           return view('home.error', ['settings' => $settings, 'errors' => $error]); 

        }   

}


public function user_profile($id){
    if(Auth::user()){
        $s_id = 1;
      $status = 1;
    $settings = Settings::where(function($p) use($s_id, $status){
        $p->where('id', '=', $s_id);
        $p->where('status', '=', $status);
   })->get();
        $resort = Shelter::orderBy('id', 'desc')->get(); 
        $users = User::orderBy('id', 'desc')->get(); 
        $myself = User::where('id', Auth::user()->id)->get();
        $profile = User::where('id', $id)->get();
        $blog = Blog::where('user_id', $id)->get();
            return view('home.profile', ['settings' => $settings, 'myselfs' => $myself, 'users' => $users, 'profiles' => $profile, 'resorts' => $resort, 'blogs' => $blog]);
        }else{
            $settings = Settings::where('id', 1)->get();
            $error = array("code" => "403",
                           "title" => "Forbidden!",
                           "message" => "You do not have the server privilage to this page! Be warned to avoid being disabled by the admin. Meanwhile, you can return to index page by clicking",
                           "link" => url('/') );
                           return view('home.error', ['settings' => $settings, 'errors' => $error]); 

        }     
}

public function settings(){

    if(Auth::user() && Auth::user()->user_type == "admin" && Auth::user()->role == 1){
        $s_id = 1;
      $status = 1;
    $settings = Settings::where(function($p) use($s_id, $status){
        $p->where('id', '=', $s_id);
        $p->where('status', '=', $status);
   })->get();
        $resort = Shelter::orderBy('id', 'desc')->get(); 
        $users = User::orderBy('id', 'desc')->get(); 
        $myself = User::where('id', Auth::user()->id)->get();
            return view('home.info', ['settings' => $settings, 'myselfs' => $myself, 'resorts' => $resort, 'users' => $users]);
        }else{
            $settings = Settings::where('id', 1)->get();
            $error = array("code" => "403",
                           "title" => "Forbidden!",
                           "message" => "You do not have the server privilage to this page! Be warned to avoid being disabled by the admin. Meanwhile, you can return to index page by clicking",
                           "link" => url('/') );
                           return view('home.error', ['settings' => $settings, 'errors' => $error]); 

        }   

}

public function events(){
    if(Auth::user() && Auth::user()->user_type == "admin" && Auth::user()->role == 1){
        $s_id = 1;
      $status = 1;
    $settings = Settings::where(function($p) use($s_id, $status){
        $p->where('id', '=', $s_id);
        $p->where('status', '=', $status);
   })->get();
        $events = Events::all(); 
        $myself = User::where('id', Auth::user()->id)->get();
            return view('home.events', ['settings' => $settings, 'myselfs' => $myself, 'events' => $events]);
        }else{
            $settings = Settings::where('id', 1)->get();
            $error = array("code" => "403",
                           "title" => "Forbidden!",
                           "message" => "You do not have the server privilage to this page! Be warned to avoid being disabled by the admin. Meanwhile, you can return to index page by clicking",
                           "link" => url('/') );
                           return view('home.error', ['settings' => $settings, 'errors' => $error]); 

        }   
}


    public function serviceForm(){

        if(Auth::user() && Auth::user()->user_type == "admin" && Auth::user()->role == 1){
            $s_id = 1;
      $status = 1;
    $settings = Settings::where(function($p) use($s_id, $status){
        $p->where('id', '=', $s_id);
        $p->where('status', '=', $status);
   })->get();
            $events = Events::all(); 
            $myself = User::where('id', Auth::user()->id)->get();
                return view('home.services', ['settings' => $settings, 'myselfs' => $myself, 'events' => $events]);
            }else{
                $settings = Settings::where('id', 1)->get();
                $error = array("code" => "403",
                               "title" => "Forbidden!",
                               "message" => "You do not have the server privilage to this page! Be warned to avoid being disabled by the admin. Meanwhile, you can return to index page by clicking",
                               "link" => url('/') );
                               return view('home.error', ['settings' => $settings, 'errors' => $error]); 
    
            }   

    }


public function member_debts(){
    if(Auth::user() && Auth::user()->user_type == "member"){
        $s_id = 1;
      $status = 1;
    $settings = Settings::where(function($p) use($s_id, $status){
        $p->where('id', '=', $s_id);
        $p->where('status', '=', $status);
   })->get();
        $resort = Shelter::orderBy('id', 'desc')->get(); 
        $users = User::orderBy('id', 'desc')->get(); 
        $myself = User::where('id', Auth::user()->id)->get();
        $debts = Debt::where('user_id', Auth::user()->id)->orderBy('id', 'desc')->get();
            return view('home.debts', ['settings' => $settings, 'myselfs' => $myself, 'resorts' => $resort, 'users' => $users, 'debts' => $debts]);
        }else{
            $settings = Settings::where('id', 1)->get();
            $error = array("code" => "403",
                           "title" => "Forbidden!",
                           "message" => "You do not have the server privilage to this page! Be warned to avoid being disabled by the admin. Meanwhile, you can return to index page by clicking",
                           "link" => url('/') );
                           return view('home.error', ['settings' => $settings, 'errors' => $error]); 

        }   
}
public function create_debts(){
    if(Auth::user()){
        if(Auth::user()->user_type == "admin" || Auth::user()->role == 1){
        $s_id = 1;
      $status = 1;
    $settings = Settings::where(function($p) use($s_id, $status){
        $p->where('id', '=', $s_id);
        $p->where('status', '=', $status);
   })->get();
        $resort = Shelter::orderBy('id', 'desc')->get(); 
        $users = User::where('user_type', 'member')->orderBy('id', 'desc')->get(); 
        $myself = User::where('id', Auth::user()->id)->get();
        $debts = Debt::orderBy('id', 'desc')->get();
            return view('home.create_debts', ['settings' => $settings, 'myselfs' => $myself, 'resorts' => $resort, 'users' => $users, 'debts' => $debts]);
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

public function reservations(){
    if(Auth::user()){
        if(Auth::user()->user_type == "admin" || Auth::user()->role == 1 || Auth::user()->user_type == "resort_owner"){
        $s_id = 1;
      $status = 1;
    $settings = Settings::where(function($p) use($s_id, $status){
        $p->where('id', '=', $s_id);
        $p->where('status', '=', $status);
   })->get();
        $resort = Shelter::orderBy('id', 'desc')->get(); 
        $users = User::where('user_type', 'member')->orderBy('id', 'desc')->get(); 
        $myself = User::where('id', Auth::user()->id)->get();
        $reservation = Reservations::orderBy('id', 'desc')->get();
        $service_booking = ServiceBooking::orderBy('id', 'desc')->get();
            return view('home.reservations', ['settings' => $settings, 'myselfs' => $myself, 'resorts' => $resort, 'users' => $users, 'reservations' => $reservation, 'bookings' => $service_booking]);
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


public function service_bookings(){
 
    if(Auth::user()){
        if(Auth::user()->user_type == "admin" || Auth::user()->role == 1){
        $s_id = 1;
      $status = 1;
    $settings = Settings::where(function($p) use($s_id, $status){
        $p->where('id', '=', $s_id);
        $p->where('status', '=', $status);
   })->get();
        $resort = Shelter::orderBy('id', 'desc')->get(); 
        $users = User::where('user_type', 'member')->orderBy('id', 'desc')->get(); 
        $myself = User::where('id', Auth::user()->id)->get();
        
        $service_booking = ServiceBooking::orderBy('id', 'desc')->get();
            return view('home.bookings', ['settings' => $settings, 'myselfs' => $myself, 'resorts' => $resort, 'users' => $users, 'bookings' => $service_booking]);
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

public function reservation($id){
    if(Auth::user()){
        if(Auth::user()->user_type == "admin" || Auth::user()->role == 1 || Auth::user()->user_type == "resort_owner" || Auth::user()->privilege == "resort_owner"){
        $s_id = 1;
      $status = 1;
    $settings = Settings::where(function($p) use($s_id, $status){
        $p->where('id', '=', $s_id);
        $p->where('status', '=', $status);
   })->get();
        $resort = Shelter::orderBy('id', 'desc')->get(); 
        $users = User::where('user_type', 'member')->orderBy('id', 'desc')->get(); 
        $myself = User::where('id', Auth::user()->id)->get();
        $reservation = Reservations::where('id', $id)->get();   
        if($reservation[0]->type == "resort"){
            $type = $reservation[0]->type;
            $t_id = $reservation[0]->id;
            $transactions = transaction::where(function($p) use($type, $t_id){
                $p->where('type', '=', $type);
                $p->where('t_id', '=', $t_id);
           })->get();
            $booking = Shelter::where('id', $reservation[0]->shelter_id)->get(); 
        }else if($reservation[0]->type == "room"){

            $type = $reservation[0]->type;
            $t_id = $reservation[0]->id;
            $transactions = transaction::where(function($p) use($type, $t_id){
                $p->where('type', '=', $type);
                $p->where('t_id', '=', $t_id);
           })->get();

            $booking = Rooms::where('id', $reservation[0]->room_id)->get(); 
        }
            return view('home.reservation', ['settings' => $settings, 'myselfs' => $myself, 'resorts' => $resort, 'users' => $users, 'reservations' => $reservation, 'resort_bookings' => $booking, 'room_bookings' => $booking, 'transactions' => $transactions]);
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


public function print_reservation($id){
    if(Auth::user()){
        if(Auth::user()->user_type == "admin" || Auth::user()->role == 1 || Auth::user()->user_type == "resort_owner"){
        $s_id = 1;
      $status = 1;
    $settings = Settings::where(function($p) use($s_id, $status){
        $p->where('id', '=', $s_id);
        $p->where('status', '=', $status);
   })->get();
        $resort = Shelter::orderBy('id', 'desc')->get(); 
        $users = User::where('user_type', 'member')->orderBy('id', 'desc')->get(); 
        $myself = User::where('id', Auth::user()->id)->get();
        $reservation = Reservations::where('id', $id)->get();
        if($reservation[0]->type == "resort"){
            $booking = Shelter::where('id', $reservation[0]->shelter_id)->get(); 
        }else if($reservation[0]->type == "room"){
            $booking = Rooms::where('id', $reservation[0]->room_id)->get(); 
        }
            return view('home.print_reservation', ['settings' => $settings, 'myselfs' => $myself, 'resorts' => $resort, 'users' => $users, 'reservations' => $reservation, 'resort_bookings' => $booking, 'room_bookings' => $booking]);
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

public function service_booking($id){
    if(Auth::user()){
        if(Auth::user()->user_type == "admin" || Auth::user()->role == 1 || Auth::user()->user_type == "boat_owner" || Auth::user()->user_type == "yacht_owner"){
        $s_id = 1;
      $status = 1;
    $settings = Settings::where(function($p) use($s_id, $status){
        $p->where('id', '=', $s_id);
        $p->where('status', '=', $status);
   })->get();
        $resort = Shelter::orderBy('id', 'desc')->get(); 
        $users = User::where('user_type', 'member')->orderBy('id', 'desc')->get(); 
        $myself = User::where('id', Auth::user()->id)->get();
        $bookings = ServiceBooking::where('id', $id)->get();
        $services = Services::where('id', $bookings[0]->service_id)->get(); 
       
            return view('home.service_booking', ['settings' => $settings, 'myselfs' => $myself, 'resorts' => $resort, 'users' => $users, 'bookings' => $bookings, 'services' => $services]);
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

public function print_booking($id){
    if(Auth::user()){
        if(Auth::user()->user_type == "admin" || Auth::user()->role == 1 || Auth::user()->user_type == "boat_owner" || Auth::user()->user_type == "yacht_owner"){
        $s_id = 1;
      $status = 1;
    $settings = Settings::where(function($p) use($s_id, $status){
        $p->where('id', '=', $s_id);
        $p->where('status', '=', $status);
   })->get();
        $resort = Shelter::orderBy('id', 'desc')->get(); 
        $users = User::where('user_type', 'member')->orderBy('id', 'desc')->get(); 
        $myself = User::where('id', Auth::user()->id)->get();
        $bookings = ServiceBooking::where('id', $id)->get();
        $services = Services::where('id', $bookings[0]->service_id)->get(); 
       
            return view('home.print_booking', ['settings' => $settings, 'myselfs' => $myself, 'resorts' => $resort, 'users' => $users, 'bookings' => $bookings, 'services' => $services]);
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

//load single resort of the resort_owner priviledge
public function resort_owner_resort_booking_page($id){
    if(Auth::user()){
        if(Auth::user()->user_type == "admin" || Auth::user()->user_type == "resort_owner"){
        $s_id = 1;
      $status = 1;
    $settings = Settings::where(function($p) use($s_id, $status){
        $p->where('id', '=', $s_id);
        $p->where('status', '=', $status);
   })->get();
        
        
        $resort = Shelter::where('id', $id)->get(); 
        $users = User::where('user_type', 'member')->orderBy('id', 'desc')->get(); 
        $myself = User::where('id', Auth::user()->id)->get();
        $reservation = Reservations::where('shelter_id', $resort[0]->id)->orderBy('id', 'desc')->get();
        
            return view('home.resort_booking', ['settings' => $settings, 'myselfs' => $myself, 'resorts' => $resort, 'users' => $users, 'reservations' => $reservation]);
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

public function resort_owner_room_booking_page($resort, $id = NULL){

    if(Auth::user()){
        if(Auth::user()->user_type == "admin" || Auth::user()->user_type == "resort_owner"){
        $s_id = 1;
      $status = 1;
    $settings = Settings::where(function($p) use($s_id, $status){
        $p->where('id', '=', $s_id);
        $p->where('status', '=', $status);
   })->get();
        
        
        $resorts = Shelter::where('id', $resort)->get(); 
        $users = User::where('user_type', 'member')->orderBy('id', 'desc')->get(); 
        $myself = User::where('id', Auth::user()->id)->get();
        $rooms = Rooms::where('id', $id)->get();
        $reservation = Reservations::where('room_id', $rooms[0]->id)->orderBy('id', 'desc')->get();
        
            return view('home.room_booking', ['settings' => $settings, 'myselfs' => $myself, 'resorts' => $resorts, 'rooms' => $rooms, 'users' => $users, 'reservations' => $reservation]);
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


public function book_service($id){

    if(Auth::user()){
        if(Auth::user()->user_type == "admin" || Auth::user()->user_type == "boat_owner" || Auth::user()->user_type == "yacht_owner"){
        $s_id = 1;
      $status = 1;
    $settings = Settings::where(function($p) use($s_id, $status){
        $p->where('id', '=', $s_id);
        $p->where('status', '=', $status);
   })->get();
        
   $resort = Shelter::orderBy('id', 'desc')->get(); 
   $users = User::where('user_type', 'member')->orderBy('id', 'desc')->get(); 
   $myself = User::where('id', Auth::user()->id)->get();
   $services = Services::where('id', $id)->get();      
   $bookings = ServiceBooking::where('service_id', $services[0]->id)->get();

return view('home.service_booking_form', ['settings' => $settings, 'myselfs' => $myself, 'resorts' => $resort, 'users' => $users, 'services' => $services, 'bookings' => $bookings]);

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

public function visitors(){
    if(Auth::user()){
        if(Auth::user()->user_type == "admin" || Auth::user()->role == 1){
        $s_id = 1;
      $status = 1;
    $settings = Settings::where(function($p) use($s_id, $status){
        $p->where('id', '=', $s_id);
        $p->where('status', '=', $status);
   })->get();
        $resort = Shelter::orderBy('id', 'desc')->get(); 
        $users = User::where('user_type', 'member')->orderBy('id', 'desc')->get(); 
        $myself = User::where('id', Auth::user()->id)->get();
        $visited = Visited::orderBy('id', 'desc')->get();
       
            return view('home.visitors', ['settings' => $settings, 'myselfs' => $myself, 'resorts' => $resort, 'users' => $users, 'visitors' => $visited]);
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


public function site_activities(){
    if(Auth::user()){
        if(Auth::user()->user_type == "admin" || Auth::user()->role == 1){
        $s_id = 1;
      $status = 1;
    $settings = Settings::where(function($p) use($s_id, $status){
        $p->where('id', '=', $s_id);
        $p->where('status', '=', $status);
   })->get();
        $resort = Shelter::orderBy('id', 'desc')->get(); 
        $users = User::where('user_type', 'member')->orderBy('id', 'desc')->get(); 
        $myself = User::where('id', Auth::user()->id)->get();
        
        $activity = SiteActivity::orderBy('id', 'desc')->get(); 
       
            return view('home.activity', ['settings' => $settings, 'myselfs' => $myself, 'resorts' => $resort, 'users' => $users, 'activities' => $activity]);
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


public function shop_orders(){
    if(Auth::user()){
        if(Auth::user()->user_type == "admin" || Auth::user()->role == 1){
        $s_id = 1;
      $status = 1;
    $settings = Settings::where(function($p) use($s_id, $status){
        $p->where('id', '=', $s_id);
        $p->where('status', '=', $status);
   })->get();
        $resort = Shelter::orderBy('id', 'desc')->get(); 
        $users = User::where('user_type', 'member')->orderBy('id', 'desc')->get(); 
        $myself = User::where('id', Auth::user()->id)->get();
        
        $orders = Orders::orderBy('id', 'desc')->get();
            return view('home.orders', ['settings' => $settings, 'myselfs' => $myself, 'resorts' => $resort, 'users' => $users, 'orders' => $orders]);
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

public function order_page($id){
    if(Auth::user()){
        if(Auth::user()->user_type == "admin" || Auth::user()->role == 1){
        $s_id = 1;
      $status = 1;
    $settings = Settings::where(function($p) use($s_id, $status){
        $p->where('id', '=', $s_id);
        $p->where('status', '=', $status);
   })->get();
        $resort = Shelter::orderBy('id', 'desc')->get(); 
        $users = User::where('user_type', 'member')->orderBy('id', 'desc')->get(); 
        $myself = User::where('id', Auth::user()->id)->get();
        
        $orders = Orders::where('id', $id)->get();
        return view('home.order_page', ['settings' => $settings, 'myselfs' => $myself, 'resorts' => $resort, 'users' => $users, 'orders' => $orders]);
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

public function transactions(){
    if(Auth::user()){
        if(Auth::user()->user_type == "admin" || Auth::user()->role == 1){
        $s_id = 1;
      $status = 1;
    $settings = Settings::where(function($p) use($s_id, $status){
        $p->where('id', '=', $s_id);
        $p->where('status', '=', $status);
   })->get();
        $resort = Shelter::orderBy('id', 'desc')->get(); 
        $users = User::where('user_type', 'member')->orderBy('id', 'desc')->get(); 
        $myself = User::where('id', Auth::user()->id)->get();
        
        $transactions = transaction::orderBy('id', 'desc')->get(); 
       
            return view('home.transactions', ['settings' => $settings, 'myselfs' => $myself, 'resorts' => $resort, 'users' => $users, 'transactions' => $transactions]);
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


public function transaction($id){
    if(Auth::user()){
        if(Auth::user()->user_type == "admin" || Auth::user()->role == 1 || Auth::user()->user_type == "resort_owner" || Auth::user()->user_type == "boat_owner" || Auth::user()->privilege == "resort_owner" || Auth::user()->privilege == "boat_owner"){
        $s_id = 1;
      $status = 1;
    $settings = Settings::where(function($p) use($s_id, $status){
        $p->where('id', '=', $s_id);
        $p->where('status', '=', $status);
   })->get();
        $resort = Shelter::orderBy('id', 'desc')->get(); 
        $users = User::where('user_type', 'member')->orderBy('id', 'desc')->get(); 
        $myself = User::where('id', Auth::user()->id)->get();
        
        $transactions = transaction::where('id', $id)->get(); 

        if($transactions[0]->type == 'resort'){
          $reservation = Reservations::where('id', $transactions[0]->t_id)->get();
          $resorts = Shelter::where('id', $reservation[0]->shelter_id)->get();
          return view('home.transaction', ['settings' => $settings, 'myselfs' => $myself, 'resorts' => $resort, 'users' => $users, 'transaction' => $transactions, 'reservations' => $reservation, 'shelter' => $resorts]);
        }else if($transactions[0]->type == 'room'){
         $reservation = Reservations::where('id', $transactions[0]->t_id)->get();
         $rooms = Rooms::where('id', $reservation[0]->room_id)->get();
         $resorts = Shelter::where('id', $rooms[0]->shelter_id)->get();
         return view('home.transaction', ['settings' => $settings, 'myselfs' => $myself, 'resorts' => $resort, 'users' => $users, 'transaction' => $transactions, 'reservations' => $reservation, 'shelter' => $resorts, 'room' => $rooms]);
        }else if($transactions[0]->type == 'Boat' || $transactions[0]->type == 'Yacht'){
         $booking = ServiceBooking::where('id', $transactions[0]->t_id)->get();
         $services = Services::where('id', $booking[0]->service_id)->get();
         return view('home.transaction', ['settings' => $settings, 'myselfs' => $myself, 'resorts' => $resort, 'users' => $users, 'transaction' => $transactions, 'booking' => $booking, 'service' => $services]);
        }else if($transactions[0]->type == 'Membership'){
            return view('home.transaction', ['settings' => $settings, 'myselfs' => $myself, 'resorts' => $resort, 'users' => $users, 'transaction' => $transactions]);
        }

        
       
           
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

public function print_transaction($id){
    if(Auth::user()){
        if(Auth::user()->user_type == "admin" || Auth::user()->role == 1 || Auth::user()->user_type == "resort_owner" || Auth::user()->user_type == "boat_owner" || Auth::user()->privilege == "resort_owner" || Auth::user()->privilege == "boat_owner"){
        $s_id = 1;
      $status = 1;
    $settings = Settings::where(function($p) use($s_id, $status){
        $p->where('id', '=', $s_id);
        $p->where('status', '=', $status);
   })->get();
        $resort = Shelter::orderBy('id', 'desc')->get(); 
        $users = User::where('user_type', 'member')->orderBy('id', 'desc')->get(); 
        $myself = User::where('id', Auth::user()->id)->get();
        
        $transactions = transaction::where('id', $id)->get(); 

        if($transactions[0]->type == 'resort'){
            $reservation = Reservations::where('id', $transactions[0]->t_id)->get();
            $resorts = Shelter::where('id', $reservation[0]->shelter_id)->get();
            return view('home.print_transaction', ['settings' => $settings, 'myselfs' => $myself, 'resorts' => $resort, 'users' => $users, 'transaction' => $transactions, 'reservations' => $reservation, 'shelter' => $resorts]);
          }else if($transactions[0]->type == 'room'){
           $reservation = Reservations::where('id', $transactions[0]->t_id)->get();
           $rooms = Rooms::where('id', $reservation[0]->room_id)->get();
           $resorts = Shelter::where('id', $rooms[0]->shelter_id)->get();
           return view('home.print_transaction', ['settings' => $settings, 'myselfs' => $myself, 'resorts' => $resort, 'users' => $users, 'transaction' => $transactions, 'reservations' => $reservation, 'shelter' => $resorts, 'room' => $rooms]);
          }else if($transactions[0]->type == 'Boat' || $transactions[0]->type == 'Yacht'){
           $booking = ServiceBooking::where('id', $transactions[0]->t_id)->get();
           $services = Services::where('id', $booking[0]->service_id)->get();
           return view('home.print_transaction', ['settings' => $settings, 'myselfs' => $myself, 'resorts' => $resort, 'users' => $users, 'transaction' => $transactions, 'booking' => $booking, 'service' => $services]);
          }else if($transactions[0]->type == 'Membership'){
            return view('home.transaction', ['settings' => $settings, 'myselfs' => $myself, 'resorts' => $resort, 'users' => $users, 'transaction' => $transactions]);
        }
       
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


public function messages(){
    if(Auth::user()){
        
        $s_id = 1;
      $status = 1;
    $settings = Settings::where(function($p) use($s_id, $status){
        $p->where('id', '=', $s_id);
        $p->where('status', '=', $status);
   })->get();
        $resort = Shelter::orderBy('id', 'desc')->get(); 
        $users = User::orderBy('id', 'desc')->get(); 
        $myself = User::where('id', Auth::user()->id)->get();
        

        $messages = Messages::where('to_user', Auth::user()->email)->orderBy('id', 'desc')->get(); 
        
            return view('home.messages', ['settings' => $settings, 'myselfs' => $myself, 'resorts' => $resort, 'users' => $users, 'messages' => $messages]);

        }else{
            $settings = Settings::where('id', 1)->get();
            $error = array("code" => "403",
                           "title" => "Forbidden!",
                           "message" => "You do not have the server privilage to this page! Be warned to avoid being disabled by the admin. Meanwhile, you can return to index page by clicking",
                           "link" => url('/') );
                           return view('home.error', ['settings' => $settings, 'errors' => $error]); 

        }     
} 

public function sent_messages(){
    if(Auth::user()){
      $s_id = 1;
      $status = 1;
    $settings = Settings::where(function($p) use($s_id, $status){
        $p->where('id', '=', $s_id);
        $p->where('status', '=', $status);
   })->get();
        $resort = Shelter::orderBy('id', 'desc')->get(); 
        $users = User::orderBy('id', 'desc')->get(); 
        $myself = User::where('id', Auth::user()->id)->get();
        

        $messages = Messages::where('from_user', Auth::user()->email)->orderBy('id', 'desc')->get(); 
        
            return view('home.sent_messages', ['settings' => $settings, 'myselfs' => $myself, 'resorts' => $resort, 'users' => $users, 'messages' => $messages]);

        }else{
            $settings = Settings::where('id', 1)->get();
            $error = array("code" => "403",
                           "title" => "Forbidden!",
                           "message" => "You do not have the server privilage to this page! Be warned to avoid being disabled by the admin. Meanwhile, you can return to index page by clicking",
                           "link" => url('/') );
                           return view('home.error', ['settings' => $settings, 'errors' => $error]); 

        }  
        
    
}

public function support(){
    if(Auth::user() && Auth::user()->user_type == "admin"){
        
        $s_id = 1;
      $status = 1;
    $settings = Settings::where(function($p) use($s_id, $status){
        $p->where('id', '=', $s_id);
        $p->where('status', '=', $status);
   })->get();
        $resort = Shelter::orderBy('id', 'desc')->get(); 
        $users = User::orderBy('id', 'desc')->get(); 
        $myself = User::where('id', Auth::user()->id)->get();
        

        $support = Support::orderBy('id', 'desc')->get(); 
        
            return view('home.support_messages', ['settings' => $settings, 'myselfs' => $myself, 'resorts' => $resort, 'users' => $users, 'supports' => $support]);

        }else{
            $settings = Settings::where('id', 1)->get();
            $error = array("code" => "403",
                           "title" => "Forbidden!",
                           "message" => "You do not have the server privilage to this page! Be warned to avoid being disabled by the admin. Meanwhile, you can return to index page by clicking",
                           "link" => url('/') );
                           return view('home.error', ['settings' => $settings, 'errors' => $error]); 

        }      
}

public function read_support_message($id){
    if(Auth::user() && Auth::user()->user_type == "admin"){
        
        $s_id = 1;
      $status = 1;
    $settings = Settings::where(function($p) use($s_id, $status){
        $p->where('id', '=', $s_id);
        $p->where('status', '=', $status);
   })->get();
        $resort = Shelter::orderBy('id', 'desc')->get(); 
        $users = User::orderBy('id', 'desc')->get(); 
        $myself = User::where('id', Auth::user()->id)->get();
        

        $support = Support::where('id', $id)->get(); 

        $update_support = Support::where('id', $id)->update(['seen' => 1]); 
        
            return view('home.read_support_messages', ['settings' => $settings, 'myselfs' => $myself, 'resorts' => $resort, 'users' => $users, 'supports' => $support]);

        }else{
            $settings = Settings::where('id', 1)->get();
            $error = array("code" => "403",
                           "title" => "Forbidden!",
                           "message" => "You do not have the server privilage to this page! Be warned to avoid being disabled by the admin. Meanwhile, you can return to index page by clicking",
                           "link" => url('/') );
                           return view('home.error', ['settings' => $settings, 'errors' => $error]); 

        }     
}


public function reply_support_message($id){
    if(Auth::user() && Auth::user()->user_type == "admin"){
        
        $s_id = 1;
      $status = 1;
    $settings = Settings::where(function($p) use($s_id, $status){
        $p->where('id', '=', $s_id);
        $p->where('status', '=', $status);
   })->get();
        $resort = Shelter::orderBy('id', 'desc')->get(); 
        $users = User::orderBy('id', 'desc')->get(); 
        $myself = User::where('id', Auth::user()->id)->get();
        

        $support = Support::where('id', $id)->get(); 

        
            return view('home.reply_support_message', ['settings' => $settings, 'myselfs' => $myself, 'resorts' => $resort, 'users' => $users, 'supports' => $support]);

        }else{
            $settings = Settings::where('id', 1)->get();
            $error = array("code" => "403",
                           "title" => "Forbidden!",
                           "message" => "You do not have the server privilage to this page! Be warned to avoid being disabled by the admin. Meanwhile, you can return to index page by clicking",
                           "link" => url('/') );
                           return view('home.error', ['settings' => $settings, 'errors' => $error]); 

        }        
}

public function new_message(){
    if(Auth::user()){
        
        $s_id = 1;
      $status = 1;
    $settings = Settings::where(function($p) use($s_id, $status){
        $p->where('id', '=', $s_id);
        $p->where('status', '=', $status);
   })->get();
        $resort = Shelter::orderBy('id', 'desc')->get(); 
        $users = User::orderBy('id', 'desc')->get(); 
        $myself = User::where('id', Auth::user()->id)->get();
        
        $messages = Messages::orderBy('id', 'desc')->get(); 
       
            return view('home.new-message', ['settings' => $settings, 'myselfs' => $myself, 'resorts' => $resort, 'users' => $users, 'messages' => $messages]);

        }else{
            $settings = Settings::where('id', 1)->get();
            $error = array("code" => "403",
                           "title" => "Forbidden!",
                           "message" => "You do not have the server privilage to this page! Be warned to avoid being disabled by the admin. Meanwhile, you can return to index page by clicking",
                           "link" => url('/') );
                           return view('home.error', ['settings' => $settings, 'errors' => $error]); 

        }     
}  


public function read_message($id){
    if(Auth::user()){
        
        $s_id = 1;
      $status = 1;
    $settings = Settings::where(function($p) use($s_id, $status){
        $p->where('id', '=', $s_id);
        $p->where('status', '=', $status);
   })->get();
        $resort = Shelter::orderBy('id', 'desc')->get(); 
        $users = User::orderBy('id', 'desc')->get(); 
        $myself = User::where('id', Auth::user()->id)->get();
        
        $messages = Messages::where('id', $id)->get();

        $update_msg = Messages::where('id', $id)->update(['read' => 1]);
       
        return view('home.read-message', ['settings' => $settings, 'myselfs' => $myself, 'resorts' => $resort, 'users' => $users, 'messages' => $messages]);

        }else{
            $settings = Settings::where('id', 1)->get();
            $error = array("code" => "403",
                           "title" => "Forbidden!",
                           "message" => "You do not have the server privilage to this page! Be warned to avoid being disabled by the admin. Meanwhile, you can return to index page by clicking",
                           "link" => url('/') );
                           return view('home.error', ['settings' => $settings, 'errors' => $error]); 

        }     
}  


public function reply_message($id){
    if(Auth::user()){
        
        $s_id = 1;
      $status = 1;
    $settings = Settings::where(function($p) use($s_id, $status){
        $p->where('id', '=', $s_id);
        $p->where('status', '=', $status);
   })->get();
        $resort = Shelter::orderBy('id', 'desc')->get(); 
        $users = User::orderBy('id', 'desc')->get(); 
        $myself = User::where('id', Auth::user()->id)->get();
        
        $messages = Messages::where('id', $id)->get(); 
       
            return view('home.reply_message', ['settings' => $settings, 'myselfs' => $myself, 'resorts' => $resort, 'users' => $users, 'messages' => $messages]);

        }else{
            $settings = Settings::where('id', 1)->get();
            $error = array("code" => "403",
                           "title" => "Forbidden!",
                           "message" => "You do not have the server privilage to this page! Be warned to avoid being disabled by the admin. Meanwhile, you can return to index page by clicking",
                           "link" => url('/') );
                           return view('home.error', ['settings' => $settings, 'errors' => $error]); 

        }     
}  


public function sent_message($id){
    if(Auth::user()){
        
        $s_id = 1;
      $status = 1;
    $settings = Settings::where(function($p) use($s_id, $status){
        $p->where('id', '=', $s_id);
        $p->where('status', '=', $status);
   })->get();
        $resort = Shelter::orderBy('id', 'desc')->get(); 
        $users = User::orderBy('id', 'desc')->get(); 
        $myself = User::where('id', Auth::user()->id)->get();
        
        $messages = Messages::where('id', $id)->get(); 
       
            return view('home.reply_message', ['settings' => $settings, 'myselfs' => $myself, 'resorts' => $resort, 'users' => $users, 'messages' => $messages]);

        }else{
            $settings = Settings::where('id', 1)->get();
            $error = array("code" => "403",
                           "title" => "Forbidden!",
                           "message" => "You do not have the server privilage to this page! Be warned to avoid being disabled by the admin. Meanwhile, you can return to index page by clicking",
                           "link" => url('/') );
                           return view('home.error', ['settings' => $settings, 'errors' => $error]); 

        }     
}  


public function notification($id){
    if(Auth::user()){
        
        $s_id = 1;
      $status = 1;
    $settings = Settings::where(function($p) use($s_id, $status){
        $p->where('id', '=', $s_id);
        $p->where('status', '=', $status);
   })->get();
        $resort = Shelter::orderBy('id', 'desc')->get(); 
        $users = User::orderBy('id', 'desc')->get(); 
        $myself = User::where('id', Auth::user()->id)->get();
        
        $notification = Notification::where(function($note) use($id){
            $note->where('id', '=', $id);
            $note->where('user_id', '=', Auth::user()->id);
        })->get(); //select query from notification parsing note_id and user_id as params
       
        $update_not = Notification::where('id', $id)->update(['seen' => 1]);
           
        return view('home.notification', ['settings' => $settings, 'myselfs' => $myself, 'resorts' => $resort, 'users' => $users, 'notifications' => $notification]);

        }else{
            $settings = Settings::where('id', 1)->get();
            $error = array("code" => "403",
                           "title" => "Forbidden!",
                           "message" => "You do not have the server privilage to this page! Be warned to avoid being disabled by the admin. Meanwhile, you can return to index page by clicking",
                           "link" => url('/') );
                           return view('home.error', ['settings' => $settings, 'errors' => $error]); 

        }     
} 


public function notification_all(){
    if(Auth::user()){
        
        $s_id = 1;
      $status = 1;
    $settings = Settings::where(function($p) use($s_id, $status){
        $p->where('id', '=', $s_id);
        $p->where('status', '=', $status);
   })->get();
        $resort = Shelter::orderBy('id', 'desc')->get(); 
        $users = User::orderBy('id', 'desc')->get(); 
        $myself = User::where('id', Auth::user()->id)->get();
        
        $notification = Notification::where('user_id', Auth::user()->id)->orderBy('id', 'desc')->get(); 
        $update_not = Notification::where('user_id', Auth::user()->id)->update(['seen' => 1]);
            return view('home.notifications', ['settings' => $settings, 'myselfs' => $myself, 'resorts' => $resort, 'users' => $users, 'notifications' => $notification]);

        }else{
            $settings = Settings::where('id', 1)->get();
            $error = array("code" => "403",
                           "title" => "Forbidden!",
                           "message" => "You do not have the server privilage to this page! Be warned to avoid being disabled by the admin. Meanwhile, you can return to index page by clicking",
                           "link" => url('/') );
                           return view('home.error', ['settings' => $settings, 'errors' => $error]); 

        }     
} 




public function news_letter(){
    if(Auth::user()){
        if(Auth::user()->user_type == "admin" || Auth::user()->role == 1){
        $s_id = 1;
      $status = 1;
    $settings = Settings::where(function($p) use($s_id, $status){
        $p->where('id', '=', $s_id);
        $p->where('status', '=', $status);
   })->get();
        $resort = Shelter::orderBy('id', 'desc')->get(); 
        $users = User::where('user_type', 'member')->orderBy('id', 'desc')->get(); 
        $myself = User::where('id', Auth::user()->id)->get();
        
        $news_letters = NewsLetters::orderBy('id', 'desc')->get(); 
       
            return view('home.news-letter', ['settings' => $settings, 'myselfs' => $myself, 'resorts' => $resort, 'users' => $users, 'news_letters' => $news_letters]);
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


public function admin_gallery(){
    if(Auth::user() && Auth::user()->user_type == "admin" && Auth::user()->role == 1){
        $s_id = 1;
      $status = 1;
    $settings = Settings::where(function($p) use($s_id, $status){
        $p->where('id', '=', $s_id);
        $p->where('status', '=', $status);
   })->get();
        $resort = Shelter::orderBy('id', 'desc')->get(); 
        $users = User::where('user_type', 'member')->orderBy('id', 'desc')->get(); 
        $myself = User::where('id', Auth::user()->id)->get();
        $gallery = Gallery::orderBy('id', 'desc')->get();
       
            return view('home.gallery', ['settings' => $settings, 'myselfs' => $myself, 'resorts' => $resort, 'users' => $users, 'galleries' => $gallery]);
        }else{
            $settings = Settings::where('id', 1)->get();
            $error = array("code" => "403",
                           "title" => "Forbidden!",
                           "message" => "You do not have the server privilage to this page! Be warned to avoid being disabled by the admin. Meanwhile, you can return to index page by clicking",
                           "link" => url('/') );
                           return view('home.error', ['settings' => $settings, 'errors' => $error]); 

        }        
}


public function member_subscription(){
    if(Auth::user() && Auth::user()->user_type == "member" && Auth::user()->dues == 0){
        $s_id = 1;
      $status = 1;
    $settings = Settings::where(function($p) use($s_id, $status){
        $p->where('id', '=', $s_id);
        $p->where('status', '=', $status);
   })->get();
        $resort = Shelter::orderBy('id', 'desc')->get(); 
        
        $myself = User::where('id', Auth::user()->id)->get();
        $blog = Blog::orderBy('id', 'desc')->get();
       
            return view('home.membership_payment', ['settings' => $settings, 'myselfs' => $myself, 'resorts' => $resort, 'blogs' => $blog]);
        }else{
            $settings = Settings::where('id', 1)->get();
            $error = array("code" => "403",
                           "title" => "Forbidden!",
                           "message" => "You do not have the server privilage to this page! Be warned to avoid being disabled by the admin. Meanwhile, you can return to index page by clicking",
                           "link" => url('/') );
                           return view('home.error', ['settings' => $settings, 'errors' => $error]); 

        }       
}


    public function editService( $id ){
        if($id != Auth::user()->id){
        return view('home.error_404');
            }else{
        $services = Service::where('id', $id)->get();
        return view('home.edit-service', ['services' => $services]);
            }
    }

    public function subServiceForm( $id ){
        if(!Auth::user()){
            $this->index();
            }else{
        $services = Service::where('id', $id)->get();
        $subServices = SubService::where('ser_id', $id)->get();
        return view('home.sub-service', ['services' => $services, 'subServices' => $subServices]);
            }
    }

    public function newUser(){
        if(!Auth::user()){
            $this->index();
            }else{
        $users = User::all();
        return view('home.users', ['users' => $users]);
            }
    }

    public function user_edit_form( $id ){
        if(!Auth::user()){
            $this->index();
            }else{
        $users = User::where('id', $id)->get();
        return view('home.edit-users', ['users' => $users]);
            }
    }

    public function content(){
        if(!Auth::user()){
            $this->index();
            }else{
        $content = Content::all();
        return view('home.content', ['contents' => $content]);
            }
    }

    

    

    public function readMessage( $id ){
        if(!Auth::user()){
            $this->index();
            }else{
        $support = Support::where('id', $id)->get();
        return view('home.read-message', ['messages' => $support]);
            }
    }

     public function service_request(){
        if(!Auth::user()){
            $this->index();
            }else{
        $requests = ServiceRequest::orderBy('created_at', 'desc')->get();
        return view('home.request', ['requests' => $requests]);
            }
     }

     public function read_request( $id ){
        if(!Auth::user()){
            $this->index();
            }else{
        $requests = ServiceRequest::where('id', $id)->get();
        return view('home.read-request', ['requests' => $requests]);
            }
     }

     public function site_info(){
        if(!Auth::user()){
            $this->index();
            }else{
        $infos = Info::where('id', 1)->get();
        return view('home.info', ['infos' => $infos]);
            }
     }

     public function userProfile( $id ){
            if($id != Auth::user()->id){
            return view('home.error_403');  
            }else{
            $user = User::where('id', $id)->get();
            return view('home.profile', ['users' => $user]);   
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
