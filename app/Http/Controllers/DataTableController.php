<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Pasien;
use App\Tindakan;
use App\User;
use Illuminate\Http\Request;

class DataTableController extends Controller
{
    public function getPasien()
    {
        return datatables()->of(Pasien::all())
            ->addColumn('sex', function ($pasien) {
                return $pasien->kelamin == 'P' ? 'Wanita' : 'Pria';
            })
            ->addColumn('aksi', function ($pasien) {
                return '<a href="' . route('detail.index', ['id' => $pasien->id]) . '" class="btn btn-primary btn-sm mr-2">Detail</a>'
                    . '<a href="' . route('pasien.edit', ['pasien' => $pasien->id]) . '" class="btn btn-warning btn-sm mr-2">Edit</a>'
                    . '<button type="button" class="btn btn-danger btn-sm" data-remote="' . route('pasien.destroy', ['pasien' => $pasien->id]) . '">Delete</button>';
            })
            ->rawColumns(['aksi'])
            ->toJson();
    }

    public function getPasienDetail()
    {
        return datatables()->of(Tindakan::all())
            ->addColumn('tanggal', function ($tindakan) {
                return substr($tindakan->created_at, 0, 11);
            })
            ->addColumn('img_foto_sebelum', function ($tindakan) {
                $img = 'N/A';
                if ($tindakan->foto_sebelum) {
                    $img = '<a href="' . asset('storage/' . $tindakan->foto_sebelum) . '"><img src="' . asset('storage/' . $tindakan->foto_sebelum) . '" width="100px"></a>';
                }
                return $img;
            })
            ->addColumn('img_foto_sesudah', function ($tindakan) {
                $img = 'N/A';
                if ($tindakan->foto_sesudah) {
                    $img = '<a href="' . asset('storage/' . $tindakan->foto_sesudah) . '"><img src="' . asset('storage/' . $tindakan->foto_sesudah) . '" width="100px"></a>';
                }
                return $img;
            })
            ->addColumn('aksi', function ($tindakan) {
                return '<a href="' . route('detail.edit', ['id' => $tindakan->pasien_id, 'detail_id' => $tindakan->id]) . '" class="btn btn-warning btn-sm mr-2">Edit</a>'
                    . '<button type="button" class="btn btn-danger btn-sm btn-delete" data-remote="' . route('detail.destroy', ['id' => $tindakan->pasien_id, 'detail_id' => $tindakan->id]) . '">Delete</button>';
            })
            ->rawColumns(['aksi', 'img_foto_sebelum', 'img_foto_sesudah'])
            ->toJson();
    }

    public function getUser()
    {
        return datatables()->of(User::all())
            ->addColumn('aksi', function ($user) {
                return '<a href="' . route('user.edit', ['user' => $user->id]) . '" class="btn btn-warning btn-sm mr-2">Edit</a>'
                    . '<button type="button" class="btn btn-danger btn-sm btn-delete" data-remote="' . route('user.destroy', ['user' => $user->id]) . '">Delete</button>';
            })
            ->rawColumns(['aksi'])
            ->toJson();
    }
}
