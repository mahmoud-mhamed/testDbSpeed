<?php

namespace Database\Factories;

use App\Models\Lorem;
use Database\Seeders\LoremSeeder;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Lorem>
 * @mixin LoremSeeder
 */
class LoremFactory extends Factory
{

    protected $model=Lorem::class;
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $title=fake()->text(50);
        $description=fake()->text(100);
        return [
            'title' => $title,
            'description' => $description,

            'title_index' => $title,
            'description_index' => $description,

            'title_full' => $title,
            'description_full' => $description,

            'title_full_index' => $title,
            'description_full_index' => $description,
        ];
    }
}
