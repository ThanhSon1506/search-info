<?php

use Illuminate\Database\Seeder;

class SeederCategories extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('categories')->insert([
            [
                'name' => 'Kinh doanh',
                'description' => 'Kinh doanh',
                'slug'=>'kinh-doanh',
                'created_at' => now(),
                'updated_at' => now(),
            ], 
            [
                'name' => 'Công nghệ',
                'description' => 'Công nghệ',
                'slug'=>'cong-nghe',
                'created_at' => now(),
                'updated_at' => now(),
            ], 
            [
                'name' => 'Giải trí',
                'description' => 'Giải trí',
                'slug'=>'giai-tri',
                'created_at' => now(),
                'updated_at' => now(),
            ], 
            [
                'name' => 'Đời sống',
                'description' => 'Đời sống',
                'slug'=>'doi-song',
                'created_at' => now(),
                'updated_at' => now(),
            ], 
        ]);
    }
}
