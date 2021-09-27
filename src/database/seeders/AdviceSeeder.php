<?php

namespace Database\Seeders;

use App\Models\Advice;
use Illuminate\Database\Seeder;

class AdviceSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Advice::factory()->count(10)->create();
    }
}
