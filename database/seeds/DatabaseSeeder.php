<?php

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Model::unguard();

        // $this->call(UserTableSeeder::class);
        factory(App\Models\Post::class, 10)->create();
        factory(App\Models\Tag::class, 5)->create();
        factory(App\Models\Category::class, 3)->create();

        Model::reguard();
    }
}
