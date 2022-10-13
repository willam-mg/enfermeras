<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\User;
use App\Models\Afiliado;
class CredencialFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            // con id espesificos
            
            'afiliado_id' => 9426,
            'user_id' => 1,
            // // para usar los que ya existen al azar
            // 'afiliado_id' => Afiliado::limit(100)->get()->random(),
            // 'user_id' => User::limit(100)->get()->random(),
            // // para crear nuevos
            // 'afiliado_id' => Afiliado::factory(),
            // 'user_id' => User::factory(),
            'fecha_registro' => $this->faker->date(),
            'fecha_emision' => $this->faker->date(),
            'fecha_vencimiento' => $this->faker->date(),
            'renovacion' => $this->faker->randomElement([
                '2',
                '1',
            ]),
            'costo_renovacion' =>  $this->faker->randomFloat(),
            'estado' => $this->faker->randomElement([
                '2',
                '1',
            ]),
        ];
    }
}
