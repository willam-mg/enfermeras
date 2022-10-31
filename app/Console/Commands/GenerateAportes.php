<?php

namespace App\Console\Commands;

use App\Models\Acreditacion;
use App\Models\Afiliado;
use Carbon\Carbon;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;

class GenerateAportes extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'generate:aportes {--gestion=}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Genera los aportes de una gestion de cada afilado';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return void
     */
    public function handle()
    { 
        $gestion = $this->option('gestion');
        if (!$gestion) {
            $gestion = date("Y");
        }

        $afiliados = DB::table('afiliados')->whereNull('deleted_at')->pluck('id')->toArray();
        $aportesGenerados = 0;
        foreach ($afiliados as $key => $idAfiliado) {
            $firstAcreditacion  = DB::table('acreditaciones')
            ->select('afiliado_id', DB::raw('min(gestion) as gestion'), DB::raw('min(mes) as mes'))
            ->where('afiliado_id', $idAfiliado)
            ->whereNull('deleted_at')
            ->groupBy('afiliado_id')
            ->first();

            $mes = 1;
            while ($mes <= 12) {
                $fechaFirstAporte = Carbon::parse($firstAcreditacion->gestion . '-' . $firstAcreditacion->mes . '-1');
                $fechaActual = Carbon::parse($gestion . '-' . $mes . '-1');
                if ( $fechaFirstAporte->lessThan($fechaActual) ) {
                    $exists = DB::table('acreditaciones')
                        ->where([
                            'afiliado_id' => $idAfiliado,
                            'mes' => $mes,
                            'gestion' => $gestion,
                        ])->whereNull('deleted_at')
                        ->exists();
                    if (!$exists)  {
                        Acreditacion::create([
                            'afiliado_id' => $idAfiliado,
                            'mes' => $mes,
                            'gestion' => $gestion,
                            'monto' => $gestion,
                        ]);
                        $aportesGenerados++;
                    }
                }
                $mes++;
            }
        }
        $this->line($aportesGenerados.' Aportes generados');
    }
}
