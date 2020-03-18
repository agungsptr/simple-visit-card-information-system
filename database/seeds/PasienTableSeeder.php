<?php

use App\Pasien;
use Illuminate\Database\Seeder;

class PasienTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        for ($i=0; $i < 20; $i++) { 
            Pasien::create([
                'nama'=>"pasien$i",
                'kelamin'=>'P',
                'umur'=>19,
                'alamat'=>'mataram',
                'telp'=>"081111222333"
            ]);
        }
        
    }
}
