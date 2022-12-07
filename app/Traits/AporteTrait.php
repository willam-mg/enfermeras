<?php
namespace App\Traits;

use App\Models\Aporte;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

/**
 * 
 */
trait AporteTrait
{
    /**
     * Genera aportes a partir del mes inscripcion.
     * Genera 12 aportes de una gestion a partir de 
     * el primer mes en que se inscribio.
     * @param integer $id de afiliado
     * @param integer $gestion gestion
     * @return integer numero de aportes generados
     */
    public function createAportesByFirstMonth($idAfiliado, $gestion) {
        $firstAporte  = DB::table('aportes')
        ->select('afiliado_id', DB::raw('min(gestion) as gestion'), DB::raw('min(mes) as mes'))
        ->where('afiliado_id', $idAfiliado)
            ->whereNull('deleted_at')
            ->groupBy('afiliado_id')
            ->first();

        $mes = 1;
        $aportesGenerados = 0;
        while ($mes <= 12) {
            $fechaFirstAporte = Carbon::parse($firstAporte->gestion . '-' . $firstAporte->mes . '-1');
            $fechaActual = Carbon::parse($gestion . '-' . $mes . '-1');
            if ($fechaFirstAporte->lessThan($fechaActual)) {
                $exists = DB::table('aportes')
                ->where([
                    'afiliado_id' => $idAfiliado,
                    'mes' => $mes,
                    'gestion' => $gestion,
                ])->whereNull('deleted_at')
                ->exists();
                if (!$exists) {
                    Aporte::create([
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
    
    /**
     * Genera 12 aportes de uan gestion.
     * Genera 12 aportes de una gestion de un afiliado en espesifico.
     * @param integer $id de afiliado
     * @param integer $gestion gestion
     * @return integer numero de aportes generados
     */
    public function createAportes($idAfiliado, $gestion, $monto = 30) {
        $mes = 1;
        $aportesGenerados = 0;
        try {
            DB::beginTransaction();
            while ($mes <= 12) {
                $exists = DB::table('aportes')
                ->where([
                    'afiliado_id' => $idAfiliado,
                    'mes' => $mes,
                    'gestion' => $gestion,
                ])->whereNull('deleted_at')
                ->exists();
                if (!$exists) {
                    Aporte::create([
                        'afiliado_id' => $idAfiliado,
                        'mes' => $mes,
                        'gestion' => $gestion,
                        'monto' => $monto,
                    ]);
                    $aportesGenerados++;
                }
                $mes++;
            }
            DB::commit();
            return $aportesGenerados;
        } catch (\Throwable $th) {
            DB::rollBack();
            throw $th;
        }
    }

    public function createAportesByYears($idAfiliado, $yearStart, $yearEnd, $monto = 30) {
        try {
            for ($year = $yearStart; $year <= $yearEnd; $year++) {
                $this->createAportes($idAfiliado, $year, $monto);
            }
        } catch (\Throwable $th) {
            throw $th;
        }
    }
}
