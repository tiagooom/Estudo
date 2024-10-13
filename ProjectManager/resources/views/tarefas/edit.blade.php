<x-layout title='Tarefa'>
    <x-slot:heading>
        <div class="flex justify-between items-center">
            <span>Editando tarefa</span>
        </div>
    </x-slot:heading>
    <form method="POST" action="/tarefas/{{ $tarefa->id }}"> 
        @csrf
        @method("PATCH")
        <div class="space-y-12">
            <div class="border-b border-gray-900/10 pb-12">
                <div class="grid grid-cols-1 gap-x-6 gap-y-8 sm:grid-cols-6">
                    <div class="sm:col-span-3">
                        <label for="titulo" class="block text-sm font-medium leading-6 text-gray-900">Título</label>
                        <div class="mt-2">
                            <input type="text" name="titulo" id="titulo" value="{{ $tarefa->titulo }}" class="block w-full rounded-md border-0 py-1.5 px-2 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6">
                            @error('titulo')
                                <span class="text-red-600 text-sm">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>
                    <div class="col-span-full">
                        <label for="descricao" class="block text-sm font-medium leading-6 text-gray-900">Descrição</label>
                        <div class="mt-2">
                          <textarea id="descricao" name="descricao" rows="3" class="block w-full rounded-md border-0 py-1.5 px-2 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6">{{ $tarefa->descricao }}</textarea>
                          @error('descricao')
                                <span class="text-red-600 text-sm">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>
                    <div class="sm:col-span-3">
                        <label for="data_inicio" class="block text-sm font-medium leading-6 text-gray-900">Início</label>
                        <div class="mt-2">
                            <input type="date" name="data_inicio" id="data_inicio" value="{{ $tarefa->data_inicio }}" class="block w-full rounded-md border-0 py-1.5 px-2 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:max-w-xs sm:text-sm sm:leading-6">
                            @error('data_inicio')
                                <span class="text-red-600 text-sm">{{ $message }}</span>
                            @enderror
                        </div>
                        <label for="data_fim" class="block text-sm font-medium mt-2 leading-6 text-gray-900">Fim</label>
                        <div class="mt-2">
                            <input type="date" name="data_fim" id="data_fim" value="{{ $tarefa->data_fim }}" class="block w-full rounded-md border-0 py-1.5 px-2 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:max-w-xs sm:text-sm sm:leading-6">
                            @error('data_fim')
                                <span class="text-red-600 text-sm">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>
                    <div class="sm:col-span-3">
                        <label for="status" class="block text-sm font-medium leading-6 text-gray-900">Status</label>
                        <div class="mt-2">
                          <select id="status" name="status" autocomplete="status-name" class="block w-full rounded-md border-0 py-1.5 px-2 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:max-w-xs sm:text-sm sm:leading-6">
                                <option value="Pendente" {{ $tarefa->status == 'Pendente' ? 'selected' : '' }}>Pendente</option>
                                <option value="Em andamento" {{ $tarefa->status == 'Em andamento' ? 'selected' : '' }}>Em andamento</option>
                                <option value="Finalizado" {{ $tarefa->status == 'Finalizado' ? 'selected' : '' }}>Finalizado</option>
                          </select>
                          @error('status')
                                <span class="text-red-600 text-sm">{{ $message }}</span>
                          @enderror
                    </div>
                    <div class="sm:col-span-3">
                        <label for="usuario" class="block text-sm font-medium mt-4 leading-6 text-gray-900">Usuário Responsável</label>
                        <div class="mt-2">
                          <select id="usuario_id" name="usuario_id" autocomplete="usuario-name" class="block w-full rounded-md border-0 py-1.5 px-2 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:max-w-xs sm:text-sm sm:leading-6">
                            @foreach ($usuarios as $usuario)
                                <option value="{{ $usuario->id }}" {{ $usuario->id == $tarefa->usuario_id ? 'selected' : '' }}>{{ $usuario->nome }}</option>
                            @endforeach
                          </select>
                          @error('usuario_id')
                                <span class="text-red-600 text-sm">{{ $message }}</span>
                          @enderror
                        </div>
                        <input type="hidden" name="projeto_id" id="projeto_id" value="{{ $tarefa->projeto_id }}">
                    </div>
                </div>
            </div>
        </div>
  
        <div class="mt-6 flex items-center justify-end gap-x-6">
            <a href='/tarefas' type="button" class="text-sm font-semibold leading-6 text-gray-900">Cancelar</a>
            <button type="submit" class="rounded-md bg-indigo-600 px-3 py-2 text-sm font-semibold text-white shadow-sm hover:bg-indigo-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600">Salvar</button>
        </div>
    </form>
</x-layout>
