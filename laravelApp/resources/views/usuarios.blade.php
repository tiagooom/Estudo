<x-layout title='Usuários'>
    <div>
        @foreach ($usuarios as $usuario)
           <a href="/usuarios/{{ $usuario->id }}" class="block mt-4 py-4 border border-gray-200 rounded-lg"> <strong>{{ $usuario->nome }}</strong> </a>
        @endforeach
    </div>
    <div class="mt-4">
        {{ $usuarios->links() }}
    </div>
</x-layout>