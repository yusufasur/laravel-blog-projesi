<?php

use Illuminate\Database\Seeder;

class PageSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $pages = ['Hakkımızda', 'Kariyer', 'Vizyonumuz', 'Misyonumuz'];
        $count = 0;
        foreach ($pages as $page) {
            $count++;
            $pagesArr[] = [
                'title' => $page,
                'slug' => Str::slug($page),
                'image' => 'http://placehold.it/800x400',
                'content' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit.
                              Suspendisse eget turpis in orci rutrum volutpat ut vitae eros.
                              Maecenas condimentum mattis leo sit amet tempus.
                              Nulla molestie elit ipsum, in eleifend est efficitur nec.
                              Suspendisse at viverra nisi, sed mattis metus.
                              Aliquam efficitur, nulla sit amet lacinia fermentum, turpis justo tincidunt turpis,
                              nec iaculis magna est ac magna. Etiam ante eros, volutpat a mollis sed, pellentesque ac diam. Aenean nec libero eros.',
                'order' => $count,
                'created_at' => now(),
                'updated_at' => now()
            ];
        }

        DB::table('pages')->insert($pagesArr);
    }
}
