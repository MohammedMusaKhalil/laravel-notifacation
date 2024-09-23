<?php

namespace App\Http\Controllers\AdminAuth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use App\Providers\RouteServiceProvider;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\JsonResponse;

use Illuminate\View\View;

class AuthenticatedSessionController extends Controller
{
    /**
     * Display the login view.
     */
    public function create(): View
    {
        return view('admin.login');
    }

    /**
     * Handle an incoming authentication request.
     */
    public function store(LoginRequest $request): RedirectResponse
    {
        $request->authenticate('admin');

        $request->session()->regenerate();

        return redirect()->route('admin.dashbord');
    }

    /**
     * Destroy an authenticated session.
     */
    public function destroy(Request $request): RedirectResponse
    {
        Auth::guard('admin')->logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect()->route('admin.login');
    }


    public function storeapi(LoginRequest $request): JsonResponse
    { $request->authenticate('admin');

        $admin = Auth::guard('admin')->user();
        $token = $admin->createToken('AdminToken')->plainTextToken;
        $lang=config('app.locale');
        return response()->json([
            'message' => 'Admin logged in successfully.',
            'admin' => $admin,
            'token' => $token,
            'lang'=>$lang,
        ]);
    }

    /**
     * Destroy an authenticated session.
     */
    public function destroyapi(Request $request): JsonResponse
    {
        Auth::guard('admin')->logout();

        return response()->json(['message' => 'Admin logged out successfully.']);
    }
}
