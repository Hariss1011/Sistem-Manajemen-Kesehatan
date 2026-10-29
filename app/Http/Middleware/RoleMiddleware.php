<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class RoleMiddleware
{
    /**
     * Memeriksa apakah pengguna memiliki role yang diizinkan.
     *
     * Contoh:
     * middleware('role:admin')
     * middleware('role:admin,dokter')
     */
    public function handle(
        Request $request,
        Closure $next,
        string ...$roles
    ): Response {
        $user = $request->user();

        // Pengguna yang belum login tidak boleh melanjutkan.
        if (!$user) {
            return redirect()->guest(route('login'));
        }

        // Tolak akses jika role tidak disertakan
        // atau tidak sesuai dengan role pengguna.
        if (
            empty($roles) ||
            !in_array($user->role, $roles, true)
        ) {
            abort(403, 'Anda tidak memiliki izin untuk mengakses halaman ini.');
        }

        return $next($request);
    }
}
