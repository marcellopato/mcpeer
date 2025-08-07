<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class EnsureSessionIsStarted
{
    /**
     * Handle an incoming request.
     */
    public function handle(Request $request, Closure $next)
    {
        // Try to get or create a session
        try {
            if (!$request->hasSession()) {
                $sessionManager = app('session');
                $session = $sessionManager->driver();
                $request->setSession($session);
            }

            // Ensure the session is started
            if (!$request->session()->isStarted()) {
                $request->session()->start();
            }
        } catch (\Exception $e) {
            // Log error but don't fail the request
            Log::warning('Session middleware error: ' . $e->getMessage());
        }

        return $next($request);
    }
}
