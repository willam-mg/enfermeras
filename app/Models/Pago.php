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
        'afiliado_id',
        'pago_matricula_id',
    ];

    public function detalle() {
        return $this->hasMany(DetallePago::class, 'pago_id');
    }

    /**
     * the appends attributes for accesors.
     */
    protected $appends = [
        'total', 
    ];

    /**
     * Get total detalle pagos
     */
    public function getTotalAttribute(){
        $total = 0;
        foreach ($this->detalle as $key => $item) {
            $total += $item->monto;
        }
        return $this->pagoMatricula?$total + $this->pagoMatricula->monto: $total;
    }

    /**
     * Get Afiliado
     */
    public function afiliado() {
        return $this->hasOne(Afiliado::class, 'id', 'afiliado_id');
    }
    
    /**
     * Get User
     */
    public function user() {
        return $this->hasOne(User::class, 'id', 'user_id');
    }
    
    /**
     * Get PagoMatricula
     */
    public function pagoMatricula() {
        return $this->hasOne(PagoMatricula::class, 'id', 'pago_matricula_id');
    }
}
