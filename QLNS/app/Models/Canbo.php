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
         'gioitinh',
         'diachi',
         'anh',
         'chucvu_id',
         'phongban_id',
         'dienthoai',
         'email',
         'ngayvao',
         'ngaysinh',
         'bangcap',
         'sobhxh',
         'sobhyt',
         //thông tin lương cán bộ hiện tại
         'luongthamnien',
         'luongtrachnhiem',
         'pccbptts', //phụ cấp cán bộ phụ trách tài sản
         'lbcb',//lương bậc cán bộ
         'lsp',
         'congtacphi',
         'pcat',
         'pcxx',
         'pcdt',
         'ptbhxh',
         'ptbhyt',
         'ptbhtn',
         'kpcd', //kinh phí công đoàn
        //trừ vào lương
        'tiencom',
        'ngaynghi',
        'tienphat'
    ];

    public function chucvu(){
        return $this->hasOne(Chucvu::class,'id','chucvu_id');
    }

    public function phongban(){
        return $this->hasOne(Phongban::class,'id','phongban_id');
    }
}
