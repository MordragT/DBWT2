<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Validator;
use App\Article;
use Illuminate\Http\Request;
use Illuminate\Database\QueryException;

class ArticleController extends Controller
{
    public function search(Request $request)
    {

        $name = $request->input('search');
        $ergebnis = Article::search($name);

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

        return view('pages.articles', ["articles" => $ergebnis]); // optional $articles

    }

    public function sell(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|max:80',
            'description' => 'required|max:1000',
            'price' => 'required|numeric|min:1',
        ], [
            'name.max' => "Leider ist der Artikelname zu lang.",
            'description.max' => "Leider ist die Beschreibung zu lang.",
        ]);

        if ($validator->fails()) {
            return back()
                ->withErrors($validator);
        } else {
            $temp = $validator->validated();
            $article = new Article([
                // Warum ist das notwendig ? Obwohl table migration auto increment
                // und seeds in laravel, kein manuelles einfügen
                'id' => Article::max('id') + 1,
                'ab_name' => $temp['name'],
                'ab_price' => $temp['price'],
                'ab_description' => $temp['description'],
                'ab_creator_id' => 5,
                'ab_createdate' => date('Y-m-d H:i:s'),
            ]);
            try {
                $article->save();
            } catch (QueryException $e) {
                return back()
                    ->withErrors(['database' => 'Fehler mit der Datenbank.']);
            }

            return redirect(route('articles'));
        }
    }

    public function search_api(Request $request)
    {
        $articles = Article::search($request->input('search'));
        if (!$articles->isEmpty()) {
            return response()->json($articles, 200);
        } else {
            return response()->json("Keine Artikel gefunden", 404);
        }
    }

    public function sell_api(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|max:80',
            'description' => 'required|max:1000',
            'price' => 'required|numeric|min:1',
        ], [
            'name.max' => "Leider ist der Artikelname zu lang.",
            'description.max' => "Leider ist die Beschreibung zu lang.",
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors(), 400);
        } else {
            $temp = $validator->validated();
            $article = new Article([
                // Warum ist das notwendig ? Obwohl table migration auto increment
                // und seeds in laravel, kein manuelles einfügen
                'id' => Article::max('id') + 1,
                'ab_name' => $temp['name'],
                'ab_price' => $temp['price'],
                'ab_description' => $temp['description'],
                'ab_creator_id' => 5,
                'ab_createdate' => date('Y-m-d H:i:s'),
            ]);
            try {
                $article->save();
            } catch (QueryException $e) {
                return response()->json(
                    ['database' => 'Fehler mit der Datenbank.'],
                    500,
                );
            }

            return response()->json(
                $article->id,
                200,
            );
        }
    }

    public function delete($id)
    {
        $article = Article::find($id);
        if (isset($article)) {
            $article->delete();
            return response()->json('success', 200);
        } else {
            return response()->json('ID not found.', 404);
        }
    }
}
