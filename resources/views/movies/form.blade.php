<x-app-layout>
    <form method="POST" action="{{ $action }}">

        @csrf

        @method($method)

        @isset($success)
            {{ $success }}
        @endisset

        @error('title')
            {{ $message }}
        @enderror
        <label for="title">Title:</label>
        <input id="title" name="title" type="text" maxlength="50" value="{{ isset($movie) ? $movie->title : old('title') }}">

        @error('format')
            {{ $message }}
        @enderror
        <label for="format">Format</label>
        <select id="format" name="format">
            <option value="VHS"{{ isset($movie) && $movie->format == 'VHS' ? ' selected' : '' }}>VHS</option>
            <option value="DVD"{{ isset($movie) && $movie->format == 'DVD' ? ' selected' : '' }}>DVD</option>
            <option value="Streaming"{{ isset($movie) && $movie->format == 'Streaming' ? ' selected' : '' }}>Streaming</option>
        </select>

        @error('length')
            {{ $message }}
        @enderror
        <label for="length">Length</label>
        <input id="length" name="length" type="number" min="1" max="500" value="{{ isset($movie) ? $movie->length : old('length') }}">

        @error('release_date')
            {{ $message }}
        @enderror
        <label for="release_date">Release Date</label>
        <input id="release_date" name="release_date" type="text" value="{{ isset($movie) ? $movie->release_date->format('m/d/Y') : old('release_date') }}">

        @error('rating')
            {{ $message }}
        @enderror
        <label for="rating">Rating</label>
        <input id="rating" name="rating" type="number" min="1" max="5" value="{{ isset($movie) ? $movie->rating : old('rating') }}">

        <button type="submit">Submit</button>
    </form>
</x-app-layout>
