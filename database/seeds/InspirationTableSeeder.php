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
        $row = 1;
        if (($handle = fopen("Inspiration.csv", "r")) !== FALSE) {
            while (($data = fgetcsv($handle, 1000, ",")) !== FALSE) {
                $num = count($data);
                $row++;
                $ins = new Inspiration();
                for ($c=0; $c < $num; $c++) {
                    switch($c)
                    {
                        case(0):
                            $ins->question = $data[$c];
                            break;
                        case(1):
                            $ins->prompt = $data[$c];
                            break;
                        case(2):
                            $ins->mediaType = $data[$c];
                            break;
                    }
                }
//                echo $ins, "\n";
                array_push($inspirations, $ins);
            }
            fclose($handle);
        }

        $first = array_shift($inspirations);
        foreach ($inspirations as $ins)
        {
            print $ins . "\n";
            $ins->save();
        }
    }
}
