<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Auth;

use App\Enums\Role;
 
class IsAdminMiddleware
{
    public function handle(Request $request, Closure $next): Response
    {  
        $user = Auth::user();
        abort_if($user->role_id !== Role::ADMINISTRATOR->value, Response::HTTP_FORBIDDEN);
 
        return $next($request);
    }
}