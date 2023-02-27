<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Projects;
use Validator;
use File;
use Storage;

class ProjectsController extends Controller
{
    private $uploadFolder;  
    public function __construct()  
    {  
      $this->uploadFolder = 'uploads/';  
    } 
    public function getProject()
    {
       return view('Admin.pages.project.project'); 
    }
    public function getExpired()
    {
        return view('Admin.pages.project.expired');
    }
    public function getUnexpired()
    {
        return view('Admin.pages.project.unExpired');
    }

    public function getDatatableExpired(Request $request)
    {
        $columns[] = 'id';
        $columns[] = 'projects_name';
        $columns[] = 'userID';
        $columns[] = 'services_name';
        $columns[] = 'time_start';
        $columns[] = 'time_end';
        $columns[] = 'id';

        $limit = $request->input('length');
        $start = $request->input('start');
        $order = $columns[$request->input('order.0.column')];
        $dir = $request->input('order.0.dir');
        $search = $request->input('search');
        $totalData = Projects::count();

        $Projects = Projects::join('services', 'projects.serviceID', '=', 'services.id')
            ->join('users', 'users.id', '=', 'projects.userID')
            ->whereDate('time_end','>', date('Y-m-d'))
            ->when(!empty($search), function ($query) use ($search){
                $query->where('projects.projects_name', 'LIKE', "%{$search}%")
                ->orwhere('services.services_name', 'LIKE', "%{$search}%");
            })
            ->select('projects.*', 'services.services_name', 'users.full_name')
            ->offset($start)
            ->limit($limit)
            ->orderBy($order, $dir)
            ->get();
        $totalFiltered = $Projects->count();

        $json_data = array(
            "draw"            => intval($request->input('draw')),
            "recordsTotal"    => intval($totalData),
            "recordsFiltered" => intval($totalData),
            "data"            => $Projects
        );

        echo json_encode($json_data);
    }
    
    public function getDatatableUnexpired(Request $request)
    {
        $columns[] = 'id';
        $columns[] = 'projects_name';
        $columns[] = 'userID';
        $columns[] = 'services_name';
        $columns[] = 'time_start';
        $columns[] = 'time_end';
        $columns[] = 'id';

        $limit = $request->input('length');
        $start = $request->input('start');
        $order = $columns[$request->input('order.0.column')];
        $dir = $request->input('order.0.dir');
        $search = $request->input('search');
        $totalData = Projects::count();

        $Projects = Projects::join('services', 'projects.serviceID', '=', 'services.id')
            ->join('users', 'users.id', '=', 'projects.userID')
            ->whereDate('time_end','<', date('Y-m-d'))
            ->when(!empty($search), function ($query) use ($search){
                $query->where('projects.projects_name', 'LIKE', "%{$search}%")
                ->orwhere('services.services_name', 'LIKE', "%{$search}%");
            })
            ->select('projects.*', 'services.services_name', 'users.full_name')
            ->offset($start)
            ->limit($limit)
            ->orderBy($order, $dir)
            ->get();
        $totalFiltered = $Projects->count();

        $json_data = array(
            "draw"            => intval($request->input('draw')),
            "recordsTotal"    => intval($totalData),
            "recordsFiltered" => intval($totalData),
            "data"            => $Projects
        );

        echo json_encode($json_data);
    }

    public function getDatatable(Request $request)
    {
      
        $columns [] ='id';
        $columns [] ='full_name';
       
        $columns [] ='services_name';
        $columns [] ='projects_name';
        $columns [] ='time_start';
        $columns [] ='time_end';
        $columns [] ='projects_description';
        $columns [] ='id';
     
        $limit = $request->input('length');
        $start = $request->input('start');
        $order = $columns[$request->input('order.0.column')];
        $dir = $request->input('order.0.dir');
        $search = $request->input('search');
        $totalData = Projects::join('services', 'projects.serviceID', '=', 'services.id')
        ->join('users', 'users.id', '=', 'projects.userID')->count();
        if(empty($search)){
            $Projects = Projects::join('services', 'projects.serviceID', '=', 'services.id')
            ->join('users', 'users.id', '=', 'projects.userID')
            ->select('projects.*', 'services.services_name', 'users.full_name')
            ->offset($start)
            ->limit($limit)
            ->orderBy($order, $dir)
            ->get();

        }else{
            $Projects = Projects::join('services', 'projects.serviceID', '=', 'services.id')
            ->join('users', 'users.id', '=', 'projects.userID')
            ->where(function ($query) use ($search){
                $query->where('projects.projects_name', 'LIKE', "%{$search}%")
                ->orWhere('users.full_name', 'LIKE', "%{$search}%")
                ->orWhere('users.phone_number', 'LIKE', "%{$search}%")
                ->orWhere('users.email', 'LIKE', "%{$search}%")
                ->orWhere('services.services_name', 'LIKE', "%{$search}%");
            })
            ->select('projects.*', 'services.services_name', 'users.full_name')
            ->offset($start)
            ->limit($limit)
            ->orderBy($order, $dir)
            ->get();
            $totalFiltered = $Projects->count();
        }
        $json_data = array(
            "draw"            => intval($request->input('draw')),
            "recordsTotal"    => intval($totalData),
            "recordsFiltered" => intval($totalData),
            "data"            => $Projects
        );

        echo json_encode($json_data);
    }

