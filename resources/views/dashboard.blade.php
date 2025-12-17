<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">

            <!-- Begrüßung -->
            <div class="bg-white dark:bg-gray-800 p-6 rounded-lg shadow">
                <h3 class="text-2xl font-bold mb-1">
                    {{ __('Welcome') }} {{ Auth::user()->name }}!
                </h3>
                <p class="text-gray-600 dark:text-gray-300">
                    {{ __('Here you can manage users, books and authors.') }}
                </p>
            </div>

            <!-- Statistik-Kacheln -->
            <div class="grid grid-cols-1 md:grid-cols-3 gap-6">

                <!-- Benutzer -->
                <div class="bg-white dark:bg-gray-800 p-6 rounded-lg shadow">
                    <p class="text-sm text-gray-500">{{ __('Total users') }}</p>
                    <p class="text-3xl font-bold mt-2">
                        {{ $usersCount ?? 0 }}
                    </p>
                </div>

                <!-- Bücher -->
                <div class="bg-white dark:bg-gray-800 p-6 rounded-lg shadow">
                    <p class="text-sm text-gray-500">{{ __('Total books') }}</p>
                    <p class="text-3xl font-bold mt-2">
                        {{ $booksCount ?? 0 }}
                    </p>
                </div>

                <!-- Autoren -->
                <div class="bg-white dark:bg-gray-800 p-6 rounded-lg shadow">
                    <p class="text-sm text-gray-500">{{ __('Total authors') }}</p>
                    <p class="text-3xl font-bold mt-2">
                        {{ $authorsCount ?? 0 }}
                    </p>
                </div>

            </div>

        </div>
    </div>
</x-app-layout>
