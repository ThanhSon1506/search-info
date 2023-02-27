<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class SedderProjects extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('projects')->insert([
            [
                'userID' => 1,
                'serviceID' => 1,
                'projects_name' => 'Dự án 1',
                'projects_description' => '<p>123</p>',
                'time_start' => '2022-03-02',
                'time_end' => '2022-01-13',
                'projects_file' => 'default.png',
                'created_at' => now(),
                'updated_at' => now(),
            ], 
        ]);
    }
}
