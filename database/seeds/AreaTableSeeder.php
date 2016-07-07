<?php

use App\Area;
use Illuminate\Database\Seeder;

class AreaTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Faker\Factory::create('en_GB');
        for ($i = 0; $i < 50; $i++)
        {
            $person = new Area();
            $person->townCity = $faker->city;
            $person->county = $faker->county;
            $person->country = "United Kingdom";

            $person->save();
            echo $person, "\n";
        }
    }
}
