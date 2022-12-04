<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Afiliado extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'afiliados';

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'id',
        'src_foto',
        'numero_afiliado',
        'cargo',
        'nombre_completo',
        'numero_matricula',
        'ci',
        'expedido',
        'fecha_nacimiento',
        'grupo_sanguineo',
        'egreso',
        'domicilio',
        'telefono',
        'anos_servicio',
        'fecha_registro',
        'costo_matricula'
    ];

    /**
     * the appends attributes for accesors.
     */
    protected $appends = [
        'foto', 
        'foto_thumbnail', 
        'foto_thumbnail_sm', 
        'total_pagos', 
    ];

    // /**
    //  * Validation rules
    //  *
    //  * @var array
    //  */
    // public static $rules = [
    //     'model.numero_afiliado' => 'required|string|max:50',
    //     'model.cargo' => 'required|string|max:50',
    //     'model.nombre_completo' => 'required|string|max:50',
    //     'model.numero_matricula' => 'required|string|max:50',
    //     'model.ci' => 'required|string|max:50|unique:afiliados,ci,id',
    //     'model.expedido' => 'required|string|max:50|',
    //     'model.fecha_nacimiento' => 'date',
    //     'model.grupo_sanguineo' => 'string',
    //     'model.egreso' => 'string|max:100',
    //     'model.domicilio' => 'string|max:300',
    //     'model.telefono' => 'string|max:20',
    //     'model.anos_servicio' => 'string|max:20',
    //     'model.costo_matricula' => 'numeric',
    //     'file' => 'image|mimes:jpeg,png,jpg,gif,svg',
    // ];

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
            return asset('storage/uploads/thumbnail/'.$this->src_foto);
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

    public function misRequisitos() {
        return $this->hasMany(MisRequisitos::class, 'afiliado_id');
    }
    
    public function aportes() {
        return $this->hasMany(Aporte::class, 'afiliado_id');
    }

    /**
     * get has many credencials
     */
    public function credenciales() {
        return $this->hasMany(Credencial::class, 'afiliado_id');
    }
    
    /**
     * get has many pagos matricula
     */
    public function pagoMatriculas() {
        return $this->hasMany(PagoMatricula::class, 'afiliado_id');
    }
    
    /**
     * get has many pagos
     */
    public function pagos() {
        return $this->hasMany(Pago::class, 'afiliado_id');
    }

    /**
     * get Total pagos
     */
    public function getTotalPagosAttribute()
    {
        $sum = 0;
        foreach ($this->pagos as $key => $pago) {
            $sum += $pago->total;
        }
        return $sum;
    }
}
