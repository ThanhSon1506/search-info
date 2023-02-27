<?php

use Illuminate\Database\Seeder;

class AwesomeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('awesome')->insert([
            [
                'image'=>'team-d-sq-2.png',
                'name' => 'Waylon Dalton',
                'position'=>"CEO & Founder",
                'des'=>'Elitr, sed diam nonumy eirmod tempor invidunt ut labore et'
            ], 
            [
                'image'=>'team-d-sq-2.png',
                'name' => 'Waylon Dalton',
                'position'=>"CEO & Founder",
                'des'=>'Elitr, sed diam nonumy eirmod tempor invidunt ut labore et'
            ], 
            [
                'image'=>'team-d-sq-2.png',
                'name' => 'Waylon Dalton',
                'position'=>"CEO & Founder",
                'des'=>'Elitr, sed diam nonumy eirmod tempor invidunt ut labore et'
            ], 
       
            [
                'image'=>'team-d-sq-2.png',
                'name' => 'Waylon Dalton',
                'position'=>"CEO & Founder",
                'des'=>'Elitr, sed diam nonumy eirmod tempor invidunt ut labore et'
            ], 
       
            [
                'image'=>'team-d-sq-2.png',
                'name' => 'Waylon Dalton',
                'position'=>"CEO & Founder",
                'des'=>'Elitr, sed diam nonumy eirmod tempor invidunt ut labore et'
            ], 
       
       
        ]);
    }
}
