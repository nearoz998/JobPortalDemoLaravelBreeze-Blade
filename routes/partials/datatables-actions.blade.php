<div class="flex space-x-2">
    <a href="{{ route('vacancies.edit', $vacancy->id) }}" class="text-blue-500">Edit</a>
    <form action="{{ route('vacancies.destroy', $vacancy->id) }}" method="POST">
        @csrf
        @method('DELETE')
        <button type="submit" class="text-red-500">Delete</button>
    </form>
</div>
