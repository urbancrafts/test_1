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

use App\Models\AdminResortFeatures;

class AdminResortController extends BaseController
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

    

    public function index(){
        $this->user =  Auth::user();
        $this->settings = Settings::first();
        $myselfs = User::where('id', $this->user->id)->first();//fetch authenticated user data from users database table
        // $business = $this->user->business_account()->orderBy('created_at', 'desc')->get();
       $features = AdminResortFeatures::orderBy('created_at', 'desc')->get();
        //$blog = Blog::all();
        return view('home.admin.resort_features', ['settings' => $this->settings, 'myselfs' => $myselfs, 'features' => $features]);
    }




    public function create_resort_feature(Request $request){
        $input = $request->all();

        $validator = Validator::make($input, [
            'resort_feature' => 'required',
        ]);

        if($validator->fails()){
            return response_data(false, 422, "Sorry a Validation Error Occured", ['errors' => $validator->errors()->all()], false, false);                
        }
      
      $checkFeature = AdminResortFeatures::where('feature', $request->resort_feature)->get();
      if(count($checkFeature) > 0){
        return response_data(false, 422, $request->resort_feature." is already added to the list.", false, false, false);   
      }else{
      $newFeature = AdminResortFeatures::create([
        'feature' => $request->resort_feature
      ]);
      
      if($newFeature){
        
        return response_data(true, 200, 'Resort feature created successfully.', ['values' => $newFeature], false, false);
    }else{
        return response_data(false, 422, "Error occured, please try again later.", false, false, false);  
    }

      }
    }

    public function remove_resort_feature($feature_id){
        // $input = $request->all();

        // $validator = Validator::make($input, [
        //     'feature_id' => 'required',
        //     'feature_name' => 'required',
        // ]);

        // if($validator->fails()){
        //     return $this->showErrorMsg('Validation Error.', $validator->errors());       
        // }

        $deleteFeature = AdminResortFeatures::where('id', $feature_id)->delete();
        // $deleted = $deleteFeature->delete();

        if($deleteFeature){
        
            return response_data(true, 200, 'Feature deleted successfully.', false, false, false);
        }else{
            return response_data(false, 422, "Error occured, please try again later.", false, false, false);  
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
