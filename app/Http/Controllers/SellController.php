<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Article;

class SellController extends Controller
{
    public function sell(Request $request)
    {
        $this->validate($request, [
            'name' => 'required',
            'description' => 'required',
            'price' => 'required|numeric|min:1',
        ]);

        $article = new Article([
            // Warum ist das notwendig ? Obwohl table migration auto increment
            // und seeds in laravel, kein manuelles einfügen
            'id' => Article::max('id') + 1,
            'ab_name' => $request->name,
            'ab_price' => $request->price,
            'ab_description' => $request->description,
            'ab_creator_id' => 5,
            'ab_createdate' => date('Y-m-d H:i:s'),
        ]);
        $article->save();

        return redirect(route('articles'));
    }
}
