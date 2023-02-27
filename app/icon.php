<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class icon extends Model
{
    protected $table = 'icons';
    protected $primaryKey = 'id';
    public $timestamps = false;
}
