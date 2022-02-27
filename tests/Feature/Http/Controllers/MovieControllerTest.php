<?php

namespace Tests\Feature\Http\Controllers;

use App\Models\Movie;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class MovieControllerTest extends TestCase
{
    use RefreshDatabase;

    /**
     * @test
     *
     * @return void
     */
    public function index_provides_list_view(): void
    {
        Movie::factory()
            ->count(3)
            ->create();

        $movies = Movie::all();

        $response = $this->get('movies');

        $response->assertSuccessful();
        $response->assertViewIs('movies.list');
        $response->assertViewHas('movies', $movies);
    }

    /**
     * @test
     *
     * @return void
     */
    public function index_view_shows_message_if_no_movies(): void
    {
        $response = $this->get('movies');

        $response->assertSuccessful();
        $response->assertViewIs('movies.list');
        $response->assertSee('There are currently no movies to show.');
    }

    /**
     * @test
     *
     * @return void
     */
    public function create_shows_form_view(): void
    {
        $response = $this->get('movies/create');

        $response->assertSuccessful();
        $response->assertViewIs('movies.form');
    }

    /**
     * @test
     *
     * @return void
     */
    public function store_creates_new_movie_record()
    {
        $movie = Movie::factory()->make();
        $data = $movie->toArray();

        $response = $this->post('movies', $data);

        $response->assertCreated();
        $response->assertSessionHas('success', 'Movie Created!');

        $this->assertDatabaseHas('movies', $data);
    }

    /**
     * @test
     *
     * @return void
     */
    public function show_provides_show_view(): void
    {
        $movie = Movie::factory()->create();
        $movie->refresh();

        $response = $this->get("movies/{$movie->id}");

        $response->assertSuccessful();
        $response->assertViewIs('movies.show');
        $response->assertViewHas('movie', $movie);
    }

    /**
     * @test
     *
     * @return void
     */
    public function edit_shows_form_view(): void
    {
        $movie = Movie::factory()->create();
        $movie->refresh();

        $response = $this->get("movies/{$movie->id}/edit");

        $response->assertSuccessful();
        $response->assertViewIs('movies.form');
        $response->assertViewHas('movie', $movie);
    }

    /**
     * @test
     *
     * @return void
     */
    public function update_changes_data_on_movie_record(): void
    {
        $movie = Movie::factory()->create();
        $movie->refresh();
        $old = $movie->toArray();

        $data = array_merge($movie->toArray(), [
            'title' => 'New Title',
        ]);

        $response = $this->put("movies/{$movie->id}", $data);

        $response->assertSuccessful();

        $this->assertDatabaseMissing('movies', $old);
        $this->assertDatabaseHas('movies', $data);
    }

    /**
     * @test
     *
     * @return void
     */
    public function destroy_deletes_movie_record(): void
    {
        $movie = Movie::factory()->create();
        $movie->refresh();

        $response = $this->delete("movies/{$movie->id}");

        $response->assertSuccessful();

        $this->assertDatabaseMissing('movies', $movie->toArray());
    }
}
