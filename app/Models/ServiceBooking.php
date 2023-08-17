<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ServiceBooking extends Model
{
    use HasFactory;

    protected $fillable = [ 
        'id',  
        'name',
        'phone',
        'email',
        'id_no',
        'id_file_url',
        'duration',
        'booked_date',
        'opened',
        'paid',
        'vendor_confired_booking',
        'customer_confired_service',
        'service_id',
        'customer_id',
        'created_at',
        'updated_at'
    ];
    
    protected $table = 'service_bookings';
    protected $casts = [ 
        'id' => 'integer', 
        //'store_id' => 'integer',
        'service_id' => 'integer',
        'customer_id' => 'integer',
    ];
    protected $primaryKey = 'id';
    protected $dates = [
        'created_at',
        'updated_at',
    ];


    public function service(){
        return $this->belongsTo(Services::class, 'service_id', 'id');
    }

}
