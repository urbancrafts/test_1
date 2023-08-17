<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Customer extends Model
{
    use HasFactory;

    protected $fillable = [ 
        'id',  
        'user_id',
        'created_at',
        'updated_at'
    ];
    
    protected $table = 'customers';
    protected $casts = [ 
        'id' => 'integer', 
        //'store_id' => 'integer',
        //'business_id' => 'integer',
        'user_id' => 'integer',
    ];
    protected $primaryKey = 'id';
    protected $dates = [
        'created_at',
        'updated_at',
    ];


    public function user(){
        return $this->belongsTo(User::class, 'user_id', 'id');
    }

    public function card_info(){
        return $this->hasMany(CustomerCardInfo::class, 'customer_id', 'id');
    }

    public function reward_point_wallet(){
        return $this->hasOne(CustomerRewardWallet::class, 'customer_id', 'id');
    }

    public function fund_wallet(){
        return $this->hasOne(CustomerWallet::class, 'customer_id', 'id');
    }


}
