<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class CaretakerMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  Closure(Request): (Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        if ($request->user() && ($request->user()->isCaretaker() || $request->user()->isAdmin())) {
            return $next($request);
        }

        abort(403, 'Unauthorized action. Caretaker role required.');
    }
}
