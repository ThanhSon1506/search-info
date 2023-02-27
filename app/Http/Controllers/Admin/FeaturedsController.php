<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Featureds;
use Illuminate\Support\Facades\Validator;

class FeaturedsController extends Controller
{
    public function fetchData(Request $request){
        $columns [] ='id';
        $columns [] ='title';
        $columns [] ='des';
        $limit = $request->input('length');
        $start = $request->input('start');
        $order = $columns[$request->input('order.0.column')];
        $dir = $request->input('order.0.dir');
        $search = $request->input('search');
        $totalData =  featureds::count();
        $fearureds = featureds::offset($start)
        ->limit($limit)
        ->orderBy($order,$dir)
        ->get();
        $data = array(
            "draw"            => intval($request->input('draw')),  
            "recordsTotal"    => intval($totalData),  
            "recordsFiltered" => intval($totalData), 
            "data"            => $fearureds   
        );
        return $data; 
    }
    public function insert(Request $request){
        $message=[
            'featureds_title.required'=>"Tiêu đề không được để trống",
            'featureds_title.min:3'=>"Tiêu đề tối thiểu 3 ký tự",
        ];
        $validate=Validator::make($request->all(),[
            'featureds_title'=>['required','min:3','max:100'],
        ],$message);
        if($validate->fails()){
            return response()->json([
                'statusBoolean'=>0,
                'msg'=>$validate->errors()->first(),
                'code'=>200
            ]);
        }
        try {
            $fearureds = new featureds();
            $fearureds->title = removeTagScript($request->featureds_title);
            $fearureds->icon = removeTagScript($request->featureds_icon);
            $fearureds->des = removeTagScript($request->featureds_des);
            $fearureds->save();
            return success($fearureds);
        } catch (\Exception $ex) {
            return error($ex->getMessage());
        }
    }
    // Get data header home by id
    public function getDataById(Request $request){
        $fearureds=featureds::where('id','=',$request->id)->first();
        if($fearureds){
            return response()->json([
                'status'=>1,
                'message'=>"Lấy dữ liệu danh mục",
                'code'=>200,
                'data'=>$fearureds,
            ]);
        }
        return response()->json([
            'status'=>0,
            'message'=>"Lấy dữ liệu thất bại",
            'code'=>400,
            'data'=>$fearureds,
        ]);
    
    }
    // 
    // Insert data categories
    public function updateData(Request $request){
        $message=[
            'featureds_title.required'=>"Tiêu đề không được để trống",
            'featureds_title.min:3'=>"Tiêu đề tối thiểu 3 ký tự",
        ];
        $validate=Validator::make($request->all(),[
            'featureds_title'=>['required','min:3','max:100'],
        ],$message);
        if($validate->fails()){
            return response()->json([
                'statusBoolean'=>0,
                'msg'=>$validate->errors()->first(),
                'code'=>200
            ]);
        }
        
        try {
            $fearureds = featureds::where("id",'=',$request->id)->first();
            $fearureds->title = removeTagScript($request->featureds_title);
            $fearureds->icon = removeTagScript($request->featureds_icon);
            $fearureds->des = removeTagScript($request->featureds_des);
            $fearureds->save();
            return success($fearureds);
        } catch (\Exception $ex) {
            return error($ex->getMessage());
        }
        
    }
    // Delete data categories
    public function delete(Request $request){
    try {
        $fearureds = featureds::where("id",'=',$request->id)->first();
        $fearureds->delete();
        return success($fearureds);
    } catch (\Exception $ex) {
        return error($ex->getMessage());
    }
    }
}