    public function postInsertProjects(Request $Request) {
        $message = [
            'required'=>":attribute không được để trống",
        ];
        $validate = Validator::make($Request->all(),[
            'projects_name'=>['required','max:150'],
            'serviceID'=>['required'],
            'userID'=>['required'],
            // 'projects_file'=>['nullable','mimes:jpeg,png,jpg,gif,pdf,doc,docx,xls,xlxs,zip,rar,txt']
            
        ],$message);
        if($validate->fails()){
            return response()->json([
                'status_validate' => 1,
                'data_error' => $validate->errors()->first()
            ]);
        }
        
        if ($Request->hasFile('projects_file')) {
            $Projects = new Projects();
            $input_file = $Request->file("projects_file");
            $file = time().'_'.$input_file->getClientOriginalName();
            $input_file->move('uploads', $file);

            $Projects->userID = $Request->userID;
            $Projects->serviceID = $Request->serviceID;
            $Projects->projects_name = $Request->projects_name;
            $Projects->time_start = $Request->time_start;
            $Projects->time_end = $Request->time_end;
            $Projects->projects_description = $Request->projects_description;
            $Projects->projects_file = $file;
            if($Projects->save()){
                return response()->json([
                    'name' => 'Thành công',
                    'status' => 200,
                    'data' => $Projects
                ]);
            }else{
                return response()->json([
                    'name' => 'Thất bại',
                    'status' => 500,
                    'data' => $Projects
                ]);
            }
        }
        else {
            $Projects = new Projects();
            $Projects->userID = $Request->userID;
            $Projects->serviceID = $Request->serviceID;
            $Projects->projects_name = $Request->projects_name;
            $Projects->time_start = $Request->time_start;
            $Projects->time_end = $Request->time_end;
            $Projects->projects_description = $Request->projects_description;
            $Projects->projects_file = '';
            if($Projects->save()){
                return response()->json([
                    'name' => 'Thành công',
                    'status' => 200,
                    'data' => $Projects
                ]);
            }else{
                return response()->json([
                    'name' => 'Thất bại',
                    'status' => 500,
                    'data' => $Projects
                ]);
            }
        }

	    
    }

    public function getUpdateProjects(Request $Request) {
        $Projects = Projects::where('id','=',$Request->id)->first();
        return response()->json([
            'name' => 'Thành công',
            'status' => 200,
            'data' => $Projects
        ]);
    }

    public function postUpdateProjects(Request $Request)
	{
            $message = [
                'required'=>":attribute không được để trống",
            ];
            $validate = Validator::make($Request->all(),[
                'projects_name'=>['required'],
                'serviceID'=>['required'],
                'userID'=>['required'],
            ],$message);
            if($validate->fails()){
                return response()->json([
                    'status_validate' => 1,
                    'data_error' => $validate->errors()->first()
                ]);
            }
                $Projects =  Projects::find($Request->id);
                $Projects->projects_name = $Request->projects_name;
                $Projects->userID = $Request->userID;
                $Projects->serviceID = $Request->serviceID;
                $Projects->time_start = $Request->time_start;
                $Projects->time_end = $Request->time_end;
                $Projects->projects_description = $Request->projects_description;
                if ($Request->hasFile('projects_file')) {
                    File::delete($this->uploadFolder.$Projects->projects_file);
                    $input_file = $Request->file("projects_file");
                    $file = time().'_'.$input_file->getClientOriginalName();
                    $input_file->move('uploads', $file);
                    $Projects->projects_file = $file;
                }
                if($Projects->save()){
                    return response()->json([
                        'name' => 'Thành công',
                        'status' => 200,
                        'data' => $Projects
                    ]);
                }else{
                    return response()->json([
                        'name' => 'Thất bại',
                        'status' => 500,
                        'data' => $Projects
                    ]);
                }
           
	}

    public function destroyProject( Request $Request ) {

        try {
            $result = Projects::where('id','=',$Request->id)->first();
            File::delete($this->uploadFolder.$result->projects_file);
            $result->delete();
            return success($result);
        } catch (\Exception $ex) {
            return error($ex->getMessage());
        }
    }
}
