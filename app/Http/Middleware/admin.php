<?php

namespace App\Http\Middleware;

use JWTAuth;
use Closure;
use Illuminate\Http\Request;
use App\Models\User;


class admin
{
    /**1
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next)
    {
        if (session('auth')) {
            $id = session('auth');

            $user = User::find($id);
            if (!$user) {
                return abort(401);
            }
            if ($user->manage === 2) {
                return $next($request);
            } else {
                return abort(401);
            }
        }
        return abort(401);
    }
}
