<?php

namespace App\Http\Controllers\Pasien;

use App\Http\Controllers\Controller;
use App\Pasien;
use App\Tindakan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class PasienDetailController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($id)
    {
        $pasien = Pasien::findOrFail($id);
        $tindakans = Tindakan::paginate(10);
        return view('pasiendetail.index', [
            'pasien' => $pasien,
            'tindakans' => $tindakans
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create($id)
    {
        $pasien = Pasien::findOrFail($id);

        return view('pasiendetail.create', ['id' => $pasien->id]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, $id)
    {
        $request->validate(
            [
                'diagnosa' => "required",
                'terapi' => "required",
            ],
            [
                'diagnosa.required' => 'Diagnosa harus diisi',
                'terapi.required' => 'Terapi harus diisi',
            ]
        );

        $pasien = Pasien::findOrFail($id);
        $tindakan = Tindakan::create($request->all());

        if ($request->file('foto_sebelum')) {
            $dir = "public/Foto/$pasien->no_pasien/Sebelum/";
            $file = $request->file('foto_sebelum')->store($dir, 'public');
            $tindakan->foto_sebelum = $file;
        }

        if ($request->file('foto_sesudah')) {
            $dir = "public/Foto/$pasien->no_pasien/Sesudah";
            $file = $request->file('foto_sesudah')->store($dir, 'public');
            $tindakan->foto_sesudah = $file;
        }

        $tindakan->save();
        return redirect()->route('detail.create', ['id' => $pasien->id])->with('status', $pasien->nama);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id, $detail_id)
    {
        Pasien::findOrFail($id);
        $tindakan = Tindakan::findOrFail($detail_id);
        return view('pasiendetail.edit', ['tindakan' => $tindakan]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id, $detail_id)
    {
        $request->validate(
            [
                'diagnosa' => "required",
                'terapi' => "required",
            ],
            [
                'diagnosa.required' => 'Diagnosa harus diisi',
                'terapi.required' => 'Terapi harus diisi',
            ]
        );
        $pasien = Pasien::findOrFail($id);
        $tindakan = Tindakan::findOrFail($detail_id);
        $tindakan->diagnosa = $request->get('diagnosa');
        $tindakan->terapi = $request->get('terapi');

        if ($request->file('foto_sebelum')) {
            if ($tindakan->foto_sebelum && file_exists(storage_path('app/public' . $tindakan->foto_sebelum))) {
                Storage::delete('public/' . $tindakan->foto_sebelum);
            }
            $dir = "public/Foto/$pasien->no_pasien/Sebelum/";
            $file = $request->file('foto_sebelum')->store($dir, 'public');
            $tindakan->foto_sebelum = $file;
        }

        if ($request->file('foto_sesudah')) {
            if ($tindakan->foto_sesudah && file_exists(storage_path('app/public' . $tindakan->foto_sesudah))) {
                Storage::delete('public/' . $tindakan->foto_sesudah);
            }
            $dir = "public/Foto/$pasien->no_pasien/Sesudah/";
            $file = $request->file('foto_sesudah')->store($dir, 'public');
            $tindakan->foto_sesudah = $file;
        }

        $tindakan->save();

        return redirect()->route('detail.edit', [
            'id' => $id,
            'detail_id' => $detail_id
        ])->with('status', $pasien->nama);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id, $detail_id)
    {
        Pasien::findOrFail($id);
        $tindakan = Tindakan::findOrFail($detail_id);
        $date = $tindakan->created_at;
        $tindakan->delete();

        return redirect()->route('detail.index', ['id' => $id])->with('status', "Berhasil menghapus tindakan $date");
    }
}
