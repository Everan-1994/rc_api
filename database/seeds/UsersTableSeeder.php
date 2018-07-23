<?php

use Illuminate\Database\Seeder;
use App\Models\User;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // 创建超级管理员
        User::insert([
            'name'       => '仁才地产',
            'email'      => 'rencai@qq.com',
            'phone'      => '18587993042',
            'remake'     => '超级管理员',
            'identify'   => 1,
            'password'   => bcrypt('rencai168'),
            'created_at' => now()->toDateTimeString(),
            'updated_at' => now()->toDateTimeString()
        ]);
    }
}
