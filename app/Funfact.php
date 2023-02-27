<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Funfact extends Model
{
    protected $table = 'funfacts';
    protected $primaryKey = 'id';
    public $timestamps = false;
}
