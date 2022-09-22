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

    /**
     * the appends attributes for accesors.
     */
    protected $appends = [
        'total', 
        'foto_thumbnail', 
        'foto_thumbnail_sm', 
    ];

    /**
     * Get accesor foto thumbnail.
     */
    public function getTotalAttribute(){
        $total = 0;
        foreach ($this->detalle as $key => $item) {
            $total += $item->monto;
        }
        return $total;
    }
}
