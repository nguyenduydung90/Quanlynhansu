<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DmkhoiPb extends Model
{
    use HasFactory;
    protected $table='dmkhoipb';
    protected $fillable = [
        'tenkhoi', 'diengiai'
    ];
}
