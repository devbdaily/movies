<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ $movie->title }}
        </h2>
    </x-slot>

    <div class="max-w-7xl mx-auto p-2 sm:px-6 lg:px-8 bg-white shadow">
        <ul>
            <li>
                <span class="font-bold">Length:</span>
                {{ $movie->length }}
            </li>
            <li>
                <span class="font-bold">Format:</span>
                {{ $movie->format }}
            </li>
            <li>
                <span class="font-bold">Release Date:</span>
                {{ $movie->release_date->format('Y-m-d') }}
            </li>
            <li>
                <span class="font-bold">Rating:</span>
                {{ $movie->rating }}
            </li>
        </ul>
    </div>
</x-app-layout>
