<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Carbon;

class Acreditacion extends Model
{
    use HasFactory, SoftDeletes;

    const PENDIENTE = 2;
    const PAGADO = 3;
    
    protected $table = 'acreditaciones';

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
     * Get the Mes.
     *
     * @return string
     */
    public function getMesAttribute($value)
    {
        if ($value)
            return Carbon::create()->month($value)->locale('es_ES')->monthName;
    }

    /**
     * Get the phone associated with the user.
     */
    public function afiliado()
    {
        return $this->hasOne(Afiliado::class, 'id', 'afiliado_id');
    }
}
