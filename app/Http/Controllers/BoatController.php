<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Boat;
use App\Models\BoatCategory;
use App\Http\Controllers\API\BaseController as BaseController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class BoatController extends BaseController
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

   public function create_categories(Request $request){
    $input = $request->all();
    
    $validator = Validator::make($input, [
        'boat_category' => 'required',
        
          
    ]);

    if($validator->fails()){
        return $this->sendError('Validation Error.', $validator->errors());       
    }

    $check = BoatCategory::where('category', $request->input('boat_category'))->get();

    if(count($check) > 0){
        return $this->showErrorMsg($check[0]->category.' is already added to the list', $check);//return json response         
    }else{
     $insert = new BoatCategory;
     $insert->category = $request->input('boat_category');
     $insert->save();
     return $this->sendResponse($insert, $insert->category.' added succesfully.');
    }

   }

   public function create_new_boat(Request $request){
    $input = $request->all();
    
    $validator = Validator::make($input, [
        'uid' => 'required',
        'category' => 'required',
        'model' => 'required',
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
    
    $insert = new Boat;
    $insert->category = $request->input('category');
    $insert->title = $request->input('model');
    $insert->about = $request->input('desc');
    $insert->curr = $request->input('curr');
    $insert->price = $request->input('price');
    $insert->location = $request->input('location');
    $insert->address = $request->input('address');
    $insert->youtube = $request->input('youtube');
    $insert->created_by = $request->input('uid');
    $insert->save();

    Storage::makeDirectory('public/img/boat/'.$insert->id, 0775);
    
    return $this->sendResponse($insert, ' Boat added succesfully.');
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
