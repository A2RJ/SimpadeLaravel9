<?php

namespace App\Http\Controllers;

use App\Models\WPMain;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Tymon\JWTAuth\Exceptions\JWTException;
use Tymon\JWTAuth\Facades\JWTAuth;

class AuthController extends Controller
{
    public function register(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'wp_id' => 'required',
            'kategori_wp_id' => 'required',
            'nama_wp' => 'required',
            'email' => 'required|string|email|max:255|unique:wp_main',
            'password' => 'required|string|min:8',
            'npwpd' => 'required',
            'alamat_wp' => 'required',
            'kode_pemda_tk2' => 'required',
            'kode_desa_lurah' => 'required',
            'kode_pos' => 'required',
            'tanggal_aktif_wp' => 'required',
            'role' => 'required',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'message' => $validator->errors()
            ], Response::HTTP_UNPROCESSABLE_ENTITY);
        } else {
            $wpMain = WPMain::create($request->all());
            $wpMain->password = Hash::make($request->password);
            $wpMain->save();
            return response()->json([
                'data' => $wpMain
            ], Response::HTTP_CREATED);
        }
    }

    public function login(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'email' => 'required|string|email|max:255',
            'password' => 'required|string|min:8',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'message' => $validator->errors()
            ], Response::HTTP_UNPROCESSABLE_ENTITY);
        }

        $credentials = $request->only('email', 'password');

        if (!$token = JWTAuth::attempt($credentials)) {
            return response()->json([
                'message' => 'invalid credentials'
            ], Response::HTTP_UNAUTHORIZED);
        }

        return $this->respondWithToken($token);
    }

    /**
     * User login data
     * @return \Illuminate\Http\JsonResponse
     */
    public function me()
    {
        try {
            if (!$user = JWTAuth::parseToken()->authenticate()) return response()->json([
                'message' => 'user_not_found'
            ], Response::HTTP_NOT_FOUND);
        } catch (\Tymon\JWTAuth\Exceptions\TokenExpiredException $e) {
            return response()->json([
                'message' => 'token_expired'
            ], Response::HTTP_UNAUTHORIZED);
        } catch (\Tymon\JWTAuth\Exceptions\TokenInvalidException $e) {
            return response()->json([
                'message' => 'token_invalid'
            ], Response::HTTP_UNAUTHORIZED);
        } catch (\Tymon\JWTAuth\Exceptions\JWTException $e) {
            return response()->json([
                'message' => 'token_absent'
            ], Response::HTTP_UNAUTHORIZED);
        }

        return response()->json([
            'data' => $user
        ], Response::HTTP_OK);
    }

    /**
     * Log the user out (Invalidate the token).
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function logout(Request $request)
    {
        if (!JWTAuth::parseToken()->authenticate())
            return response()->json([
                'message' => "Not valid token"
            ], Response::HTTP_UNAUTHORIZED);
        try {
            JWTAuth::invalidate($request->token);
            return response()->json([
                'message' => 'User has been logged out'
            ], Response::HTTP_OK);
        } catch (JWTException $exception) {
            return response()->json([
                'message' => 'Sorry, user cannot be logged out'
            ], Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

    /**
     * Refresh a token.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function refresh()
    {
        return $this->respondWithToken(JWTAuth::refresh());
    }

    /**
     * Get the token array structure.
     *
     * @param  string $token
     *
     * @return \Illuminate\Http\JsonResponse
     */
    function respondWithToken($token)
    {
        return response()->json([
            'access_token' => $token,
            'token_type' => 'bearer',
            'expires_in' =>  60
        ], Response::HTTP_OK);
    }
}
