<?php
namespace App\Traits;

use App\Models\Aporte;
use App\Models\Obsequio;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

trait ObsequioTrait 
{
    /**
     * agrega a la lista de obsequios anual.
     * @param integer id Afiliado
     * @param integer gestion 
     * @return void
     */
    public function giveGift($idAfiliado, $gestion) {
        try {
            // verificar si teine la gestion completa
            $numeroAportesPagados = Aporte::where('afiliado_id', $idAfiliado)
                ->where('gestion', $gestion)
                ->where('estado', '=', Aporte::PAGADO)->count();
            // agregando a la lista
            if ($numeroAportesPagados >= 12) {
                $obsequio = new Obsequio();
                $obsequio->afiliado_id = $idAfiliado;
                $obsequio->gestion = $gestion;
                $obsequio->estado = Obsequio::PENDIENTE;
                if (!$obsequio->save() ) {
                    throw new \Exception($obsequio->errors()->all());
                }
            }
        } catch (\Throwable $th) {
            return $th->getMessage();
        }
    }

    /**
     * Agrega a la lista de obsequi por gestiones.
     * @param integer id Afiliado
     * @param Array<Ingeger> gestion 
     * @return void
     */
    public function giveGiftByYears($idAfiliado, $gestiones) {
        try {
            foreach ($gestiones as $key => $gestion) {
                $this->giveGift($idAfiliado, $gestion);
            }
        } catch (\Throwable $th) {
            return $th->getMessage();
        }
    }

    public function findYears($aportes, $indexYear) {
        $gestiones = [];
        foreach ($aportes as $key => $value) {
            if ($value) {
                $explodeValue = explode("-", $value);
                $year = $explodeValue[$indexYear];
                if (!in_array($year, $gestiones)) {
                    array_push($gestiones, $year);
                }
            }
        }
        return $gestiones;
    }


}
