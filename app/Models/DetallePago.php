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
        'acreditacion_id',
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
    public function acreditacion()
    {
        return $this->hasOne(Acreditacion::class, 'id', 'acreditacion_id');
    }
}
