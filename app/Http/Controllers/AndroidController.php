<?php
namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use App\Models\User;

class AndroidController extends Controller
{
public function signUp(Request $request)
{
    $validator = \Validator::make($request->all(), [
        'username'          => 'required|string|max:255|unique:users,username',
        'email'             => 'required|email|unique:users,email',
        'password'          => 'required|string|min:6',
        'confirm_password'  => 'required|same:password',
    ]);

    if ($validator->fails()) {
        return response()->json([
            'status'  => 'error',
            'message' => $validator->errors()->first()
        ], 400);
    }

    $user = new \App\Models\User();
    $user->username = $request->username;
    $user->email    = $request->email;
    $user->password = \Hash::make($request->password);
    $user->save();

    return response()->json([
        'status'  => 'success',
        'message' => 'Registrasi berhasil'
    ], 201);
}

public function login(Request $request)
    {
        $login = $request->input('login');
        $password = $request->input('password');

        if (!$login || !$password) {
            return response()->json([
                "status" => "error",
                "message" => "Login & password required"
            ], 400);
        }

        // cari user berdasarkan username atau email
        $user = User::where('username', $login)
                    ->orWhere('email', $login)
                    ->first();

        if (!$user) {
            return response()->json([
                "status" => "error",
                "message" => "User tidak ditemukan"
            ], 404);
        }

        // verifikasi password
        if (Hash::check($password, $user->password)) {
            return response()->json([
                "status" => "success",
                "message" => "Login berhasil",
                "user" => $user
            ]);
        }

        return response()->json([
            "status" => "error",
            "message" => "Password salah"
        ], 401);
    }

public function getAfdeling()
{
    $afdeling = \DB::table('list_afdelings')
        ->select('id', 'afdeling')
        ->orderBy('afdeling', 'asc')
        ->get();

    return response()->json([
        'status' => 'success',
        'data'   => $afdeling
    ], 200);
}

public function getKebun()
{
    $kebun = \DB::table('list_kebuns')
        ->select('id', 'nama_kebun')
        ->orderBy('nama_kebun', 'asc')
        ->get();

    return response()->json([
        'status' => 'success',
        'data'   => $kebun
    ], 200);
}

public function getPks()
{
    $pks = \DB::table('list_pks')
        ->select('id', 'nama_pks')
        ->orderBy('nama_pks', 'asc')
        ->get();

    return response()->json([
        'status' => 'success',
        'data'   => $pks
    ], 200);
}

public function insertKebun(Request $request)
{
    // Validasi input
    $validator = \Validator::make($request->all(), [
        'tanggal'    => 'required|date',
        'nama_kebun' => 'required|string',
        'afdeling'   => 'required|string',
        'blanko'     => 'required|string',
        'nopol'      => 'required|string',
        'supir'      => 'required|string',
        'foto1'      => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
        'foto2'      => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
        'foto3'      => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
    ]);

    if ($validator->fails()) {
        return response()->json([
            'status'  => 'error',
            'message' => $validator->errors()->first()
        ], 400);
    }

    // Upload file ke storage/app/public/kebun
    $foto_keseluruhan = $request->file('foto1') 
        ? $request->file('foto1')->store('kebun', 'public') 
        : null;
    $foto_sebelum = $request->file('foto2') 
        ? $request->file('foto2')->store('kebun', 'public') 
        : null;
    $foto_sesudah = $request->file('foto3') 
        ? $request->file('foto3')->store('kebun', 'public') 
        : null;

    // Simpan ke database
    $id = \DB::table('kebuns')->insertGetId([
        'tanggal_pengiriman'      => $request->tanggal,
        'nama_kebun'              => $request->nama_kebun,
        'afdeling'                => $request->afdeling,
        'nomor_blanko_pb25'       => $request->blanko,
        'nopol_mobil'             => $request->nopol,
        'nama_supir'              => $request->supir,
        'foto_keseluruhan_kebun'  => $foto_keseluruhan,
        'foto_sebelum_kebun'      => $foto_sebelum,
        'foto_sesudah_kebun'      => $foto_sesudah,
        'created_at'              => now(),
        'updated_at'              => now(),
    ]);

    return response()->json([
        'status'  => 'success',
        'message' => 'Data berhasil dikirim',
        'id'      => $id,
        'path_foto' => [
            'foto_keseluruhan' => $foto_keseluruhan,
            'foto_sebelum'     => $foto_sebelum,
            'foto_sesudah'     => $foto_sesudah,
        ]
    ], 201);
}


public function insertPks(Request $request)
{
    // Validasi input
    $validator = \Validator::make($request->all(), [
        'tanggal'   => 'required|date',
        'nama_pks'  => 'required|string',
        'tujuan'    => 'required|string',
        'blanko'    => 'required|string',
        'nopol'     => 'required|string',
        'supir'     => 'required|string',
        'foto1'     => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
        'foto2'     => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
        'foto3'     => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
    ]);

    if ($validator->fails()) {
        return response()->json([
            'status'  => 'error',
            'message' => $validator->errors()->first()
        ], 400);
    }

    // Upload file ke storage/app/public/pks
    $foto_keseluruhan = $request->file('foto1')
        ? $request->file('foto1')->store('pks', 'public')
        : null;
    $foto_sebelum = $request->file('foto2')
        ? $request->file('foto2')->store('pks', 'public')
        : null;
    $foto_sesudah = $request->file('foto3')
        ? $request->file('foto3')->store('pks', 'public')
        : null;

    // Simpan ke database
    $id = \DB::table('pks')->insertGetId([
        'tanggal_pengiriman'   => $request->tanggal,
        'nama_pks'             => $request->nama_pks,
        'tujuan_pengiriman'    => $request->tujuan,
        'nomor_blanko_pb33'    => $request->blanko,
        'nopol_mobil'          => $request->nopol,
        'nama_supir'           => $request->supir,
        'foto_keseluruhan_pks' => $foto_keseluruhan,
        'foto_sebelum_pks'     => $foto_sebelum,
        'foto_sesudah_pks'     => $foto_sesudah,
        'created_at'           => now(),
        'updated_at'           => now(),
    ]);

    return response()->json([
        'status'  => 'success',
        'message' => 'Data berhasil dikirim',
        'id'      => $id,
        'path_foto' => [
            'foto_keseluruhan' => $foto_keseluruhan,
            'foto_sebelum'     => $foto_sebelum,
            'foto_sesudah'     => $foto_sesudah,
        ]
    ], 201);
}


}
