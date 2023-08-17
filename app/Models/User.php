<?php

namespace App\Models;


use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;


class User extends Authenticatable implements MustVerifyEmail
{
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'referrer_code',
        'first_name',
        'last_name',
        'phone',
        'email',
        'email_verified_at',
        'password',
        'none_hsh',
        'country',
        'state',
        'city',
        'address',
        'dob',
        'gender',
        'profile_img_url',
        'user_type',
        'is_email_verified',
        'is_business_verified',
        'status',
        'security_2fa',
        'security_question',
        'security_pin',
        'admin_user',
        'loggedIn',
        'remember_token',
        'created_at',
        'updated_at'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];


    public function user_verification()
    {
        return $this->hasOne(UserVerification::class, 'user_id', 'id');
    }


  public function customer_account(){
    return $this->hasOne(Customer::class, 'user_id', 'id');
  }

  public function business_account(){
    return $this->hasMany(BusinessDetail::class, 'user_id', 'id');
  }

  public function admin_account(){
    return $this->hasOne(Admin::class, 'user_id', 'id');
  }


    // public function user_type(){//
    //     $account_type = self::first()->user_type;
    //     if($account_type == "Customer"){
    //         return $this->hasOne(Customer::class, 'user_id', 'id');
    //     }else if($account_type == "Business"){
    //         return $this->hasMany(BusinessDetail::class, 'user_id', 'id');
    //     }else if($account_type == "Admin"){
    //         return $this->hasOne(Admin::class, 'user_id', 'id');
    //     }

    // }



}
