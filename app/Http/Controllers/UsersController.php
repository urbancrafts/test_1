<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\User;
use App\Models\Settings;
use App\Models\Content;
use App\Models\Visited;
use App\Models\SiteActivity;
use App\Models\Services;
use App\Models\Shelter;
use App\Models\Rooms;
use App\Models\Blog;
use App\Http\Controllers\API\BaseController as BaseController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;


class UsersController extends BaseController
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

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

     
   public function activate($id){

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
    
    $users = User::where('id', $id)->get();
    return view('pages.user_activation', ['settings' => $settings, 'contents' => $content,  'users' => $users, 'services' => $services, 'resorts' => $resort, 'blogs' => $blog]); 
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
