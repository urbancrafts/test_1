<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class State extends Model
{
    use HasFactory;

    protected $fillable = [ 
        'id',
        'name',
        'country_id',
        'country_code',
        'fips_code',
        'iso2',
        'type',
        'latitude',
        'longitude',
        'created_at',
        'updated_at',
        'flag',
        'wikiDatald'
    ];
    
    protected $table = 'states';
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

    public function country(): BelongsTo
    {
        return $this->belongsTo(Country::class, 'country_id', 'id');
    }

    public function city(){
        return $this->hasMany(City::class, 'state_id', 'id');
    }
}
