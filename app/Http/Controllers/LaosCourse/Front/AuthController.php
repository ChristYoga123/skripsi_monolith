<?php

namespace App\Http\Controllers\LaosCourse\Front;

use Exception;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use App\Http\Controllers\Controller;
use App\Http\Controllers\Helpers\ResponseFormatterController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;

class AuthController extends Controller
{
    public function loginIndex()
    {
        return view('pages.laos-course.front.auth.login', [
            'title' => 'Login'
        ]);
    }

    public function authenticate(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ], [
            'email.required' => 'Email tidak boleh kosong',
            'email.email' => 'Email tidak valid',
            'password.required' => 'Password tidak boleh kosong',
        ]);

        $credentials = $request->only('email', 'password');

        if(Auth::attempt($credentials))
        {
            $request->session()->regenerate();
            return redirect()->route('course.dashboard.index')->with('success', 'Selamat datang ' . Auth::user()->name);
        }
        
        return redirect()->back()->with('error', 'Email atau password salah')->withInput([
            'email' => $request->email,
        ]);
    }

    public function registerIndex()
    {
        return view('pages.laos-course.front.auth.register', [
            'title' => 'Register',
        ]);
    }

    public function register(Request $request)
    {
        $request->validate([
            'name' => 'required|unique:users,name',
            'email' => 'required|email|email:dns|unique:users,email',
            'password' => 'required|min:8',
        ], [
            'name.required' => 'Nama tidak boleh kosong',
            'name.unique' => 'Nama sudah digunakan',
            'email.required' => 'Email tidak boleh kosong',
            'email.email' => 'Email tidak valid',
            'email.email:dns' => 'Email tidak valid',
            'email.unique' => 'Email sudah digunakan',
            'password.required' => 'Password tidak boleh kosong',
            'password.min' => 'Password minimal 8 karakter',
        ]);

        DB::beginTransaction();
        try
        {
            $user = User::create([
                'name' => $request->name,
                'email' => $request->email,
                'password' => bcrypt($request->password),
            ]);

            $user->assignRole('student');

            DB::commit();
            Auth::login($user);
            return redirect()->route('course.dashboard.index')->with('success', 'Akun berhasil dibuat. Selamat datang ' . $user->name);
        }catch(Exception $e)
        {
            Log::error($e->getMessage());
            DB::rollback();
            return redirect()->back()->with('error', 'Terjadi kesalahan. Silahkan coba lagi')->withInput($request->only('name', 'email'));
        }
    }

    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return ResponseFormatterController::success(null, 'Logout berhasil', 200);
    }
}
