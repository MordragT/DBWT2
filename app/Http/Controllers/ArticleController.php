<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Redis;
use App\Article;
use App\Events\ArticleSold;
use Illuminate\Http\Request;
use Illuminate\Database\QueryException;

class ArticleController extends Controller
{
    public function get_api(Request $request)
    {
        if ($request->input('search') != "") {
            Redis::lrem("lastarticlesearch", 0, $request->input('search'));
            Redis::lpush("lastarticlesearch", $request->input('search'));
        }
        Redis::ltrim("lastarticlesearch", 0, 4);

        $articles = Article::where('ab_name', 'ilike', '%' . $request->input('search') . '%');
        $limit = $request->input('limit');
        $offset = $request->input('offset');

        if (isset($offset))
            $articles->offset($offset);

        if (isset($limit))
            $articles->limit($limit);

        $articles = $articles->get();

        if (!$articles->isEmpty()) {
            return response()->json($articles, 200);
        } else {
            return response()->json("Keine Artikel gefunden", 404);
        }
    }

    public function post_api(Request $request)
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
                'id' => Article::max('id') + 1,
                'ab_name' => $temp['name'],
                'ab_price' => $temp['price'],
                'ab_description' => $temp['description'],
                'ab_creator_id' => $request->session()->get('user_id'),
                'ab_createdate' => date('Y-m-d H:i:s'),
            ]);
            try {
                $article->save();
            } catch (QueryException $e) {
                return response()->json(
                    [
                        'Fehler mit der Datenbank.',
                        $e,
                    ],
                    500
                );
            }

            return response()->json(
                $article->id,
                200
            );
        }
    }

    public function angebot_api(Request $request)
    {
        $name = $request->input('articlename');
        $id = $request->input('userId');
        $client = new \Bloatless\WebSocket\Client;
        $client->connect('localhost', 8000, '/angebot');
        $client->sendData(json_encode([
            'action' => 'echo',
            'data' => $name,
            'userId' => $id,
        ]));

        return response()->json('success', 200);
    }

    public function delete_api($id)
    {
        $article = Article::find($id);
        if (isset($article)) {
            $article->delete();
            return response()->json('success', 200);
        } else {
            return response()->json('ID not found.', 404);
        }
    }

    public function postSold_api($id)
    {
        $article = Article::find($id);
        if (isset($article)) {
            $userID = $article->ab_creator_id;
            event(new ArticleSold($userID, $id));
            return response()->json("Success");
        }
        return response()->json("Failure");
    }
}
