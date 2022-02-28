<?php

namespace Tests\Feature\Http\Controllers;

use App\Models\Movie;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Str;
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
        $input = array_merge(
            $movie->toArray(),
            [
                'release_date' => $movie->release_date->format('m/d/Y'),
            ]
        );

        $response = $this->post('movies', $input);

        $response->assertRedirect('movies/create');
        $response->assertSessionHas('success', 'Movie Created!');
        $this->assertDatabaseHas('movies', $movie->toArray());
    }

    /**
     * @test
     * @dataProvider inputValidationDataProvider
     *
     * @return void
     */
    public function store_validates_inputs(array $input, array $errors): void
    {
        $movie = Movie::factory()->make();
        $data = array_merge(
            $movie->toArray(),
            $input,
        );

        $response = $this->post('movies', $data);
        $response->assertSessionHasErrors($errors);
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

        $new = array_merge($movie->toArray(), [
            'title' => 'New Title',
        ]);

        $input = array_merge(
            $new,
            [
                'release_date' => $movie->release_date->format('m/d/Y'),
            ]
        );

        $response = $this->put("movies/{$movie->id}", $input);

        $response->assertRedirect("movies/{$movie->id}/edit");
        $response->assertSessionHas('success', 'Movie Updated!');

        $this->assertDatabaseMissing('movies', $old);
        $this->assertDatabaseHas('movies', $new);
    }

    /**
     * @test
     * @dataProvider inputValidationDataProvider
     *
     * @return void
     */
    public function update_validates_inputs(array $input, array $errors): void
    {
        $movie = Movie::factory()->create();
        $movie->refresh();
        $data = array_merge(
            $movie->toArray(),
            $input,
        );

        $response = $this->put("movies/{$movie->id}", $data);
        $response->assertSessionHasErrors($errors);
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

    /**
     * Data provider for testing input validation for store/update routes.
     *
     * @return array
     */
    public function inputValidationDataProvider(): array
    {
        return [
            'null on required inputs' => [
                [
                    'title' => null,
                    'format' => null,
                    'length' => null,
                    'release_date' => null,
                    'rating' => null,
                ],
                [
                    'title',
                    'format',
                    'length',
                    'release_date',
                    'rating',
                ],
            ],
            'title must be <= 50 characters' => [
                [
                    'title' => Str::random(51)
                ],
                [
                    'title',
                ],
            ],
            'format is an invalid value' => [
                [
                    'format' => 'betamax',
                ],
                [
                    'format',
                ],
            ],
            'length is not an integer' => [
                [
                    'length' => 'forever',
                ],
                [
                    'length',
                ]
            ],
            'length is too long' => [
                [
                    'length' => 505,
                ],
                [
                    'length',
                ],
            ],
            'release_date is in the correct format' => [
                [
                    'release_date' => '1993-06-11',
                ],
                [
                    'release_date',
                ],
            ],
            'release_date must be after 1800-01-01' => [
                [
                    'release_date' => '01/01/1701',
                ],
                [
                    'release_date'
                ],
            ],
            'release_date must be before 2100-01-01' => [
                [
                    'release_date' => '02/03/2102',
                ],
                [
                    'release_date',
                ],
            ],
            'rating must be an integer' => [
                [
                    'rating' => 'bad',
                ],
                [
                    'rating',
                ],
            ],
            'rating must be >= 1' => [
                [
                    'rating' => 0,
                ],
                [
                    'rating',
                ],
            ],
            'rating must be <=5' => [
                [
                    'rating' => 10,
                ],
                [
                    'rating',
                ],
            ],
        ];
    }
}
