<?php

use Illuminate\Database\Seeder;

class MisionesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(App\Models\misiones::class, 30)->create();
    }
}
