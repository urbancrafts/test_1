<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BusinessWallet extends Model
{
    use HasFactory;

    protected $fillable = [ 
        'id',  
        'curr',
        'pending_balance',
        'current_balance',
        'business_id',
        'created_at',
        'updated_at'
    ];
    
    protected $table = 'business_wallets';
    protected $casts = [ 
        'id' => 'integer', 
        //'store_id' => 'integer',
        'business_id' => 'integer',
    ];
    protected $primaryKey = 'id';
    protected $dates = [
        'created_at',
        'updated_at',
    ];


    public function business_detail(){
        return $this->belongsTo(BusinessDetail::class, 'business_id', 'id');
    }
    
}
