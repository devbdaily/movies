<?php

namespace App\Http\Requests;

use App\Models\Movie;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class MovieRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'title' => 'required|string|between:1,50',
            'format' => [
                'required',
                'string',
                Rule::in(Movie::ALLOWED_FORMATS),
            ],
            'length' => 'required|integer|min:1|max:500',
            'release_date' => 'required|date_format:m/d/Y|after:1800-01-01|before:2100-01-01',
            'rating' => 'required|integer|min:1|max:5',
        ];
    }
}
