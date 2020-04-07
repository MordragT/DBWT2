<?php

namespace App\Http\Controllers;

use App\ArticlesModel;
use Illuminate\Http\Request;

class ArticlesController extends Controller
{
    public function search(Request $request){

        $name = $request->input('search');
        $ergebnis = ArticlesModel::search($name);

        /*
        $articles = array();

        foreach ($ergebnis as $article){
            array_push($articles, array("id" => $article->id,
            "ab_name" => $article->ab_name,
            "ab_price" => $article->ab_price,
            "ab_description" => $article->ab_description,
            "ab_createdate" => $article->ab_createdate,
            "user_id" => $article->ab_creator_id )
            );
        }
        */

        return view('pages.articles',["articles" =>$ergebnis]); // optional $articles

    }
}
