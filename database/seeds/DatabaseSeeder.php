<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call(UsersTableSeeder::class);
        $this->call(RolesTableSeeder::class);
        $this->call(CategoriesTableSeeder::class);
        $this->call(PhonesTableSeeder::class);
        $this->call(NationsTableSeeder::class);
        $this->call(ImagesTableSeeder::class);
        $this->call(ReviewsTableSeeder::class);
    }
}
