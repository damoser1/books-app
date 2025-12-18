<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Authors') }}
        </h2>
    </x-slot>

    {{-- ADD AUTHOR --}}
    <div class="mt-6 space-y-3">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <h2 class="text-lg md:text-xl lg:text-2xl">{{ __('Edit Author') }}</h2>

                    @if(session()->has('success'))
                        <div>
                            <p class="text-lime-500 text-lg font-semibold mb-4">{{session('success')}}</p>
                        </div>
                    @endif

                    <form action="{{ route('authors.update', $author->id) }}" method="post" class="space-y-6">
                        @csrf
                        @method('PATCH')

                        {{-- NAME --}}
                        <div>
                            <label for="name" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">
                                {{ __('Name') }}
                            </label>
                            <input
                                type="text"
                                name="name"
                                id="name"
                                value="{{ old('name', $author->name) }}"
                                class="w-full max-w-md border-gray-300 rounded-md focus:border-indigo-500 focus:ring-indigo-500"
                            >
                            @error('name')
                            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        {{-- EMAIL --}}
                        <div>
                            <label for="email" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">
                                {{ __('Email') }}
                            </label>
                            <input
                                type="email"
                                name="email"
                                id="email"
                                value="{{ old('email', $author->email) }}"
                                class="w-full max-w-md border-gray-300 rounded-md focus:border-indigo-500 focus:ring-indigo-500"
                            >
                            @error('email')
                            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        <x-primary-button class="px-5 py-2">
                            {{ __('Save') }}
                        </x-primary-button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
