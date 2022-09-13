<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class RequisitoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('requisitos')->insert([
            'numero' => 1,
            'requisito' => 'Carta dirigida a la presidente de A.D.E.A. CBBA, Sra. Virginia Cabero o solicitando la afiliacion conforme al formato',
        ]);
        DB::table('requisitos')->insert([
            'numero' => 2,
            'requisito' => 'Carnet de identidad acompañado del original y fotocopia',
        ]);
        DB::table('requisitos')->insert([
            'numero' => 3,
            'requisito' => 'Matricula profecional original y fotocopia',
        ]);
        DB::table('requisitos')->insert([
            'numero' => 4,
            'requisito' => 'Certificado de egreso extendido por universidad, instituto o centro de capacitacion original y fotocopia',
        ]);
        DB::table('requisitos')->insert([
            'numero' => 5,
            'requisito' => 'Certificado de egreso extendido por ceduca',
        ]);
        DB::table('requisitos')->insert([
            'numero' => 6,
            'requisito' => 'Titulo en provision nacional original y fotocopia',
        ]);
        DB::table('requisitos')->insert([
            'numero' => 7,
            'requisito' => 'Resolucion ministerial original y fotocopia',
        ]);
        DB::table('requisitos')->insert([
            'numero' => 8,
            'requisito' => 'Grupo sanguineo original y fotocopia',
        ]);
        DB::table('requisitos')->insert([
            'numero' => 9,
            'requisito' => 'Certificado de trabajo o en su defecto contratos y boleta de pago reciente',
        ]);
        DB::table('requisitos')->insert([
            'numero' => 10,
            'requisito' => '2 fotos manaño 3x4 con fondo rojo con uniforme y cofia para mujeres',
        ]);
        DB::table('requisitos')->insert([
            'numero' => 11,
            'requisito' => 'Cancelar matricula 100 Bs. y 30 Bs. de aporte mensual',
        ]);
        DB::table('requisitos')->insert([
            'numero' => 12,
            'requisito' => 'Presentar documentos en folder amarillo con nepaco, adicionando datos personales en la parte anterior del folder',
        ]);
    }
}
