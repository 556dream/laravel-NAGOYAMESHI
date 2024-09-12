<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Encore\Admin\Auth\Database\Administrator;
use Illuminate\Support\Facades\Hash;

class AdminUserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Administrator::create([
            'username' => 'test',
            'password' => Hash::make('password'),
            'name'     => 'Test',
        ]);
    }
}
