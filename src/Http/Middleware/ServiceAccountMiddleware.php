<?php

namespace Arpitech\SanctumServiceToken\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class ServiceAccountMiddleware
{
    public function handle(Request $request, Closure $next)
    {
        $user = $request->user();
        
        if (!$user instanceof \Arpitech\SanctumServiceToken\Models\ServiceAccount) {
            return response()->json(['error' => 'Accesso riservato ai service account'], 403);
        }
        
        return $next($request);
    }
}
