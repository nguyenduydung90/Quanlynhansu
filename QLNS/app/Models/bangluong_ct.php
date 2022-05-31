<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class bangluong_ct extends Model
{
    use HasFactory;
    protected $table='bangluong_ct';
    protected $fillable = [
          'luongcoban',  
         'luongthamnien',
         'luongtrachnhiem',
         'pccbptts', //phụ cấp cán bộ phụ trách tài sản
         'lbcb',//lương bậc cán bộ
         'lsp',
         'pcat',
         'pcxx',
         'pcdt',
         'ptbhxh',
         'ptbhyt',
         'ptbhtn',
         'kpcd', //kinh phí công đoàn
         'tongluong',
         'thucnhan',
         'mabl',
         'macb',
         'luongchucvu',
         'tiencom',
         'tienphat'

    ];

    public function canbos(){
        return $this->belongsToMany(Canbo::class,'bangluong_ct.macb','canbo.id');
    }
}
