<?php

namespace App\Http\Controllers\API;

use Illuminate\Support\Facades\Session;
use Illuminate\Http\Request;
use App\Http\Controllers\API\BaseController as BaseController;
use App\Models\User;
use App\Models\UserVerification;
use App\Http\Controllers\EmailController;
use App\Http\Controllers\DateTimeController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Validator;
   
class RegisterController extends BaseController
{
    /**
    * Register api
    *
    * @return \Illuminate\Http\Response
    */
    public function register(Request $request)
    {
        $input = $request->all();
        $validator = Validator::make($input, [
            'title' => 'required',
            'name' => 'required',
            'email' => 'required|email',
            'phone' => 'required',
            'pass' => 'required|min:6',
            'user_type' => 'required',
            
        ]);
   
        if($validator->fails()){
            return $this->sendError('Validation Error.', $validator->errors());       
        }
   /************************************************
        $input = $request->all();
        if($input['role'] == 1){
        $input['role'] = 1; // Super Admin role identification
        }else if($input['role'] == 2){
        $input['role'] = 2; // Admin role identification
        }else if($input['role'] == 3){
        $input['role'] = 3; // Merchant role identification
        }
    ************************************************/

    $checkEmail = User::where('email', $request->input('email'))->get();
    $checkPhone = User::where('phone', $request->input('phone'))->get();

      if(count($checkEmail) > 0){//if query count is greater than zero
        return $this->showErrorMsg('Email address already exists', 'Error');
      }else if(count($checkPhone) > 0){
        return $this->showErrorMsg('Phone number already exists', 'Error');
      }else{

        $input['password'] = bcrypt($input['pass']);
        $input['unhash_pass'] = $input['pass'];
        $create_user = User::create($input);

        $success['token'] =  $create_user->createToken('MyApp')-> accessToken;
        $success['user_id'] =  $create_user->id;
        $success['name'] = $create_user->name;
        $success['phone'] = $create_user->phone;
        $success['email'] =  $create_user->email;
        $success['country'] =  $create_user->country;
        $success['state'] =  $create_user->state;
        $success['img'] =  $create_user->img;
        $success['about'] =  $create_user->about;
        $success['profession'] =  $create_user->profession;
        $success['role']  =  $create_user->role;
        $success['user_type'] = $create_user->user_type;
        $success['privilege']  =  $create_user->privilege;
        $success['privilege_2'] = $create_user->privilege_2;
        $success['position']  =  $create_user->position;
        $success['admin'] = $create_user->admin;
        $success['dues']  =  $create_user->dues;
        $success['status'] = $create_user->status;
        $success['role']  =  $create_user->role;
        $success['loggedIn'] = $create_user->loggedIn;
       
        Storage::makeDirectory('public/img/users/'.$create_user->id, 0775);
        Storage::makeDirectory('public/img/users/'.$create_user->id.'/profile', 0775);
        Storage::makeDirectory('public/img/users/'.$create_user->id.'/blog', 0775);
      
        //Storage::makeDirectory('storage/'.$user->email , 0775);
        //Storage::makeDirectory('/app/users/'.$user->id.'/store', 0775);
        //Storage::makeDirectory('/app/users/'.$user->id.'/profile' , 0775);

        
        
        EmailController::signupVerification($create_user);//Initiaze mail service
        
        return $this->sendResponse($success, 'Signup success: please check your mail for an otp verification code.');
    }

}


//OTP authentication api endpoin
public function confirm_otp(Request $request){
    $input = $request->all();
    $validator = Validator::make($input, [
        'uid' => 'required',
        'otp_code' => 'required',
        
    ]);

    if($validator->fails()){
        return $this->sendError('Validation Error.', $validator->errors());       
    }

    //$verify = UserVerification::where()
      /*****************************************
      $uid = $request->input('uid');
      $code = $request->input('otp_code');
      $verificationCheck = UserVerification::where(function($p) use($uid, $code){
        $p->where('uid', '=', $uid);
        $p->where('email_code', '=', $code);
       })->get();

       ***************************************/
      $verificationCheck = UserVerification::getSingleEmailCode($request->input('uid'), $request->input('otp_code'));

       if(!$verificationCheck){
        $result = 'Oops! Incorrect token';
        return $this->showErrorMsg($result, 'Error');  
       }else if($verificationCheck && DateTimeController::currentTime() > $verificationCheck->email_token_time){

        $result = 'Oops! Token expired';
        return $this->showErrorMsg($result, 'Error');
       }else{

        $updateOTP = UserVerification::updateToken($request->input('uid'), $request->input('otp_code'));
        


        $user = User::where('id', $request->input('uid'))->get();

        $credential = ['email' => $user[0]->email, 'password' => $user[0]->unhash_pass];
        $credential2 = ['phone' => $user[0]->phone, 'password' => $user[0]->unhash_pass];

        

        
        //$credential2 = ['phone' => $user[0]->phone, 'password' => $request->pass];
        if(Auth::attempt($credential) || Auth::attempt($credential2)){ 
        $user_auth = Auth::user(); 
        $update_user = User::where('id', $user_auth->id)->update(['status' => 'Active', 'loggedIn' => 1]);
       //select all from AdminWalletSettings table
        
        $success['token'] =  $user_auth->createToken('MyApp')-> accessToken;
        $success['user_id'] =  $user_auth->id;
        $success['name'] = $user_auth->name;
        $success['phone'] = $user_auth->phone;
        $success['email'] =  $user_auth->email;
        $success['country'] =  $user_auth->country;
        $success['state'] =  $user_auth->state;
        $success['img'] =  $user_auth->img;
        $success['about'] =  $user_auth->about;
        $success['profession'] =  $user_auth->profession;
        $success['role']  =  $user_auth->role;
        $success['user_type'] = $user_auth->user_type;
        $success['privilege']  =  $user_auth->privilege;
        $success['privilege_2'] = $user_auth->privilege_2;
        $success['position']  =  $user_auth->position;
        $success['admin'] = $user_auth->admin;
        $success['dues']  =  $user_auth->dues;
        $success['status'] = $user_auth->status;
        $success['role']  =  $user_auth->role;
        $success['loggedIn'] = $user_auth->loggedIn;

       setcookie("user_id", $success['user_id'], strtotime( '+30 days' ), "/", "", "", TRUE);
       setcookie("name", $success['name'], strtotime( '+30 days' ), "/", "", "", TRUE);
       setcookie("phone", $success['phone'], strtotime( '+30 days' ), "/", "", "", TRUE);
       setcookie("email", $success['email'], strtotime( '+30 days' ), "/", "", "", TRUE);
       setcookie("role", $success['role'], strtotime( '+30 days' ), "/", "", "", TRUE);

        //call userWelcome static method to push a new signup welcome mail
        EmailController::userWelcome($user);//Initiaze mail service

        return $this->sendResponse($success, 'otp verification is succesful.');

       }else{
        return $this->showErrorMsg('Your user record not found.', 'Error');
       }
    }

  }
   
