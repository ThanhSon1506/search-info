<?php

namespace App\Http\Controllers\Admin;

use \Cviebrock\EloquentSluggable\Services\SlugService;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Storage;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Categories;
use App\News;
use File;


class NewsController extends Controller
{
    private $uploadFolder;  
    public function __construct()  
    {  
      $this->uploadFolder = 'uploads';  
    } 
    // get url news
    public function getNews()
    {
       return view('admin.pages.news.news'); 
    }
    // Fetch data news
    public function fetchData(Request $request){
        $columns [] ='id';
        $columns [] ='title';
        $columns [] ='content';
        $columns [] ='categories.name';
        $columns [] ='slug';
        $columns [] ='created_at';
     
        $limit = $request->input('length');
        $start = $request->input('start');
        $order = $columns[$request->input('order.0.column')];
        $dir = $request->input('order.0.dir');
        $category = $request->category;
        $totalData =  News::count();
        if(empty($category)){
        $news = News::with('categories')->offset($start)
        ->limit($limit)
        ->orderBy($order,$dir)
        ->get();
        } else {
            $news = News::with('categories')->Where(function($query)use($category){
	            $query->where('category_id', 'like',"%{$category}%");
	        })
	        ->offset($start)
	        ->limit($limit)
	        ->orderBy($order,$dir)
	        ->get();
	        $totalFiltered =$news->count();
        }
        $data = array(
            "draw"            => intval($request->input('draw')),  
            "recordsTotal"    => intval($totalData),  
            "recordsFiltered" => intval($totalData), 
            "data"            => $news   
        );
        return $data; 
    }
    // Get data by id news
    public function getDataById(Request $request){
        try {
            $news = News::where("id",'=',$request->id)->first();
            return success($news);
        } catch (\Exception $ex) {
            return error($ex->getMessage());
        }
    }
    // Update data news
    public function updateData(Request $request){
        $message=[
            'title.required'=>"Tiêu đề không được để trống",
            'title.min:3'=>"Tiêu đề tối thiểu 3 ký tự",
            'content.required'=>"Nội dung không được để trống",
            'image.max'=>"Quá kích thước ảnh",
        ];
        $validate=Validator::make($request->all(),[
            'title'=>['required','min:3','max:100'],
            'content'=>['required'],
            'category_id'=>['required'],
            'image'=>['max:5120']
        ],$message);
        if($validate->fails()){
            return response()->json([
                'statusBoolean'=>0,
                'msg'=>$validate->errors()->first(),
                'code'=>200
            ]);
        }

        try {
            $news = News::where("id",'=',$request->id)->first();
            $news->title = removeTagScript($request->title);
            $news->summary = removeTagScript($request->summary);
            $news->content = removeTagScript($request->content);
            $news->category_id = removeTagScript($request->category_id);
            $slug =SlugService::createSlug(News::class, 'slug', $request->title);
            if($request->image){
                $this->dataFile($request,$news);
            }
            $news->slug = $slug;
            $news->save();
            return success($news);
        } catch (\Exception $ex) {
            return error($ex->getMessage());
        }
    }
    public function insertData(Request $request){
        $message=[
            'title.required'=>"Tiêu đề không được để trống",
            'title'=>"Tiêu đề không được để trùng",
            'title.min:3'=>"Tiêu đề tối thiểu 3 ký tự",
            'content.required'=>"Nội dung không được để trống",
            'image.max'=>"Quá kích thước ảnh",
        ];
        $validate=Validator::make($request->all(),[
            'title'=>['required','min:3','max:100'],
            'content'=>['required'],
            'category_id'=>['required'],
            'image'=>['max:5120']
        ],$message);
        if($validate->fails()){
            return response()->json([
                'statusBoolean'=>0,
                'msg'=>$validate->errors()->first(),
                'code'=>200
            ]);
        }

        try {
            $news = new News();
            $news->title = removeTagScript($request->title);
            $news->summary = removeTagScript($request->summary);
            $news->content = removeTagScript($request->content);
            $news->category_id = removeTagScript($request->category_id);
            $slug =SlugService::createSlug(News::class, 'slug', $request->title);
            $news->slug=$slug;
            $this->dataFile($request,$news);
            $news->save();
            return success($news);
        } catch (\Exception $ex) {
            return error($ex->getMessage());
        }
    }
    public function deleteData(Request $request){
        try {
            $news = News::where("id",'=',$request->id)->first();
            $destinationPath="/storage/images/news/";
            File::delete($destinationPath.$news->image);
            $news->delete();
            return success($news);
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
            $data->image=getConfigSetting()->guest_logo_header;
        }
    }
  
}
