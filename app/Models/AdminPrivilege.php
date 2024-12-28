<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AdminPrivilege extends Model
{
    use HasFactory;

    protected $fillable = [ 
        'id',  
        'privilege',
        'admin_id',
        'created_at',
        'updated_at'
    ];
    
    protected $table = 'admin_privileges';
    protected $casts = [ 
        'id' => 'integer', 
        //'store_id' => 'integer',
        //'branch_id' => 'integer',
        'admin_id' => 'integer',
    ];
    protected $primaryKey = 'id';
    protected $dates = [
        'created_at',
        'updated_at',
    ];


    public function admin(){
        return $this->belongsTo(Admin::class, 'admin_id', 'id');
    }


}
