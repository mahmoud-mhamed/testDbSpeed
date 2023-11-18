<?php

namespace Database\Seeders;

use App\Models\TestFullText;
use Illuminate\Database\Seeder;

class TestFullTextSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        TestFullText::truncate();
        for ($i = 0; $i < 1000; $i++) {
            TestFullText::factory()->count(1000)->create();
        }
    }
}
