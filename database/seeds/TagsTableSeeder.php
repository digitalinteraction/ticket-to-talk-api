<?php

use App\Tag;
use Illuminate\Database\Seeder;

class TagsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $tags = [
            "Family",
            "Beach",
            "Party",
            "Holiday",
            "Camping",
            "BBQ",
            "Old",
            "Photo",
            "Grandma",
            "Granddad",
            "Friends",
            "Anniversary",
            "Food",
            "Home",
            "Meal",
            "Wedding",
            "Swimming",
            "Graduation",
            "Baby",
            "Restaurant",
            "Baking",
            "Laughing",
            "Fishing",
            "Knitting",
            "School",
            "Boat",
            "Games"
        ];

        foreach ($tags as $tag_item)
        {
            $tag = new Tag();
            $tag->text = $tag_item;
            $tag->save();
            echo $tag, "\n";
        }
    }
}
