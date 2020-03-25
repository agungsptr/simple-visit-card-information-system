<?php

use Illuminate\Database\Seeder;
use App\User;
use Illuminate\Support\Facades\Hash;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::create([
            "name"=>"agung",
            "username"=>"agung",
            "password"=>Hash::make(123),
            "username"=>"agung",
            "role"=>"admin",
            "telp"=>"123"
        ]);
    }
}
