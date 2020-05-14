<?php

use Illuminate\Database\Seeder;

class article_has_articlecategory_seeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $ab_article_has_articlecategory = array();
        if (($handle = fopen("./database/seeds/article_has_articlecategory.csv", "r")) !== FALSE) {
            // Skip first line
            fgetcsv($handle);
            while (($data = fgetcsv($handle, 1000, ";")) !== FALSE) {
                array_push($ab_article_has_articlecategory, array(
                    "ab_articlecategory_id" => $data[0],
                    "ab_article_id" => $data[1],
                ));
            }
            fclose($handle);
        }

        DB::table('ab_article_has_articlecategory')->insert($ab_article_has_articlecategory);
    }
}
