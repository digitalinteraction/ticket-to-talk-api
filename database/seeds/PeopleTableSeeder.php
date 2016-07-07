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
        for ($i = 0; $i < 100; $i++)
        {
            $person = new \App\Person();
            $person->name = $faker->name;
        }
    }
}
