<?php

use Illuminate\Database\Seeder;
use App\User;
use Illuminate\Support\Facades\Hash;

class RootUserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::create([
            "name"=>"root",
            "username"=>"root",
            "password"=>Hash::make("*PXhauCdMb7*EVWy"),
            "role"=>"admin",
            "telp"=>"000000000000"
        ]);
    }
}
