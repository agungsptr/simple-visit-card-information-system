<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Pasien;
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
                    . '<button type="button" class="btn btn-danger btn-sm btn-delete" data-remote="' . route('pasien.destroy', ['pasien' => $pasien->id]) . '">Delete</button>';
            })
            ->rawColumns(['aksi'])
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
