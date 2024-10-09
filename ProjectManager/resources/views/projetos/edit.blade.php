<x-layout title='Usuários'>
    <x-slot:heading>
        Editando tarefa
    </x-slot:heading>
    <form method="POST" action="/tarefas/{{ $tarefa->id }}"> 
        @csrf
        @method('PATCH')
        <div class="space-y-12">
            <div class="border-b border-gray-900/10 pb-12">
                <h2 class="text-base font-semibold leading-7 text-gray-900">Tarefa</h2>
                <p class="mt-1 text-sm leading-6 text-gray-600">Só mais algumas informações.</p>
  
                <div class="mt-10 grid grid-cols-1 gap-x-6 gap-y-8 sm:grid-cols-6">
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
                        <label for="usuario" class="block text-sm font-medium leading-6 text-gray-900">Usuário</label>
                        <div class="mt-2">
                          <select id="usuario_id" name="usuario_id" autocomplete="usuario-name" class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:max-w-xs sm:text-sm sm:leading-6">
                            @foreach ($usuarios as $usuario)
                                <option value="{{ $usuario->id }}" {{ $usuario->id == $tarefa->usuario_id ? 'selected' : '' }}>{{ $usuario->nome }}</option>
                            @endforeach
                          </select>
                          @error('usuario_id')
                                <span class="text-red-600 text-sm">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="mt-6 flex items-center justify-end gap-x-6">
            <button type="submit" form="deletetarefa" class="rounded-md bg-red-600 px-3 py-2 text-sm font-semibold text-white shadow-sm hover:bg-red-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600">Delete</button>
            <a href='/tarefas' type="button" class="text-sm font-semibold leading-6 text-gray-900">Cancelar</a>
            <button type="submit" class="rounded-md bg-indigo-600 px-3 py-2 text-sm font-semibold text-white shadow-sm hover:bg-indigo-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600">Salvar</button>
        </div>
    </form>
    <form method="POST" id="deletetarefa" name="deletetarefa" action="/tarefas/{{ $tarefa->id }}"> 
        @csrf
        @method('DELETE')
    </form>
</x-layout>
