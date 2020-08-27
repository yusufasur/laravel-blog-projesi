<?php

use Illuminate\Database\Seeder;
use Faker\Factory as Faker;

class ArticleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Faker::create();
        for ($i = 0; $i < 4; $i++) {
            $title = $faker->sentence(6);
            DB::table('articles')->insert([
                'category_id' => rand(1, 7),
                'title' => $title,
                'image' => 'http://placehold.it/800x400', //$faker->imageUrl(800, 400, 'cats', true)
                'content' => $faker->paragraph(6),
                'slug' => Str::slug($title),
                'created_at' => $faker->dateTime('now'),
                'updated_at' => now()
            ]);
        }
    }
}
