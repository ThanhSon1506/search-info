<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
class SedderPermission extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('permissions')->insert([
            [
                'name' => 'Tất cả các quyền',
                'description' => 'Thêm sửa xóa dữ liệu',
            ], 
            [
                'name' => 'Chỉ có quyền đọc dữ liệu',
                'description' => 'Chỉ đọc dữ liệu',
            ], 
        ]);
    }
}
