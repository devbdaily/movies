<x-app-layout>
    <h1>{{ $movie->title }}</h1>
    <ul>
        <li>Length: {{ $movie->length }}</li>
        <li>Format: {{ $movie->format }}</li>
        <li>Release Date: {{ $movie->release_date->format('Y-m-d') }}</li>
        <li>Rating: {{ $movie->rating }}</li>
    </ul>
</x-app-layout>
