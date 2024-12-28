<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BoatCategory extends Model
{
    use HasFactory;

    protected $fillable = [ 
        'id',  
        'category',
        'created_at',
        'updated_at'
    ];
    
    protected $table = 'boat_categories';
    protected $casts = [ 
        'id' => 'integer', 
        
    ];
    protected $primaryKey = 'id';
    protected $dates = [
        'created_at',
        'updated_at',
    ];

}
