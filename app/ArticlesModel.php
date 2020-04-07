<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class ArticlesModel extends Model
{
    public static function search($name){

        /*
        $articles = DB::table('ab_article')
                    ->where('ab_name', 'ilike', '%'.$name.'%')
                    ->get();
        */

        $articles = DB::select("SELECT * FROM ab_article WHERE lower(ab_article.ab_name) LIKE lower('%$name%')");

        return $articles;
    }
}
