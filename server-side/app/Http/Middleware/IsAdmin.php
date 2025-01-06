<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class IsAdmin
{
    /**
     * Handle an incoming request.
     */
    public function handle(Request $request, Closure $next): Response
    {
        $user = auth()->user();

        if ($user->user_type_id !== 2) {
            return response()->json([
                'message' => 'Unauthorized access.'
            ], 403);
        }

        return $next($request);
    }
}
