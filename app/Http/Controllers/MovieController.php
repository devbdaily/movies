<?php

namespace App\Http\Controllers;

use App\Http\Requests\MovieRequest;
use App\Models\Movie;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class MovieController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $movies = Movie::all();

        return response()->view('movies.list', [
            'movies' => $movies,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        return response()->view('movies.form', [
            'method' => 'POST',
            'action' => route('movies.store'),
            'success' => $request->session()->get('success'),
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\MovieRequest
     * @return \Illuminate\Http\Response
     */
    public function store(MovieRequest $request)
    {
        $input = $request->validated();
        $movie = Movie::query()->create($input);

        Session::flash('success', 'Movie Created!');

        return response()->redirectToRoute('movies.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Movie  $movie
     * @return \Illuminate\Http\Response
     */
    public function show(Movie $movie)
    {
        return response()->view('movies.show', ['movie' => $movie]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Movie  $movie
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function edit(Movie $movie, Request $request)
    {
        return response()->view('movies.form', [
            'movie' => $movie,
            'method' => 'PUT',
            'action' => route('movies.update', ['movie' => $movie]),
            'success' => $request->session()->get('success'),
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\MovieRequest  $request
     * @param  \App\Models\Movie  $movie
     * @return \Illuminate\Http\Response
     */
    public function update(MovieRequest $request, Movie $movie)
    {
        $input = $request->validated();
        $movie->update($input);

        Session::flash('success', 'Movie Updated!');

        return response()->redirectToRoute('movies.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Movie  $movie
     * @return \Illuminate\Http\Response
     */
    public function destroy(Movie $movie)
    {
        $movie->delete();

        Session::flash('success', 'Movie deleted!');

        return response()->redirectToRoute('movies.index');
    }
}
