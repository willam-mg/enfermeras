<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Obsequio extends Model
{
    use HasFactory;

    protected $fillable = [
        'fecha_entrega',
        'hora_entrega',
        'user_id',
        'afiliado_id',
        'observacion',
        'estado',
    ];

    /**
     * Get user
     */
    public function user()
    {
        return $this->hasOne(User::class, 'id', 'user_id');
    }

    /**
     * Get user
     */
    public function afiliado()
    {
        return $this->hasOne(Afiliado::class, 'id', 'afiliado_id');
    }
}
