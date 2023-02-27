<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class SedderUser extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->insert([
            [
                'full_name' => 'admin',
                'date' => '2000/03/17',
                'date_start' => '2022/02/11',
                'gender'=>0,
                'room_id' => 1,
                'position' => 1,
                'email' => 'admin@gmail.com',
                'password' => bcrypt('123456'),
                'address' => 'cong ty ing',
                'phone_number' => '0921100517',
                'note' => 'nothing',
                'keyword' => 'ADMIN',
                'permissions' => 1,
                'description'=>"Chưa có dữ liệu",
                'created_at' => now(),
                'updated_at' => now(),
                'cover'=>'1646295620_7.jpg',
                'cover_after'=>'1646295620_7.jpg',
                'email_verified_at' => now(),
                'is_admin'=>1,
            ], 
            [
                'full_name' => 'user',
                'date' => '2000/03/17',
                'date_start' => '2022/02/11',
                'gender'=>0,
                'room_id' => 1,
                'position' => 0,
                'email' => 'user@gmail.com',
                'password' => bcrypt('123456'),
                'address' => 'cong ty ing',
                'phone_number' => '0921100517',
                'note' => 'nothing',
                'keyword' => 'ADMIN',
                'permissions' => 0,
                'description'=>"Chưa có dữ liệu",
                'created_at' => now(),
                'updated_at' => now(),
                'cover'=>'1646295620_7.jpg',
                'cover_after'=>'1646295620_7.jpg',
                'email_verified_at' => now(),
                'is_admin'=>0,
            ], 
        ]);
    }
}
