<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Settings;
use App\Models\User;
use App\Models\Shelter;
use App\Models\Rooms;
use App\Models\ResortFeatures;
use App\Models\AdminResortFeatures;
use App\Models\roomNumber;
use App\Http\Controllers\API\BaseController as BaseController;
use App\Http\Controllers\DateManagerController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\ Mail;
use Intervention\Image\ImageManagerStatic as Image;

class Room {

}

class ResortController extends BaseController
{

    public function create_resort_feature(Request $request){
        $input = $request->all();

        $validator = Validator::make($input, [
            'resort-feature' => 'required',
        ]);

        if($validator->fails()){
            return $this->showErrorMsg('Validation Error.', $validator->errors());       
        }
      
      $checkFeature = AdminResortFeatures::where('feature', $request->input('resort-feature'))->get();
      if(count($checkFeature) > 0){
      return $this->showErrorMsg($checkFeature[0]->feature.' is already on the list', $checkFeature);//return json response      
      }else{
      $newFeature = new AdminResortFeatures;
      $newFeature->feature = $request->input('resort-feature');
      $newFeature->save();
      return $this->sendResponse($newFeature, 'A new resort feature added.');
      }
    }

    public function remove_resort_feature(Request $request){
        $input = $request->all();

        $validator = Validator::make($input, [
            'feature_id' => 'required',
            'feature_name' => 'required',
        ]);

        if($validator->fails()){
            return $this->showErrorMsg('Validation Error.', $validator->errors());       
        }

        $deleteFeature = AdminResortFeatures::find($request->input('feature_id'));
        $deleteFeature->delete();
        return $this->sendResponse('success', $request->input('feature_name').' is removed from the list.');
    }
    
    public function create_new_resort(Request $request){//new resort form request
        $input = $request->all();//form request input handler

        $validator = Validator::make($input, [//input field validator
            'name' => 'required',
            'location' => 'required',
            'address' => 'nullable',
            'desc' => 'nullable',
            'price' => 'nullable',
            'curr' => 'nullable', 
            //'feature' => 'nullable',
            //'img_1' => 'required|image|mimes:jpeg,png,jpg,gif|max:6144',
            //'img_2' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:6144',
            //'img_3' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:6144',
            //'img_4' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:6144',
            //'img_5' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:6144',
            //'img_6' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:6144',
            //'img_7' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:6144',
            //'img_8' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:6144',
            'youtube' => 'nullable',
            'uid' => 'required',    
        ]);

        if($validator->fails()){
            return $this->sendError('Validation Error.', $validator->errors());       
        }
        //insert into shelter table model, parse form fields variables
        $resort = new Shelter;
        $resort->name = $request->input('name');
        $resort->location = $request->input('location');
        $resort->address = $request->input('address');
        $resort->descr = $request->input('desc');
        $resort->price = $request->input('price');
        $resort->curr = $request->input('curr');
        $resort->youtube = $request->input('youtube');
        $resort->created_by = $request->input('uid');
        $resort->save();//save data

     //create resort directory and sub directories 
     Storage::makeDirectory('public/img/resorts/'.$resort->id, 0775);
     Storage::makeDirectory('public/img/resorts/'.$resort->id.'/images', 0775);
     Storage::makeDirectory('public/img/resorts/'.$resort->id.'/rooms', 0775);

        return $this->sendResponse($resort, 'Resort created succesfully.');

    }


