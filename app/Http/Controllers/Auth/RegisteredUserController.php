<?php

namespace App\Http\Controllers\Auth;

use App\Models\User;
use App\Models\Messe;
use Illuminate\View\View;
use Illuminate\Http\Request;
use Illuminate\Validation\Rules;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\RedirectResponse;
use Illuminate\Auth\Events\Registered;

class RegisteredUserController extends Controller
{
    /**
     * Display the registration view.
     */
    public function create(): View
    {
        return view('auth.register');
    }

    /**
     * Handle an incoming registration request.
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(Request $request): RedirectResponse
    {
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'lowercase', 'email', 'max:255', 'unique:' . User::class],
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
           
        ]);

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'role' => 'manager',
        ]);

        event(new Registered($user));

        Auth::login($user);
        // If the user is a manager, check for mess existence
        if ($user->role === 'manager') {
            $mess = Messe::where('user_id', $user->id)->first();
            if (!$mess) {
                // Redirect to mess creation page
                return redirect()->route('mess.create')->with('showModal', true);
            }
        }

        return redirect(route('dashboard', absolute: false));
    }
}
