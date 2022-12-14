<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class MisRequisitos extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'requisito_id',
        'afiliado_id',
        'fecha_presentacion',
        'hora_presentacion'
    ];

    /**
     * Get the phone associated with the user.
     */
    public function requisito()
    {
        return $this->hasOne(Requisito::class, 'id', 'requisito_id');
    }
    /**
     * Get the phone associated with the user.
     */
    public function afiliado()
    {
        return $this->hasOne(Afiliado::class, 'id', 'afiliado_id');
    }
}
