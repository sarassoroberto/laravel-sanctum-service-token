<?php

namespace Arpitech\SanctumServiceToken\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;

class SanctumOrServiceAccountMiddleware
{
    public function handle(Request $request, Closure $next)
    {
        // Prima proviamo con l'autenticazione Sanctum standard
        $user = $request->user();
        
        if ($user) {
            // Se l'utente è autenticato tramite Sanctum standard, procediamo
            if ($user instanceof \App\Models\User || !($user instanceof \Arpitech\SanctumServiceToken\Models\ServiceAccount)) {
                return $next($request);
            }
            
            // Se l'utente è un ServiceAccount, procediamo
            if ($user instanceof \Arpitech\SanctumServiceToken\Models\ServiceAccount) {
                return $next($request);
            }
        }
        
        // Se non c'è autenticazione, ritorniamo errore
        return new JsonResponse(['error' => 'Accesso non autorizzato. Richiesta autenticazione Sanctum o Service Account.'], 401);
    }
}
