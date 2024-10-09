<x-layout title='Projeto'>
    <x-slot:heading>
        Projeto
    </x-slot:heading>
    <h2 class="font-bold text-lg">{{ $projeto->titulo }}</h2>
    <p class="mb-4 mt-4">
         <strong>Descrição:</strong> {{ $projeto->descricao }}.
    </p>
    <p>
        <strong>Inicio:</strong> {{ $projeto->data_inicio }} <strong>Fim:</strong> {{ $projeto->data_fim }}
   </p>
   <p class="mb-4 mt-4">
        <strong>Status:</strong> {{ $projeto->status }}.
   </p>
   <p>
        <strong>Usuarios:</strong> 
        @foreach ($projeto->usuarios as $usuario)
        {{ $projeto->usuarios->pluck('nome')->implode(', ') }}
        @endforeach.
   </p>
    <p class="mt-6">
        <x-button href="/Projetos/{{ $projeto->id }}/edit">Editar</x-button>
    </p>
</x-layout>
