<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Edit Vacancy') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <form method="POST" action="{{ route('vacancies.update', $vacancy) }}">
                        @csrf
                        @method('PUT')

                        <!-- Title -->
                        <div>
                            <x-input-label for="title" :value="__('Title')" />
                            <x-text-input id="title" class="block mt-1 w-full" type="text" name="title" :value="old('title', $vacancy->title)" required autofocus />
                            <x-input-error :messages="$errors->get('title')" class="mt-2" />
                        </div>

                        <!-- Description -->
                        <div class="mt-4">
                            <x-input-label for="description" :value="__('Description')" />
                            <x-text-input id="description" class="block mt-1 w-full" type="text" name="description" :value="old('description', $vacancy->description)" required />
                            <x-input-error :messages="$errors->get('description')" class="mt-2" />
                        </div>

                        <!-- Details -->
                        <div class="mt-4">
                            <x-input-label for="details" :value="__('Details')" />
                            <textarea id="details" class="block mt-1 w-full" name="details" required>{{ old('details', $vacancy->details) }}</textarea>
                            <x-input-error :messages="$errors->get('details')" class="mt-2" />
                        </div>

                        <!-- Expiry -->
                        <div class="mt-4">
                            <x-input-label for="expiry" :value="__('Expiry')" />
                            <x-text-input id="expiry" class="block mt-1 w-full" type="date" name="expiry" :value="old('expiry', $vacancy->expiry)" required />
                            <x-input-error :messages="$errors->get('expiry')" class="mt-2" />
                        </div>

                        <!-- Submit Button -->
                        <div class="flex items-center justify-end mt-4">
                            <x-primary-button>
                                {{ __('Update') }}
                            </x-primary-button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
