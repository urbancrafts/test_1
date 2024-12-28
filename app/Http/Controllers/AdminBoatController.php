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
use App\Models\Settings;
use App\Models\User;
use App\Models\Country;
use App\Models\State;
use App\Models\City;

use App\Models\BoatCategory;

class AdminBoatController extends BaseController
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
         $this->middleware('admin');
     } 

    public function index()
    {
    
        $this->user =  Auth::user();
        $this->settings = Settings::first();
        $myselfs = User::where('id', $this->user->id)->first();//fetch authenticated user data from users database table
        // $business = $this->user->business_account()->orderBy('created_at', 'desc')->get();
       $categories = BoatCategory::orderBy('created_at', 'desc')->get();
        //$blog = Blog::all();
        return view('home.admin.boat_categories', ['settings' => $this->settings, 'myselfs' => $myselfs, 'categories' => $categories]); 

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */

     public function create_categories(Request $request){
        $input = $request->all();
        
        $validator = Validator::make($input, [
            'boat_category' => 'required',
            
              
        ]);
    
        if($validator->fails()){
            return response_data(false, 422, "Sorry a Validation Error Occured", ['errors' => $validator->errors()->all()], false, false);               
        }
    
        $check = BoatCategory::where('category', $request->boat_category)->get();
    
        if(count($check) > 0){
            return response_data(false, 422, $check[0]->category." is already added to the list.", false, false, false);   
        }else{
            $new_boat_category = BoatCategory::create([
                'category' => $request->boat_category
              ]);
              
              if($new_boat_category){
                
                return response_data(true, 200, 'Boat category created successfully.', ['values' => $new_boat_category], false, false);
            }else{
                return response_data(false, 422, "Error occured, please try again later.", false, false, false);  
            }
        }
    
       }


       public function remove_boat_category($feature_id){
        

        $deleteCategory = BoatCategory::where('id', $feature_id)->delete();
        // $deleted = $deleteFeature->delete();

        if($deleteCategory){
        
            return response_data(true, 200, 'Category deleted successfully.', false, false, false);
        }else{
            return response_data(false, 422, "Error occured, please try again later.", false, false, false);  
        }

        
    }


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
