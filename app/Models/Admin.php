<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Admin extends Model
{
    use HasFactory;


    protected $fillable = [ 
        'id',  
        'type',
        'user_id',
        'created_at',
        'updated_at'
    ];
    
    protected $table = 'admins';
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


    public function privileges(){
        return $this->hasMany(AdminPrivilege::class, 'admin_id', 'id');
    }

}
