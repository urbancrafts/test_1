<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Shelter extends Model
{
    use HasFactory;

    protected $fillable = [ 
        'id',  
        'name',
        'map_location',
        'address',
        'descr',
        'curr',
        'price',
        'img_1',
        'images',
        'youtube',
        'duration',
        'available',
        'subscribed',
        'discount_enabled',
        'business_id',
        'user_id',
        'created_at',
        'updated_at'
    ];
    
    protected $table = 'shelters';
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

    public function rooms(){
        return $this->hasMany(Rooms::class, 'resort_id', 'id');
    }



}
