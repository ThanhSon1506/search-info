<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Awesome extends Model
{
    protected $table = 'awesome';
    protected $primaryKey = 'id';
    public $timestamps = false;
}
