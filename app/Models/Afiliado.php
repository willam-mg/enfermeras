<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Afiliado extends Model
{
    use HasFactory, SoftDeletes;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'scr_foto',
        'numero_afiliado',
        'cargo',
        'nombre_completo',
        'numero_matricula',
        'ci',
        'fecha_nacimiento',
        'grupo_sanguineo',
        'egreso',
        'domicilio',
        'telefono',
        'fecha_registro'
    ];

    /**
     * the appends attributes for accesors.
     */
    protected $appends = [
        'foto', 
        'foto_thumbnail', 
        'foto_thumbnail_sm', 
    ];

    /**
     * Get accesor foto attribute.
     */
    public function getFotoAttribute(){
        if ($this->src_foto){
            return url('/').'/uploads/' . $this->src_foto;
        }
        return null;
    }
    
    /**
     * Get accesor foto thumbnail.
     */
    public function getFotoThumbnailAttribute(){
        if ($this->src_foto){
            return url('/').'/uploads/thumbnail/' . $this->src_foto;
        }
        return null;
    }
    /**
     * Get accesor foto thumbnail.
     */
    public function getFotoThumbnailSmAttribute(){
        if ($this->src_foto){
            return url('/').'/uploads/thumbnail-small/' . $this->src_foto;
        }
        return null;
    }
}
