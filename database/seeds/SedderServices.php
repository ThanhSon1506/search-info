<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class SedderServices extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('services')->insert([
            [
                'services_name' => 'Dịch vụ SEO',
                'services_description' => '<p>SEO Google</p>',
                'services_slug' => 'dich-vu-seo',
                'created_at' => now(),
                'updated_at' => now(),
            ], 
        ]);
    }
}
