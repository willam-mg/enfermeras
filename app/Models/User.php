<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Database\Eloquent\SoftDeletes;

class User extends Authenticatable
{
    const ROL_ADMIN = 'administrador';
    const ROL_ASISTENTE = 'asistente';
    
    use HasApiTokens, HasFactory, Notifiable, SoftDeletes;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'rol',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    /**
     * The append logic attributes accessors.
     *
     * @var array<string, string>
     */
    protected $appends = [
        'rol_name'
    ];

    public function getRolNameAttribute() {
        switch ($this->rol) {
            case self::ROL_ADMIN:
                return 'Adminsitrador';
                break;
            case self::ROL_ASISTENTE:
                return 'Asistente';
                break;
            default:
                return 'No asignado';
                break;
        }
    }

    /**
     * get has many credencials
     */
    public function credenciales() {
        return $this->hasMany(Credencial::class, 'afiliado_id');
    }
}
