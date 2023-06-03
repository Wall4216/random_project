<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;

class LoginController extends Controller
{
    public function showLoginForm()
    {
        return view('auth.login');
    }

    public function login(Request $request)
    {
        $credentials = $request->only('email', 'password');

        // Выполните здесь вашу логику аутентификации с использованием полученных данных $credentials

        // Пример:
        if (Auth::attempt($credentials)) {
            // Аутентификация успешна
            $user = Auth::user();

            // Сохраняем данные пользователя в сессии
            Session::put('user', $user);

            return redirect()->intended('/dashboard');
        }

        // Аутентификация не удалась
        return redirect()->back()->withErrors(['message' => 'Неверные учетные данные']);
    }

    public function logout()
    {
        Auth::logout();
        return redirect('/');
    }
}
