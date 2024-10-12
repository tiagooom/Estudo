<x-layout title='Tarefas'>
    <x-slot:heading>
        <div class="flex justify-between items-center">
            <span>Lista de tarefas</span>
        </div>
    </x-slot:heading>
    @if (session('delSuccess'))
        <div class="bg-green-100 border border-green-400 text-green-800 px-4 py-3 rounded relative" role="alert">
            <span class="block sm:inline">{{ session('delSuccess') }}</span>
        </div>
    @endif
    <div class="space-y-4">
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
    <div class="mt-4">
        {{ $tarefas->links() }}
    </div>
</x-layout>