<x-layout title='Tarefas'>
    <x-slot:heading>
        <div class="flex justify-between items-center">
            <span>Lista de Tarefas</span>
            <a href="/tarefas/create" rel="next" class="relative inline-flex items-center px-4 py-2 text-sm font-medium text-gray-700 bg-white border border-gray-300 leading-5 rounded-md hover:text-gray-500 focus:outline-none focus:ring ring-gray-300 focus:border-blue-300 active:bg-gray-100 active:text-gray-700 transition ease-in-out duration-150 dark:bg-gray-800 dark:border-gray-600 dark:text-gray-300 dark:focus:border-blue-700 dark:active:bg-gray-700 dark:active:text-gray-300">
                Criar Tarefas
            </a>
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