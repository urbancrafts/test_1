<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model as Eloquent;

class Settings extends Eloquent 
{
    use HasFactory;


    protected $fillable = [ 
        'id',  
        'curr',
        'logo',
        'icon',
        'language',
        'tel',
        'mobile',
        'email',
        'address',
        'payment_type',
        'memb_discount',
        'memb_debt_capacity',
        'membership_fee',
        'facebook',
        'instagram',
        'twitter',
        'linkedin',
        'terms',
        'site_name',
        'site_url',
        'other_url',
        'status'
	 ];
     
	protected $primaryKey = 'id';
	protected $table = 'settings';
  	protected $dates = [
        'created_at',
        'updated_at'
    ];


    public static function insertTable($subData=array()){
        if($subData->id){
            $info = self::where('id', $subData->id)->update([
                'curr'                 => $subData->curr,
                'logo'                 => $subData->logo,
                'icon'                 => $subData->icon,
                'language'             => $subData->language,
                'tel'                  => $subData->tel,
                'mobile'               => $subData->mobile,
                'email'                => $subData->email,
                'memb_discount'        => $subData->memb_discount,
                'memb_debt_capacity'   => $subData->memb_debt_capacity,
                'membership_fee'       => $subData->membership_fee,
                'payment_type'         => $subData->payment_type,
                'facebook'             => $subData->facebook,
                'instagram'            => $subData->instagram,
                'twitter'              => $subData->twitter,
                'linkedin'             => $subData->linkedin,
                'terms'                => $subData->terms,
                'site_name'            => $subData->site_name,
                'site_url'             => $subData->site_url,
                'other_url'            => $subData->other_url
            ]);
        }
        else {
            $info = self::create([
                'curr'                 => $subData->curr,
                'logo'                 => $subData->logo,
                'icon'                 => $subData->icon,
                'language'             => $subData->language,
                'tel'                  => $subData->tel,
                'mobile'               => $subData->mobile,
                'email'                => $subData->email,
                'memb_discount'        => $subData->memb_discount,
                'memb_debt_capacity'   => $subData->memb_debt_capacity,
                'membership_fee'       => $subData->membership_fee,
                'payment_type'         => $subData->payment_type,
                'facebook'             => $subData->facebook,
                'instagram'            => $subData->instagram,
                'twitter'              => $subData->twitter,
                'linkedin'             => $subData->linkedin,
                'terms'                => $subData->terms,
                'site_name'            => $subData->site_name,
                'site_url'             => $subData->site_url,
                'other_url'            => $subData->other_url,
                'status'               => $subData->status
            ]);

        }

        return $info;
    }


    public static function single(){
        return self::first();
    }


}
