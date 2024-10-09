<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\ValidationException;

class LoginController extends Controller
{
    public function show ()
    {
        return view ('auth.login');
    } 

    public function login (Request $request)
    {
        $atributos = $request->validate([
            'email' => 'required',
            'password' => 'required'
        ]);

        if (!Auth::attempt($atributos)){
            throw ValidationException::withMessages([
                'email' => "Email ou senha incorretos. Digite novamente."
            ]);
        }

        $request->session()->regenerate();

        return redirect('/');
    }

    public function logout ()
    {
        Auth::logout();

        return redirect('/');
    }
}
