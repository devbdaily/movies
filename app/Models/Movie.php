<?php

namespace App\Models;

use Carbon\Carbon;
use DateTimeInterface;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Movie extends Model
{
    use HasFactory;

    /**
     * The allowed format values.
     *
     * @var array
     */
    const ALLOWED_FORMATS = [
        'VHS',
        'DVD',
        'Streaming',
    ];

    /**
     * The fillable attributes on the model.
     *
     * @var array
     */
    protected $fillable = [
        'title',
        'format',
        'length',
        'release_date',
        'rating',
    ];

    /**
     * Attribute cast definitions.
     *
     * @var array
     */
    protected $casts = [
        'release_date' => 'datetime:Y-m-d H:i:s',
        'created_at' => 'datetime:Y-m-d H:i:s',
        'updated_at' => 'datetime:Y-m-d H:i:s',
    ];

    /**
     * release_date attribute mutator.
     *
     * @return \Illuminate\Database\Eloquent\Casts\Attribute
     */
    public function releaseDate(): Attribute
    {
        return Attribute::make(
            set: fn ($value) => $value instanceof DateTimeInterface ? $value : Carbon::createFromFormat("m/d/Y", $value),
        );
    }
}
