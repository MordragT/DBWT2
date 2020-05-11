<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Shoppingcart extends Model
{
    protected $table = 'ab_shoppingcart';
    public $timestamps = false;
    public $incrementing = true;
    protected $fillable = ['id', 'ab_creator_id', 'ab_createdate'];

    public static function search($id)
    {
        return Shoppingcart::where('ab_creator_id', $id)->first();

    }
}
