<?php

use Illuminate\Database\Seeder;

class CategoryTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(App\Models\Category::class)->create([
            'category_name'=>'blog',
        ]);
        factory(App\Models\Category::class)->create([
            'category_name'=>'share',
        ]);
        factory(App\Models\Category::class)->create([
            'category_name'=>'test',
        ]);
    }
}
