<x-layout title='tarefa'>
    <x-slot:heading>
        tarefa
    </x-slot:heading>
    <h2 class="font-bold text-lg">{{ $tarefa->titulo }}</h2>
    <p class="mb-4 mt-4">
         <strong>Descrição:</strong> {{ $tarefa->descricao }}.
    </p>
    <p>
        <strong>Inicio:</strong> {{ \Carbon\Carbon::parse($tarefa->data_inicio)->format('d/m/Y') }} <strong>Fim:</strong> {{ \Carbon\Carbon::parse($tarefa->data_fim)->format('d/m/Y') }}
   </p>
   <p class="mb-4 mt-4">
        <strong>Status:</strong> {{ $tarefa->status }}.
   </p>
   <p>
        <strong>Usuario:</strong> {{ $tarefa->usuario->nome }}.
   </p>
    <p class="mt-6">
        <x-button href="/tarefas/{{ $tarefa->id }}/edit">Editar</x-button>
    </p>
</x-layout>
