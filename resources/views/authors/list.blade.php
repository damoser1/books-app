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
                    <h2 class="text-lg md:text-xl lg:text-2xl mb-6">
                        {{ __('Add Author') }}
                    </h2>

                    <form action="{{ route('authors.save') }}" method="POST" class="space-y-6">
                        @csrf

                        {{-- NAME --}}
                        <div>
                            <label for="name" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">
                                {{ __('Name') }}
                            </label>
                            <input
                                type="text"
                                name="name"
                                id="name"
                                value="{{ old('name') }}"
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
                                value="{{ old('email') }}"
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

    {{-- SUCCESS MESSAGE --}}
    @if(session()->has('success'))
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 mt-6">
            <p class="text-lime-600 font-semibold">
                {{ session('success') }}
            </p>
        </div>
    @endif

    {{-- AUTHOR LIST --}}
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <h2 class="text-lg md:text-xl lg:text-2xl mb-6 font-bold">
                        {{ __('Authors') }}
                    </h2>

                    @if($authors->isEmpty())
                        <p class="text-gray-500">No authors found.</p>
                    @else
                        <div class="space-y-4">
                            @foreach($authors as $author)
                                <div class="p-4 bg-white dark:bg-gray-700 rounded-xl shadow border border-gray-100 dark:border-gray-600 flex justify-between items-center">

                                    {{-- LEFT --}}
                                    <div>
                                        <div class="text-xl font-semibold">
                                            {{ $author->name }}
                                        </div>
                                        <div class="text-sm text-gray-500 dark:text-gray-400">
                                            {{ $author->email }}
                                        </div>
                                    </div>

                                    {{-- DELETE --}}
                                    <form action="{{ route('authors.destroy', $author) }}" method="POST">
                                        @csrf
                                        @method('DELETE')

                                        <button type="submit"
                                                class="text-red-500 hover:text-red-700 transition"
                                                onclick="return confirm('Delete this author?')">
                                            <x-trash />
                                        </button>
                                    </form>
                                </div>
                            @endforeach
                        </div>
                    @endif

                </div>
            </div>
        </div>
    </div>
</x-app-layout>
