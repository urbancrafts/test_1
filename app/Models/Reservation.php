<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Reservation extends Model
{
    use HasFactory;

    protected $fillable = [ 
        'id',
        'full_name',  
        'phone',
        'email',
        'checkin',
        'checkout',
        'duration',
        'adults',
        'children',
        'curr',
        'price',
        'id_type',
        'id_no',
        'id_file_url',
        'discount_percentage',
        'opened',
        'paid',
        'approved',
        'status',
        'vendor_confired_booking',
        'customer_confired_checkin',
        'customer_id',
        'room_number_id',
    ];
    
    protected $table = 'reservations';
    protected $casts = [ 
        'id' => 'integer', 
        //'store_id' => 'integer',
        //'business_id' => 'integer',
        'customer_id' => 'integer',
        'room_number_id' => 'integer',
    ];
    protected $primaryKey = 'id';
    protected $dates = [
        'created_at',
        'updated_at',
    ];


    public function customer(){
        return $this->belongsTo(Customer::class, 'customer_id', 'id');
    }

    public function room_number(){
        return $this->belongsTo(roomNumber::class, 'room_number_id', 'id');
    }



}
