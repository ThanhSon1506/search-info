<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Clients;
use File;

class ClientsController extends Controller
{
    private $uploadFolder;  
    public function __construct()  
    {  
      $this->uploadFolder = 'themes/guest/img/clients/';  
    } 
    public function fetchData(Request $request){
        $columns [] ='id';
        $columns [] ='image';
        $columns [] ='image_color';
  
        $limit = $request->input('length');
        $start = $request->input('start');
        $order = $columns[$request->input('order.0.column')];
        $dir = $request->input('order.0.dir');
        $search = $request->input('search');
        $totalData =  Clients::count();
        $clients = Clients::offset($start)
        ->limit($limit)
        ->orderBy($order,$dir)
        ->get();
        $data = array(
            "draw"            => intval($request->input('draw')),  
            "recordsTotal"    => intval($totalData),  
            "recordsFiltered" => intval($totalData), 
            "data"            => $clients   
        );
        return $data; 
    }
    public function insert(Request $request){
        $message=[
            
        ];
        $validate=Validator::make($request->all(),[
        ],$message);
        if($validate->fails()){
            return response()->json([
                'statusBoolean'=>0,
                'msg'=>$validate->errors()->first(),
                'code'=>200
            ]);
        }
        try {
            $clients = new Clients();
            $this->dataFile($request,$clients);
            $this->dataFile2($request,$clients);
            $clients->save();
            return success($clients);
        } catch (\Exception $ex) {
            return error($ex->getMessage());
        }
    }
    // Get data header home by id
    public function getDataById(Request $request){
        $clients=Clients::where('id','=',$request->id)->first();
        if($clients){
            return response()->json([
                'status'=>1,
                'message'=>"Lấy dữ liệu danh mục",
                'code'=>200,
                'data'=>$clients,
            ]);
        }
        return response()->json([
            'status'=>0,
            'message'=>"Lấy dữ liệu thất bại",
            'code'=>400,
            'data'=>$clients,
        ]);
    
    }
    // 
    // Insert data categories
    public function updateData(Request $request){
        $message=[
       
        ];
        $validate=Validator::make($request->all(),[
        ],$message);
        if($validate->fails()){
            return response()->json([
                'statusBoolean'=>0,
                'msg'=>$validate->errors()->first(),
                'code'=>200
            ]);
        }
        
        try {
            $clients = Clients::where("id",'=',$request->id)->first();
            $this->dataFile($request,$clients);
            $this->dataFile2($request,$clients);
            $clients->save();
            return success($clients);
        } catch (\Exception $ex) {
            return error($ex->getMessage());
        }
        
    }
    // Delete data categories
    public function delete(Request $request){
    try {
        $clients = Clients::where("id",'=',$request->id)->first();
        File::delete($this->uploadFolder.$clients->image);
        File::delete($this->uploadFolder.$clients->image_color);
        $clients->delete();
        return success($clients);
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
    }
    public function dataFile2($request,$data){
        if ($request->hasFile('image_color')) {
            File::delete($this->uploadFolder.$data->image_color);
            $image2=$request->file("image_color");
            $imageName2 = time().'_'.$image2->getClientOriginalName();
            $image2->move($this->uploadFolder, $imageName2);
            $data->image_color = $imageName2;
        }
    }
}
