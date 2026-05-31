<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use App\Models\Visitor;
use Carbon\Carbon;

class LogVisitor
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        try {
            $ip = $request->ip();
            $date = Carbon::today()->format('Y-m-d');
            $userAgent = $request->header('User-Agent');

            // Skip logging for local development loopback if desired, but here we log everything for demo
            $visitor = Visitor::firstOrCreate(
                ['ip_address' => $ip, 'date' => $date],
                ['user_agent' => $userAgent, 'hits' => 0]
            );

            $visitor->increment('hits');
        } catch (\Exception $e) {
            // Ignore errors (e.g. database not migrated yet) so it doesn't break the app
        }

        return $next($request);
    }
}
