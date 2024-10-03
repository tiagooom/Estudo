<x-layout title='Tarefas'>
    <x-slot:heading>
        <div class="flex justify-between items-center">
            <span>Lista de Tarefas</span>
            <x-button href="/tarefas/create"> Criar Tarefas</x-button>
        </div>
    </x-slot:heading>
    <div class="space-y-4">
        @foreach ($tarefas as $tarefa)
            <a href="/tarefas/{{ $tarefa->id }}" class="block mt-4 py-4 border border-gray-200 rounded-lg"> 
                <div class="font-bold text-blue-500 text-sm">  
                    {{ $tarefa->usuario->nome }}
                </div>
                <div>
                    <strong>Tarefa: </strong> {{ $tarefa->titulo }}
                </div>
            </a>
        @endforeach
    </div>
    <div class="mt-4">
        {{ $tarefas->links() }}
    </div>
</x-layout>