   public function update_resort_img(Request $request){
    $input = $request->all();
    
    $validator = Validator::make($input, [
        'resort' => 'required',
        'img_1' => 'required|image|mimes:jpeg,png,jpg,gif|max:6144',
    ]);

    if($validator->fails()){
        return $this->sendError('Validation Error.', $validator->errors());       
    }

    $resort = Shelter::where('id', $request->input('resort'))->get();

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

        $destinationPath = public_path('storage/img/resorts/'.$request->input('resort').'/images');

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

        $dir = asset('storage/img/resorts/'.$resort[0]->id.'/images');
        
        if ($resort[0]->images) {

            $getServerImg = json_decode($resort[0]->images, true);

            $getServerImg[] = $dir.'/'.$fileNameToStore;

        } else {

            $getServerImg = array();

            $getServerImg[] = $dir.'/'.$fileNameToStore;

        }



        $update_resort_img = Shelter::where('id', $request->input('resort'))->update([
            'img_1' => $getServerImg[0],
            'images' => json_encode($getServerImg)
        ]);

    if($update_resort_img){
     //Redirect::url('admin/edit_resort_img/'.$resort[0]->id);
     return $this->sendResponse($update_resort_img, 'Image uploaded succesfully.');
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
    
    $validator = Validator::make($input, [
        'resort' => 'required',
        //'img_1' => 'required|image|mimes:jpeg,png,jpg,gif|max:6144',
        'feature' => 'nullable',
    ]);

    if($validator->fails()){
        return $this->sendError('Validation Error.', $validator->errors());       
    }

     $features = ResortFeatures::where('resort_id', $request->input('resort'))->get();

    if(count($features) > 0){
     if ($features[0]->features) {

        $getServerImg = json_decode($features[0]->features, true);

        foreach($request->input('feature') as $feature){
            $getServerImg[] = $feature;
            }

        //$getServerImg[] = $request->input('feature');

    } else {

        $getServerImg = array();

        //$getServerImg[] = $request->input('feature');

        foreach($request->input('feature') as $feature){
            $getServerImg[] = $feature;
            }

    }

    $update_resort_feature = ResortFeatures::where('resort_id', $request->input('resort'))->update([
        'features' => json_encode($getServerImg)
    ]);

    if($update_resort_feature){
        $data = array('resort_id' => $request->input('resort'));
        //Redirect::url('admin/edit_resort_img/'.$resort[0]->id);
        return $this->sendResponse($data, 'Features updated succesfully.');
       }

}else{
    $getServerImg = array();

    //$feature = json_decode($request->input('feature'), true);

    foreach($request->input('feature') as $feature){
    $getServerImg[] = $feature;
    }
    $update_resort_feature = new ResortFeatures;
    $update_resort_feature->resort_id = $request->input('resort');
    $update_resort_feature->features =  json_encode($getServerImg);
    $update_resort_feature->save();

    if($update_resort_feature){
        //Redirect::url('admin/edit_resort_img/'.$resort[0]->id);
        return $this->sendResponse($update_resort_feature, 'Features updated succesfully.');
       }

}



    
   }


   public function remove_resort_user_feature(Request $request){
    $input = $request->all();
    
    $validator = Validator::make($input, [
        'resort' => 'required',
        'key_num' => 'required',
    ]);

    if($validator->fails()){
        return $this->sendError('Validation Error.', $validator->errors());       
    }

     $features = ResortFeatures::where('resort_id', $request->input('resort'))->get();

    
     $getServerImg = json_decode($features[0]->features, true);



    unset($getServerImg[$request->input('key_num')]);//unset object number of the array


    //update resort_features table
    $update = ResortFeatures::where('resort_id', $request->input('resort'))->update([

        'features' => json_encode($getServerImg)

    ]);



    if ($update) {

        return $this->sendResponse($update, 'Image removed succesfully.');

    }


    
   }


    public function update_resort_input(Request $request){
        $input = $request->all();
    
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
            return $this->sendError('Validation Error.', $validator->errors());       
        }
    
        
$resort2 = Shelter::where('id', $request->input('resort'))->update(['name' => $request->input('name'), 
                                                                   'location' => $request->input('location'), 
                                                                   'address' => $request->input('address'), 
                                                                   'descr' => $request->input('desc'), 
                                                                   'price' => $request->input('price'), 
                                                                   'curr' =>  $request->input('curr'),
                                                                   'youtube' => $request->input('youtube')]);
if($resort2){                 
return $this->sendResponse($resort2, 'resort info updated succesful.'); 
} 
    }




