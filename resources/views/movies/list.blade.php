<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Movies') }}
        </h2>
    </x-slot>

    <div class="max-w-7xl mx-auto p-2 sm:px-6 lg:px-8 bg-white shadow">
        @if($success = request()->session()->get('success'))
            <div class="w-full block text-left font-bold">
                {{ $success }}
            </div>
        @endif
        @if($movies->isEmpty())
            There are currently no movies to show.
        @else
            <table class="w-full border-collapse mx-auto">
                <thead>
                    <tr>
                        <th class="border border-gray-400 bg-gray-200">Movie</th>
                        <th class="border border-gray-400 bg-gray-200">Controls</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($movies as $movie)
                    <tr>
                        <td class="border border-gray-400 p-2">
                            <a class="underline text-blue-500" href="{{ route('movies.show', [ $movie->id ]) }}">{{ $movie->title }}</a>
                        </td>
                        <td class="border border-gray-400 p-2">
                            <a href="{{route('movies.edit', [ 'movie' => $movie ])}}">
                                <button type="button" class="bg-amber-500 text-white p-2 rounded-md">
                                    <x-icons.pencil class="h-5 w-5"></x-icons.pencil>
                                </button>
                            </a>
                            <form id="delete-{{$movie->id}}" name="delete-{{$movie->id}}" class="inline-block" action="{{route('movies.destroy', ['movie' => $movie])}}" method="POST">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="bg-red-500 text-white p-2 rounded-md">
                                    <x-icons.trash class="h-5 w-5"></x-icons.trash>
                                </button>
                            </form>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        @endif
        <div class="w-full block text-right my-2">
            <a href="{{ route('movies.create') }}">
                <button type="button" class="bg-green-500 text-white p-2 rounded-md">Add</button>
            </a>
        </div>
    </div>
</x-app-layout>
