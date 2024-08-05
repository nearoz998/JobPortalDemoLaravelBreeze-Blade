<!-- resources/views/user/dashboard.blade.php -->

<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Vacancies') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <!-- Search Form -->
                    <form method="GET" action="{{ route('dashboard') }}" class="mb-4">
                        <div class="flex items-center">
                            <x-text-input 
                                id="search" 
                                name="search" 
                                class="block mt-1 w-full"
                                type="text" 
                                :value="request('search')" 
                                placeholder="Search vacancies..."
                            />
                            <x-primary-button class="ml-4">
                                {{ __('Search') }}
                            </x-primary-button>
                        </div>
                    </form>

                    <!-- Grid Layout for Vacancies -->
                    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
                        @forelse($vacancies as $vacancy)
                            <div class="bg-white p-4 rounded-lg shadow-md">
                                <h3 class="text-lg font-semibold">{{ $vacancy->title }}</h3>
                                <p class="mt-2 text-gray-600">{{ $vacancy->description }}</p>
                                <p class="mt-2 text-gray-600">Company: {{ $vacancy->user->name }}</p>
                                <p class="mt-2 text-gray-600">Company Address: {{ $vacancy->user->company->address }}</p>
                                <p class="mt-2 text-gray-600">Expiry Date: {{ $vacancy->expiry }}</p>
                                <a href="{{ route('vacancies.show', $vacancy) }}" class="mt-4 inline-block text-blue-600 hover:text-blue-800">
                                    View
                                </a>
                            </div>
                        @empty
                            <p class="col-span-1 text-gray-600">No vacancies available at the moment.</p>
                        @endforelse
                    </div>

                    <!-- Pagination Controls -->
                    <div class="mt-4">
                        {{ $vacancies->appends(['search' => request('search')])->links('pagination::tailwind') }}
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
