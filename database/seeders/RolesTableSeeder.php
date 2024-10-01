<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class RolesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table("roles")->insert([
            "role_name" => "Admin",
            "role_slug" => "admin",
        ]);

        DB::table("roles")->insert([
            "role_name" => "Customer",
            "role_slug" => "customer",
        ]);

        DB::table("roles")->insert([
            "role_name" => "Front_Officer",
            "role_slug" => "front_officer",
        ]);
        DB::table("roles")->insert([
            "role_name" => "Deliver",
            "role_slug" => "deliver",
        ]);
    }
}
