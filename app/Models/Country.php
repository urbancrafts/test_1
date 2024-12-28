<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Country extends Model
{
    use HasFactory;

    protected $fillable = [ 
        'id',
        'name',
        'iso3',
        'numeric_code',
        'iso2',
        'phonecode',
        'capital',
        'currency',
        'currency_name',
        'currency_symbol',
        'tld',
        'native',
        'region',
        'subregion',
        'timezones',
        'translations',
        'latitude',
        'longitude',
        'emoji',
        'emojiU',
        'created_at',
        'updated_at',
        'flag',
        'wikiDatald'
    ];
    
    protected $table = 'countries';
    protected $casts = [ 
        'id' => 'integer', 
        //'store_id' => 'integer',
        //'branch_id' => 'integer',
        //'store_id' => 'integer',
    ];
    protected $primaryKey = 'id';
    protected $dates = [
        'created_at',
        'updated_at',
    ];

    public function state(){
        return $this->hasMany(State::class, 'country_id', 'id');
    }

    public function city(){
        return $this->hasMany(City::class, 'country_id', 'id');
    }
    
}
