<?php

use Illuminate\Database\Seeder;

class DevelopmentData extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $ab_user = array();
        if (($handle = fopen("./database/seeds/user.csv", "r")) !== FALSE) {
            // Skip first line
            fgetcsv($handle);
            while (($data = fgetcsv($handle, 1000, ";")) !== FALSE) {
                array_push($ab_user, array(
                    "id" => $data[0],
                    "ab_name" => $data[1],
                    "ab_password" => $data[2],
                    "ab_mail" => $data[3],
                ));
            }
            fclose($handle);

        }

        $ab_article = array();
        if (($handle = fopen("./database/seeds/articles.csv", "r")) !== FALSE) {
            // Skip first line
            fgetcsv($handle);
            while (($data = fgetcsv($handle, 1000, ";")) !== FALSE) {
                array_push($ab_article, array(
                    "id" => $data[0],
                    "ab_name" => $data[1],
                    "ab_price" => $data[2],
                    "ab_description" => $data[3],
                    "ab_creator_id" => $data[4],
                    "ab_createdate" => $data[5],
                ));
            }
            fclose($handle);

        }

        $ab_articlecategory = array();
        if (($handle = fopen("./database/seeds/articlecategory.csv", "r")) !== FALSE) {
            // Skip first line
            fgetcsv($handle);
            while (($data = fgetcsv($handle, 1000, ";")) !== FALSE) {
                array_push($ab_articlecategory, array(
                    "id" => $data[0],
                    "ab_name" => $data[1],
                    "ab_parent" => ($data[2] == 'NULL' ? NULL : $data[2] ),
                ));
            }
            fclose($handle);
        }

        DB::table('ab_user')->insert($ab_user);
        DB::table('ab_article')->insert($ab_article);
        DB::table('ab_articlecategory')->insert($ab_articlecategory);
    }
}
