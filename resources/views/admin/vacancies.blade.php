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
                    <form method="GET" action="{{ route('admin.vacancies') }}">
                        <input type="text" name="search" placeholder="Search vacancies..." value="{{ request()->get('search') }}" class="border p-2 rounded">
                        <button type="submit" class="ml-2 bg-blue-500 text-white p-2 rounded">Search</button>
                    </form>

                    <table class="min-w-full mt-6">
                        <thead>
                            <tr>
                                <th class="py-2 px-4 border-b">ID</th>
                                <th class="py-2 px-4 border-b">Title</th>
                                <th class="py-2 px-4 border-b">Description</th>
                                <th class="py-2 px-4 border-b">Company</th>
                                <th class="py-2 px-4 border-b">Expiry</th>
                                <th class="py-2 px-4 border-b">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($vacancies as $key => $vacancy)
                                <tr>
                                    <td class="py-2 px-4 border-b">{{ $key+1 }}</td>
                                    <td class="py-2 px-4 border-b">{{ $vacancy->title }}</td>
                                    <td class="py-2 px-4 border-b truncate-text">{{ $vacancy->description }}</td>
                                    <td class="py-2 px-4 border-b">{{ $vacancy->user->name ?? 'N/A' }}</td>
                                    <td class="py-2 px-4 border-b">{{ $vacancy->expiry }}</td>
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

                    {{ $vacancies->links() }} <!-- Pagination links -->
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
