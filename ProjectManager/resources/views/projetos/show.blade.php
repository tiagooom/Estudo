<x-layout title='Projeto'>
    <x-slot:heading>
        Projeto
    </x-slot:heading>
    <h2 class="font-bold text-lg">{{ $projeto->titulo }}</h2>
    <p class="mb-4 mt-4">
         <strong>Descrição:</strong> {{ $projeto->descricao }}.
    </p>
    <p>
        <strong>Inicio:</strong> {{ \Carbon\Carbon::parse($projeto->data_inicio)->format('d/m/Y') }} <strong>Fim:</strong> {{ \Carbon\Carbon::parse($projeto->data_fim)->format('d/m/Y') }}
   </p>
   <p class="mb-4 mt-4">
        <strong>Status:</strong> {{ $projeto->status }}.
   </p>
   <p>
        <strong>Usuarios:</strong>  {{ trim($projeto->usuarios->pluck('nome')->implode(', ')) }}.
   </p>
    <p class="mt-6">
        <x-button href="/projetos/{{ $projeto->id }}/edit">Editar</x-button>
    </p>
</x-layout>
