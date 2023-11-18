<?php

namespace Database\Factories;

use App\Models\TestFullText;
use Database\Seeders\TestFullTextSeeder;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\TestFullText>
 * @mixin TestFullTextSeeder
 */
class TestFullTextFactory extends Factory
{

    protected $model=TestFullText::class;
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $title=fake()->title(50);
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
