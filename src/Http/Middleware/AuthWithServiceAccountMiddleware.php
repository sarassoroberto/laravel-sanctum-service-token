<?php

namespace Arpitech\SanctumServiceToken\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;

class AuthWithServiceAccountMiddleware
{
    /**
     * Handle an incoming request.
     * Questo middleware estende auth:sanctum per supportare anche i service account
     * mantenendo piena compatibilità con l'autenticazione Sanctum esistente
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        // Prima prova l'autenticazione Sanctum standard
        $user = $request->user();
        
        if (!$user) {
            return new JsonResponse(['error' => 'Unauthenticated.'], 401);
        }
        
        // Accetta sia User che ServiceAccount
        $isUser = $user instanceof \App\Models\User;
        $isServiceAccount = $user instanceof \Arpitech\SanctumServiceToken\Models\ServiceAccount;
        
        if (!$isUser && !$isServiceAccount) {
            return new JsonResponse(['error' => 'Invalid authentication type.'], 403);
        }
        
        return $next($request);
    }
}
