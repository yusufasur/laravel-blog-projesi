<?php

use Illuminate\Database\Seeder;

class ConfigSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \DB::table('configs')->insert([
            'title' => 'Laravel Blog Projesi',
            'created_at' => now(),
            'updated_at' => now(),
        ]);
    }
}
