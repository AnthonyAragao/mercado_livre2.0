<x-app-layout>
    {{-- {{dd(Auth::user()->produtor[0]->produtor_has_produto[0])}} --}}
    <x-slot name="header">
        @if (Auth::user()->usuario->first() !== null)
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            <a href="{{route('usuarios.show', [Crypt::encrypt(Auth::user()->usuario->first()->id)]) }}">usuario</a>
        </h2>
        @else
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            <a href="{{route('produtor.show', [Crypt::encrypt(Auth::user()->produtor->first()->id)]) }}  ">produtor</a>
        </h2>

        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            <a href="{{route('produto.create')}}">criar produto</a>
        </h2>
        @endif

    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    {{ __("You're logged in!") }}
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
