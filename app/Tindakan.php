<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Tindakan extends Model
{
    protected $table = "tindakan";
    protected $fillable = ['diagnosa', 'terapi', 'foto_sebelum', 'foto_sesudah', 'pasien_id'];

    public function Pasien()
    {
        return $this->belongsTo('App\Pasien');
    }
}
