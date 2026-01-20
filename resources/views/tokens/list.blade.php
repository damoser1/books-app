<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Tokens') }}
        </h2>
    </x-slot>


    <div class="mt-6 space-y-3">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <h2 class="text-lg md:text-xl lg:text-2xl">{{__('Add Tokens') }}</h2>

                    <form action="{{ route('tokens.save') }}" method="post" class="space-y-6">
                        @csrf

                        <div>
                            <label for="Token" class="block text-sm font-medium text-gray-700 mb-1">
                                {{ __('Token') }}
                            </label>
                            <input
                                value="{{ old('name') }}"
                                type="text"
                                name="name"
                                id="name"
                                class="w-full max-w-md border-gray-300 rounded-md focus:border-indigo-500 focus:ring-indigo-500"
                            >
                            @error('isbn')
                            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                            @enderror
                        </div>
                        <div>
                            <x-primary-button class="px-5 py-2">
                                {{ __('Save') }}
                            </x-primary-button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>


    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <div>
                        @if(session()->has('success'))
                            <div>
                                <p class="text-lime-500 text-lg font-semibold mb-4">{{session('success')}}</p>
                            </div>
                        @endif
                    </div>
                    <h2 class="text-lg md:text-xl lg:text-2xl ml-2 mb-6">{{__('List') }}</h2>
                    <div class="space-y-4">
                        @foreach($tokens as $token)
                            <div class="p-4 bg-white dark:bg-gray-700 rounded-xl shadow-lg border border-gray-100 dark:border-gray-600 transition duration-300 hover:shadow-xl hover:border-gray-800 dark:hover:border-indigo-500">

                                {{-- HIER die Änderung --}}
                                <div class="flex justify-between items-start">
                                    {{-- Linke Seite --}}
                                    <div class="flex flex-col">
                                        <div class="text-xl font-medium text-gray-900 dark:text-gray-100">
                                            {{ $token->name }}
                                        </div>
                                    </div>

                                    {{-- ACTIONS --}}
                                    <div class="flex items-center gap-3">
                                        {{-- DELETE --}}
                                        <form action="{{ route('tokens.destroy', $book->id) }}" method="POST" class="m-0">
                                            @csrf
                                            @method('DELETE')

                                            <button type="submit"
                                                    class="inline-flex items-center justify-center w-10 h-10 rounded-lg
                                                       text-red-500 hover:text-red-700
                                                       hover:bg-red-50 dark:hover:bg-gray-600
                                                       transition">
                                                <x-trash />
                                                <span class="sr-only">Remove Token</span>
                                            </button>
                                        </form>
                                    </div>

                                </div>
                            </div>
                        @endforeach
                    </div>

                </div>
            </div>
        </div>
    </div>
</x-app-layout>
