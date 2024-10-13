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
    
   <div class="space-y-4">
    <h2 class="mt-16 font-bold text-lg">Tarefas</h2>
    @foreach ($tarefas as $tarefa)
        <a href="/tarefas/{{ $tarefa->id }}" class="block mt-4 py-4 border border-gray-200 rounded-lg"> 
            <div class="font-bold text-blue-500 text-sm">  
                {{ $tarefa->titulo }}
            </div>
            <div>
                <strong>Inicio: </strong> {{ \Carbon\Carbon::parse($tarefa->data_inicio)->format('d-m-Y') }} <strong>Fim: </strong> {{ \Carbon\Carbon::parse($tarefa->data_fim)->format('d-m-Y') }} <strong>Status: </strong>{{ $tarefa->status }} <strong>Usuário: </strong>{{ $tarefa->usuario->nome }}
            </div>
        </a>
    @endforeach
    </div>
</x-layout>
