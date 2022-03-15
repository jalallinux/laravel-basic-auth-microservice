<?php

namespace App\Http\Middleware;

use Illuminate\Auth\AuthenticationException;
use Illuminate\Auth\Middleware\AuthenticateWithBasicAuth as BaseAuthenticateWithBasicAuth;

class AuthenticateWithBasicAuth extends BaseAuthenticateWithBasicAuth
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @param  string|null  $guard
     * @param  string|null  $field
     * @return mixed
     * @throws \Symfony\Component\HttpKernel\Exception\UnauthorizedHttpException
     */
    public function handle($request, \Closure $next, $guard = null, $field = null)
    {
        $request->headers->set('Cache-Control', 'no-cache, must-revalidate, max-age=0');

        $this->auth->guard($guard)->basic($field ?: 'mobile');

        if (is_null($request->user())) {
            if ($request->expectsJson()) {
                throw new AuthenticationException();
            } else {
                header('HTTP/1.1 401 Authorization Required');
                header('WWW-Authenticate: Basic realm="Access denied"');
                exit;
            }
        }

        return $next($request);
    }
}
