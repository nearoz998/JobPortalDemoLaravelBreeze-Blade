<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Vacancy Details') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    <div class="max-w-2xl mx-auto bg-white rounded-xl shadow-md overflow-hidden">
                        <div class="p-4">
                            <h3 class="text-2xl font-bold text-gray-900 mb-2">{{ $vacancy->title }}</h3>
                            <div class="mb-4">
                                <span class="text-gray-700 font-semibold">{{ __('Description') }}:</span>
                                <p class="text-gray-600 mt-1">{{ $vacancy->description }}</p>
                            </div>
                            <div class="mb-4 relative">
                                <span class="text-gray-700 font-semibold">{{ __('Details') }}:</span>
                                <p class="text-gray-600 mt-1 details-text">
                                    {{ $vacancy->details }}
                                </p>
                                <button class="absolute right-0 bottom-0 mt-2 mr-2 text-blue-600 hover:text-blue-800 read-more-btn">
                                    Read More
                                </button>
                            </div>
                            <div class="mb-4">
                                <span class="text-gray-700 font-semibold">{{ __('Expiry') }}:</span>
                                <p class="text-gray-600 mt-1">{{ $vacancy->expiry }}</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <style>
        .details-text {
            max-height: 100px; /* Set this to the desired initial height */
            overflow: hidden;
            position: relative;
            transition: max-height 0.3s ease;
        }
        
        .details-text.expanded {
            max-height: none;
        }

        .read-more-btn {
            display: none;
        }

        .details-text.expanded + .read-more-btn {
            display: block;
        }
    </style>

    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const detailsText = document.querySelector('.details-text');
            const readMoreBtn = document.querySelector('.read-more-btn');

            if (detailsText.scrollHeight > detailsText.clientHeight) {
                readMoreBtn.style.display = 'block';
                readMoreBtn.addEventListener('click', function () {
                    detailsText.classList.toggle('expanded');
                    this.textContent = detailsText.classList.contains('expanded') ? 'Read Less' : 'Read More';
                });
            }
        });
    </script>
</x-app-layout>
