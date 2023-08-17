<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model as Eloquent;
use App\Http\Controllers\SettingsController;
use App\Http\Controllers\DateTimeController;
use App\Models\User;
class UserVerification extends Eloquent
{
    use HasFactory;


    protected $fillable = [ 
        'id',
        'email_code', 
        'email_verified',
        'email_token_time',
        'sms_code', 
        'sms_verified',
        'sms_token_time',
        'user_id',
        'created_at',
        'updated_at',
    ];
    
    protected $table = 'user_verifications';
    protected $casts = [ 
        'id' => 'integer', 
        'user_id' => 'integer', 
        //'email_verified' => 'integer', 
        //'sms_verified' => 'integer', 
    ];
    protected $dates = [
        'created_at',
        'updated_at',
    ];


    public function user(){
        return $this->belongsTo(User::class, 'user_id', 'id');
    }

    public static function insertEmailCode($userID=null){
        return self::create([
            'email_code' => SettingsController::randomNums(3).SettingsController::randomNums(3),
            'email_token_time' => DateTimeController::addDate('3 hours'),
            'user_id' => $userID
        ]); 
    }


    public static function forgotPasswordCode($userID=null){
        return self::create([
            'email_code' => $userID.'_'.SettingsController::randomNums(20),
            'email_token_time' => DateTimeController::addDate('1 hours'),
            'user_id' => $userID
        ]); 
    }


    public static function insertSMSCode($userID=null){
        return self::create([
            'sms_code' => SettingsController::randomNums(8),
            'sms_token_time' => DateTimeController::addDate('3 hours'),
            'user_id' => $userID
        ]);
    }

    public static function getSingle($code){
        return self::where('email_code', $code)->Orwhere('sms_code', $code)->first();
    }

    public static function getSingleEmailCode($userID, $code){
        return self::where('email_code', $code)->where('user_id', $userID)->first();
    }


    public static function updateToken($userID, $code){
        return self::where('user_id', $userID)->where('email_code', $code)->update([
            'email_verified' => 1
        ]);
    }

    public static function delete_code($userID, $code){
        return self::where('user_id', $userID)->where('email_code', $code)->delete();
    }










    public static function verifyEmail($code){
        $user = self::getSingle($code);
        if ($user) {
            if ($user->sms_code) {
                self::where('sms_code', $code)->update(['sms_verified' => 1]);
                Seller::where('uid', $user->uid)->update([
                    'status' => 'Active',
                    'sms_verified' => 1
                ]);
            } else {
                self::where('email_code', $code)->update(['email_verified' => 1]);
                Seller::where('uid', $user->uid)->update([
                    'status' => 'Active',
                    'email_verified' => 1
                ]);
            }
            $user = User::singleSeller($user->uid);
        }
        return $user;
    }

}
