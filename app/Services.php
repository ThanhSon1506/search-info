<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Services extends Model
{
    protected $table = 'services';
    protected $primaryKey = 'id';
    public $timestamps = false;

    protected $fillable = [
        'services_name', 'services_description', 'services_slug'
    ];

}
