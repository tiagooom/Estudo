<x-layout title='Tarefa'>
    <x-slot:heading>
        Terefa
    </x-slot:heading>
    <h2 class="font-bold text-lg">{{ $tarefa->titulo }}</h2>
    <p>
         Descrição: {{ $tarefa['descricao'] }}.
    </p>
    <p>
        Criado por: {{ $tarefa->usuario->nome }}.
   </p>
    <p class="mt-6">
        <x-button href="/tarefas/{{ $tarefa->id }}/edit">Editar</x-button>
    </p>
</x-layout>
