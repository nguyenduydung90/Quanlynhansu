<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Roles extends Model
{
    use HasFactory;
    protected $table='roles';

    protected $fillable = [
        'tenquyen',
        'diengiai'

    ];

    public function users (){
        return $this->belongsToMany(User::class,'role_users','role_id','user_id');
    }

    public function permissions()
    {
        return $this->belongsToMany(Permissions::class,'permission_roles','role_id','permission_id');
    }
}
