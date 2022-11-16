<?php 

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PagoMatricula extends Model
{
	use HasFactory;
	
    public $timestamps = true;

    protected $table = 'pago_matriculas';

    protected $fillable = ['fecha','hora','user_id','monto','afiliado_id'];
	
    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function afiliado()
    {
        return $this->hasOne('App\Models\Afiliado', 'id', 'afiliado_id');
    }
    
    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function user()
    {
        return $this->hasOne('App\Models\User', 'id', 'user_id');
    }
    
}
