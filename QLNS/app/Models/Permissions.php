<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Permissions extends Model
{
    use HasFactory;
    protected $table='permissions';

    protected $fillable = [
        'tenquyen',
        'diengiai',
        'parent',
        'key_code'
    ];

    public function permissionChildrent()
    {
        return $this->hasMany(Permissions::class,'parent');
    }
}
