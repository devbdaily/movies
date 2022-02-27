<x-app-layout>
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
