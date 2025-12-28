<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Books') }}
        </h2>
</x-slot>


    <div class="mt-6 space-y-3">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <h2 class="text-lg md:text-xl lg:text-2xl">{{__('Add Books') }}</h2>

                    <form action="{{ route('save') }}" method="post" class="space-y-6">
                        @csrf

                        <div>
                            <label for="isbn" class="block text-sm font-medium text-gray-700 mb-1">
                                {{ __('ISBN') }}
                            </label>
                            <input
                                value="{{ old('isbn') }}"
                                type="text"
                                name="isbn"
                                id="isbn"
                                class="w-full max-w-md border-gray-300 rounded-md focus:border-indigo-500 focus:ring-indigo-500"
                            >
                            @error('isbn')
                            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        <div>
                            <label for="title" class="block text-sm font-medium text-gray-700 mb-1">
                                {{ __('Title') }}
                            </label>
                            <input
                                value="{{ old('title') }}"
                                type="text"
                                name="title"
                                id="title"
                                class="w-full max-w-md border-gray-300 rounded-md focus:border-indigo-500 focus:ring-indigo-500"
                            >
                            @error('title')
                            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        <div>
                            <label for="pages" class="block text-sm font-medium text-gray-700 mb-1">
                                {{ __('Pages') }}
                            </label>
                            <input
                                value="{{ old('pages') }}"
                                type="number"
                                name="pages"
                                id="pages"
                                class="w-full max-w-md border-gray-300 rounded-md focus:border-indigo-500 focus:ring-indigo-500"
                            >
                            @error('pages')
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

                {{--
                <p>{{$username}}</p>

                <p>Zufallszahlen</p>
                <ul>
                    @foreach($nums as $num)
                        <li>{{$num}}</li>
                    @endforeach
                </ul>
                --}}

                <div class="space-y-4">
                    @foreach($books as $book)
                        <div class="p-4 bg-white dark:bg-gray-700 rounded-xl shadow-lg border border-gray-100 dark:border-gray-600 transition duration-300 hover:shadow-xl hover:border-gray-800 dark:hover:border-indigo-500">

                            {{-- HIER die Änderung --}}
                            <div class="flex justify-between items-start">
                                {{-- Linke Seite --}}
                                <div class="flex flex-col">
                                    <div class="text-xl font-medium text-gray-900 dark:text-gray-100">
                                        {{ $book->title }}
                                        <p class="text-sm text-gray-800">
                                            {{$book->author?->name}}
                                        </p>
                                    </div>

                                    <div class="text-sm text-gray-500 dark:text-gray-400 mt-1">
                                        ISBN:
                                        <span class="font-mono text-gray-700 dark:text-gray-300">
                                            {{ $book->isbn }}
                                        </span>
                                    </div>
                                </div>

                                {{-- ACTIONS --}}
                                <div class="flex items-center gap-3">
                                    {{-- EDIT --}}
                                    <a href="{{ route('edit', $book->id) }}"
                                       class="inline-flex items-center justify-center w-10 h-10 rounded-lg
                                              text-indigo-500 hover:text-indigo-700
                                              hover:bg-indigo-50 dark:hover:bg-gray-600
                                              transition">
                                        <x-pencil />
                                        <span class="sr-only">Edit book</span>
                                    </a>

                                    {{-- DELETE --}}
                                    <form action="{{ route('destroy', $book->id) }}" method="POST" class="m-0">
                                        @csrf
                                        @method('DELETE')

                                        <button type="submit"
                                                class="inline-flex items-center justify-center w-10 h-10 rounded-lg
                                                       text-red-500 hover:text-red-700
                                                       hover:bg-red-50 dark:hover:bg-gray-600
                                                       transition">
                                            <x-trash />
                                            <span class="sr-only">Remove book</span>
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
