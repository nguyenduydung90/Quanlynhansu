<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class lichsufile extends Model
{
    use HasFactory;
    protected $table='lichsu_upfile';
    protected $fillable = [
        'ttpm_id', 'file_gt','file_demo','thoigiantao','thoigianchinhsua','tkthuchien','cbphutrach','tenpm'
    ];

    public function ttpm_lsfile(){
        return $this->hasOne(thongtinphanmem::class,'id','ttpm_id');
    }
}
