<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Users') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <form method="GET" action="{{ route('admin.users') }}">
                        <input type="text" name="search" placeholder="Search users..." value="{{ request()->get('search') }}" class="border p-2 rounded">
                        <button type="submit" class="ml-2 bg-blue-500 text-white p-2 rounded">Search</button>
                    </form>

                    <table class="min-w-full mt-6">
                        <thead>
                            <tr>
                                <th class="py-2 px-4 border-b">SN</th>
                                <th class="py-2 px-4 border-b">Name</th>
                                <th class="py-2 px-4 border-b">Email</th>
                                <th class="py-2 px-4 border-b">Role</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($users as $key => $user)
                                <tr>
                                    <td class="py-2 px-4 border-b">{{ $key+1 }}</td>
                                    <td class="py-2 px-4 border-b">{{ $user->name }}</td>
                                    <td class="py-2 px-4 border-b">{{ $user->email }}</td>
                                    <td class="py-2 px-4 border-b">{{ $user->role ?? 'N/A' }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>

                    {{ $users->links() }} <!-- Pagination links -->
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
