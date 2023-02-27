<?php

use Illuminate\Database\Seeder;

class SeederFunfact extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('funfacts')->insert([
            [
                'count'=>"160",
                'title' => 'Downloaded',
            ], 
            [
                'count'=>"160",
                'title' => 'Downloaded',
            ], 
            [
                'count'=>"160",
                'title' => 'Downloaded',
            ], 
            [
                'count'=>"160",
                'title' => 'Downloaded',
            ], 
        ]);
    }
}
