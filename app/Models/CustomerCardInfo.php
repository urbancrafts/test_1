<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CustomerCardInfo extends Model
{
    use HasFactory;

    protected $fillable = [ 
        'id',  
        'card_type',
        'card_number',
        'exp_month',
        'exp_year',
        'cvv_code',
        'name_on_card',
        'card_pin',
        'customer_id',
        'created_at',
        'updated_at'
    ];
    
    protected $table = 'customer_card_infos';
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
