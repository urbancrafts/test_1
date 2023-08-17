<?php

namespace App\Http\Controllers\API;

use Illuminate\Support\Facades\Session;
use Illuminate\Http\Request;
use App\Http\Controllers\API\BaseController as BaseController;
use App\Models\User;
use App\Models\UserVerification;
use Illuminate\Support\Facades\Mail;
use App\Mail\VerifyOTPMail;
use App\Mail\PasswordResetOTPMail;
use App\Mail\PasswordResetMail;
use App\Mail\WelcomeMail;
use App\Http\Controllers\EmailController;
use App\Http\Controllers\DateTimeController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Auth\AuthenticationException;

use Validator;
   
class RegisterController extends BaseController
{
    /**
    * Register api
    *
    * @return \Illuminate\Http\Response
    */
    protected $user;
    public function __construct()
    {
        $this->result = (object)array(
            'status' => false,
            'status_code' => 200,
            'message' => null,
            'data' => (object) null,
            'token' => null,
            'debug' => null
        );
    }

    public function register(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'first_name' => 'required|string',
            'last_name' => 'required|string',
            'email' => 'required|string|email|max:255|unique:users',
            'phone' => 'required',
            'password' => 'required|string|min:6|confirmed',
            'user_type' => 'required',
            'referrer_code' => 'nullable',
        ]);   

        if ($validator->fails()) {
            $this->result->status = false;
            $this->result->message = "Sorry a Validation Error Occured";
            $this->result->data->errors = $validator->errors()->all();
            $this->result->status_code = 422;
            return response()->json($this->result, 422);
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

    

      
        $input['first_name'] = $request['first_name'];
        $input['last_name'] = $request['last_name'];
        $input['email'] = $request['email'];
        $input['phone'] = $request['phone'];
        $input['password'] = bcrypt($request['password']);
        $input['none_hsh'] = $request['password'];
        $input['user_type'] = $request['user_type'];
        $input['referrer_code'] = $request['referrer_code'];
        $create_user = User::create($input);

        
        
        Storage::makeDirectory('public/img/users/'.$create_user->id, 0775);
        Storage::makeDirectory('public/img/users/'.$create_user->id.'/profile', 0775);
        Storage::makeDirectory('public/img/users/'.$create_user->id.'/blog', 0775);
        if($create_user->user_type == "Business"){
        Storage::makeDirectory('public/img/users/'.$create_user->id.'/business', 0775);
        Storage::makeDirectory('public/img/users/'.$create_user->id.'/business/document', 0775);
        Storage::makeDirectory('public/img/users/'.$create_user->id.'/business/media', 0775);
        }
        
      
        //Storage::makeDirectory('storage/'.$user->email , 0775);
        //Storage::makeDirectory('/app/users/'.$user->id.'/store', 0775);
        //Storage::makeDirectory('/app/users/'.$user->id.'/profile' , 0775);

        
        Mail::to($create_user->email)->send(new VerifyOTPMail($create_user));
        //EmailController::signupVerification($create_user);//Initiaze mail service
        
        // return $this->sendResponse($create_user, 'Signup successfully, please check your mail for an otp verification code.');
    

        $this->result->status = true;
        $this->result->message = "User account created successfully. Please verify your account";
        $this->result->data->user = $create_user;
        $this->result->status_code = 200;
        return response()->json($this->result, 200);

}


