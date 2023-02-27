<?php

namespace App;

// use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\News;
use Cviebrock\EloquentSluggable\Sluggable;

class Categories extends Model
{
    use Sluggable;
    // use HasFactory;
    const TABLE='categories';
    protected $table = self::TABLE;
    protected $primaryKey = 'id';
    public $timestamps = true;
           
    public function sluggable()
    {
        return [
            'slug' => [
                'source' => 'name'
            ]
        ];
    }
    protected $fillable = [
       'id' ,'name','category_id', 'description', 'created_at','updated_at'
    ];
    public function cats()
    {
        return $this->hasMany(Categories::class,'category_id');
    }
    public function childrenCategories(){
        return $this->hasMany(Categories::class,'category_id')->with('cats');
    }
    public function news(){
        return $this->hasmany('App\News');
    }
    public function parent_cats(){
        return $this->belongsTo(Categories::class,'category_id');
    }
}
