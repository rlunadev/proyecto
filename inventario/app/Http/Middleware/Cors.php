<?php
namespace App\Http\Middleware;
use Closure;
/**
 * Class Cors
 * @package App\Http\Middleware
 */
class Cors
{
    /**
     * Handle an incoming request.
     *
     * Please add header('Access-Control-Allow-Origin: http://example.com');
     * & header('Access-Control-Allow-Credentials: true');
     * at the top of your route file.
     * 
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        if ($request->isMethod('options')) {
            return response('', 200)
              ->header('Access-Control-Allow-Methods', '*')
              ->header('Access-Control-Allow-Headers', '*'); // Add any required headers here
              //'accept, content-type,x-xsrf-token, x-csrf-token'
        }
        return $next($request);
    }