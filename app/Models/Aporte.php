<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Carbon;

class Aporte extends Model
{
    use HasFactory, SoftDeletes;

    const PENDIENTE = 2;
    const PAGADO = 3;
    
    protected $table = 'aportes';

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'gestion',
        'mes',
        'monto',
        'estado',
        'afiliado_id',
    ];
    
    /**
     * the appends attributes for accesors.
     */
    protected $appends = [
        'mes_name',
    ];

    /**
     * Get the Mes.
     *
     * @return string
     */
    public function getMesNameAttribute()
    {
        if ($this->mes)
            return Carbon::create()->month($this->mes)->locale('es_ES')->monthName;
    }

    /**
     * Get the phone associated with the user.
     */
    public function afiliado()
    {
        return $this->hasOne(Afiliado::class, 'id', 'afiliado_id');
    }

    /**
     * get has many pagos
     */
    public function detallePagos()
    {
        return $this->hasMany(DetallePago::class, 'aporte_id');
    }
}
