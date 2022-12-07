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
            DB::beginTransaction();
            // verificar si teine la gestion completa
            $numeroAportesPagados = Aporte::where('afiliado_id', $idAfiliado)
                ->where('gestion', $gestion)
                ->where('estado', '=', Aporte::PAGADO)->count();
            // agregando a la lista
            if ($numeroAportesPagados >= 12) {
                $obsequio = new Obsequio();
                $obsequio->user_id = Auth::user()->id;
                $obsequio->afiliado_id = $idAfiliado;
                $obsequio->gestion = $gestion;
                $obsequio->estado = Obsequio::PENDIENTE;
                $obsequio->save();
                DB::commit();
            }
        } catch (\Throwable $th) {
            DB::rollBack();
            $this->dispatchBrowserEvent('switalert', [
                'type' => 'warning',
                'title' => '',
                'message' => $th->getMessage()
            ]);
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
            $this->dispatchBrowserEvent('switalert', [
                'type' => 'warning',
                'title' => '',
                'message' => $th->getMessage()
            ]);
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
