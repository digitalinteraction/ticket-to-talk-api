<?php

use App\Inspiration;
use Illuminate\Database\Seeder;

class InspirationTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $inspirations = [];

        $file = fopen("Inspiration.txt", "r");

        while(! feof($file))
        {
            $rawIns = explode(" - ", fgets($file));
//            print $rawIns[0] . "\n";
//            print $rawIns[1] . "\n";
//            print $rawIns[2] . "\n";

            $ins = new Inspiration();
            $ins->question = $rawIns[0];
            $ins->prompt = $rawIns[1];
            $ins->mediaType = $rawIns[2];

            array_push($inspirations, $ins);
        }
        fclose($file);

        $first = array_shift($inspirations);
        foreach ($inspirations as $ins)
        {
            print $ins . "\n";
            $ins->save();
        }
    }
}
