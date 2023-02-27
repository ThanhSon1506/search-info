<?php

use Illuminate\Database\Seeder;

class SeederSkillArea extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('skill_area')->insert([
            [
                'title' => 'Responsive design',
            ], 
            [
                'title' => 'Responsive design',
            ],
            [
                'title' => 'Responsive design',
            ],
            [
                'title' => 'Responsive design',
            ],
            [
                'title' => 'Responsive design',
            ],
        ]);
    }
}
