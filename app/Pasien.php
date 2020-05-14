<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Pasien extends Model
{
    protected $table = "pasien";
    protected $fillable = ['nama', 'kelamin', 'umur', 'alamat', 'telp', 'no_pasien'];
    
    public function Tindakan()
    {
        return $this->hasMany("App\Tindakan");
    }
}
