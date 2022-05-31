<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Phongban extends Model
{
    use HasFactory;
    protected $table='phongban';
    protected $fillable = [
        'tenpb', 'diengiai','dmkhoi_id'
    ];


}
