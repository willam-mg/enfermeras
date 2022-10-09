<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class AfiliadoFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'numero_afiliado' => $this->faker->postcode(),
            'cargo' => $this->faker->randomElement([
                'Auxiliar de enfermeria',
                'Tecnico Medio en enfermeria',
                'Auciliar medio de enfermeria',
            ]),
            'nombre_completo' => $this->faker->name(),
            'numero_matricula' => $this->faker->postcode(),
            'ci' => $this->faker->unique()->numberBetween(),
            'fecha_nacimiento' => $this->faker->date(),
            'grupo_sanguineo' => $this->faker->randomElement(['RH O+' ,'RH O-', 'RH AB+', 'RH B+', 'RH A+']),
            'egreso' => $this->faker->randomElement([
                'Colegio de enfermeria',
                'Universidad de enfemria auxiliar',
                'Domingo sabio especialdiad',
                'Stanta fe Esmeralda Colegio de enfermeria',
            ]),
            'domicilio' => $this->faker->address(),
            'telefono' => $this->faker->postcode(),
            'fecha_registro' => $this->faker->date(),
            'anos_servicio' => $this->faker->buildingNumber(),
            'src_foto' => null,
        ];
    }
}
