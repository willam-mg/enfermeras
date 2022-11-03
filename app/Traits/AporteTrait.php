<?php
namespace App\Traits;

use App\Models\Acreditacion;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

/**
 * 
 */
trait AporteTrait
{
    /**
     * genera las mensualidades de una gestion
     * @param Array | integer $id de afiliado
     * @param Array | integer $gestion es el numero total
     * @param boolean $integer numero de aportes generados
     */
    public function createAportes($idAfiliado, $gestion) {
        $firstAcreditacion  = DB::table('acreditaciones')
        ->select('afiliado_id', DB::raw('min(gestion) as gestion'), DB::raw('min(mes) as mes'))
        ->where('afiliado_id', $idAfiliado)
            ->whereNull('deleted_at')
            ->groupBy('afiliado_id')
            ->first();

        $mes = 1;
        $aportesGenerados = 0;
        while ($mes <= 12) {
            $fechaFirstAporte = Carbon::parse($firstAcreditacion->gestion . '-' . $firstAcreditacion->mes . '-1');
            $fechaActual = Carbon::parse($gestion . '-' . $mes . '-1');
            if ($fechaFirstAporte->lessThan($fechaActual)) {
                $exists = DB::table('acreditaciones')
                ->where([
                    'afiliado_id' => $idAfiliado,
                    'mes' => $mes,
                    'gestion' => $gestion,
                ])->whereNull('deleted_at')
                ->exists();
                if (!$exists) {
                    Acreditacion::create([
                        'afiliado_id' => $idAfiliado,
                        'mes' => $mes,
                        'gestion' => $gestion,
                        'monto' => 30,
                    ]);
                    $aportesGenerados++;
                }
            }
            $mes++;
        }
        return $aportesGenerados;
    }
}
