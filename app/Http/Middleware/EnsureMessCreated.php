<?php

namespace App\Http\Middleware;

use Closure;
use App\Models\Messe;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class EnsureMessCreated
{
    public function handle(Request $request, Closure $next)
    {
        $user = Auth::user();

        // Only apply to managers
        if ($user && $user->role === 'manager') {
            $mess = Messe::where('user_id', $user->id)->first();
            if (!$mess && $request->route()->named('mess.index') === false) {
                return redirect()->route('mess.index')->with('showModal', true);
            }
        }

        return $next($request);
    }
}