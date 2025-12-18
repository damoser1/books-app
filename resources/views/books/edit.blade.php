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
                    <h2 class="text-lg md:text-xl lg:text-2xl">{{__('Edit Book') }}</h2>

                    @if(session()->has('success'))
                        <div>
                            <p class="text-lime-500 text-lg font-semibold mb-4">{{session('success')}}</p>
                        </div>
                    @endif

                    <form action="{{ route('update', $book->id) }}" method="post" class="space-y-6">
                        @csrf
                        @method('PATCH')

                        <div>
                            <label for="isbn" class="block text-sm font-medium text-gray-700 mb-1">
                                {{ __('ISBN') }}
                            </label>
                            <input
                                value="{{ old('isbn', $book->isbn) }}"
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
                                value="{{ old('title', $book->title) }}"
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
                                value="{{ old('pages', $book->pages) }}"
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
</x-app-layout>
