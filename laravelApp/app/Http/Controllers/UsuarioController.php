<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Usuario;


class UsuarioController extends Controller
{
    public function index()
    {
        $usuarios = Usuario::latest()->orderby('id', 'desc')->cursorPaginate(6);

        return (view('usuarios', ['usuarios' => $usuarios]));
    }

    public function create()
    {
        return view('create');
    }

    public function store(Request $request)
    {
        Usuario::create([
            'nome' => request()->nome,
            'email' => request()->email
        ]);
    
        $usuarios = Usuario::latest()->orderby('id')->cursorPaginate(6);
    
        return (view('usuarios', ['usuarios' => $usuarios]));
    }

    public function show(string $id)
    {
        $usuario = Usuario::findOrFail($id);

        return (view('edit', ['usuario' => $usuario]));
    }

    public function edit(string $id)
    {
        $usuario = Usuario::findOrFail($id);

        return (view('edit', ['usuario' => $usuario]));
    }

    public function update(Request $request, string $id)
    {
        $usuario = Usuario::findOrFail($id);
        
        $usuario->update([
            'nome' => request()->nome,
            'email' => request()->email
        ]);

        return (redirect('usuarios'));
    }

    public function destroy(string $id)
    {
        $usuario = Usuario::findOrFail($id);

        $usuario->delete();

        return (redirect('usuarios'));
    }
}
