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
                    <!-- Add New Vacancy Button -->
                    <a href="{{ route('vacancies.create') }}" class="btn btn-primary mb-4">Add New Vacancy</a>

                    <!-- Search Form -->
                    <form method="GET" action="{{ route('dashboard') }}" class="mb-4">
                        <input type="text" name="search" placeholder="Search vacancies..." value="{{ request()->get('search') }}" class="border p-2 rounded">
                        <button type="submit" class="btn btn-primary rounded ml-2">Search</button>
                    </form>

                    <!-- Table -->
                    <table id="vacancies-table" class="table table-striped table-bordered mt-2">
                        <thead>
                            <tr>
                                <th>{{ __('Index') }}</th>
                                <th>{{ __('Title') }}</th>
                                <th>{{ __('Description') }}</th>
                                <th>{{ __('Details') }}</th>
                                <th>{{ __('Expiry') }}</th>
                                <th>{{ __('Actions') }}</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($vacancies as $key => $vacancy)
                                <tr>
                                    <td>{{ $key + 1 }}</td>
                                    <td>{{ $vacancy->title }}</td>
                                    <td class="truncate-text">{{ $vacancy->description }}</td>
                                    <td class="truncate-text">{{ $vacancy->details }}</td>
                                    <td>{{ $vacancy->expiry }}</td>
                                    <td>
                                        <a href="{{ route('vacancies.show', $vacancy) }}" class="btn btn-info btn-sm"><i class="fa fa-eye"></i> View</a>
                                        <a href="{{ route('vacancies.edit', $vacancy) }}" class="btn btn-warning btn-sm"><i class="fa fa-edit"></i> Edit</a>
                                        <form action="{{ route('vacancies.destroy', $vacancy) }}" method="POST" style="display:inline;">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-danger btn-sm"><i class="fa fa-trash"></i> Delete</button>
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>

                    <!-- Pagination Controls -->
                    <div class="mt-4">
                        {{ $vacancies->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
