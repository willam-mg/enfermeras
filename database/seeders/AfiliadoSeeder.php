<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Afiliado;

class AfiliadoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Afiliado::factory()
            ->count(5000)
            ->create();
    }
}
