<x-layout title='Usuários'>
    <x-slot:heading>
        Criando Usuario
    </x-slot:heading>
    <form method="POST" action="/usuarios/{{ $usuario->id }}"> 
        @csrf
        @method('PATCH')
        <div class="space-y-12">
            <div class="border-b border-gray-900/10 pb-12">
                <h2 class="text-base font-semibold leading-7 text-gray-900">Perfil</h2>
                <p class="mt-1 text-sm leading-6 text-gray-600">Só mais algumas informações.</p>
  
                <div class="mt-10 grid grid-cols-1 gap-x-6 gap-y-8 sm:grid-cols-6">
                    <div class="sm:col-span-3">
                        <label for="nome" class="block text-sm font-medium leading-6 text-gray-900">Nome</label>
                        <div class="mt-2">
                            <input type="text" name="nome" id="nome" value="{{ $usuario->nome }}" class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6" required>
                        </div>
                        @error('nome')
                            <span class="text-red-600 text-sm">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="sm:col-span-3">
                        <label for="email" class="block text-sm font-medium leading-6 text-gray-900">Email</label>
                        <div class="mt-2">
                            <input type="text" name="email" id="email" autocomplete="given-name" value="{{ $usuario->email }}" class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6" required>
                            @error('email')
                                <span class="text-red-600 text-sm">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>
                </div>
            </div>
        </div>
  
        <div class="mt-6 flex items-center justify-end gap-x-6">
            <button type="submit" form="deleteusuario" class="rounded-md bg-red-600 px-3 py-2 text-sm font-semibold text-white shadow-sm hover:bg-red-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600">Delete</button>
            <a href='/usuarios' type="button" class="text-sm font-semibold leading-6 text-gray-900">Cancelar</a>
            <button type="submit" class="rounded-md bg-indigo-600 px-3 py-2 text-sm font-semibold text-white shadow-sm hover:bg-indigo-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600">Salvar</button>
        </div>
    </form>
    <form method="POST" id="deleteusuario" name="deleteusuario" action="/usuarios/{{ $usuario->id }}"> 
        @csrf
        @method('DELETE')
    </form>
</x-layout>
