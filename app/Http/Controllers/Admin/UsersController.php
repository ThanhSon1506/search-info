<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\User;
use App\Projects;
use Validator;
use Auth;
use Illuminate\Support\Facades\DB;

class UsersController extends Controller
{
    public function getUser()
    {
       return view('Admin.pages.user.user'); 
    }
    public function getDatatable(Request $Request)
    {
      
        $columns [] ='id';
        $columns [] ='full_name';
        $columns [] ='email';
        $columns [] ='address';
        $columns [] ='phone_number';
        $columns [] ='note';
        $columns [] ='keyword';
        $columns [] ='id';
     
        $limit = $Request->input('length');
        $start = $Request->input('start');
        $order = $columns[$Request->input('order.0.column')];
        $dir = $Request->input('order.0.dir');
        $search = $Request->input('search');
        $totalData =  User::count();
        $userID=Auth::user()->id;

        if(empty($search)){
        $Users = User::offset($start)
        ->where('Users.is_admin','!=','1')
        ->where('Users.id','!=',$userID)
        ->limit($limit)
        ->orderBy($order,$dir)
        ->get();
        } else {
            $Users = User::Where(function($query)use($search){
	            $query->where('full_name', 'LIKE',"%{$search}%")
	            ->orWhere('email', 'LIKE',"%{$search}%")
	            ->orWhere('address', 'LIKE',"%{$search}%")
                ->orWhere('phone_number', 'LIKE',"%{$search}%")
                ->orWhere('note', 'LIKE',"%{$search}%")
                ->orWhere('keyword', 'LIKE',"%{$search}%");
	        })
            ->where('Users.is_admin','!=','1')
            ->where('Users.id','!=',$userID)
	        ->offset($start)
	        ->limit($limit)
	        ->orderBy($order,$dir)
	        ->get();
	        $totalFiltered = $Users->count();
        }
        $json_data = array(
            "draw"            => intval($Request->input('draw')),  
            "recordsTotal"    => intval($totalData),  
            "recordsFiltered" => intval($totalData), 
            "data"            => $Users   
        );
        echo json_encode($json_data); 
    }

    public function postInsertUsers(Request $Request) {
        $message = [
            'required'=>":attribute kh??ng ???????c ????? tr???ng",
            'max:20'=>":attribute d??? li???u t???i ??a 20 k?? t???",
            'email.unique'=>":attribute ???? t???n t???i trong d??? li???u",
            'email'=>"B???n ph???i nh???p ????ng ?????nh d???ng email",
            'full_name.regex'=>"B???n ph???i nh???p ????ng ?????nh d???ng c???a ch???",
            'phone_number.min'=>"B???n ph???i nh???p ????? 10 s???",
            'phone_number.max'=>"B???n ph???i nh???p ????? 10 s???",
            'phone_number.unique'=>"S??? ??i???n tho???i ???? t???n t???i"
        ];
        $validate = Validator::make($Request->all(),[
            'full_name'=>['required','min:3','max:40'],
            'email'=>['required','min:8','max:40','unique:users','email'],
            'password'=>['required','min:8','max:40'],
            'phone_number'=>['required','min:10','max:10','unique:users']
        ],$message);
        if($validate->fails()){
            return response()->json([
                'data_error' => $validate->errors()->first(),
                'status_validate' => 1
            ]);
        }
        $Users = new User();
	    $Users->full_name = $Request->full_name;
	    $Users->email = $Request->email;
	    $Users->address = $Request->address;
        $Users->phone_number = $Request->phone_number;
        $Users->keyword = $Request->keyword;
        $Users->note = $Request->note;
        $Users->password = bcrypt($Request->password);
        $Users->permissions = 0;
	    if($Users->save()){
	        return response()->json([
                'name' => 'Th??nh c??ng',
                'status' => 200,
                'data' => $Users
            ]);
	    }else{
	        return response()->json([
                'name' => 'Th???t b???i',
                'status' => 500,
                'data' => $Users
            ]);
	    }
    }

    public function getUpdateUsers(Request $Request) {
        $Users = User::where('id','=',$Request->id)->first();
        return response()->json([
            'name' => 'Th??nh c??ng',
            'status' => 200,
            'data' => $Users
        ]);
    }

    public function postUpdateUsers(Request $Request)
	{
            $message = [
                'required'=>":attribute kh??ng ???????c ????? tr???ng",
                'max:20'=>":attribute d??? li???u t???i ??a 20 k?? t???",
                'email.unique'=>":attribute ???? t???n t???i trong d??? li???u",
                'email'=>"B???n ph???i nh???p ????ng ?????nh d???ng email",
                'full_name.regex'=>"B???n ph???i nh???p ????ng ?????nh d???ng c???a ch???",
                'phone_number.min'=>"B???n ph???i nh???p ????? 10 s???",
                'phone_number.max'=>"B???n ph???i nh???p ????? 10 s???",
                'phone_number.unique'=>"S??? ??i???n tho???i ???? t???n t???i"
            ];
            $validate = Validator::make($Request->all(),[
                'full_name'=>['required','min:3','max:40'],
                'email'=>['required','min:8','max:40'],
                'phone_number'=>['required','min:10','max:10']
            ],$message);
            if($validate->fails()){
                return response()->json([
                    'data_error' => $validate->errors()->first(),
                    'status_validate' => 1
                ]);
            }

	        $Users =  User::find($Request->id);
	        $Users->full_name = $Request->full_name;
		    $Users->email = $Request->email;
            $Users->address = $Request->address;
            $Users->phone_number = $Request->phone_number;
            $Users->keyword = $Request->keyword;
            $Users->note = $Request->note;
	        if($Users->save()){
                return response()->json([
                    'name' => 'Th??nh c??ng',
                    'status' => 200,
                    'data' => $Users
                ]);
            }else{
                return response()->json([
                    'name' => 'Th???t b???i',
                    'status' => 500,
                    'data' => $Users
                ]);
            }
	 
	}

    public function destroyUser( Request $request ) {
     
        $projects = Projects::where("userID",'=',$request->id)->count();
        if($projects>0){
            return response()->json([
                'statusBoolean'=>0,
                'msg'=>"D??? li???u ??ang ???????c s??? d???ng kh??ng th??? x??a !",
                'code'=>400
            ]);
        }
        try {
            $users = User::where("id",'=',$request->id)->first();
            $users->delete();
            return success($users);
        } catch (\Exception $ex) {
            return error($ex->getMessage());
        }
        
    }

    public function getProfileAdmin()
    {
       return view('Admin.pages.user.profile-admin'); 
    }

    public function postUpdateProfileAdmin( request $request )
    {
        // $Profile_admin =  User::find($Request->id);
        // $Profile_admin = $Request->email;
        // $Profile_admin = bcrypt($Request->password);
        // $Profile_admin->save();

        // $Profile_admin=User::find($Request->id);
        // $Profile_admin->update($Request->all());

        $Profile_admin = $request->input('id');
        DB::table('users')->where('id', $Profile_admin)->update([
            'email' => $request->input('email'),
            'password' => bcrypt($request->password)
        ]);

        return back();
    }
}
