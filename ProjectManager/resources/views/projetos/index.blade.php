<x-layout title='Projetos'>
    <x-slot:heading>
        <div class="flex justify-between items-center">
            <span>Lista de projetos</span>
            <x-button href="/projetos/create"> Criar projetos</x-button>
        </div>
    </x-slot:heading>
    @if (session('delSuccess'))
        <div class="bg-green-100 border border-green-400 text-green-800 px-4 py-3 rounded relative" role="alert">
            <span class="block sm:inline">{{ session('delSuccess') }}</span>
        </div>
    @endif
    <div class="space-y-4">
        @foreach ($projetos as $projeto)
            <a href="/projetos/{{ $projeto->id }}" class="block mt-4 py-4 border border-gray-200 rounded-lg"> 
                <div class="font-bold text-blue-500 text-sm">  
                    {{ $projeto->titulo }}
                </div>
                <div>
                    <strong>Inicio: </strong> {{ \Carbon\Carbon::parse($projeto->data_inicio)->format('d-m-Y') }} <strong>Fim: </strong> {{ \Carbon\Carbon::parse($projeto->data_fim)->format('d-m-Y') }} <strong>Status: </strong>{{ $projeto->status }}
                </div>
            </a>
        @endforeach
    </div>
    <div class="mt-4">
        {{ $projetos->links() }}
    </div>
</x-layout>