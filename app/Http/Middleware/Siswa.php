<?php

namespace App\Http\Middleware;

use Closure;

class Siswa
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        if (strtolower($request->user()->role) !== 'siswa') {
            return redirect('home')->with('error', 'Akses hanya untuk siswa.');
        }

        return $next($request);
    }
}
