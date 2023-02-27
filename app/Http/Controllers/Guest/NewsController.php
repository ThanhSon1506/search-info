<?php

namespace App\Http\Controllers\guest;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Artesaos\SEOTools\Facades\SEOMeta;
use Artesaos\SEOTools\Facades\SEOTools;
use Artesaos\SEOTools\Facades\OpenGraph;
use Artesaos\SEOTools\Facades\TwitterCard;
use Artesaos\SEOTools\Facades\JsonLd;
use Artesaos\SEOTools\Facades\JsonLdMulti;
use Illuminate\Http\Request;
use App\News;
use App\Categories;
class NewsController extends Controller
{
    // Fetch data new
    public function getNews(){
        SEOMeta::setTitle('Tin tức');
        OpenGraph::addProperty('site_name', "Tin tức");
        return view('Guest.pages.new.new');
    }
    // Fetch data in data by id news
    public function getNewsDetail(Request $request){
        $news = News::where('slug','=',$request->slug)->first();
        SEOTools::setCanonical(url("/news/detail/".$news->slug));
        SEOMeta::setTitle($news->title);
        SEOMeta::setDescription($news->summary);
        SEOMeta::addMeta('article:section', 'Tin tức', 'property');
        SEOMeta::addMeta('article:published_time', $news->created_at, 'property');
        SEOMeta::addMeta('article:modified_time', $news->updated_at, 'property');

        OpenGraph::addProperty('locale','vi_VN');
        OpenGraph::addProperty('type', 'article');
        OpenGraph::addProperty('title', $news->title);
        OpenGraph::addProperty('updated_time', $news->updated_at);
        OpenGraph::addProperty('site_name', $news->title);
        if($news->image){
            OpenGraph::addImage([asset('uploads/'.$news->image), 'size' => 300]);
            OpenGraph::addImage(['secure_url'=>asset('uploads/'.$news->image)]);
        }
        else{
            OpenGraph::addImage([asset('uploads/'.getConfigSetting()->guest_logo_header), 'size' => 300]);
            OpenGraph::addImage(['secure_url'=>asset('uploads/'.getConfigSetting()->guest_logo_header)]);
        }
        OpenGraph::addImage(['alt'=>$news->image]);
        OpenGraph::addImage(['type'=>"image/png"]);

        TwitterCard::addValue("card", $news->image);
        TwitterCard::addValue("title", $news->title);
        TwitterCard::addValue("description", $news->content);
        TwitterCard::addValue("image",asset('uploads/news/'.$news->image));


        JsonLd::setTitle($news->title);
        JsonLd::setDescription($news->description);
        JsonLd::addValue('@id', $news->id);
        
        JsonLdMulti::addImage([asset('uploads/news/'.$news->image), 'size' => 300]);
        JsonLdMulti::setType('Article');

        return view('Guest.pages.new.detail',['news' => $news]);
    }
    // Fetch data in data by categories
    public function getNewsCategory(Request $request){
        $news=DB::table('news')->join('categories','news.category_id','=','categories.id')
        ->where('categories.slug','=',$request->slug) ->select('news.*')->paginate(5);
        $categories=Categories::where('slug','=',$request->slug)->first();
        SEOMeta::setTitle($categories->name);
        SEOMeta::addMeta('article:section', 'Tin tức', 'property');
        OpenGraph::addProperty('locale','vi_VN');
        OpenGraph::addProperty('type', 'article');
        OpenGraph::addProperty('site_name',$request->slug);
        TwitterCard::addValue("title", $request->slug);
        JsonLd::setTitle($request->slug);
        JsonLdMulti::setType('Article');
        return view('Guest.pages.new.category',['news'=>$news]);
    }   
}
