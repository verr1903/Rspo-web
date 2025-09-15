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
    // ======================= SIGN UP =======================
    public function signUp(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'sap'              => 'required|string|unique:users,sap',
            'username'         => 'required|string|max:255|unique:users,username',
            'email'            => 'required|email|unique:users,email',
            'password'         => 'required|string|min:6',
            'confirm_password' => 'required|same:password',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status'  => 'error',
                'message' => $validator->errors()->first()
            ], 400);
        }

        $user = new User();
        $user->sap      = $request->sap;
        $user->username = $request->username;
        $user->email    = $request->email;
        $user->password = Hash::make($request->password);
        $user->save();

        return response()->json([
            'status'  => 'success',
            'message' => 'Registrasi berhasil'
        ], 201);
    }

    // ======================= LOGIN =======================
    public function login(Request $request)
    {
        $sap      = $request->input('sap');
        $password = $request->input('password');

        if (!$sap || !$password) {
            return response()->json([
                "status"  => "error",
                "message" => "Nomor SAP & password required"
            ], 400);
        }

        $user = User::where('sap', $sap)->first();

        if (!$user) {
            return response()->json([
                "status"  => "error",
                "message" => "User tidak ditemukan"
            ], 404);
        }

        if (Hash::check($password, $user->password)) {
            return response()->json([
                "status"   => "success",
                "message"  => "Login berhasil",
                "user_id"  => $user->id,
                "sap"      => $user->sap,
                "username" => $user->username,
                "email"    => $user->email
            ], 200);
        }

        return response()->json([
            "status"  => "error",
            "message" => "Password salah"
        ], 401);
    }

    // ======================= GET DATA =======================
    public function getAfdeling()
    {
        $afdeling = DB::table('list_afdelings')
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
        $kebun = DB::table('list_kebuns')
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
        $pks = DB::table('list_pks')
            ->select('id', 'nama_pks')
            ->orderBy('nama_pks', 'asc')
            ->get();

        return response()->json([
            'status' => 'success',
            'data'   => $pks
        ], 200);
    }

    // ======================= INSERT KEBUN =======================
    public function insertKebun(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'user_id'    => 'required|integer|exists:users,id',
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

        $foto_keseluruhan = $request->file('foto1') 
            ? $request->file('foto1')->store('kebun', 'public') 
            : null;
        $foto_sebelum = $request->file('foto2') 
            ? $request->file('foto2')->store('kebun', 'public') 
            : null;
        $foto_sesudah = $request->file('foto3') 
            ? $request->file('foto3')->store('kebun', 'public') 
            : null;

        $id = DB::table('kebuns')->insertGetId([
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

        // Simpan history
        DB::table('history_inputs')->insert([
            'user_id'   => $request->user_id,
            'form_type' => 'kebun',
            'form_id'   => $id,
            'created_at'=> now(),
            'updated_at'=> now(),
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

// ======================= INSERT PKS =======================
public function insertPks(Request $request)
{
    // Validasi input
    $validator = Validator::make($request->all(), [
        'user_id'   => 'required|integer|exists:users,id',
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

    // Upload foto jika ada
    $foto_keseluruhan = $request->file('foto1')?->store('pks', 'public');
    $foto_sebelum     = $request->file('foto2')?->store('pks', 'public');
    $foto_sesudah     = $request->file('foto3')?->store('pks', 'public');

    // Simpan data PKS
    $id = DB::table('pks')->insertGetId([
        'tanggal_pengiriman'    => $request->tanggal,
        'nama_pks'              => $request->nama_pks,
        'tujuan_pengiriman'     => $request->tujuan,
        'nomor_blanko_pb33'     => $request->blanko,
        'nopol_mobil'           => $request->nopol,
        'nama_supir'            => $request->supir,
        'foto_keseluruhan_pks'  => $foto_keseluruhan,
        'foto_sebelum_pks'      => $foto_sebelum,
        'foto_sesudah_pks'      => $foto_sesudah,
        'created_at'            => now(),
        'updated_at'            => now(),
    ]);

    // Simpan history input
    DB::table('history_inputs')->insert([
        'user_id'    => $request->user_id,
        'form_type'  => 'pks',
        'form_id'    => $id,
        'created_at' => now(),
        'updated_at' => now(),
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


// ======================= GET HISTORY USER =======================
public function getHistory($userId)
{
    if (!$userId || !User::find($userId)) {
        return response()->json([
            'status'  => 'error',
            'message' => 'User tidak ditemukan'
        ], 404);
    }

    $history = DB::table('history_inputs')
        ->where('user_id', $userId)
        ->orderBy('created_at', 'desc')
        ->get();

    // Load detail kebun atau pks
    $history->transform(function($item) {
        if ($item->form_type == 'kebun') {
            $item->detail = DB::table('kebuns')->where('id', $item->form_id)->first();
        } elseif ($item->form_type == 'pks') {
            $item->detail = DB::table('pks')->where('id', $item->form_id)->first();
        }
        return $item;
    });

    return response()->json([
        'status' => 'success',
        'data'   => $history
    ], 200);
}

}