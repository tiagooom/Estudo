<x-layout title='Projeto'>
    <x-slot:heading>
        Criando projeto
    </x-slot:heading>
    <form method="POST" action="/projetos/{{ $projeto->id}}"> 
        @csrf
        @method('PATCH')
        <div class="space-y-12">
            <div class="border-b border-gray-900/10 pb-8">
                <div class="grid grid-cols-1 gap-x-6 gap-y-5 sm:grid-cols-6">
                    <div class="sm:col-span-3">
                        <label for="titulo" class="block text-sm font-medium leading-6 text-gray-900">Título</label>
                        <div class="mt-2">
                            <input type="text" name="titulo" id="titulo" value="{{ $projeto->titulo }}" class="block w-full rounded-md border-0 py-1.5 px-2 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6">
                            @error('titulo')
                                <span class="text-red-600 text-sm">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>
                    <div class="col-span-full">
                        <label for="descricao" class="block text-sm font-medium leading-6 text-gray-900">Descrição</label>
                        <div class="mt-2">
                          <textarea id="descricao" name="descricao" rows="3" class="block w-full rounded-md border-0 py-1.5 px-2 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6">{{ $projeto->descricao }}</textarea>
                          @error('descricao')
                                <span class="text-red-600 text-sm">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>
                    <div class="sm:col-span-3">
                        <label for="data_inicio" class="block text-sm font-medium leading-6 text-gray-900">Início</label>
                        <div class="mt-2">
                            <input type="date" name="data_inicio" id="data_inicio" value="{{ $projeto->data_inicio }}" class="block w-full rounded-md border-0 py-1.5 px-2 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:max-w-xs sm:text-sm sm:leading-6">
                            @error('data_inicio')
                                <span class="text-red-600 text-sm">{{ $message }}</span>
                            @enderror
                        </div>
                        <label for="data_fim" class="block text-sm font-medium mt-2 leading-6 text-gray-900">Fim</label>
                        <div class="mt-2">
                            <input type="date" name="data_fim" id="data_fim" value="{{ $projeto->data_fim }}" class="block w-full rounded-md border-0 py-1.5 px-2 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:max-w-xs sm:text-sm sm:leading-6">
                            @error('data_fim')
                                <span class="text-red-600 text-sm">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>
                    <div class="sm:col-span-3">
                        <label for="status" class="block text-sm font-medium leading-6 text-gray-900">Status</label>
                        <div class="mt-2">
                          <select id="status" name="status" autocomplete="status-name" class="block w-full rounded-md border-0 py-1.5 px-2 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:max-w-xs sm:text-sm sm:leading-6">
                                <option value="Pendente" >Pendente</option>
                                <option value="Em andamento" >Em andamento</option>
                                <option value="Finalizado" >Finalizado</option>
                          </select>
                          @error('status')
                                <span class="text-red-600 text-sm">{{ $message }}</span>
                          @enderror
                    </div>
                </div>
                <div class="sm:col-span-6 flex gap-4">
                    <div class="flex-1">
                        <label class="block text-sm font-medium leading-6 text-gray-900">Adicionar Usuário ao Projeto</label>
                        <div class="flex items-center gap-2 mt-2">
                            <select id="add_user" name="add_user" class="block w-full rounded-md border-0 py-1.5 px-2 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:max-w-xs sm:text-sm sm:leading-6">
                                @foreach($usuarios as $usuario)
                                    @if(!$projeto->usuarios->contains($usuario->id))
                                        <option value="{{ $usuario->id }}">{{ $usuario->nome }}</option>
                                    @endif
                                @endforeach
                            </select>
                            <button type="submit" name="action" value="add_user" class="inline-flex items-center px-4 py-2 border border-transparent text-sm font-medium rounded-md text-white bg-green-600 hover:bg-green-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-green-500">
                                Adicionar
                            </button>
                        </div>
                    </div>
            
                    <div class="flex-1">
                        <label class="block text-sm font-medium leading-6 text-gray-900">Remover Usuário do Projeto</label>
                        <div class="flex items-center gap-2 mt-2">
                            <select id="del_user" name="del_user" class="block w-full rounded-md border-0 py-1.5 px-2 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:max-w-xs sm:text-sm sm:leading-6">
                                @foreach($projeto->usuarios as $usuario)
                                    <option value="{{ $usuario->id }}">{{ $usuario->nome }}</option>
                                @endforeach
                            </select>
                            <button type="submit" name="action" value="del_user" class="inline-flex items-center px-4 py-2 border border-transparent text-sm font-medium rounded-md text-white bg-red-600 hover:bg-red-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-red-500">
                                Remover
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
  
        <div class="mt-6 flex items-center justify-between gap-x-6">
            <div>
                <button type="submit" form="deleteprojeto" class="rounded-md bg-red-600 px-3 py-2 text-sm font-semibold text-white shadow-sm hover:bg-red-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600">Remover projeto</button>
            </div>
            <div>
                <a href='{{ url()->previous() }}' type="button" class="text-sm font-semibold leading-6 text-gray-900">Cancelar</a>
                <button type="submit" class="rounded-md bg-indigo-600 px-3 py-2 text-sm font-semibold text-white shadow-sm hover:bg-indigo-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600">Salvar</button>
            </div>
        </div>
    </form>
    <form method="POST" id="deleteprojeto" name="deleteprojeto" action="/projetos/{{ $projeto->id }}"> 
        @csrf
        @method('DELETE')
    </form>
</x-layout>
