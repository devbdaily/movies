<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Movies') }}
        </h2>
    </x-slot>

    <div class="max-w-7xl mx-auto p-2 sm:px-6 lg:px-8 bg-white shadow">
        <form method="POST" action="{{ $action }}">

            @csrf

            @method($method)


            <div>
                <x-label for="title" :value="__('Title')" />
                @error('title')
                    <span class="text-red-500">{{ $message }}</span>
                @enderror
                <x-input id="title" name="title" class="block mt-1 w-full" type="text" :value="isset($movie) ? $movie->title : old('title')" required autofocus />
            </div>

            <div>
                <x-label for="format" :value="__('Format')" />
                @error('format')
                    <span class="text-red-500">{{ $message }}</span>
                @enderror
                <select id="format" name="format" class="rounded-md shadow-sm border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 block mt-1 w-full" required>
                    <option value="VHS"{{ isset($movie) && $movie->format == 'VHS' ? ' selected' : '' }}>VHS</option>
                    <option value="DVD"{{ isset($movie) && $movie->format == 'DVD' ? ' selected' : '' }}>DVD</option>
                    <option value="Streaming"{{ isset($movie) && $movie->format == 'Streaming' ? ' selected' : '' }}>Streaming</option>
                </select>
            </div>

            <div>
                <x-label for="length" :value="__('Length')" />
                @error('length')
                    <span class="text-red-500">{{ $message }}</span>
                @enderror
                <x-input id="length" name="length" class="block mt-1 w-full" type="number" min="1" max="500" :value="isset($movie) ? $movie->length : old('length')" placeholder="movie run time in minutes" required />
            </div>

            <div>
                <x-label for="release_date" :value="__('Release Date')" />
                @error('release_date')
                    <span class="text-red-500">{{ $message }}</span>
                @enderror
                <x-input id="release_date" name="release_date" class="block mt-1 w-full" type="text" :value="isset($movie) ? $movie->release_date->format('m/d/Y') : old('release_date')" placeholder="mm/dd/yyyy" required />
            </div>

            <div>
                <x-label for="rating" :value="__('Rating')" />
                @error('rating')
                    <span class="text-red-500">{{ $message }}</span>
                @enderror
                <x-input id="rating" name="rating" class="block mt-1 w-full" type="number" min="1" max="5" :value="isset($movie) ? $movie->rating : old('rating')" placeholder="1-5" />
            </div>

            <button type="submit" class="rounded-md bg-green-500 text-white p-2 m-2">Submit</button>
        </form>
    </div>
</x-app-layout>
