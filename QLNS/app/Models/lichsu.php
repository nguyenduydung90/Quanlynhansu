<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class lichsu extends Model
{
    use HasFactory;
    protected $table='lichsu';
    protected $fillable = [
        'ttpm_id', 'cbphutrach','thoigiantao','thoigiancapnhat','tkthuchien','tenpm'
    ];
    public function ttpm_ls(){
        return $this->hasOne(thongtinphanmem::class,'id','ttpm_id');
    }
}
