<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Cviebrock\EloquentSluggable\Sluggable;
use App\Categories;
class News extends Model
{
    use Sluggable;
    protected $table = 'news';
    protected $primaryKey = 'id';
    public $timestamps = true;


    protected $fillable = [
        'title', 'image', 'summary','content','category_id','created_at'
    ];
        
    public function sluggable()
    {
        return [
            'slug' => [
                'source' => 'title'
            ]
        ];
    }
    public function categories(){
        return $this->belongsTo('App\Categories','category_id');
    }
}
