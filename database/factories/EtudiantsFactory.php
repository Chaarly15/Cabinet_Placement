<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Model>
 */
class EtudiantsFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            "nom" => fake()->lastName,
            "prenom" => fake()->firstName,
            "residence" => fake()->address,
            "sexe" => fake()->randomElement(['M', 'F']),
            "matricule" => fake()->randomElement([fake()->numberBetween(1, 100)]),
            "filiere" => fake()->name,
            "niveau_etude" => fake()->name,
            "competences" =>  json_encode([0 => "Math", 1=> "Angluar", 2=> "Angluar"])
        ];
    }
}
