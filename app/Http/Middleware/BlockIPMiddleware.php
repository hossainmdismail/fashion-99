<?php

namespace App\Http\Middleware;

use App\Models\IpBlock;
use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class BlockIPMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $ip = request()->getClientIp();

        $blockedIP = IpBlock::where('ip_address', $ip)->where('is_blocked', true)->first();

        if ($blockedIP) {
            return response()->json(['message' => 'Access denied. Your IP is blocked.'], 403);
        }
        return $next($request);
    }
}
