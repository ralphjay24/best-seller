<?php

namespace App\Http\Requests;

use Closure;
use Illuminate\Foundation\Http\FormRequest;

/**
 * @property string $title
 * @property array  $isbn
 * @property string $author
 * @property int    $offset
 */
class BestSellerRequest extends FormRequest
{
    /**
     * Rules and validating requests.
     *
     * @return array<string, array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'author' => 'string',
            'isbn' => 'array',
            'isbn.*' => [
                'string',
                'regex:/^(\d{10}|\d{13})$/',
            ],
            'title' => 'string',
            'offset' => [
                'integer',
                function (string $attribute, mixed $value, Closure $fail) {
                    if ($value % 20 !== 0 && $value !== 0) {
                        $fail("The {$attribute} must be multiple by 20. Default to 0.");
                    }
                },
            ],
        ];
    }

    /**
     * Get the error messages for the defined validation rules.
     *
     * @return string[]
     */
    public function messages(): array
    {
        return [

        ];
    }
}
