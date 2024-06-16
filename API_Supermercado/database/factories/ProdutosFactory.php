<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Carbon\Carbon;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\produtos>
 */
class ProdutosFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'nome' => $this->faker->word,
            'preco' => $this->faker->randomFloat(2, 1, 100),
            'tipo' => $this->faker->word,
            'quantidade' => $this->faker->numberBetween(1, 100),
            'foto' => 'imagem_' . $this->faker->numberBetween(1, 10) . '.jpg', // Nome fictício de imagem
            'created_at' => Carbon::now()->setTimezone('America/Sao_Paulo'),
            'updated_at' => Carbon::now()->setTimezone('America/Sao_Paulo'),
        ];
    }
}