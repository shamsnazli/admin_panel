<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use phpDocumentor\Reflection\PseudoTypes\True_;

class BookRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return True;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'title' => 'required|string',
            'description' => 'string',
            'published_year' => 'numeric|min:1990|max:2021',
            'published_number' => 'numeric',
            'publisher_id' => 'required',
            'author_id' => 'required',
            'category_id' => 'required',
        ];
    }
    public function messages()
    {
        return[
            'title.required' => 'Book title is required',
            'title.string' => 'Book title must be a string',
            'description.string' => 'Book description must be a string',
            'published_year.numeric' => 'The field of Published Year is a number',
            'published_year.min:1990' => 'Wrong value for Published Year selected',
            'published_year.max:2021' => 'Wrong value for Published Year selected',
            'published_number.numeric' => 'The field of Published number is a number',
            'publisher_id.required' => 'You must choose a Publisher',
            'author_id.required' => 'You must choose an Author',
            'category_id.required' => 'You must choose a Category',
        ];
    }

}
