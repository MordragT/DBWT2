<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class User extends Model
{
    protected $table = 'ab_user';
    public $timestamps = false;
    public $incrementing = true;
    protected $fillable = ['id', 'ab_name', 'ab_password', 'ab_mail'];
}
