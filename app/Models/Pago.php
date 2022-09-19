<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pago extends Model
{
    use HasFactory;

    protected $fillable = [
        'fecha',
        'hora',
        'user_id',
    ];

    public function detalle() {
        return $this->hasMany(DetallePago::class, 'pago_id');
    }
}