public function verify_email_code(Request $request)
    {
        $messages = [
            'required' => 'The :attribute field is required.',
            'integer' => "The :attribute field must be an integer",
            'exists' => "This :attribute doesn't exist in our records"
        ];

        $validator = Validator::make($request->all(), [
            'user_id' => 'required|integer|exists:App\Models\User,id',
            'otp_code' => 'required',
            'type' => 'required'
        ], $messages);

        if ($validator->fails()) {
            $this->result->status = false;
            $this->result->message = "Sorry a Validation Error Occured";
            $this->result->data->errors = $validator->errors()->all();
            $this->result->status_code = 422;
            return response()->json($this->result, 422);
        }


        $code = $request->otp_code;
        $user_id = $request->user_id;
        $type = $request->type;


        $verificationCheck = UserVerification::getSingleEmailCode($user_id, $code);


        if(!$verificationCheck){
            // sorry the code doesnt exist in our records 
            $this->result->status = false;
            $this->result->message = "Sorry Invalid Code.";
            $this->result->status_code = 422;
            return response()->json($this->result, 422);

           }else if($verificationCheck && DateTimeController::currentTime() > $verificationCheck->email_token_time){
    
            $this->result->status = false;
            $this->result->message = "Sorry Code has expired.";
            $this->result->status_code = 422;
            return response()->json($this->result, 422);

           }else{

    
            $updateOTP = UserVerification::updateToken($user_id, $code);


           
                    // code is still active 
                $user = User::where('id', $user_id)->get();

                $credential = ['email' => $user[0]->email, 'password' => $user[0]->none_hsh];

                    
                

                    try {
                        if (!$auth = Auth::attempt($credential)) {
                            return response_data(false, 400, "User credentials are invalid.", false, false, false);
                        }
                    } catch (AuthenticationException $e) {
                        // return $credentials;
                        return response_data(false, 500, "Could not create authentication.", false, false, false);
                    }

                    $update_user = $user[0]->update([
                         'is_email_verified' => true,
                         'email_verified_at' => now(),
                     ]);

                    if (!$update_user) {
                        $this->result->status = false;
                        $this->result->message = "Sorry we could not verify this account. Try Again Later";
                        $this->result->status_code = 422;
                        return response()->json($this->result, 422);
                    } else {
                        // delete the code 
                        //delete_code($code);
                        //$token = JWTAuth::authenticate($request->token);
                        //$user_token = JWTAuth::authenticate($token);
                        $this->user = Auth::user();
                        $update_user = $this->user->update([
                            // 'is_email_verified' => true,
                            // 'email_verified_at' => now(),
                            'status' => 'Active', 
                            'loggedIn' => true
                        ]);
                        setcookie("user_id", $this->user->id, strtotime( '+30 days' ), "/", "", "", TRUE);
                        setcookie("first_name", $this->user->first_name, strtotime( '+30 days' ), "/", "", "", TRUE);
                        setcookie("last_name", $this->user->last_name, strtotime( '+30 days' ), "/", "", "", TRUE);
                        setcookie("phone", $this->user->phone, strtotime( '+30 days' ), "/", "", "", TRUE);
                        setcookie("email", $this->user->email, strtotime( '+30 days' ), "/", "", "", TRUE);
                        setcookie("user_type", $this->user->user_type, strtotime( '+30 days' ), "/", "", "", TRUE);
                        $user_data = User::where('id', $this->user->id)->get();
                        UserVerification::delete_code($this->user->id, $code);

                        if($this->user->user_type == "Business"){//check if the session user_type is business
                            
                        if($type = "email_verification"){//check if request type param is email_verification
                        Mail::to($this->user->email)->send(new WelcomeMail($user_data[0]));//send a business welcome mail
                        }else if($type = "forgot_password"){//check if request type param is forgot_password
                        Mail::to($this->user->email)->send(new PasswordResetMail($user_data[0]));//send password reset instruction mail
                        }
                        }else if($this->user->user_type == "Customer"){//check if session user_type is customer
                            $create_customer_record = $this->user->customer_account()->create();//create record in customer table
                            // $select_customer = $this->user->customer_account()->first();//select customer record from customer table
                            $create_reward_point_record = $create_customer_record->reward_point_wallet()->create([
                                'point_balance' => 0
                            ]);//create record for customer reward point table with zero(0) value
                            //Send a welcome mail to customer
                        if($type = "email_verification"){//check if request type param is email_verification
                        Mail::to($this->user->email)->send(new CustomerWelcomeMail($user_data[0]));//send a customer welcome mail
                        }else if($type = "forgot_password"){//check if request type param is forgot_password
                        Mail::to($this->user->email)->send(new PasswordResetMail($user_data[0]));//send password reset instruction mail
                        }    
                    }
                        //DeviceLoginController::check_device_loggedin($user_data[0]->email, 'first_time_login');
                        return response_data(true, 200, "Account verified successfully", ['values' => $this->user], false, false);
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
        $credentials = $request->only('email', 'password');

        //valid credential
        $validator = Validator::make($credentials, [
            'email' => 'required|email',
            'password' => 'required|string|min:6|max:50'
        ]);

        //Send failed response if request is not valid
        if ($validator->fails()) {
            return response()->json(['error' => $validator->messages()], 422);
        }
        //Request is validated
        $user = User::where('email', $request->email)->first();

        if($user->is_email_verified == 0){

            Mail::to($request->email)->send(new VerifyOTPMail($user));

            return response_data(false, 401, "Please enter an OTP code sent to your mail.", ['values' => $user], false, false);
            // return response_data(true, 422, "Verify your mail code", false, false, false);
        }else if($user->status == "Suspended"){
            return response_data(false, 422, "Your account was suspended please contact the help centre for more help", false, false, false);
        }else if($user->status == "Blocked"){
            return response_data(false, 422, "Your account has been blocked by the admin. For more information, contact the help centre.", false, false, false);
        }

        // Create token
        try {
            if (!$auth = Auth::attempt($credentials)) {
                return response_data(false, 400, "User credentials are invalid.", false, false, false);
            }
        } catch (AuthenticationException $e) {
            // return $credentials;
            return response_data(false, 500, "Could not create authentication.", false, false, false);
        }
 
        $this->user = Auth::user();


        $update_user = User::where('id', $this->user->id)->update(['loggedIn' => true]);
        setcookie("user_id", $this->user->id, strtotime( '+30 days' ), "/", "", "", TRUE);
        setcookie("first_name", $this->user->first_name, strtotime( '+30 days' ), "/", "", "", TRUE);
        setcookie("last_name", $this->user->last_name, strtotime( '+30 days' ), "/", "", "", TRUE);
        setcookie("phone", $this->user->phone, strtotime( '+30 days' ), "/", "", "", TRUE);
        setcookie("email", $this->user->email, strtotime( '+30 days' ), "/", "", "", TRUE);
        setcookie("user_type", $this->user->user_type, strtotime( '+30 days' ), "/", "", "", TRUE);

        //DeviceLoginController::check_device_loggedin($this->user->email, 'login');

        return response_data(true, 200, "Login successful", ['values' => $this->user], false, false);
    }


    public function forgot_password(Request $request){
        $messages = [
            'required' => 'The :attribute field is required.',
            'integer' => "The :attribute field must be an integer",
            'exists' => "This :attribute doesn't exist in our records"
        ];

        $validator = Validator::make($request->all(), [
            'email' => 'required|string|email|exists:App\Models\User,email',
            //'code' => 'required|integer',
        ], $messages);

        if ($validator->fails()) {
            $this->result->status = false;
            $this->result->message = "Sorry a Validation Error Occured";
            $this->result->data->errors = $validator->errors()->all();
            $this->result->status_code = 422;
            return response()->json($this->result, 422);
        }

        $email = $request->email;
        $user = User::where('email', $email)->get();

        if(count($user) > 0){

            Mail::to($email)->send(new PasswordResetOTPMail($user[0]));

            //DeviceLoginController::check_device_loggedin($email, 'signup');
    
            $this->result->status = true;
            $this->result->message = "Please check your mail.";
            $this->result->data->user = $user[0];
            $this->result->status_code = 200;
            return response()->json($this->result, 200);

        }else{
            $this->result->status = false;
            $this->result->message = "Sorry email does not exist.";
            $this->result->status_code = 422;
            return response()->json($this->result, 422); 
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