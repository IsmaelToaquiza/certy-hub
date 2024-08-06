<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\ValidationException;
use Illuminate\View\View;
use Illuminate\Support\Facades\Log;

class AuthenticatedSessionController extends Controller
{
    /**
     * Display the login view.
     */
    public function create(): View
    {
        return view('auth.login');
    }

    /**
     * Handle an incoming authentication request.
     */
    public function store(LoginRequest $request): RedirectResponse
    {
        try {
            $request->authenticate();

            $request->session()->regenerate();

            $user = $request->user();

            // Redirigir basado en el rol del usuario
            switch ($user->role_id) {
                case 1:
                    return redirect()->route('admin.dashboard');
                case 2:
                    return redirect()->route('adminproy.dashboard');
                case 3:
                    return redirect()->route('student.dashboard');
                default:
                    return redirect('/');
            }
        } catch (ValidationException $e) {
            // Loggear intentos fallidos para análisis posterior
            Log::warning('Failed login attempt', [
                'email' => $request->input('email'),
                'ip' => $request->ip(),
            ]);

            return redirect()->route('login')
                ->withErrors($e->validator->errors())
                ->withInput($request->only('email', 'remember'));
        }
    }

    /**
     * Destroy an authenticated session.
     */
    public function destroy(Request $request): RedirectResponse
    {
        Auth::guard('web')->logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect('/');
    }
}
