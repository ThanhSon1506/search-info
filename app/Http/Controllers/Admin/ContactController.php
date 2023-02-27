<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Contact;

class ContactController extends Controller
{
    public function getContact()
    {
       return view('admin.pages.contact.contact'); 
    }
    public function getDatatable(Request $Request)
    {
      
        $columns [] ='id';
        $columns [] ='contact_name';
       
        $columns [] ='contact_phone';
        $columns [] ='contact_content';
        $columns [] ='id';
     
        $limit = $Request->input('length');
        $start = $Request->input('start');
        $order = $columns[$Request->input('order.0.column')];
        $dir = $Request->input('order.0.dir');
        $search = $Request->input('search');
        $totalData =  Contact::count();
        if(empty($search)){
        $Contact = Contact::offset($start)
        ->limit($limit)
        ->orderBy($order,$dir)
        ->get();
        } else {
            $Contact = Contact::Where(function($query)use($search){
	            $query->where('contact_name', 'LIKE',"%{$search}%")
	            ->orWhere('contact_phone', 'LIKE',"%{$search}%")
	            ->orWhere('contact_content', 'LIKE',"%{$search}%");
	        })
	        ->offset($start)
	        ->limit($limit)
	        ->orderBy($order,$dir)
	        ->get();
	        $totalFiltered = $Contact->count();
        }
        $json_data = array(
            "draw"            => intval($Request->input('draw')),  
            "recordsTotal"    => intval($totalData),  
            "recordsFiltered" => intval($totalData), 
            "data"            => $Contact   
        );
        echo json_encode($json_data); 
    }

    public function destroyContact( Request $Request ) {
        $result = Contact::where('id','=',$Request->id)->delete();
        return $result;
    }
}
