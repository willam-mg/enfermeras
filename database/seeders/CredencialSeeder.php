<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Credencial;

class CredencialSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Credencial::factory()
            ->count(100)
            ->create();
    }
}
