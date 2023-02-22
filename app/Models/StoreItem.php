<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model as Eloquent;
use App\Models\User;

class StoreItem extends Eloquent
{
    use HasFactory;



    protected $fillable = [ 
        'id', 
        'category',  
        'item_name',
        'type',
        'price',
        'curr',
        'location',
        'youtube',
        'desc',
        'discount_opt',
        'discount_percent',
        'discount_number',
        'img_1',
        'images',
        'available',
        'subscribed',
        'sub_exp',
        'stock',
        'status',
        'created_by',
        'created_at',
        'updated_at'
    ];
    
    protected $table = 'store_items';
    protected $casts = [ 
        'id' => 'integer', 
        'created_by' => 'integer',
        //'subscriber_range' => 'integer',
    ];
    protected $primaryKey = 'id';
    protected $dates = [
        'created_at',
        'updated_at',
    ];


    public static function getAllSubscription(){
        $shops = self::orderBy('id', 'desc')->get();

        if(count($shops) > 0){
            foreach($shops as $shop){
                $data = array(
                    'id' => $shop->id, 
                    'user' => User::where('id', $shop->created_by)->get(),
                    'category' => $shop->category,  
                    'item_name' => $shop->item_name,
                    'type' => $shop->type,
                    'price' => $shop->price,
                    'curr' => $shop->curr,
                    'location' => $shop->location,
                    'youtube' => $shop->youtube,
                    'desc' => $shop->desc,
                    'discount_opt' => $shop->discount_opt,
                    'discount_percent' => $shop->discount_percent,
                    'discount_number' => $shop->dicount_number,
                    'img_1' => $shop->img_1,
                    'images' => $shop->images,
                    'available' => $shop->available,
                    'subscribed' => $shop->subscribed,
                    'sub_exp' => $shop->sub_exp,
                    'stock' => $shop->stock,
                    'status' => $shop->status,
                    'created_at' => $shop->created_at,
                    'updated_at' => $shop->updated_at
                          );
                
                     }
              return $data;

        }else{
            return false;
        }
    }

    


    public static function deleteVoucher($id){
        $voucher = self::where('id', $id)->delete();
        if($voucher){
            return true;
        }else{
            return false;
        }
    }



}
