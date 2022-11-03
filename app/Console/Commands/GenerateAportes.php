<?php

namespace App\Console\Commands;

use App\Models\Acreditacion;
use App\Models\Afiliado;
use App\Traits\AporteTrait;
use Carbon\Carbon;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;

class GenerateAportes extends Command
{
    use AporteTrait;
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
            $aportesGenerados += $this->createAportes($idAfiliado, $gestion);
        }
        $this->line($aportesGenerados.' Aportes generados');
    }
}
