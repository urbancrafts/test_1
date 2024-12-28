<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ResortFeatures extends Model
{
    use HasFactory;

    protected $fillable = [ 
        'id',  
        'features',
        'curr',
        'price',
        'duration',
        'resort_id',
        'created_at',
        'updated_at'
    ];
    
    protected $table = 'resort_features';
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


}
