<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class SedderPage extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('pages')->insert([
            [
                'pages_name' => 'Trung tâm trợ giúp',
                'pages_slug' => 'trung-tam-tro-giup',
                'pages_content' => '<p>Chưa có nội dung</p></p>',
            ], 
        ]);
    }
}
