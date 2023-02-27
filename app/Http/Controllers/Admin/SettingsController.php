<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Settings;

class SettingsController extends Controller
{
    public function getSetting()
    {
       return view('Admin.pages.setting.setting'); 
    }
    public function fetchSetting(){
        return \App\Settings::find(1);
    }
    public function updateMail(Request $Request)
	{
            
	        $Settings =  Settings::find($Request->id);
	        $Settings->mail_driver = $Request->mail_driver;
		    $Settings->mail_host = $Request->mail_host;
		    $Settings->mail_port = $Request->mail_port;
            $Settings->mail_from_address = $Request->mail_from_address;
            $Settings->mail_from_name = $Request->mail_from_name;
            $Settings->mail_encryption = $Request->mail_encryption;
            $Settings->mail_username = $Request->mail_username;
            $Settings->mail_password = $Request->mail_password;
            $Settings->mail_receive = $Request->mail_receive;
	        $Settings->save();

            return back();
	}
    public function updateGuest(Request $Request)
    {
        $Settings =  Settings::find($Request->id);
        if ($Request->hasFile('guest_logo_header')) {
            $input_file = $Request->file("guest_logo_header");
            $file = time().'_'.$input_file->getClientOriginalName();
            $input_file->move('uploads', $file);

            $Settings->guest_logo_header = $file;
        }else {
            $Settings->guest_logo_header = $Request->header_file_old;
        }

        if ($Request->hasFile('guest_logo_footer')) {
            $input_file_footer = $Request->file("guest_logo_footer");
            $file_footer = time().'_'.$input_file_footer->getClientOriginalName();
            $input_file_footer->move('uploads', $file_footer);

            $Settings->guest_logo_footer = $file_footer;
        }else {
            $Settings->guest_logo_footer = $Request->footer_file_old;
        }
        $Settings->route_admin = $Request->route_admin;
        $Settings->route_login = $Request->route_login;
        $Settings->url_map = $Request->url_map;
        $Settings->guest_description_footer = $Request->guest_description_footer;
        $Settings->title = $Request->title;
        $Settings->web_des=$Request->web_des;
	    $Settings->save();

        return response()->json([
            'status'=>1,
            'message'=>"Cập nhật thành công",
            'code'=>200
        ]);
    }
    public function updateHeader(Request $request){
        $Settings =  Settings::find($request->id);
        $arrProject = array();
        array_push($arrProject, [
            'title' => $request->title,
            'des' => $request->des
        ]);
        $jsonProject = json_encode($arrProject, JSON_UNESCAPED_UNICODE);
        $Settings->header_project = $jsonProject;
        $Settings->save();

            return response()->json([
                'status'=>1,
                'message'=>"Cập nhật thành công",
                'code'=>200
            ]);
    }
    public function skillArea(Request $request){
        $Settings =  Settings::find($request->id);
        $arrProject = array();
        array_push($arrProject, [
            'title' => $request->title_skill_area,
            'des' => $request->des_skill_area
        ]);
        $jsonProject = json_encode($arrProject, JSON_UNESCAPED_UNICODE);
        $Settings->skill_area = $jsonProject;
        $Settings->save();
            return response()->json([
                'status'=>1,
                'message'=>"Cập nhật thành công",
                'code'=>200
            ]);
    }
    // featureds
    public function featureds(Request $request){
        $Settings =  Settings::find($request->id);
        $arrProject = array();
        array_push($arrProject, [
            'title' => $request->title_featureds,
            'des' => $request->des_featureds
        ]);
        $jsonProject = json_encode($arrProject, JSON_UNESCAPED_UNICODE);
        $Settings->featureds = $jsonProject;
        $Settings->save();
            return response()->json([
                'status'=>1,
                'message'=>"Cập nhật thành công",
                'code'=>200
            ]);
    }
    // awesome
    public function awesome(Request $request){
        $Settings =  Settings::find($request->id);
        $arrProject = array();
        array_push($arrProject, [
            'title' => $request->title_awesome,
            'des' => $request->des_awesome
        ]);
        $jsonProject = json_encode($arrProject, JSON_UNESCAPED_UNICODE);
        $Settings->awesome = $jsonProject;
        $Settings->save();
            return response()->json([
                'status'=>1,
                'message'=>"Cập nhật thành công",
                'code'=>200
            ]);
    }
     // featureds
    public function funfact(Request $request){
        $Settings =  Settings::find($request->id);
        $arrProject = array();
        array_push($arrProject, [
            'title' => $request->title_funfact,
            'des' => $request->des_funfact
        ]);
        $jsonProject = json_encode($arrProject, JSON_UNESCAPED_UNICODE);
        $Settings->funfact = $jsonProject;
        $Settings->save();
            return response()->json([
                'status'=>1,
                'message'=>"Cập nhật thành công",
                'code'=>200
            ]);
    }
    // featureds
    public function clients(Request $request){
        $Settings =  Settings::find($request->id);
        $arrProject = array();
        array_push($arrProject, [
            'title' => $request->title_clients,
            'des' => $request->des_clients
        ]);
        $jsonProject = json_encode($arrProject, JSON_UNESCAPED_UNICODE);
        $Settings->clients = $jsonProject;
        $Settings->save();
            return response()->json([
                'status'=>1,
                'message'=>"Cập nhật thành công",
                'code'=>200
            ]);
    }

}
