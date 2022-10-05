<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Requisito extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'numero',
        'requisito',
        'estado',
    ];

    public function misRequisitos() {
        return $this->hasMany(MisRequisitos::class, 'requisito_id');
    }
}
