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
                    <!-- Filtro de Status -->
                    <div class="col-span-1">
                        <label for="status" class="block text-sm font-medium text-gray-700">Status</label>
                        <select id="status" name="status" class="mt-1  w-full rounded-lg border-gray-300 bg-gray-50 shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                            <option value="">Todos</option>
                            <option value="Pendente" {{ request('status') == 'Pendente' ? 'selected' : '' }}>Pendente</option>
                            <option value="Em andamento" {{ request('status') == 'Em andamento' ? 'selected' : '' }}>Em andamento</option>
                            <option value="Finalizado" {{ request('status') == 'Finalizado' ? 'selected' : '' }}>Finalizado</option>
                        </select>
                    </div>
            
                    <!-- Filtro de Data de Início -->
                    <div class="col-span-1">
                        <label for="start_date" class="block text-sm font-medium text-gray-700">Data de Início</label>
                        <input type="date" id="start_date" name="start_date" value="{{ request('start_date') }}" class="mt-1 block w-full rounded-lg border-gray-300 bg-gray-50 shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                    </div>
            
                    <!-- Filtro de Data de Fim -->
                    <div class="col-span-1">
                        <label for="end_date" class="block text-sm font-medium text-gray-700">Data de Fim</label>
                        <input type="date" id="end_date" name="end_date" value="{{ request('end_date') }}" class="mt-1 block w-full rounded-lg border-gray-300 bg-gray-50 shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                    </div>

                    <div class="col-span-1">
                        <label for="status" class="block text-sm font-medium text-gray-700">Usuário</label>
                        <select id="status" name="status" class="mt-1 block w-full rounded-lg border-gray-300 bg-gray-50 shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                            <option value="">Todos</option>
                            @foreach ($usuarios as $usuario)
                                <option value="{{ $usuario->id }}" {{ $usuario->id == auth()->user()->id ? 'selected' : '' }}>{{ $usuario->nome }}</option>
                            @endforeach
                        </select>
                    </div>
                    
                    <!-- Botão de Filtro -->
                    <div class="col-span-1 flex items-end">
                        <x-button type="submit">Filtrar</x-button>
                    </div>
                </div>
            </form>
        </div>
        
        
        
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