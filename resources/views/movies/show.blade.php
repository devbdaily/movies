<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ $movie->title }}
        </h2>
    </x-slot>

    <ul>
        <li>Length: {{ $movie->length }}</li>
        <li>Format: {{ $movie->format }}</li>
        <li>Release Date: {{ $movie->release_date->format('Y-m-d') }}</li>
        <li>Rating: {{ $movie->rating }}</li>
    </ul>
</x-app-layout>
