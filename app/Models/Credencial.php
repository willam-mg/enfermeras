<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Credencial extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'fecha_registro',
        'fecha_emision',
        'fecha_vencimiento',
        'renovacion',
        'costo_renovacion',
        'estado',
    ];

    /**
     * Get Afiliado.
     */
    public function afiliado()
    {
        return $this->hasOne(Afiliado::class, 'id', 'afiliado_id');
    }
    
    /**
     * Get Afiliado.
     */
    public function user()
    {
        return $this->hasOne(User::class, 'id', 'user_id');
    }
}
