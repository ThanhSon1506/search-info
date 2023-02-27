<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Services;
use App\Projects;
use Validator;

class ServicesController extends Controller
{
    public function getService()
    {
       return view('Admin.pages.service.service'); 
    }
    public function getDatatable(Request $Request)
    {
      
        $columns [] ='id';
        $columns [] ='services_name';
        $columns [] ='services_slug';
        $columns [] ='id';
     
        $limit = $Request->input('length');
        $start = $Request->input('start');
        $order = $columns[$Request->input('order.0.column')];
        $dir = $Request->input('order.0.dir');
        $search = $Request->input('search');
        $totalData =  Services::count();
        if(empty($search)){
        $Services = Services::offset($start)
        ->limit($limit)
        ->orderBy($order,$dir)
        ->get();
        } else {
            $Services = Services::Where(function($query)use($search){
	            $query->where('services_name', 'LIKE',"%{$search}%")
	            ->orWhere('services_slug', 'LIKE',"%{$search}%");
	        })
	        ->offset($start)
	        ->limit($limit)
	        ->orderBy($order,$dir)
	        ->get();
	        $totalFiltered =$Services->count();
        }
        $json_data = array(
            "draw"            => intval($Request->input('draw')),  
            "recordsTotal"    => intval($totalData),  
            "recordsFiltered" => intval($totalData), 
            "data"            => $Services   
        );
        echo json_encode($json_data); 
    }
    
    public function postInsertServices(Request $Request) {
        $message = [
            'required'=>":attribute không được để trống",
        ];
        $validate = Validator::make($Request->all(),[
            'services_name'=>['required','max:150']
                
        ],$message);
        if($validate->fails()){
            return response()->json([
                'status_validate' => 1,
                'data_error' => $validate->errors()->first()
            ]);
        }
        $Services = new Services();
	    $Services->services_name=removeTagScript($Request->services_name);
	    $Services->services_description=removeTagScript($Request->services_description);
	    $Services->services_slug=change_to_slug($Request->services_name);
	    if($Services->save()){
	        return response()->json([
                'name' => 'Thành công',
                'status' => 200,
                'data' => $Services
            ]);
	    }else{
	        return response()->json([
                'name' => 'Thất bại',
                'status' => 500,
                'data' => $Services
            ]);
	    }
    }
    public function getUpdateServices(Request $Request) {
        $Service = Services::where('id','=',$Request->id)->first();
        return response()->json([
            'name' => 'Thành công',
            'status' => 200,
            'data' => $Service
        ]);
    }

    public function postUpdateServices(Request $Request)
	{
            $message = [
                'required'=>":attribute không được để trống",
            ];
            $validate = Validator::make($Request->all(),[
                'services_name'=>['required']
                    
            ],$message);
            if($validate->fails()){
                return response()->json([
                    'status_validate' => 1,
                    'data_error' => $validate->errors()->first()
                ]);
            }
	        $Services =  Services::find($Request->id);
	        $Services->services_name = removeTagScript($Request->services_name);
		    $Services->services_description = removeTagScript($Request->services_description);
		    $Services->services_slug = change_to_slug($Request->services_name);
	        if($Services->save()){
                return response()->json([
                    'name' => 'Thành công',
                    'status' => 200,
                    'data' => $Services
                ]);
            }else{
                return response()->json([
                    'name' => 'Thất bại',
                    'status' => 500,
                    'data' => $Services
                ]);
            }
	 
	}

    public function destroyService( Request $request ) {
        $projects = Projects::where("serviceID",'=',$request->id)->count();
        if($projects>0){
            return response()->json([
                'statusBoolean'=>0,
                'msg'=>"Dữ liệu đang được sử dụng không thể xóa !",
                'code'=>400
            ]);
        }
        try {
            $services = Services::where("id",'=',$request->id)->first();
            $services->delete();
            return success($services);
        } catch (\Exception $ex) {
            return error($ex->getMessage());
        }
        
    }
}
