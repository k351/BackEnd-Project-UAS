<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;
use Illuminate\View\View;
use Illuminate\Support\Facades\Password;
use Illuminate\Validation\ValidationException;

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
            'email' => ['required', 'string', 'lowercase', 'email', 'max:255', 'unique:'.User::class],
            'password' => [
                'required',
                'confirmed',
                function ($attribute, $value, $fail) {
                    if (strlen($value) < 8) {
                        $fail('The password must be at least 8 characters.');
                    }
                    if (!preg_match('/[A-Z]/', $value)) {
                        $fail('The password must contain at least one uppercase letter.');
                    }
                    if (!preg_match('/[a-z]/', $value)) {
                        $fail('The password must contain at least one lowercase letter.');
                    }
                    if (!preg_match('/\d/', $value)) {
                        $fail('The password must contain at least one digit.');
                    }
                    if (!preg_match('/[!@#$%^&*(),.?":{}|<>]/', $value)) {
                        $fail('The password must contain at least one symbol.');
                    }
                },
            ],
        ]);

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'phone' => $request->phone,
            'address' => $request->address,
            'password' => Hash::make($request->password),
        ]);

        event(new Registered($user));

        Auth::login($user);

        return redirect(route('verification.notice', absolute: false));
    }
}
