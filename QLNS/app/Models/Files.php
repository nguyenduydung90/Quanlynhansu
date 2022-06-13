<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Files extends Model
{
    use HasFactory;
    protected $table='files';
    protected $fillable = [
        'ttpm_id', 'noidung','hdsd','demo'
    ];

    public function ttpm(){
        return $this->hasOne(thongtinphanmem::class,'id','ttpm_id');
    }

}
