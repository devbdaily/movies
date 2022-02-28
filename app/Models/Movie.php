<?php

namespace App\Models;

use Carbon\Carbon;
use DateTime;
use DateTimeInterface;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Movie extends Model
{
    use HasFactory;

    const ALLOWED_FORMATS = [
        'VHS',
        'DVD',
        'Streaming',
    ];

    protected $fillable = [
        'title',
        'format',
        'length',
        'release_date',
        'rating',
    ];

    protected $casts = [
        'release_date' => 'datetime:Y-m-d H:i:s',
        'created_at' => 'datetime:Y-m-d H:i:s',
        'updated_at' => 'datetime:Y-m-d H:i:s',
    ];

    public function releaseDate(): Attribute
    {
        return Attribute::make(
            set: fn ($value) => $value instanceof DateTime ? $value : Carbon::createFromFormat("m/d/Y", $value),
        );
    }
}
