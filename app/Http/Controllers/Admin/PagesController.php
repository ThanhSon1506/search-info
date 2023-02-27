<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Pages;
use Validator;

class PagesController extends Controller
{
    public function getPage()
    {
       return view('Admin.pages.pages.pages'); 
    }
    public function getDatatable(Request $Request)
    {
      
        $columns [] ='id';
        $columns [] ='pages_name';
       
        $columns [] ='pages_slug';
        $columns [] ='pages_content';
        $columns [] ='id';
     
        $limit = $Request->input('length');
        $start = $Request->input('start');
        $order = $columns[$Request->input('order.0.column')];
        $dir = $Request->input('order.0.dir');
        $search = $Request->input('search');
        $totalData =  Pages::count();
        if(empty($search)){
        $Pages = Pages::offset($start)
        ->limit($limit)
        ->orderBy($order,$dir)
        ->get();
        } else {
            $Pages = Pages::Where(function($query)use($search){
	            $query->where('pages_name', 'LIKE',"%{$search}%")
	            ->orWhere('pages_slug', 'LIKE',"%{$search}%")
	            ->orWhere('pages_content', 'LIKE',"%{$search}%");
	        })
	        ->offset($start)
	        ->limit($limit)
	        ->orderBy($order,$dir)
	        ->get();
	        $totalFiltered =$Pages->count();
        }
        $json_data = array(
            "draw"            => intval($Request->input('draw')),  
            "recordsTotal"    => intval($totalData),  
            "recordsFiltered" => intval($totalData), 
            "data"            => $Pages   
        );
        echo json_encode($json_data); 
    }

    public function postInsertPages(Request $Request) {
        $message = [
            'required'=>":attribute không được để trống",
        ];
        $validate = Validator::make($Request->all(),[
            'pages_name'=>['required','max:150']
            
        ],$message);
        if($validate->fails()){
            return response()->json([
                'status_validate' => 1,
                'data_error' => $validate->errors()->first()
            ]);
        }
        $Pages = new Pages();
	    $Pages->pages_name = removeTagScript($Request->pages_name);
	    $Pages->pages_content = removeTagScript($Request->pages_content);
	    $Pages->pages_slug = change_to_slug($Request->pages_name);
	    if($Pages->save()){
	        return response()->json([
                'name' => 'Thành công',
                'status' => 200,
                'data' => $Pages
            ]);
	    }else{
	        return response()->json([
                'name' => 'Thất bại',
                'status' => 500,
                'data' => $Pages
            ]);
	    }
    }

    public function getUpdatePages(Request $Request) {
        $Pages = Pages::where('id','=',$Request->id)->first();
        return response()->json([
            'name' => 'Thành công',
            'status' => 200,
            'data' => $Pages
        ]);
    }

    public function postUpdatePages(Request $Request)
	{
            $message = [
                'required'=>":attribute không được để trống",
            ];
            $validate = Validator::make($Request->all(),[
                'pages_name'=>['required']
                
            ],$message);
            if($validate->fails()){
                return response()->json([
                    'status_validate' => 1,
                    'data_error' => $validate->errors()->first()
                ]);
            }
	        $Pages =  Pages::find($Request->id);
	        $Pages->pages_name = $Request->pages_name;
		    $Pages->pages_content = $Request->pages_content;
		    $Pages->pages_slug = change_to_slug($Request->pages_name);
	        if($Pages->save()){
                return response()->json([
                    'name' => 'Thành công',
                    'status' => 200,
                    'data' => $Pages
                ]);
            }else{
                return response()->json([
                    'name' => 'Thất bại',
                    'status' => 500,
                    'data' => $Pages
                ]);
            }
	 
	}

    public function destroyPage( Request $Request ) {
        $result = Pages::where('id','=',$Request->id)->delete();
        return success($result);
    }
}
