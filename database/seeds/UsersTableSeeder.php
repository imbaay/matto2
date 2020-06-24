<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // reset users table
        DB::table('users')->truncate();

        // insert 3 users
        DB::table('users')->insert([
            [
                'name'=>'Nguyễn Quỳnh Trang',
                'email'=>'trang@gmail.com',
                'password'=> bcrypt('123456'),
                'role_id'=> 1,
                'is_active'=> 1
            ],
            [
                'name' => 'Trang Xinh Gái',
                'email' => 'admin@admin.com',
                'password'=> bcrypt('123456'),
                'role_id'=> 1,
                'is_active'=> 1
            ],
            [
                'name'=> 'Tiến Đẹp Trai',
                'email'=> 'tien@phoneshop.com',
                'password'=> bcrypt('123456'),
                'role_id'=> 3,
                'is_active'=> 1
            ],
            [
                'name'=> 'Trang Ngáo Ngơ',
                'email'=> 'master@phoneshop.com',
                'password'=> bcrypt('123456'),
                'role_id'=> 2,
                'is_active'=> 1
            ],
        ]);
    }
}
