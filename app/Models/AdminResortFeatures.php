<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AdminResortFeatures extends Model
{
    use HasFactory;

    protected $fillable = [ 
        'id',  
        'feature',
        'created_at',
        'updated_at'
    ];
    
    protected $table = 'admin_resort_features';
    protected $casts = [ 
        'id' => 'integer', 
        
    ];
    protected $primaryKey = 'id';
    protected $dates = [
        'created_at',
        'updated_at',
    ];

}
