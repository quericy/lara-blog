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
    protected $seeders = [
        PostTableSeeder::class,
        CategoryTableSeeder::class,
        TagTableSeeder::class,
        PostTagTableSeeder::class,
    ];

    public function run()
    {
        Model::unguard();

        // $this->call(UserTableSeeder::class);
        foreach ($this->seeders as $each_seeder) {
            $this->call($each_seeder);
        }
        Model::reguard();
    }
}
