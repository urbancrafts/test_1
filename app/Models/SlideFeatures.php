<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SlideFeatures extends Model
{
    use HasFactory;

    protected $fillable = [ 
        'id',  
        'ref_id',
        'category',
        'name',
        'img_url',
        'url',
        'allow',
        'updated',
        'created_at',
        'updated_at'
    ];
    
    protected $table = 'slide_features';
    protected $casts = [ 
        'id' => 'integer', 
        'ref_id' => 'integer',
        
    ];
    protected $primaryKey = 'id';
    protected $dates = [
        'created_at',
        'updated_at',
    ];


    public function module($category){

        $modules = self::where('category', $category)->get();

        foreach($modules as $module){
            if($module->category == "Resort"){
                
            }
        }

        if(self::get()->category == "Resort"){
            return $this->belongsTo(Shelter::class, 'ref_id', 'id');
        }else if(self::where()->category == "Boat"){
            return $this->belongsTo(Boat::class, 'ref_id', 'id');
        }else if(self::first()->category == "Others"){
            return $this->belongsTo(Sevices::class, 'ref_id', 'id');
        }
       
    }


}
