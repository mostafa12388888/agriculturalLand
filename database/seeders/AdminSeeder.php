<?php

namespace Database\Seeders;

use App\Models\Admin;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('admins')->delete();
        Admin::create([
            "name"=>"Musdtafa",
            "email"=>"Musdtafa@gmail.com",
            "password"=>bcrypt("123456"),
            "phone"=>"01060688891",

        ]);
    }
}
