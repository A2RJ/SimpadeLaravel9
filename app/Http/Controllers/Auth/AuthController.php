<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Arr;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class AuthController extends Controller
{
    public function login(Request $request)
    {
        $validate = Validator::make($request->all(), [
            'email' => 'required',
            'password' => 'required',
        ]);

        if ($validate->fails()) {
            $respon = [
                'message' => $validate->errors()
            ];
            return response()->json($respon, 200);
        } else {
            $credentials = request(['email', 'password']);
            $credentials = Arr::add($credentials, 'status', 'aktif');
            if (!Auth::attempt($credentials)) {
                $respon = [
                    'message' => 'Unathorized, credentials not match'
                ];
                return response()->json($respon, 401);
            }

            $user = User::where('email', $request->email)->first();
            if (!Hash::check($request->password, $user->password, [])) {
                throw new \Exception('Error in Login');
            }

            $tokenResult = $user->createToken('token-auth')->plainTextToken;
            $respon = [
                'message' => 'Login successfully',
                'access_token' => $tokenResult,
                'type' => 'Bearer',
            ];
            return response()->json($respon, 200);
        }
    }

    public function me(Request $request)
    {
        $user = $request->user();
        $respon = [
            'user' => $user,
        ];
        return response()->json($respon, 200);
    }
    public function logout(Request $request)
    {
        $user = $request->user();

        $respon = [
            'user' => $user,
            'message' => $user->currentAccessToken()->delete() ? 'Logout successfully' : 'Logout failed',
        ];

        return response()->json($respon, 200);
    }

    public function logoutall(Request $request)
    {
        $user = $request->user();

        $respon = [
            'user' => $user,
            'message' => $user->tokens()->delete() ? 'Logout successfully' : 'Logout failed',
        ];

        return response()->json($respon, 200);
    }
}
