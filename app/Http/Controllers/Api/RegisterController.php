<?php

namespace App\Http\Controllers\Api;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Hash;


class RegisterController extends Controller
{
    /**
     * Handle the incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function __invoke(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'nama_depan' => ['required', 'string', 'max:255'],
            'nama_belakang' => ['required', 'string', 'min:2', 'max:255'],
            'nomer_telepon' => ['required', 'string', 'min:2', 'max:14'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'username' => ['required', 'string', 'min:6', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
            'password_confirmation' => ['required', 'string', 'min:8'],
            'tanggal_lahir' => ['required', 'date'],
            'jenis_kelamin' => ['required', 'string', 'max:255'],
            'referensi' => ['required', 'string', 'max:255'],
            'label_alamat' => ['required', 'string', 'max:255'],
            'kota_kecamatan' => ['required', 'string', 'max:255'],
            'alamat_lengkap' => ['required', 'string', 'max:255'],

        ]);
        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }

        //create user
        $user = User::create([
            'nama_depan'      => $request->nama_depan,
            'nama_belakang'      => $request->nama_belakang,
            'nomer_telepon'      => $request->nomer_telepon,
            'email'      => $request->email,
            'username'      => $request->username,
            'password'      => Hash::make($request->password),
            'password_confirmation'      => $request->password_confirmation,
            'tanggal_lahir'      => $request->tanggal_lahir,
            'jenis_kelamin'      => $request->jenis_kelamin,
            'referensi'      => $request->referensi,
            'label_alamat'      => $request->label_alamat,
            'kota_kecamatan' => $request->kota_kecamatan,
            'alamat_lengkap'     => $request->alamat_lengkap,
        ]);

        if($user) {
            return response()->json([
                'success' => true,
                'user'    => $user,  
            ], 201);
        }

        return response()->json([
            'success' => false,
        ], 409);
    }
}