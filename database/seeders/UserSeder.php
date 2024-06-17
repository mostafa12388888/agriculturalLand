<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class UserSeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('users')->delete();
        User::create([
            "name"=>"Ahmed",
            "email"=>"ahmed@gmail.com",
            "password"=>bcrypt("123456"),
        ]);
    }
}
