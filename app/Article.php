<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Article extends Model
{
    protected $table = 'ab_article';
    public $timestamps = false;
    public $incrementing = true;
    protected $fillable = ['id', 'ab_name', 'ab_price', 'ab_description', 'ab_creator_id', 'ab_createdate'];

    public static function search($name)
    {
        /*
        $articles = DB::table('ab_article')
            ->where('ab_name', 'ilike', '%' . $name . '%')
            ->get();
        $articles = DB::select("SELECT * FROM ab_article WHERE lower(ab_article.ab_name) LIKE lower('%$name%')");

        return $articles;
        */
        return Article::where('ab_name', 'ilike', '%' . $name . '%')->get();
    }
}