    /**
    * Login api
    *
    * @return \Illuminate\Http\Response
    */
    public function login(Request $request)
    {
        $this->validate($request, ['loginId' => 'required', 'pass' => 'required|min:6']);
        
        $credential = ['email' => $request->loginId, 'password' => $request->pass];

        $credential2 = ['phone' => $request->loginId, 'password' => $request->pass];

        if(Auth::attempt($credential) || Auth::attempt($credential2)){ 
            $user = Auth::user(); 
            $status = User::where('id', $user->id)->update(['loggedIn' => 1]);
            
            if($user->role == 1 || $user->role == 2){
                session_start();
                $_SESSION['loggedIn'] = true;
                $_SESSION['token'] =  $user->createToken('MyApp')-> accessToken;
                $_SESSION['user_id'] =  $user->id;
                $_SESSION['name'] = $user->name;
                $_SESSION['phone'] = $user->phone;
                $_SESSION['email'] =  $user->email;
                $_SESSION['role']  =  $user->role;
                $_SESSION['user_type'] = $user->user_type;
                $_SESSION['verified'] = $user->verified;
                $_SESSION['isActive'] = $user->isActive;

        setcookie("user_id", $_SESSION['user_id'], strtotime( '+30 days' ), "/", "", "", TRUE);
		setcookie("name", $_SESSION['name'], strtotime( '+30 days' ), "/", "", "", TRUE);
		setcookie("phone", $_SESSION['phone'], strtotime( '+30 days' ), "/", "", "", TRUE);
		setcookie("email", $_SESSION['email'], strtotime( '+30 days' ), "/", "", "", TRUE);
		setcookie("role", $_SESSION['role'], strtotime( '+30 days' ), "/", "", "", TRUE);

                return $this->sendResponse($_SESSION, 'User login successfully.');
            }

            return $this->sendError('Unauthorised.', ['error'=>'Does not belong here. Ensure you are a registered Admin.']);
        } 
        else{ 
            return $this->showErrorMsg('Error', 'Invalid login credentials');//return json response   
        } 
    }

    public function logout($request)
    {
        session_start();
        unset($_SESSION['user_id']);
        unset($_SESSION['token']);
        unset($_SESSION['username']);
        unset($_SESSION['email']);
        unset($_SESSION['status']);
        unset($_SESSION['role']);
        session_destroy();
        
        if(User::where('id', $request)->update(['status' => 0])){
            $status = 0;
        }
        $success['status'] = $status;

        return $this->sendResponse($success, 'successfully logged out.');
    }

     public function activateUsers($request){

     }

     public function deactivateUsers($request){
     
     }
    
}