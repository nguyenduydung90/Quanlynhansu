<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class thongtinphanmem extends Model
{
    use HasFactory;

    protected $table='thongtinphanmems';
    protected $fillable = [
        'tenpm','hdsd','congnghe','linkdm','canbo_id','thoigianphattrien'
    ];

    public function canbo(){
        return $this->hasOne(Canbo::class,'id','canbo_id');
    }

}
