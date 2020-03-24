<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;

class UserController extends Controller
{
    public function __construct()
    {
        $this->middleware(function ($request, $next) {
            if (Gate::allows('admin')) return $next($request);
            abort(403, 'Anda tidak memiliki cukup hak akses');
        });
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('user.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('user.create');
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
                'name' => "required|max:191",
                'username' => "required|unique:users",
                'password' => "required",
                'password_conf' => "required|same:password",
                'telp' => "required|max:15",
            ],
            [
                'name.required' => 'Nama harus diisi',
                'name.max' => 'Nama tidak boleh melebihi 191 karakter',
                'username.required' => 'Username harus diisi',
                'username.unique' => 'Username sudah terdaftar',
                'password.required' => 'Password harus diisi',
                'password_conf.required' => 'Konfirmasi password harus diisi',
                'password_conf.same' => 'Password dan Konfirmasi Password harus sama',
                'telp.required' => 'Nomor telepon harus diisi',
                'telp.max' => 'Nomor telepon tidak boleh melebihi 15 digit',
            ]
        );

        $user = new User;
        $user->name = $request->get('name');
        $user->username = $request->get('username');
        $user->password = \Hash::make($request->get('password'));
        $user->telp = $request->get('telp');
        $user->role = $request->get('role');
        $user->save();

        return redirect()->route('user.create')->with('status', 'User Berhasil Ditambahkan');
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
        $user = User::findOrFail($id);
        return view('user.edit', ['user' => $user]);
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
                'name' => "required|max:191",
                'username' => "required|unique:users",
                'password' => "required",
                'password_conf' => "required|same:password",
                'telp' => "required|max:15",
            ],
            [
                'name.required' => 'Nama harus diisi',
                'name.max' => 'Nama tidak boleh melebihi 191 karakter',
                'username.required' => 'Username harus diisi',
                'username.unique' => 'Username sudah terdaftar',
                'password.required' => 'Password harus diisi',
                'password_conf.required' => 'Konfirmasi password harus diisi',
                'password_conf.same' => 'Password dan Konfirmasi Password harus sama',
                'telp.required' => 'Nomor telepon harus diisi',
                'telp.max' => 'Nomor telepon tidak boleh melebihi 15 digit',
            ]
        );

        $user = User::findOrFail($id);
        $user->name = $request->get('name');
        $user->username = $request->get('username');
        $user->password = \Hash::make($request->get('password'));
        $user->telp = $request->get('telp');
        $user->role = $request->get('role');
        $user->save();

        return redirect()->route('user.edit', ['user' => $user->id])->with('status', 'User Berhasil Diedit');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $user = User::findOrFail($id);
        $name = $user->name;
        $user->delete();
        return redirect()->route('user.index')->with('status', "Berhasil Menghapus User $name");
    }
}
