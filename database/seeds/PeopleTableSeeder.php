<?php

use Illuminate\Database\Seeder;

class PeopleTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Faker\Factory::create('en_GB');
        for ($i = 0; $i < 5; $i++)
        {
            $person = new \App\Person();
            $person->name = $faker->name;
            $person->birthPlace = $faker->city;
            $person->birthYear = $faker->year($max = 1970);
            $person->admin_id = 1;
            $person->address_id = rand(1, 50);
            $person->save();

            echo $person, "\n";
        }
    }
}
