<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Pages extends Model
{
    protected $table = 'pages';
    protected $primaryKey = 'id';
    public $timestamps = false;

    protected $fillable = [
        'pages_name', 'pages_content', 'pages_slug'
    ];
}
