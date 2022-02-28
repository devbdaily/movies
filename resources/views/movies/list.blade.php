<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Movies') }}
        </h2>
    </x-slot>

    @if($movies->isEmpty())
        There are currently no movies to show.
    @else
        <ul>
            @foreach ($movies as $movie)
                <li>
                    <a href="{{ route('movies.show', [ 'movie' => $movie->id ]) }}">{{ $movie->title }}</a>
                </li>
            @endforeach
        </ul>
    @endif
</x-app-layout>
