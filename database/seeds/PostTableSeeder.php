<?php

use Illuminate\Database\Seeder;

class PostTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(App\Models\Post::class, 1)->create([
            'title' => 'Hello World',
            'content' => 'This is the first article of this system.',
            'updated_at' =>  date_create(),
            'user_id' => 1,
            'category_id' => 1,
        ]);
        factory(App\Models\Post::class, 9)->create();
    }
}
