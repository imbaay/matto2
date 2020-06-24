<?php

use Faker\Factory;
use App\Nation;
use Illuminate\Database\Seeder;

class NationsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Factory::create();
        $nations = [];

        for($i = 1; $i <= 8; $i++)
        {
            $nations [] = [
                'name' => $faker->name,
                'slug'=> $faker->slug(2),
                'bio' => $faker->paragraphs(rand(2,4), true)
            ];
        }

        Nation::truncate();
        Nation::insert($nations);
    }
}
