<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;


class RegistroController extends Controller
{
    public function show ()
    {
        return view ('auth.registro');
    } 

    public function create (Request $request)
    {
        $atributos = $request->validate([
            'nome' => ['required'],
            'email' => ['required', 'email', 'unique:users,email'],
            'password' => ['required', 'confirmed', 'min:6'],
        ]);

        $usuario = User::create($atributos);

        Auth::login($usuario);

        return redirect('/');
    }
}
