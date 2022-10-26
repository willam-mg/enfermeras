<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PagoMatricula extends Model
{
    use HasFactory;

    protected $fillable = [
        'fecha',
        'hora',
        'user_id',
        'monto',
        'afiliado_id',
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
