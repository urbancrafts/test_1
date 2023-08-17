<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Rooms extends Model
{
    use HasFactory;

    protected $fillable = [ 
        'id',  
        'room_name',
        'type',
        'descr',
        'available_number',
        'capacity',
        'curr',
        'price',
        'img_1',
        'images',
        'duration',
        'available',
        'resort_id',
        'created_at',
        'updated_at'
    ];
    
    protected $table = 'rooms';
    protected $casts = [ 
        'id' => 'integer', 
        //'store_id' => 'integer',
        //'business_id' => 'integer',
        'resort_id' => 'integer',
    ];
    protected $primaryKey = 'id';
    protected $dates = [
        'created_at',
        'updated_at',
    ];


    public function resort(){
        return $this->belongsTo(Shelter::class, 'resort_id', 'id');
    }



    public function room_numbers(){
        return $this->hasMany(roomNumber::class, 'room_id', 'id');
    }

}
