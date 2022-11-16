<?php

namespace Database\Factories;

use App\Models\PagoMatricula;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class PagoMatriculaFactory extends Factory
{
    protected $model = PagoMatricula::class;

    public function definition()
    {
        return [
			'fecha' => $this->faker->name,
			'hora' => $this->faker->name,
			'user_id' => $this->faker->name,
			'monto' => $this->faker->name,
			'afiliado_id' => $this->faker->name,
        ];
    }
}
