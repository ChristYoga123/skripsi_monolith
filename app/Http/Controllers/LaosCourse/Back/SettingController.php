<?php

namespace App\Http\Controllers\LaosCourse\Back;

use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class SettingController extends Controller
{
    public function index()
    {
        return view('pages.laos-course.back.setting.index', [
            'title' => 'Edit Profil',
        ]);
    }

    public function update(Request $request)
    {
        $request->validate([
            'name' => 'required|unique:users,name,' . auth()->user()->id,
            'email' => 'required|email|unique:users,email,' . auth()->user()->id,
            'password' => 'nullable|min:8',
            'avatar' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
        ], [
            'name.required' => 'Nama tidak boleh kosong',
            'name.unique' => 'Nama sudah terdaftar',
            'email.required' => 'Email tidak boleh kosong',
            'email.email' => 'Email tidak valid',
            'email.unique' => 'Email sudah terdaftar',
            'password.min' => 'Password minimal 8 karakter',
            'avatar.image' => 'File harus berupa gambar',
            'avatar.mimes' => 'File harus berupa jpg, jpeg, png, atau webp',
            'avatar.max' => 'Ukuran file maksimal 2MB',
        ]);

        if($request->hasFile('avatar'))
        {
            Storage::delete(Auth::user()->avatar_url);
            $avatar = $request->file('avatar');
            $avatarName = time() . '_' . Auth::user()->id . '.' . $avatar->getClientOriginalExtension();
            $avatarPath = $avatar->storeAs('avatars', $avatarName, 'public');
            
        }
        DB::beginTransaction();
        try
        {
            Auth::user()->update([
                'name' => $request->name,
                'email' => $request->email,
                'password' => $request->password ? bcrypt($request->password) : Auth::user()->password,
                'custom_fields' => [
                    'job' => $request->job,
                ],
                'avatar_url' => $request->hasFile('avatar') ? $avatarPath : Auth::user()->avatar_url,
            ]);

            DB::commit();
            return redirect()->back()->with('success', 'Profil berhasil diupdate');
        } catch(Exception $e)
        {
            DB::rollBack();
            Log::error('Error updating user profile: ' . $e->getMessage());
            return redirect()->back()->with('error', 'Gagal mengupdate profil');
        }


    }
}
