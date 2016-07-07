<?php

use App\Ticket;
use Illuminate\Database\Seeder;

class TicketTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $medias = ["Photo", "Song", "Video", "Area"];
        $access_levels = ["All", "Family", "Carers"];

        $faker = Faker\Factory::create('en_GB');
        for ($i = 0; $i < 5; $i++)
        {
            $ticket = new Ticket();
            $ticket->title = "Generated Ticket: " . $i;
            $ticket->description = $faker->realText($maxNbChars = 200, $indexSize = 2);
            $ticket->year = rand(1970, 2016);
            $ticket->mediaType = $medias[rand(0, 3)];
            $ticket->access_level = $access_levels[rand(0, 2)];
            $ticket->pathToFile = "/generated";
            $ticket->area_id = rand(1, 50);
            $ticket->person_id = 2;
            $ticket->save();

            echo $ticket, "\n";
        }
    }
}
