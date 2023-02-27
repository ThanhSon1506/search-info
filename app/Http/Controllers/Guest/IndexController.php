<?php

namespace App\Http\Controllers\guest;

use Artesaos\SEOTools\Facades\SEOMeta;
use Artesaos\SEOTools\Facades\SEOTools;
use Artesaos\SEOTools\Facades\OpenGraph;
use Artesaos\SEOTools\Facades\TwitterCard;
use Artesaos\SEOTools\Facades\JsonLd;
use Artesaos\SEOTools\Facades\JsonLdMulti;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class IndexController extends Controller
{
    public function index(){
        SEOMeta::setTitle(getConfigSetting()->title);
        SEOMeta::setDescription(getConfigSetting()->web_des);
        SEOMeta::addMeta('article:section', getConfigSetting()->title, 'property');
        OpenGraph::addProperty('locale','vi_VN');
        OpenGraph::addProperty('type', 'article');
        OpenGraph::addProperty('title', getConfigSetting()->title);
        OpenGraph::addProperty('site_name', getConfigSetting()->title);
        OpenGraph::addImage([asset('uploads/'.getConfigSetting()->guest_logo_header)]);
        OpenGraph::addImage(['secure_url'=>asset('uploads/'.getConfigSetting()->guest_logo_header)]);

        TwitterCard::addValue("title", getConfigSetting()->title);
        TwitterCard::addValue("card", getConfigSetting()->guest_logo_header);
        TwitterCard::addValue("description", getConfigSetting()->web_des);
        TwitterCard::addValue("image",asset('uploads/'.getConfigSetting()->guest_logo_header));

      
        JsonLd::setTitle(getConfigSetting()->title);
        JsonLd::setDescription(getConfigSetting()->web_des);
        
        JsonLdMulti::addImage([asset('uploads/'.getConfigSetting()->guest_logo_header), 'size' => 300]);
        JsonLdMulti::setType('Article');
        return view('guest.pages.home.index');
    }
}
