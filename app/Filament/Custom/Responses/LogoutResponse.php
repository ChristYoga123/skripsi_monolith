<?php

namespace App\Filament\Custom\Responses;

use Filament\Http\Responses\Auth\Contracts\LogoutResponse as ContractsLogoutResponse;
use Illuminate\Http\RedirectResponse;

class LogoutResponse implements ContractsLogoutResponse
{
    public function toResponse($request): RedirectResponse
    {
        return redirect()->route('course.auth.login')
            ->with('success', 'Berhasil logout');
    }
}
