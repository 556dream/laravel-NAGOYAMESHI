<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Encore\Admin\Auth\Database\Administrator;
use Encore\Admin\Auth\Database\Role;
use Encore\Admin\Auth\Database\Permission;
use Illuminate\Support\Facades\Hash;

class AdminUserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
       // ユーザー名 'test' を持つユーザーが存在するか確認
       $user = Administrator::firstOrNew(['username' => 'test'], [
        'password' => Hash::make('password'),
        'name'     => 'Test',
        ]);

        // ユーザーが存在しない場合のみ新規作成
        if (!$user->exists) {
        $user->save();
        }

        // 管理者ロールが存在しない場合、作成
        $role = Role::firstOrCreate(['name' => 'administrator'], ['display_name' => 'Administrator']);
    
        // 全てのパーミッションを取得
        $permissions = Permission::all();

        // ロールにパーミッションを割り当て
        $role->permissions()->sync($permissions);

        // ユーザーに管理者ロールを割り当て
        $user->roles()->attach($role);

        
        
    }
}
