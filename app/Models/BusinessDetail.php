<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BusinessDetail extends Model
{
    use HasFactory;


    protected $fillable = [ 
        'id',  
        'owner_first_name',
        'owner_last_name',
        'business_name',
        'country',
        'state',
        'city',
        'address',
        'zip_code',
        'business_category',
        'registration_number',
        'document_url',
        'logo_url',
        'verified',
        'subscribed',
        'referrer_code',
        'user_id',
        'created_at',
        'updated_at'
    ];
    
    protected $table = 'business_details';
    protected $casts = [ 
        'id' => 'integer', 
        //'store_id' => 'integer',
        //'branch_id' => 'integer',
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


    public function business(){
        if(self::first()->business_category == "Resort"){
            return $this->hasMany(Shelter::class);
        }else if(self::first()->business_category == "Boat"){
            return $this->hasMany(Boat::class);
        }else if(self::first()->business_category == "Beauty & Spar"){
            return $this->hasMany(Sevices::class);
        }else if(self::first()->business_category == "Health & Fitness"){
            return $this->hasMany(Sevices::class);
        }
    }


    public function resorts(){
        return $this->hasMany(Shelter::class, 'business_id', 'id');
    }

    public function boats(){
        return $this->hasMany(Boat::class, 'business_id', 'id');
    }

    public function services(){
        return $this->hasMany(Services::class, 'business_id', 'id');
    }

}
