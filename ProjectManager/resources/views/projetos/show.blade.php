<x-layout title='Projeto'>
    <x-slot:heading>
        <div class="flex justify-between items-center">
            <div>
                <span>Projeto</span>
            </div>
            <div>
                <x-button href="/projetos/{{ $projeto->id }}/edit">Editar Projeto</x-button>
                <x-button href="{{ route('tarefas.create', ['projeto' => $projeto->id]) }}"> Criar Tarefa</x-button>
            </div>
        </div>
    </x-slot:heading>
    <div>
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
    </div>
</x-layout>