    public function upload_rooms_info(Request $request){
        $input = $request->all();
    
        $validator = Validator::make($input, [
            'resort' => 'required',
            'curr' => 'required',
            'name' => 'required',
            'price' => 'nullable',
            'desc' => 'required',
            'qnty' => 'required',
            'capacity' => 'required',
            'location' => 'nullable',
              
        ]);
    
        if($validator->fails()){
            return $this->sendError('Validation Error.', $validator->errors());       
        }
    
        $room = new Rooms;
        $room->shelter_id = $request->input('resort');
        $room->room_no = $request->input('name');
        $room->descr = $request->input('desc');
        $room->qnty = $request->input('qnty');
        $room->capacity = $request->input('capacity');
        $room->amount = $request->input('price');
        $room->curr = $request->input('curr');
        $room->location = $request->input('location');
        $room->created_by = Auth::user()->id;
        $room->save();
    
        Storage::makeDirectory('public/img/resorts/'.$request->input('resort').'/rooms/'.$room->id, 0775);
          
        return $this->sendResponse($room, 'Room created succesfully.');  
    
    }

public function update_resort_room_img(Request $request){
 
    $input = $request->all();
    
        $validator = Validator::make($input, [
            'resort' => 'required',
            'room' => 'required',
            
            'img_1' => 'required|image|mimes:jpeg,png,jpg,gif|max:6144',
               
        ]);
    
        if($validator->fails()){
            return $this->sendError('Validation Error.', $validator->errors());       
        }

    $rooms = Rooms::where('id', $request->input('room'))->get();

    if($request->hasFile('img_1')){
        //get filename with the extension
        $fileNameWithExt = $request->file('img_1')->getClientOriginalName();
        //get just filename
        $filename = pathinfo($fileNameWithExt, PATHINFO_FILENAME);
        //get just ext
        $extension = $request->file('img_1')->getClientOriginalExtension();
        //filename to store
        $fileNameToStore = str_replace(' ', '_', $filename).'_'.time().'.'.$extension;
        $path = $request->file('img_1')->storeAs('public/img/resorts/'.$rooms[0]->shelter_id.'/rooms/'.$rooms[0]->id, $fileNameToStore);

        }else{
        $fileNameToStore = "";
        }

    
        $dir = asset('storage/img/resorts/'.$rooms[0]->shelter_id.'/rooms/'.$rooms[0]->id);
        
        if ($rooms[0]->images) {

            $getServerImg = json_decode($rooms[0]->images, true);

            $getServerImg[] = $dir.'/'.$fileNameToStore;

        } else {

            $getServerImg = array();

            $getServerImg[] = $dir.'/'.$fileNameToStore;

        }



        $update_room_img = Rooms::where('id', $request->input('room'))->update([
            'img_1' => $getServerImg[0],
            'images' => json_encode($getServerImg)
        ]);

    if($update_room_img){
     //Redirect::url('admin/edit_resort_img/'.$resort[0]->id);
     return $this->sendResponse($update_room_img, 'Image uploaded succesfully.');
    }


    
}


public function remove_resort_room_img(Request $request){

    $input = $request->all();
    
    $validator = Validator::make($input, [
        'room' => 'required',
        'key_num' => 'required',
    ]);

    //$id = Input::get('resort'); 

    //$arrID = Input::get('arrID');



    $rooms = Rooms::where('id', $request->input('room'))->get();

    $getServerImg = json_decode($rooms[0]->images, true);



    unset($getServerImg[$request->input('key_num')]);



    $update = Rooms::where('id', $request->input('room'))->update([

        'images' => json_encode($getServerImg)

    ]);



    if ($update) {

        return $this->sendResponse($update, 'Image removed succesfully.');

    }

}


//
public function update_rooms_info(Request $request){
        $input = $request->all();
    
        $validator = Validator::make($input, [
            'resort' => 'required',
            'room' => 'required',
            'name' => 'required',
            'price' => 'nullable',
            'desc' => 'required',
            'qnty' => 'required',
            'capacity' => 'required',
            'location' => 'nullable',    
        ]);
    
        if($validator->fails()){
            return $this->sendError('Validation Error.', $validator->errors());       
        }
    
        $room = Rooms::find($request->input('room'));
        $room->shelter_id = $request->input('resort');
        $room->room_no = $request->input('name');
        $room->descr = $request->input('desc');
        $room->qnty = $request->input('qnty');
        $room->capacity = $request->input('capacity');
        $room->amount = $request->input('price');
        $room->location = $request->input('location');
        $room->save();
     return $this->sendResponse($room, 'Room updates succesfully.');  
    }


    public function delete_resort(Request $request){
        $resort = Shelter::find($request->input('uid'));
        $resort->delete();
        $room = DB::table('rooms')->where('shelter_id', $resort->id)->delete();
        return $this->sendResponse($resort, 'resort deleted.');
    }
    
    public function delete_room(Request $request){
      $room = Rooms::find($request->input('uid'));
      $room->delete();
      return $this->sendResponse($room, 'room deleted.');
    }


    public function sub_room_create(Request $request){
        $input = $request->all();
    
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

    $checkRoom = roomNumber::where(function($p) use($resort_id, $room_id, $room){
        $p->where('resort_id', '=', $resort_id);
        $p->where('room_id', '=', $room_id);
        $p->where('name', '=', $room);
   })->get();//query roomNumber model table
   if(count($checkRoom) > 0){
       return $this->showErrorMsg($checkRoom[0]->name.' already exist under this category', $checkRoom);
   }else{
    $subRoom = new roomNumber;
    $subRoom->resort_id = $request->input('resort_id');
    $subRoom->room_id = $request->input('room_id');
    $subRoom->name = $request->input('room');
    $subRoom->capacity = $request->input('capacity');
    $subRoom->status = "Ready";
    $subRoom->save();
    //header('Content-Type: application/json');
    //echo json_encode($subRoom);
    return $this->sendResponse($subRoom, 'room added.');
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

    $checkRoom = roomNumber::where(function($p) use($resort_id, $room_id){
        $p->where('resort_id', '=', $resort_id);
        $p->where('room_id', '=', $room_id);
        
   })->get();//query roomNumber model table
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
