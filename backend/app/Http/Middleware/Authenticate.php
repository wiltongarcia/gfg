<?php

namespace App\Http\Middleware;

use Closure;
use App\Services\Auth;

/**
 * Middleware for Authentication
 *
 * @package App\Http\Controllers
 * @author Wilton Garcia <wiltonog@gmail.com>
**/
class Authenticate
{
    /**
     * The authentication instance
     *
     * @var \App\Services\Auth
     */
    protected $auth;

    /**
     * Create a new middleware instance.
     *
     * @param  \App\Services\Auth  $auth
     * @return void
     */
    public function __construct(Auth $auth)
    {
        $this->auth = $auth;
    }

    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @param  string|null  $guard
     * @return mixed
     */
    public function handle($request, Closure $next, $guard = null)
    {
        if (!$this->auth->validate($request)) {
            return response('Unauthorized.', 401);
        }

        return $next($request);
    }
}
