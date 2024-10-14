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
        <div class="space-y-4">
            <form method="GET" action="{{ route('tarefas.index') }}" class="bg-white p-6 rounded-lg shadow-lg mb-6">
                <div class="grid grid-cols-1 sm:grid-cols-4 gap-6">
                    <div class="col-span-1">
                        <label for="status" class="block text-sm font-medium text-gray-700">Status</label>
                        <select id="status" name="filter[status]" class="mt-1  w-full rounded-lg border-gray-300 bg-gray-50 shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                            <option value="">Todos</option>
                            <option value="Pendente" {{ request('filter.status') == 'Pendente' ? 'selected' : '' }}>Pendente</option>
                            <option value="Em andamento" {{ request('filter.status') == 'Em andamento' ? 'selected' : '' }}>Em andamento</option>
                            <option value="Finalizado" {{ request('filter.status') == 'Finalizado' ? 'selected' : '' }}>Finalizado</option>
                        </select>
                    </div>
            
                    <div class="col-span-1">
                        <label for="start_date" class="block text-sm font-medium text-gray-700">Data de Início</label>
                        <input type="date" id="start_date" name="filter[data_inicio]" value="{{ request('filter.data_inicio') }}" class="mt-1 block w-full rounded-lg border-gray-300 bg-gray-50 shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                    </div>

                    <div class="col-span-1">
                        <label for="usuario" class="block text-sm font-medium text-gray-700">Usuário</label>
                        <select id="usuario" name="filter[usuario_id]" class="mt-1 block w-full rounded-lg border-gray-300 bg-gray-50 shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                            <option value="">Todos</option>
                            @foreach ($usuarios as $usuario)
                                <option value="{{ $usuario->id }}" {{ (request('filter.usuario_id') == $usuario->id || (auth()->user()->id == $usuario->id && !request()->has('filter.usuario_id')) ? 'selected' : '') }}>{{ $usuario->nome }}</option>
                            @endforeach
                        </select>
                    </div>
                    
                    <div class="mt-4 flex justify-center">
                        <button type="submit" class="relative inline-flex items-center px-4 py-2 text-sm font-medium text-gray-700 bg-white border border-gray-300 leading-5 rounded-md hover:text-gray-500 focus:outline-none focus:ring ring-gray-300 focus:border-blue-300 active:bg-gray-100 active:text-gray-700 transition ease-in-out duration-150 dark:bg-gray-800 dark:border-gray-600 dark:text-gray-300 dark:focus:border-blue-700 dark:active:bg-gray-700 dark:active:text-gray-300">
                            Filtrar
                        </button>
                    </div>
                </div>
            </form>
        </div>
        
        
        
        @foreach ($tarefas as $tarefa)
        <div class="block mt-4 py-4 border border-gray-200 rounded-lg">
            <a href="/tarefas/{{ $tarefa->id }}" class="font-bold text-blue-500 text-sm">
                {{ $tarefa->titulo }}
            </a>
            <div>
                <a href="/tarefas/{{ $tarefa->id }}">
                    <strong>Inicio: </strong> {{ \Carbon\Carbon::parse($tarefa->data_inicio)->format('d-m-Y') }} 
                    <strong>Fim: </strong> {{ \Carbon\Carbon::parse($tarefa->data_fim)->format('d-m-Y') }} 
                    <strong>Status: </strong>{{ $tarefa->status }} 
                    <strong>Usuário: </strong>{{ $tarefa->usuario->nome }}
                </a>
            </div>
        </div>
        
        @endforeach
    </div>
    <div class="mt-4">
        {{ $tarefas->links() }}
    </div>
</x-layout>