<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\skill_area;
use Illuminate\Support\Facades\Validator;

class SkillAreaController extends Controller
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
        $totalData =  skill_area::count();
        $skill_areas = skill_area::offset($start)
        ->limit($limit)
        ->orderBy($order,$dir)
        ->get();
        $data = array(
            "draw"            => intval($request->input('draw')),  
            "recordsTotal"    => intval($totalData),  
            "recordsFiltered" => intval($totalData), 
            "data"            => $skill_areas   
        );
        return $data; 
    }
    public function insert(Request $request){
        $message=[
            'skill_area_title.required'=>"Tiêu đề không được để trống",
            'skill_area_title.min:3'=>"Tiêu đề tối thiểu 3 ký tự",
        ];
        $validate=Validator::make($request->all(),[
            'skill_area_title'=>['required','min:3','max:100'],
        ],$message);
        if($validate->fails()){
            return response()->json([
                'statusBoolean'=>0,
                'msg'=>$validate->errors()->first(),
                'code'=>200
            ]);
        }
        try {
            $skill_areas = new skill_area();
            $skill_areas->title = removeTagScript($request->skill_area_title);
            $skill_areas->save();
            return success($skill_areas);
        } catch (\Exception $ex) {
            return error($ex->getMessage());
        }
    }
    // Get data header home by id
    public function getDataById(Request $request){
        $skill_areas=skill_area::where('id','=',$request->id)->first();
        if($skill_areas){
            return response()->json([
                'status'=>1,
                'message'=>"Lấy dữ liệu danh mục",
                'code'=>200,
                'data'=>$skill_areas,
            ]);
        }
        return response()->json([
            'status'=>0,
            'message'=>"Lấy dữ liệu thất bại",
            'code'=>400,
            'data'=>$skill_areas,
        ]);
    
    }
    // 
    // Insert data categories
    public function updateData(Request $request){
        $message=[
            'skill_area_title.required'=>"Tiêu đề không được để trống",
            'skill_area_title.min:3'=>"Tiêu đề tối thiểu 3 ký tự",
        ];
        $validate=Validator::make($request->all(),[
            'skill_area_title'=>['required','min:3','max:100'],
        ],$message);
        if($validate->fails()){
            return response()->json([
                'statusBoolean'=>0,
                'msg'=>$validate->errors()->first(),
                'code'=>200
            ]);
        }
        
        try {
            $skill_areas = skill_area::where("id",'=',$request->id)->first();
            $skill_areas->title = removeTagScript($request->skill_area_title);
            $skill_areas->save();
            return success($skill_areas);
        } catch (\Exception $ex) {
            return error($ex->getMessage());
        }
        
    }
    // Delete data categories
    public function delete(Request $request){
    try {
        $skill_areas = skill_area::where("id",'=',$request->id)->first();
        $skill_areas->delete();
        return success($skill_areas);
    } catch (\Exception $ex) {
        return error($ex->getMessage());
    }
    }
}
