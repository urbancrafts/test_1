<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Boat extends Model
{
    use HasFactory;

    protected $fillable = [ 
        'id',  
        'category',
        'model',
        'passenger_capacity',
        'about',
        'curr',
        'price',
        'img_1',
        'images',
        'map_location',
        'address',
        'youtube',
        'duration',
        'available',
        'subscribed',
        'business_id',
        'user_id',
        'created_at',
        'updated_at'
    ];
    
    protected $table = 'boats';
    protected $casts = [ 
        'id' => 'integer', 
        //'store_id' => 'integer',
        'business_id' => 'integer',
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


    public function business_detail(){
        return $this->belongsTo(BusinessDetail::class, 'business_id', 'id');
    }


    public function bookings(){
        return $this->hasMany(BoatBooking::class, 'boat_id', 'id');
    }



}
