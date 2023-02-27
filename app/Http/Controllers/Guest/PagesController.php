<?php

namespace App\Http\Controllers\Guest;

use App\Http\Controllers\Controller;
use Artesaos\SEOTools\Facades\SEOMeta;
use Artesaos\SEOTools\Facades\SEOTools;
use Artesaos\SEOTools\Facades\OpenGraph;
use Artesaos\SEOTools\Facades\TwitterCard;
use Artesaos\SEOTools\Facades\JsonLd;
use Artesaos\SEOTools\Facades\JsonLdMulti;
use Illuminate\Http\Request;
use App\Pages;
class PagesController extends Controller
{
    public function getPages(Request $Request)
    {    
        $pages = Pages::where('pages_slug','=',$Request->slug)->first();
            SEOMeta::setTitle($pages->pages_name);
            SEOMeta::addMeta('article:section', getConfigSetting()->title, 'property');
            OpenGraph::addProperty('locale','vi_VN');
            OpenGraph::addProperty('type', 'article');
            OpenGraph::addProperty('title', getConfigSetting()->title);
            TwitterCard::addValue("title", getConfigSetting()->title);
            JsonLd::setTitle(getConfigSetting()->title);
            JsonLdMulti::setType('Article');
            return view('Guest.pages.pages.pages',['pages' => $pages]); 
    }
}
