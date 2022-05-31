<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class bangluong extends Model
{
    use HasFactory;
    protected $table='bangluong';
    protected $fillable=[
        'noidung','thang','nam','ngaylap','nguoilap','ghichu'
    ];
}
