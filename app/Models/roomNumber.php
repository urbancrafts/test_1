<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class roomNumber extends Model
{
    use HasFactory;

    protected $fillable = [ 
        'id',  
        'number',
        'capacity',
        'status',
        'created_at',
        'updated_at'
    ];
    
    protected $table = 'room_numbers';
    protected $casts = [ 
        'id' => 'integer', 
        //'store_id' => 'integer',
        //'business_id' => 'integer',
        'room_id' => 'integer',
    ];
    protected $primaryKey = 'id';
    protected $dates = [
        'created_at',
        'updated_at',
    ];


    public function room(){
        return $this->belongsTo(Rooms::class, 'room_id', 'id');
    }



    public function reservations(){
        return $this->hasMany(Reservation::class, 'room_number_id', 'id');
    }
}
