<?php

namespace App\Http\Controllers\Guest;

use App\Http\Controllers\Controller;
use Artesaos\SEOTools\Facades\SEOMeta;
use Artesaos\SEOTools\Facades\SEOTools;
use Artesaos\SEOTools\Facades\OpenGraph;
use Artesaos\SEOTools\Facades\TwitterCard;
use Artesaos\SEOTools\Facades\JsonLd;
use Artesaos\SEOTools\Facades\JsonLdMulti;
use Illuminate\Http\Request;
use App\Contact;
use Validator;
// use App\Mail\ContactMail;
use Illuminate\Support\Facades\Mail;

class ContactController extends Controller
{
    public function getContact()
    {
        SEOMeta::setTitle('Liên hệ');
        SEOMeta::addMeta('article:section', getConfigSetting()->title, 'property');
        OpenGraph::addProperty('locale','vi_VN');
        OpenGraph::addProperty('type', 'article');
        OpenGraph::addProperty('title', getConfigSetting()->title);
        TwitterCard::addValue("title", getConfigSetting()->title);
        JsonLd::setTitle(getConfigSetting()->title);
        JsonLdMulti::setType('Article');
       return view('guest.pages.contact.contact'); 
    }
    public function postContact(Request $Request)
    {
        // Validate contact
        $message = [
            'required'=>":attribute không được để trống",
        ];
        $validate = Validator::make($Request->all(),[
            'contact_name'=>['required','max:150'],
            'contact_phone'=>['required'],
            'contact_content'=>['required']
            
        ],$message);
        if($validate->fails()){
            return response()->json([
                'status_validate' => 1,
                'data_error' => $validate->errors()->first()
            ]);
        }

        // Save data json contact 
        if(file_exists('data_contact.json')) {
            $current_data = file_get_contents('data_contact.json');
            $array_data = json_decode($current_data, true, JSON_UNESCAPED_UNICODE);
            $extra = array(
                'name' => $Request->contact_name,
                'phone' => $Request->contact_phone,
                'content' => $Request->contact_content
            );
            $array_data[] = $extra;
            $final_data = json_encode($array_data, JSON_UNESCAPED_UNICODE);

            file_put_contents('data_contact.json',$final_data);
            
        }

        // Config mail
        config([
            'mail.default' => getConfigMail()->mail_driver,
            'mail.mailers.smtp.host' => getConfigMail()->mail_host,
            'mail.mailers.smtp.port' => getConfigMail()->mail_port,
            'mail.mailers.smtp.encryption' => getConfigMail()->mail_encryption,
            'mail.mailers.smtp.username' => getConfigMail()->mail_username,
            'mail.mailers.smtp.password' => getConfigMail()->mail_password,
            'mail.from.address' => getConfigMail()->mail_from_address,
            'mail.from.name' => getConfigMail()->mail_from_name
        ]);

        // Send mail
        // if(count(getConfigMail())>0){
            $title_mail = "Thông tin liên hệ";
            $data = array(
                "subject" => $title_mail,
                "contact_name" => $Request->contact_name,
                'contact_phone' => $Request->contact_phone,
                'contact_email' => $Request->contact_email,
                'contact_content' => $Request->contact_content,
                "email_to" => getConfigMail()->mail_receive,
                "email_from" => getConfigMail()->mail_from_address
            );
            Mail::send('Guest.mails.contact',
                    ['data' => $data], function ($message) use ($title_mail, $data)
                    {
                        $message->to($data['email_to'])->subject($title_mail);
                        $message->from($data['email_from'],getConfigMail()->mail_from_name);
                    });
        // }
        

        // Insert database contact
        $Contact = new Contact();
	    $Contact->contact_name = $Request->contact_name;
	    $Contact->contact_phone = $Request->contact_phone;
	    $Contact->contact_content = $Request->contact_content;
	    if($Contact->save()){
	        return response()->json([
                'name' => 'Thành công',
                'status' => 200,
                'data' => $Contact
            ]);
	    }else{
	        return response()->json([
                'name' => 'Thất bại',
                'status' => 500,
                'data' => $Contact
            ]);
	    }
    }
}
