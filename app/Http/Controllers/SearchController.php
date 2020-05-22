<?php

namespace App\Http\Controllers;

use App\Pasien;
use Illuminate\Http\Request;

class SearchController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index(Request $request)
    {
        $search_result = null;
        if ($request->get('q')) {
            $q = $request->get('q');
            $search_result = Pasien::where('nama', 'LIKE', "%$q%")
                ->orWhere('id', 'LIKE', "%$q%")
                ->orWhere('telp', 'LIKE', "%$q%")
                ->paginate(5);
        }

        return view('search.index', ['result' => $search_result]);
    }
}
