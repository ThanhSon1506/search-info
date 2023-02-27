<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class SedderSettings extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $header_project = array([
            'title' => 'Giải pháp CNTT an toàn cho một môi trường an toàn hơn',
            'des' => 'Chào mừng bạn đến với Công ty tư vấn đầu tư ING <br>Giải pháp công nghệ thông tin cho doanh nghiệp bạn',
        ]);
        $image_skill_area=array(['image1'=>'skill-bg.png','image2'=>'skill-note.png','image3'=>'leaf.png']);
        $skill_area = array([
            'title' => 'What Our Software Can Do For You',
            'des' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod
            tempor incididunt ut labore et dolore magna aliqua.',
            'image'=>json_encode($image_skill_area),
        ]);
        $featureds=array([
            'title'=>'Our featureds',
            'des'=>'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod
            tempor incididunt ut labore et dolore magna aliqua.',
        ]);
        $awesome=array([
            'title'=>'Our Awesome',
            'des'=>'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod
            tempor incididunt ut labore et dolore magna aliqua.',
        ]);
        $funfact=array([
            'title'=>'We Always Try To Understand Users Expectation',
            'des'=>'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod
            tempor incididunt ut labore et dolore magna aliqua.',
        ]);
        $clients=array([
            'title'=>'The News From Our Blogs',
            'des'=>'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod
            tempor incididunt ut labore et dolore magna aliqua',
        ]);
        DB::table('settings')->insert([
            [
                'mail_driver' => 'smtp',
                'mail_host' => 'smtp.gmail.com',
                'mail_port' => '587',
                'mail_from_address' => 's1357299@gmail.com',
                'mail_from_name' => 'Thanh Son',
                'mail_encryption' => 'tls',
                'mail_username' => 's1357299@gmail.com',
                'mail_password' => 'untstjclvahltaqr',
                'mail_receive' => 'coderthanhson@gmail.com',
                'guest_logo_header' => '1646703493_logo_header.png',
                'guest_logo_footer' => '1646703118_logo_footer.png',
                'url_map' => 'https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3924.6922742059796!2d107.08750261474535!3d10.366471392600515!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x31756fc8c7863579%3A0x2a959d34ca70a288!2zQ8O0bmcgVHkgVE5ISCBUxrAgduG6pW4gxJHhuqd1IFTGsCBJTkc!5e0!3m2!1svi!2s!4v1646297997690!5m2!1svi!2s',
                'title'=>"Search Info Support",
                'header_project'=>json_encode($header_project),
                'skill_area'=>json_encode($skill_area),
                'featureds'=>json_encode($featureds),
                'awesome'=>json_encode($awesome),
                'funfact'=>json_encode( $funfact),
                'clients'=>json_encode($clients),
                'route_admin' => 'admin',
                'route_login' => 'admin-login',
                'web_des' => 'Tin tức nhanh - mới - nóng nhất đang diễn ra về: kinh tế, chính trị, xã hội, thế giới, giáo dục, thể thao, văn hóa, giải trí, công nghệ.',
            ], 
        ]);
    }
}
