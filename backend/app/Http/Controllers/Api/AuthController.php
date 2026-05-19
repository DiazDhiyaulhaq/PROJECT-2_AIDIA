<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;

use Illuminate\Http\Request;

use App\Models\User;
use App\Models\Patient;

use Illuminate\Support\Facades\Hash;

use Illuminate\Validation\ValidationException;

class AuthController extends Controller
{

    // 🔥 REGISTER PASIEN
    public function register(Request $request)
    {
        $request->validate([

            'name' => 'required|string|max:255',

            'email' => 'required|email|unique:users',

            'password' => 'required|min:6'
        ]);

        // 🔥 CREATE USER
        $user = User::create([

            'name' => $request->name,

            'email' => $request->email,

            'password' => Hash::make(
                $request->password
            ),

            'role' => 'pasien'
        ]);

        // 🔥 AUTO CREATE PATIENT
        Patient::create([

            // dummy nik sementara
            'nik' =>
                'P' . time(),

            'name' =>
                $request->name,

            // default sementara
            'gender' =>
                'male',

            'birth_date' =>
                now(),

            'address' =>
                '-',

            'phone' =>
                '-',

            'created_by' =>
                $user->id
        ]);

        // 🔥 TOKEN
        $token = $user
            ->createToken('mobile')
            ->plainTextToken;

        return response()->json([

            'message' =>
                'Register berhasil',

            'user' =>
                $user,

            'token' =>
                $token
        ]);
    }


    // 🔥 LOGIN PASIEN
    public function login(Request $request)
    {
        $request->validate([

            'email' => 'required|email',

            'password' => 'required'
        ]);

        $user = User::where(
                'email',
                $request->email
            )
            ->where(
                'role',
                'pasien'
            )
            ->first();

        if (
            !$user ||
            !Hash::check(
                $request->password,
                $user->password
            )
        ) {

            throw ValidationException
                ::withMessages([

                'email' => [
                    'Email atau password salah'
                ]
            ]);
        }

        $token = $user
            ->createToken('mobile')
            ->plainTextToken;

        return response()->json([

            'message' =>
                'Login berhasil',

            'user' =>
                $user,

            'token' =>
                $token
        ]);
    }


    // 🔥 LOGOUT
    public function logout(Request $request)
    {
        $request
            ->user()
            ->currentAccessToken()
            ->delete();

        return response()->json([

            'message' =>
                'Logout berhasil'
        ]);
    }
}