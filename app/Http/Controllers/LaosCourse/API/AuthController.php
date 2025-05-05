<?php

namespace App\Http\Controllers\LaosCourse\API;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Controllers\Helpers\ResponseFormatterController;
use Illuminate\Support\Facades\Validator;

class AuthController extends Controller
{
    /**
     * Create a new User
     * 
     * @return \Illuminate\Http\JsonResponse
     */
    public function register(Request $request)
    {
        $data = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|email:dns|max:255|unique:users',
            'password' => 'required|string|min:8',
        ], [
            'name.required' => 'Nama wajib diisi',
            'name.string' => 'Nama harus berupa string',
            'name.max' => 'Nama tidak boleh lebih dari 255 karakter',
            'email.required' => 'Email wajib diisi',
            'email.string' => 'Email harus berupa string',
            'email.email' => 'Email tidak valid',
            'email.dns' => 'Email tidak valid',
            'email.max' => 'Email tidak boleh lebih dari 255 karakter',
            'email.unique' => 'Email sudah terdaftar',
            'password.required' => 'Password wajib diisi',
            'password.string' => 'Password harus berupa string',
            'password.min' => 'Password minimal 8 karakter',
        ]);

        if($data->fails())
        {
            return ResponseFormatterController::error($data->errors(), 422);
        }

        $user = User::create([
            'name' => $data->name,
            'email' => $data->email,
            'password' => bcrypt($data->password),
        ]);

        $user->assignRole('student');

        return ResponseFormatterController::success($user, 'Berhasil Daftar');
    }

    /**
     * Get a JWT via given credentials.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function login(Request $request)
    {
        $data = Validator::make($request->all(), [
            'email' => 'required|string|email|email:dns|max:255',
            'password' => 'required|string|min:8',
        ], [
            'email.required' => 'Email wajib diisi',
            'email.string' => 'Email harus berupa string',
            'email.email' => 'Email tidak valid',
            'email.dns' => 'Email tidak valid',
            'email.max' => 'Email tidak boleh lebih dari 255 karakter',
            'password.required' => 'Password wajib diisi',
            'password.string' => 'Password harus berupa string',
            'password.min' => 'Password minimal 8 karakter',
        ]);

        if($data->fails())
        {
            return ResponseFormatterController::error($data->errors(), 422);
        }

        if (! $token = auth('api')->attempt([
            'email' => $request->email,
            'password' => $request->password
        ])) {
            return ResponseFormatterController::error('Unauthenticated', 401);
        }

        return $this->respondWithToken($token);
    }

    /**
     * Get the token array structure.
     *
     * @param  string $token
     *
     * @return \Illuminate\Http\JsonResponse
     */
    protected function respondWithToken($token)
    {
        return ResponseFormatterController::success([
            'access_token' => $token,
            'token_type' => 'bearer',
            'expires_in' => auth('api')->factory()->getTTL() * 60
        ], 'Berhasil mendapatkan token');
    }
}
