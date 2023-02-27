<?php

use Illuminate\Database\Seeder;

class SeederHeaderHome extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('header_home')->insert([
            [
                'title' => 'Zero Configuration',
                'icon' => 'flaticon-gear',
                'background'=>'zero',
                'des' => '<p>Elitr, sed diam nonumy eirmod tempor invidunt ut labore et dolore magna aliquyam erat,</p>',
                'created_at' => now(),
                'updated_at' => now(),
            ], 
            [
                'title' => 'Zero Configuration',
                'icon' => 'flaticon-shield',
                'background'=>'code',
                'des' => '<p>Elitr, sed diam nonumy eirmod tempor invidunt ut labore et dolore magna aliquyam erat,</p>',
                'created_at' => now(),
                'updated_at' => now(),
            ], 
            [
                'title' => 'Zero Configuration',
                'icon' => 'flaticon-network',
                'background'=>'team',
                'des' => '<p>Elitr, sed diam nonumy eirmod tempor invidunt ut labore et dolore magna aliquyam erat,</p>',
                'created_at' => now(),
                'updated_at' => now(),
            ], 
            [
                'title' => 'Zero Configuration',
                'icon' => 'flaticon-login',
                'background'=>'access',
                'des' => '<p>Elitr, sed diam nonumy eirmod tempor invidunt ut labore et dolore magna aliquyam erat,</p>',
                'created_at' => now(),
                'updated_at' => now(),
            ], 
        ]);
    }
}
