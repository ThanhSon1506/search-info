<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\header_home;
use Illuminate\Support\Facades\Validator;

class HeaderHomeController extends Controller
{
    public function fetchData(Request $request){
        $columns [] ='id';
        $columns [] ='title';
        $columns [] ='icon';
        $columns [] ='des';
        $limit = $request->input('length');
        $start = $request->input('start');
        $order = $columns[$request->input('order.0.column')];
        $dir = $request->input('order.0.dir');
        $search = $request->input('search');
        $totalData =  header_home::count();
        $header_homes = header_home::offset($start)
        ->limit($limit)
        ->orderBy($order,$dir)
        ->get();
        $data = array(
            "draw"            => intval($request->input('draw')),  
            "recordsTotal"    => intval($totalData),  
            "recordsFiltered" => intval($totalData), 
            "data"            => $header_homes   
        );
        return $data; 
    }
    public function insert(Request $request){
        $message=[
            'header_home_title.required'=>"Tiêu đề không được để trống",
            'header_home_title.min:3'=>"Tiêu đề tối thiểu 3 ký tự",
        ];
        $validate=Validator::make($request->all(),[
            'header_home_title'=>['required','min:3','max:100'],
        ],$message);
        if($validate->fails()){
            return response()->json([
                'statusBoolean'=>0,
                'msg'=>$validate->errors()->first(),
                'code'=>200
            ]);
        }
        try {
            $header_homes = new header_home();
            $header_homes->title = removeTagScript($request->header_home_title);
            $header_homes->icon = removeTagScript($request->header_home_icon);
            $header_homes->background = removeTagScript($request->header_home_background);
            $header_homes->des = removeTagScript($request->description);
            $header_homes->save();
            return success($header_homes);
        } catch (\Exception $ex) {
            return error($ex->getMessage());
        }
    }
    // Get data header home by id
    public function getDataById(Request $request){
        $header_homes=header_home::where('id','=',$request->id)->first();
        if($header_homes){
            return response()->json([
                'status'=>1,
                'message'=>"Lấy dữ liệu danh mục",
                'code'=>200,
                'data'=>$header_homes,
            ]);
        }
        return response()->json([
            'status'=>0,
            'message'=>"Lấy dữ liệu thất bại",
            'code'=>400,
            'data'=>$header_homes,
        ]);
    
    }
    // 
    // Insert data categories
    public function updateData(Request $request){
        $message=[
            'header_home_title.required'=>"Tiêu đề không được để trống",
            'header_home_title.min:3'=>"Tiêu đề tối thiểu 3 ký tự",
        ];
        $validate=Validator::make($request->all(),[
            'header_home_title'=>['required','min:3','max:100'],
        ],$message);
        if($validate->fails()){
            return response()->json([
                'statusBoolean'=>0,
                'msg'=>$validate->errors()->first(),
                'code'=>200
            ]);
        }
        
        try {
            $header_homes = header_home::where("id",'=',$request->id)->first();
            $header_homes->title = removeTagScript($request->header_home_title);
            $header_homes->icon = removeTagScript($request->header_home_icon);
            $header_homes->background = removeTagScript($request->header_home_background);
            $header_homes->des = removeTagScript($request->description);
            $header_homes->save();
            return success($header_homes);
        } catch (\Exception $ex) {
            return error($ex->getMessage());
        }
        
    }
    // Delete data categories
    public function delete(Request $request){
    try {
        $header_homes = header_home::where("id",'=',$request->id)->first();
        $header_homes->delete();
        return success($header_homes);
    } catch (\Exception $ex) {
        return error($ex->getMessage());
    }
    }
}
