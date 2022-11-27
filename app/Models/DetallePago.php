<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DetallePago extends Model
{
    use HasFactory;

    protected $table = 'detalle_pagos';

    protected $fillable = [
        'monto',
        'aporte_id',
        'pago_id'
    ];
    /**
     * Get the phone associated with the user.
     */
    public function pago()
    {
        return $this->hasOne(Pago::class, 'id', 'pago_id');
    }
    
    /**
     * Get the phone associated with the user.
     */
    public function aporte()
    {
        return $this->hasOne(Aporte::class, 'id', 'aporte_id');
    }
}
