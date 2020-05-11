<?php

namespace App\Http\Controllers;

use App\Shoppingcart;
use App\ShoppingcartItem;
use Illuminate\Http\Request;
use PhpParser\Node\Scalar\String_;

class WarenkorbController extends Controller
{

    public function add_article_api(Request $request)
    {
        //$user_id = $request->session()->get('user_id');
        $user_id = 6;
        $user_shoppingcart = Shoppingcart::search($user_id);

        if($user_shoppingcart['ab_creator_id'] == null) {

            $shoppingcart = new Shoppingcart([
                'id' => Shoppingcart::max('id') + 1,
                'ab_creator_id' => $user_id,
                'ab_createdate' => date('Y-m-d H:i:s'),
            ]);

            $shoppingcart->save();
            $user_shoppingcart = Shoppingcart::search($user_id);
        }

        $user_shoppingcart_item = ShoppingcartItem::search($user_shoppingcart['id'],$request->get('id'));

        if($user_shoppingcart_item['id'] == null) {

            $shoppingcart_item = new ShoppingcartItem([
                'id' => ShoppingcartItem::max('id') + 1,
                'ab_shoppingcart_id' => $user_shoppingcart['id'],
                'ab_article_id' => $request->get('id'),
                'ab_createdate' => date('Y-m-d H:i:s'),
            ]);

            $shoppingcart_item->save();
        }
    }

    public function getItems(Request $request)
    {
        $user_id = $request->session()->get('user_id');
        //$user_id = 6;
        $user_shoppingcart = Shoppingcart::search($user_id);
        $shoppingcart_id = $user_shoppingcart['id'];

        $items = ShoppingcartItem::getItems($shoppingcart_id);
        return response()->json($items);
    }

    public function delete_article_api($shoppingcartid,$articleId){
        $item = ShoppingcartItem::where('ab_shoppingcart_id',$shoppingcartid)->where('ab_article_id',$articleId);
        if (isset($item)) {
            $item->delete();
            return response()->json('success', 200);
        } else {
            return response()->json('ID not found.', 404);
        }
    }
}
