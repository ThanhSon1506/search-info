<?php

use Illuminate\Database\Seeder;

class SeederClients extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('clients')->insert([
            [
                'image'=>"asana.png",
                'image_color' => 'asana-color.png',
            ], 
        ]);
    }
}
