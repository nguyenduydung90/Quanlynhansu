<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Chucvu;

class Canbo extends Model
{
    use HasFactory;
    protected $table='canbo';
    protected $fillable = [
        'hoten',
        'ngaysinh',
         'gioitinh',
         'quequan',
         'thuongtru',
         'cccd',
         'chucvu_id',
         'phongban_id',
         'sdt',
         'email',
         'ngayvaoct',
         'bangcap',
         'file_cccd',
         'tdcm',
         'truongdaotao',
         'namtotnghiep',
         'file_bc',
         'theodoi'
    ];

    public function chucvu(){
        return $this->hasOne(Chucvu::class,'id','chucvu_id');
    }

    public function phongban(){
        return $this->hasOne(Phongban::class,'id','phongban_id');
    }
}
