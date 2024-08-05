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
                    <a href="{{ route('vacancies.create') }}" class="btn btn-primary mb-4">Add New Vacancy</a>
                    <table id="vacancies-table" class="table table-striped table-bordered" style="width:100%">
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
                            @foreach ($vacancies as $vacancy)
                                <tr>
                                    <td></td>
                                    <td>{{ $vacancy->title }}</td>
                                    <td>{{ $vacancy->description }}</td>
                                    <td>{{ $vacancy->details }}</td>
                                    <td>{{ $vacancy->expiry }}</td>
                                    <td>
                                        <a href="{{ route('vacancies.show', $vacancy) }}" class="text-blue-600 hover:text-blue-800"><i class="fa fa-eye"></i></a>
                                        <a href="{{ route('vacancies.edit', $vacancy) }}" class="text-blue-600 hover:text-blue-800"><i class="fa fa-edit"></i></a>
                                        <form action="{{ route('vacancies.destroy', $vacancy) }}" method="POST" style="display:inline;">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="text-red-600 hover:text-red-800"><i class="fa fa-trash"></i></button>
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>

{{-- <script>
    document.addEventListener('DOMContentLoaded', function() {
        let table = $('#vacancies-table').DataTable({
            "columnDefs": [{
                "searchable": false,
                "orderable": false,
                "targets": 0
            }],
            "order": []
        });

        table.on('draw.dt', function() {
            var PageInfo = table.page.info();
            table.column(0, {
                page: 'current'
            }).nodes().each(function(cell, i) {
                cell.innerHTML = i + 1 + PageInfo.start;
            });
        }).draw();
    });
</script> --}}
