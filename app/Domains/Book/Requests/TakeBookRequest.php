<?php

namespace App\Domains\Book\Requests;

use Illuminate\Foundation\Http\FormRequest;

class TakeBookRequest extends FormRequest
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
            'user_id' => 'required|int|exists:users,id',
            'book_id' => 'required|int|exists:books,id',
            'return_at' => 'required|date'
        ];
    }
}
