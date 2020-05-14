<?php

namespace App\Http\Controllers\Pasien;

use App\Http\Controllers\Controller;
use App\Pasien;
use Illuminate\Http\Request;

class PasienController extends Controller
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
    public function index()
    {
        return view('pasien.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('pasien.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate(
            [
                'no_pasien' => 'required|unique:pasien|max:18',
                'nama' => "required|max:191",
                'kelamin' => "required|max:1",
                'umur' => "required|max:3",
                'alamat' => "required",
                'telp' => "required|max:15",
            ],
            [
                'no_pasien.required' => 'No pasien harus diisi',
                'no_pasien.unique' => 'No pasien sudah terdaftar',
                'no_pasien.max' => 'No pasien maksimal 18 digit',
                'nama.required' => 'Nama harus diisi',
                'nama.max' => 'Nama tidak boleh melebihi 191 karakter',
                'kelamin.required' => 'Jenis kelamin harus diisi',
                'kelamin.max' => 'Jenis kelamin tidak boleh 2',
                'umur.required' => 'Umur harus diisi',
                'umur.max' => 'Umur tidak boleh melebihi 3 digit',
                'alamat.required' => 'Alamat harus diisi',
                'telp.required' => 'Nomor telepon harus diisi',
                'telp.max' => 'Nomor telepon tidak boleh melebihi 15 digit',
            ]
        );

        Pasien::create($request->all());
        $nama = $request->get('nama');
        return redirect()->route('pasien.create')->with('status', "Pasien $nama berhasil ditambahkan");
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        abort(404);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $pasien = Pasien::findOrFail($id);
        return view('pasien.edit', ['pasien' => $pasien]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $request->validate(
            [
                'nama' => "required|max:191",
                'kelamin' => "required|max:1",
                'umur' => "required|max:3",
                'alamat' => "required",
                'telp' => "required|max:15",
            ],
            [
                'nama.required' => 'Nama harus diisi',
                'nama.max' => 'Nama tidak boleh melebihi 191 karakter',
                'kelamin.required' => 'Jenis kelamin harus diisi',
                'kelamin.max' => 'Jenis kelamin tidak boleh 2',
                'umur.required' => 'Umur harus diisi',
                'umur.max' => 'Umur tidak boleh melebihi 3 digit',
                'alamat.required' => 'Alamat harus diisi',
                'telp.required' => 'Nomor telepon harus diisi',
                'telp.max' => 'Nomor telepon tidak boleh melebihi 15 digit',
            ]
        );

        $pasien = Pasien::findOrFail($id);
        $pasien->nama = $request->get('nama');
        $pasien->kelamin = $request->get('kelamin');
        $pasien->umur = $request->get('umur');
        $pasien->alamat = $request->get('alamat');
        $pasien->telp = $request->get('telp');
        $pasien->save();

        return redirect()->route('pasien.edit', ['pasien' => $id])->with('status', "Pasien $pasien->nama berhasil diedit");
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $pasien = Pasien::findOrFail($id);
        $name = $pasien->nama;
        $pasien->delete();
        return redirect()->route('pasien.index')->with('status', "Data pasien $name berhasil dihapus");
    }
}
