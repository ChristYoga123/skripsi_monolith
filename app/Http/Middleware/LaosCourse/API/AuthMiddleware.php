<?php

namespace App\Http\Middleware\LaosCourse\API;

use App\Http\Controllers\Helpers\ResponseFormatterController;
use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class AuthMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        if(!auth('api')->check()) {
            // return redirect()->route('course.auth.login');
            return ResponseFormatterController::error('Unauthorized', 401);
        }
        return $next($request);
    }
}
