<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
class Acreditacion extends Model
{
    use HasFactory, SoftDeletes;
    
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
        'pendiente',
        'afiliado_id',
    ];

    /**
     * Get the phone associated with the user.
     */
    public function afiliado()
    {
        return $this->hasOne(Afiliado::class, 'id', 'afiliado_id');
    }
}
