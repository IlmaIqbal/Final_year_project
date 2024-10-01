<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table("users")->insert([
            "role_id" => "1",
            "name" => "Admin",
            "email" => "admin@gmail.com",
            "password" => bcrypt("pass@admin"),
        ]);

        DB::table("users")->insert([
            "role_id" => "2",
            "name" => "Customer",
            "email" => "customer@gmail.com",
            "password" => bcrypt("pass@customer"),
        ]);

        DB::table("users")->insert([
            "role_id" => "3",
            "name" => "Front_Officer",
            "email" => "front_officer@gmail.com",
            "password" => bcrypt("pass@front_officer"),
        ]);
        DB::table("users")->insert([
            "role_id" => "4",
            "name" => "Deliver",
            "email" => "deliver@gmail.com",
            "password" => bcrypt("pass@deliver"),
        ]);
    }
}
