<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class FrameHeader
{

    private $unwantedHeaderList = [
        'X-Powered-By',
        'Server',
        'Host'
    ];
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next)
    {
        $response = $next($request);
        $response->header('X-Frame-Options','deny'); // Anti clickjacking
        $response->header('X-XSS-Protection', '1; mode=block'); // Anti cross site scripting (XSS)
        $response->header('X-Content-Type-Options', 'nosniff'); // Reduce exposure to drive-by dl attacks
        $response->header('Content-Security-Policy', "base-uri 'self';form-action 'self';font-src 'self' 'unsafe-inline' 'unsafe-eval'"); // Reduce risk of XSS, clickjacking, and other stuff
        $response->header('Strict-Transport-Security', 'max-age=31536000; includeSubdomains');
        $this->removeUnwantedHeaders($this->unwantedHeaderList);
        return $response;
    }

    private function removeUnwantedHeaders($headerList)
    {
        foreach ($headerList as $header)
            header_remove($header);
    }
}
