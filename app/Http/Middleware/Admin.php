<?php

namespace App\Http\Middleware;

use Closure;
use RealRashid\SweetAlert\Facades\Alert;

class Admin
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
        if ($request->user()->level == '1') {
            return $next($request);
        } else {
            $level = $request->user()->level;
            if ($level == 2) {
                Alert::error('Akses Ditolak', 'Anda tidak memiliki Akses!');
                return redirect()->route('admin');
            } else {
                Alert::error('Akses Ditolak', 'Anda tidak memiliki Akses!');
                return redirect()->back();
            }
        }
    }
}
