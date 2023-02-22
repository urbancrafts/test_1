<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Services;
use App\Models\ServiceCategory;
use App\Http\Controllers\API\BaseController as BaseController;
use App\Http\Controllers\DateManagerController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\ Mail;
use Intervention\Image\ImageManagerStatic as Image;

class ServiceController extends BaseController
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */


    public function create_categories(Request $request){
        $input = $request->all();
        
        $validator = Validator::make($input, [
            'service_category' => 'required',    
        ]);
    
        if($validator->fails()){
            return $this->sendError('Validation Error.', $validator->errors());       
        }
    
        $check = ServiceCategory::where('category', $request->input('service_category'))->get();
    
        if(count($check) > 0){
            return $this->showErrorMsg($check[0]->category.' is already added to the list', $check);//return json response         
        }else{
         $insert = new ServiceCategory;
         $insert->category = $request->input('service_category');
         $insert->save();
         return $this->sendResponse($insert, $insert->category.' added succesfully.');
        }
    
       }


    
       public function create_new_service(Request $request){
        $input = $request->all();
        
        $validator = Validator::make($input, [
            'uid' => 'required',
            'category' => 'required',
            'name' => 'required',
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
        
        $insert = new Services;
        $insert->category = $request->input('category');
        $insert->title = $request->input('name');
        $insert->about = $request->input('desc');
        $insert->curr = $request->input('curr');
        $insert->price = $request->input('price');
        $insert->location = $request->input('location');
        $insert->address = $request->input('address');
        $insert->youtube = $request->input('youtube');
        $insert->created_by = $request->input('uid');
        $insert->save();
    
        Storage::makeDirectory('public/img/services/'.$insert->id, 0775);
        
        return $this->sendResponse($insert, ' Service added succesfully.');
       }
    
    
    
       public function update_service_img(Request $request){
        $input = $request->all();
        
        $validator = Validator::make($input, [
            'service' => 'required',
            'img_1' => 'required|image|mimes:jpeg,png,jpg,gif|max:6144',
        ]);
    
        if($validator->fails()){
            return $this->sendError('Validation Error.', $validator->errors());       
        }
    
        $service = Services::where('id', $request->input('service'))->get();
    
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
    
            $destinationPath = public_path('storage/img/services/'.$request->input('service'));
    
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
    
            $dir = asset('storage/img/services/'.$service[0]->id);
            
            if ($service[0]->images) {
    
                $getServerImg = json_decode($service[0]->images, true);
    
                $getServerImg[] = $dir.'/'.$fileNameToStore;
    
            } else {
    
                $getServerImg = array();
    
                $getServerImg[] = $dir.'/'.$fileNameToStore;
    
            }
    
    
    
            $update_service_img = Services::where('id', $request->input('service'))->update([
                'img_1' => $getServerImg[0],
                'images' => json_encode($getServerImg)
            ]);
    
        if($update_service_img){
         //Redirect::url('admin/edit_resort_img/'.$resort[0]->id);
         return $this->sendResponse($update_service_img, 'Image uploaded succesfully.');
        }
    
       }
    
    
       public function remove_service_img(Request $request){
    
        $input = $request->all();
        
        $validator = Validator::make($input, [
            'service' => 'required',
            'key_num' => 'required',
        ]);
    
        //$id = Input::get('resort'); 
    
        //$arrID = Input::get('arrID');
    
    
    
        $service = Services::where('id', $request->input('service'))->get();
    
        $getServerImg = json_decode($service[0]->images, true);
    
    
    
        unset($getServerImg[$request->input('key_num')]);
    
    
    
        $update = Services::where('id', $request->input('service'))->update([
    
            'images' => json_encode($getServerImg)
    
        ]);
    
    
    
        if ($update) {
    
            return $this->sendResponse($update, 'Image removed succesfully.');
    
        }
    
    
    }
    
    
    
    public function update_service(Request $request){
        $input = $request->all();
    
        $validator = Validator::make($input, [
            'service' => 'required',
            'price' => 'nullable',
            'name' => 'required',
            'location' => 'nullable',
            'address' => 'nullable',
            'desc' => 'nullable',
            'youtube' => 'nullable',
            'curr' => 'nullable',
        ]);
    
        if($validator->fails()){
            return $this->sendError('Validation Error.', $validator->errors());       
        }
    
        
    $service = Services::where('id', $request->input('service'))->update(['title' => $request->input('name'), 
                                                                   'location' => $request->input('location'), 
                                                                   'address' => $request->input('address'), 
                                                                   'about' => $request->input('desc'), 
                                                                   'price' => $request->input('price'), 
                                                                   'curr' =>  $request->input('curr'),
                                                                   'youtube' => $request->input('youtube')]);
    if($service){                 
    return $this->sendResponse($service, 'service info updated succesful.'); 
    } 
    }
    
    public function delete_service(Request $request){
        $boat = Services::find($request->input('id'));
        $boat->delete();
        return $this->sendResponse($boat, ' deleted.'); 
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
