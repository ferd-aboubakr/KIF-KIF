<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class EnsureEntrepriseValidated
{
    /**
     * Handle an incoming request.
     *
     * @param  Closure(Request): (Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $user = auth()->user();
        
        if ($user && $user->entreprise && $user->entreprise->statut_validation !== 'validee') {
            if ($request->expectsJson()) {
                return response()->json(['message' => 'Votre entreprise est suspendue. Veuillez contacter l\'administration.'], 403);
            }
            
            abort(403, 'Votre entreprise est suspendue. Veuillez contacter l\'administration.');
        }

        return $next($request);
    }
}
