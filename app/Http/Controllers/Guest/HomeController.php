<?php

namespace App\Http\Controllers\Guest;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Artesaos\SEOTools\Facades\SEOMeta;
use Artesaos\SEOTools\Facades\SEOTools;
use Artesaos\SEOTools\Facades\OpenGraph;
use Artesaos\SEOTools\Facades\TwitterCard;
use Artesaos\SEOTools\Facades\JsonLd;
use Artesaos\SEOTools\Facades\JsonLdMulti;
use App\User;
use App\Projects;
use App\Categories;
class HomeController extends Controller
{
    // public function index(){
    //     // Tin tức nhanh - mới - nóng nhất đang diễn ra về: kinh tế, chính trị, xã hội, thế giới, giáo dục, thể thao, văn hóa, giải trí, công nghệ.
    //     SEOMeta::setTitle(getConfigSetting()->title);
    //     SEOMeta::addMeta('article:section', getConfigSetting()->title, 'property');
    //     OpenGraph::addProperty('locale','vi_VN');
    //     OpenGraph::addProperty('type', 'article');
    //     OpenGraph::addProperty('title', getConfigSetting()->title);
    //     OpenGraph::addProperty('site_name', getConfigSetting()->title);
    //     OpenGraph::addImage([asset('uploads/'.getConfigSetting()->guest_logo_header)]);
    //     OpenGraph::addImage(['secure_url'=>asset('uploads/'.getConfigSetting()->guest_logo_header)]);

    //     TwitterCard::addValue("title", getConfigSetting()->title);
    //     TwitterCard::addValue("card", getConfigSetting()->guest_logo_header);
    //     TwitterCard::addValue("description", $news->content);
    //     TwitterCard::addValue("image",asset('uploads/news/'.$news->image));

    //     JsonLd::setTitle(getConfigSetting()->title);
    //     JsonLdMulti::setType('Article');
    //     return view('guest.pages.home.index');
    // }
    public function getHome()
    {
        SEOMeta::setTitle('Tìm kiếm thông tin');
        $categories =Categories::whereNull('category_id')->with('childrenCategories')->get();
        // dd($categories);
       return view('guest.pages.home.home',compact('categories')); 
    }

    public function searchInfomation(Request $Request){
		$columns[] = 'id';
        $columns[] = 'full_name';
        $columns[] = 'phone_number';
        $columns[] = 'services_name';
        $columns[] = 'projects_name';
        $columns[] = 'keyword';
        $columns[] = 'time_end';
        $columns[] = 'id';

        $limit = $Request->input('length');
        $start = $Request->input('start');
        $order = $columns[$Request->input('order.0.column')];
        $dir = $Request->input('order.0.dir');
        $search = $Request->input('search');

        $totalData = User::leftJoin('projects', 'users.id', '=', 'projects.userID')
        ->leftJoin('services', 'services.id', '=', 'projects.serviceID')->count();

        if(empty($search)){
            $Users = User::leftJoin('projects', 'users.id', '=', 'projects.userID')
            ->leftJoin('services', 'services.id', '=', 'projects.serviceID')
            ->select(
                'users.id',
                'users.full_name',
                'users.phone_number',
                'users.keyword',
                'projects.projects_name',
                'projects.time_end',
                'services.services_name'
            )
            ->offset($start)
            ->limit($limit)
            ->orderBy($order, $dir)
	        ->get();
        }else{
	        $Users = User::leftJoin('projects', 'users.id', '=', 'projects.userID')
				->leftJoin('services', 'services.id', '=', 'projects.serviceID')
                ->Where(function($query)use($search){
                    $query->where('users.full_name', '=', "{$search}")
                    ->orwhere('users.keyword', '=', "{$search}")
				    ->orwhere('users.phone_number', '=', "{$search}");
                })
				->select(
                    'users.id',
                    'users.full_name',
                    'users.phone_number',
                    'users.keyword',
                    'projects.projects_name',
                    'projects.time_end',
                    'services.services_name'
                )
	            ->offset($start)
	            ->limit($limit)
	            ->orderBy($order, $dir)
	            ->get();
		}
        $json_data = array(
            "draw"            => intval($Request->input('draw')),
            "recordsTotal"    => intval($totalData),
            "recordsFiltered" => intval($totalData),
            "data"            => $Users
        );
        echo json_encode($json_data);
	}

    public function getInformation(Request $Request){
		$projectID = $Request->projectID;
		$project = Projects::where('projects.projects_name', '=' , $projectID)->first();
        return response()->json([
            'name' => 'Thành công',
            'status' => 200,
            'data' => $project
        ]);

	}

}
