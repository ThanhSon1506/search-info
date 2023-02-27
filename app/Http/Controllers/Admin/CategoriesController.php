<?php

namespace App\Http\Controllers\Admin;

use \Cviebrock\EloquentSluggable\Services\SlugService;
use Illuminate\Support\Facades\Validator;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Categories;
use App\News;

class CategoriesController extends Controller
{
    // Get url categories
    public function getCategories()
    {
       return view('admin.pages.categories.categories'); 
    }
    public function fetchIndex(){
        $categories =Categories::get();
        return $categories;
    }
    
    // Fetch data categories for databases
    public function fetchData(Request $request){
        $columns [] ='id';
        $columns [] ='name';
        $columns [] ='parent_cats.name';
        $columns [] ='description';
        $columns [] ='slug';
        $columns [] ='created_at';
     
        $limit = $request->input('length');
        $start = $request->input('start');
        $order = $columns[$request->input('order.0.column')];
        $dir = $request->input('order.0.dir');
        $search = $request->input('search');
        $category = $request->category;
        $totalData =  Categories::count();
        if(empty($search) && empty($category)){
        $categories = Categories::with('childrenCategories')->with('parent_cats')->offset($start)
        ->limit($limit)
        ->orderBy($order,$dir)
        ->get();
        } else {
            if(!empty($search)){
                $categories =Categories::with('childrenCategories')->with('parent_cats')->Where(function($query)use($search){
                    $query->where('name', 'LIKE',"%{$search}%")
                    ->orWhere('description', 'LIKE',"%{$search}%");
                })
                ->offset($start)
                ->limit($limit)
                ->orderBy($order,$dir)
                ->get();
                $totalFiltered =$categories->count();
            }else{
                $categories =Categories::with('childrenCategories')->with('parent_cats')->Where(function($query)use($category){
                    $query->where('category_id', 'like',"%{$category}%");
                })
                ->offset($start)
                ->limit($limit)
                ->orderBy($order,$dir)
                ->get();
                $totalFiltered =$categories->count();
            }
            
        }
        $data = array(
            "draw"            => intval($request->input('draw')),  
            "recordsTotal"    => intval($totalData),  
            "recordsFiltered" => intval($totalData), 
            "data"            => $categories   
        );
        return $data; 
    }
    // Get data categories by id
    public function getDataById(Request $request){
        $categories=Categories::where('id','=',$request->id)->first();
        if($categories){
            return response()->json([
                'status'=>1,
                'message'=>"Lấy dữ liệu danh mục",
                'code'=>200,
                'data'=>$categories,
            ]);
        }
        return response()->json([
            'status'=>0,
            'message'=>"Lấy dữ liệu thất bại",
            'code'=>400,
            'data'=>$categories,
        ]);
      
    }
    //  Insert data categories
    public function insertData(Request $request){
        $message=[
            'name.required'=>"Tiêu đề không được để trống",
            'name.min:3'=>"Tiêu đề tối thiểu 3 ký tự",
            'description.required'=>"Nội dung không được để trống",
        ];
        $validate=Validator::make($request->all(),[
            'name'=>['required','min:3','max:100'],
        ],$message);
        if($validate->fails()){
            return response()->json([
                'statusBoolean'=>0,
                'msg'=>$validate->errors()->first(),
                'code'=>200
            ]);
        }
        try {
            $categories = new Categories();
            $categories->name = removeTagScript($request->name);
            $categories->description = removeTagScript($request->description);
            $slug =SlugService::createSlug(Categories::class, 'slug', $request->name);
            $categories->slug= $slug;
            $categories->category_id=$request->category_id;
            $categories->save();
            return success($categories);
        } catch (\Exception $ex) {
            return error($ex->getMessage());
        }
    }  
    // Insert data categories
    public function updateData(Request $request){
        $message=[
            'name.required'=>"Tiêu đề không được để trống",
            'name.min:3'=>"Tiêu đề tối thiểu 3 ký tự",
            'description.required'=>"Nội dung không được để trống",
        ];
        $validate=Validator::make($request->all(),[
            'name'=>['required','min:3','max:100'],
            'description'=>['required'],
        ],$message);
        if($validate->fails()){
            return response()->json([
                'statusBoolean'=>0,
                'msg'=>$validate->errors()->first(),
                'code'=>200
            ]);
        }
       
        try {
            $categories = Categories::where("id",'=',$request->id)->first();
            $categories->name = removeTagScript($request->name);
            $categories->description = removeTagScript($request->description);
            $slug =SlugService::createSlug(Categories::class, 'slug', $request->name);
            $categories->slug=$slug;
            $categories->category_id=$request->category_id;
            $categories->save();
            return success($categories);
        } catch (\Exception $ex) {
            return error($ex->getMessage());
        }
        
    }
    // Delete data categories
    public function deleteData(Request $request){
        $new = News::where("category_id",'=',$request->id)->count();
        if($new>0){
            return response()->json([
                'statusBoolean'=>0,
                'msg'=>"Dữ liệu đang được sử dụng không thể xóa !",
                'code'=>400
            ]);
        }
        try {
            $categories = Categories::where("id",'=',$request->id)->first();
            $categories->delete();
            return success($categories);
        } catch (\Exception $ex) {
            return error($ex->getMessage());
        }
        
    }
}
