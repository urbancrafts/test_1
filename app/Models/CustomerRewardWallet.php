<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CustomerRewardWallet extends Model
{
    use HasFactory;

    protected $fillable = [ 
        'id',  
        'point_balance',
        'customer_id',
        'created_at',
        'updated_at'
    ];
    
    protected $table = 'customer_reward_wallets';
    protected $casts = [ 
        'id' => 'integer', 
        //'store_id' => 'integer',
        //'business_id' => 'integer',
        'customer_id' => 'integer',
    ];
    protected $primaryKey = 'id';
    protected $dates = [
        'created_at',
        'updated_at',
    ];


    public function customer(){
        return $this->belongsTo(Customer::class, 'customer_id', 'id');
    }
    
}
