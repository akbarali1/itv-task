<?php
declare(strict_types=1);

namespace App\Http\Controllers;

use App\ActionData\AuthActionData;
use App\Models\User;
use Illuminate\Http\RedirectResponse;

final class AuthController extends Controller
{
    public function showLogin()
    {
        return view('auth.login');
    }

    public function login(AuthActionData $actionData): RedirectResponse
    {
        $credentials = [
            'email'    => $actionData->email,
            'password' => $actionData->password,
        ];

        if (auth()->attempt($credentials, $actionData->remember)) {
            return to_route('home');
        }

        return back()->withErrors([
            'email' => 'The provided credentials do not match our records.',
        ]);
    }

    public function logout(): RedirectResponse
    {
        auth()->logout();

        return to_route('login');
    }

    public function userCreate()
    {
        User::query()->create([
            'name'     => 'Akbarali',
            'email'    => 'github@akbararli.uz',
            'password' => bcrypt('password'),
        ]);
    }
}
