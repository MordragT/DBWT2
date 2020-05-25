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
}
