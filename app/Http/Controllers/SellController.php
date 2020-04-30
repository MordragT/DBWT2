<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Article;

class SellController extends Controller
{
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
            return redirect(route('sell'))
                ->withErrors($validator);
            /*
            return response([
                'success' => false,
                'errors' => $validator->errors(),
            ]);
            */
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
            $article->save();

            return redirect(route('articles'));
        }
    }
}
