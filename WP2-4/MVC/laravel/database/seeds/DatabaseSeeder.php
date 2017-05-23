<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
     //   $this->call(PostTableSeeder::class);
        //Zodat je geen posts meer aanmaakt met seeden
        $this->call(TagTableSeeder::class);

        //runnen via cmd
            // php artisan db:seed

    }
}
