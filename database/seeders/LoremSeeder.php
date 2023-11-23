<?php

namespace Database\Seeders;

use App\Models\Lorem;
use Illuminate\Database\Seeder;

class LoremSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Lorem::truncate();
//        for ($i = 0; $i <= 1000; $i++) {
        for ($i = 0; $i <= 1; $i++) {
            Lorem::factory()->count(1000)->create();
        }
    }
}
