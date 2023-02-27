<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Awesome;
use Illuminate\Support\Facades\Validator;
use File;
class AwesomeController extends Controller
{
    private $uploadFolder;  
    public function __construct()  
    {  
      $this->uploadFolder = 'themes/guest/img/team/';  
    } 
    public function fetchData(Request $request){
        $columns [] ='id';
        $columns [] ='image';
        $columns [] ='name';
        $columns [] ='position';
        $columns [] ='des';
        $limit = $request->input('length');
        $start = $request->input('start');
        $order = $columns[$request->input('order.0.column')];
        $dir = $request->input('order.0.dir');
        $search = $request->input('search');
        $totalData =  Awesome::count();
        $Awesomes = Awesome::offset($start)
        ->limit($limit)
        ->orderBy($order,$dir)
        ->get();
        $data = array(
            "draw"            => intval($request->input('draw')),  
            "recordsTotal"    => intval($totalData),  
            "recordsFiltered" => intval($totalData), 
            "data"            => $Awesomes   
        );
        return $data; 
    }
    public function insert(Request $request){
        $message=[
            'awesome_name.required'=>"Tiêu đề không được để trống",
            'awesome_name.min:3'=>"Tiêu đề tối thiểu 3 ký tự",
        ];
        $validate=Validator::make($request->all(),[
            'awesome_name'=>['required','min:3','max:100'],
        ],$message);
        if($validate->fails()){
            return response()->json([
                'statusBoolean'=>0,
                'msg'=>$validate->errors()->first(),
                'code'=>200
            ]);
        }
        try {
            $Awesomes = new Awesome();
            $Awesomes->name = removeTagScript($request->awesome_name);
            $Awesomes->des = removeTagScript($request->awesome_des);
            $Awesomes->position = removeTagScript($request->awesome_position);
            $this->dataFile($request,$Awesomes);
            $Awesomes->save();
            return success($Awesomes);
        } catch (\Exception $ex) {
            return error($ex->getMessage());
        }
    }
    // Get data header home by id
    public function getDataById(Request $request){
        $Awesomes=Awesome::where('id','=',$request->id)->first();
        if($Awesomes){
            return response()->json([
                'status'=>1,
                'message'=>"Lấy dữ liệu danh mục",
                'code'=>200,
                'data'=>$Awesomes,
            ]);
        }
        return response()->json([
            'status'=>0,
            'message'=>"Lấy dữ liệu thất bại",
            'code'=>400,
            'data'=>$Awesomes,
        ]);
    
    }
    // 
    // Insert data categories
    public function updateData(Request $request){
        $message=[
            'awesome_name.required'=>"Tiêu đề không được để trống",
            'awesome_name.min:3'=>"Tiêu đề tối thiểu 3 ký tự",
        ];
        $validate=Validator::make($request->all(),[
            'awesome_name'=>['required','min:3','max:100'],
        ],$message);
        if($validate->fails()){
            return response()->json([
                'statusBoolean'=>0,
                'msg'=>$validate->errors()->first(),
                'code'=>200
            ]);
        }
        
        try {
            $Awesomes = Awesome::where("id",'=',$request->id)->first();
            $Awesomes->name = removeTagScript($request->awesome_name);
            $Awesomes->des = removeTagScript($request->awesome_des);
            $Awesomes->position = removeTagScript($request->awesome_position);
            $this->dataFile($request,$Awesomes);
            $Awesomes->save();
            return success($Awesomes);
        } catch (\Exception $ex) {
            return error($ex->getMessage());
        }
        
    }
    // Delete data categories
    public function delete(Request $request){
    try {
        $Awesomes = Awesome::where("id",'=',$request->id)->first();
        $Awesomes->delete();
        return success($Awesomes);
    } catch (\Exception $ex) {
        return error($ex->getMessage());
    }
    }
    public function dataFile($request,$data){
        if ($request->hasFile('image')) {
            File::delete($this->uploadFolder.$data->image);
            $image=$request->file("image");
            $imageName = time().'_'.$image->getClientOriginalName();
            $image->move($this->uploadFolder, $imageName);
            $data->image = $imageName;
        }
        else{
            if(!$data->id){
                $data->image=getConfigSetting()->guest_logo_header;
            }
        }
    }
}
