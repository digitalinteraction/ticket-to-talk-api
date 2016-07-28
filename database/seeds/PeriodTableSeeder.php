<?php

use App\Period;
use Illuminate\Database\Seeder;

class PeriodTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $standard_periods =
            [
                "Childhood",
                "Teenager",
                "Adult",
                "Retirement"
            ];

        foreach ($standard_periods as $period_text)
        {
            $period = new Period();
            $period->text = $period_text;
            $period->save();
        }
    }
}
