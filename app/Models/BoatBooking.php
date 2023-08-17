<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BoatBooking extends Model
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
        'boat_id',
        'customer_id',
        'created_at',
        'updated_at'
    ];
    
    protected $table = 'boat_bookings';
    protected $casts = [ 
        'id' => 'integer', 
        //'store_id' => 'integer',
        'boat_id' => 'integer',
        'customer_id' => 'integer',
    ];
    protected $primaryKey = 'id';
    protected $dates = [
        'created_at',
        'updated_at',
    ];


    public function boat(){
        return $this->belongsTo(Boat::class, 'boat_id', 'id');
    }

}
