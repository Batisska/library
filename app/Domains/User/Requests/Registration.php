<?php

declare(strict_types=1);

namespace App\Domains\User\Requests;

use Illuminate\Foundation\Http\FormRequest;

/**
 * Class Registration
 * @package App\Domains\User\Requests
 */
class Registration extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules(): array
    {
        return [
            'email' => 'required|email|unique:users',
            'name' => 'required',
            'password' => 'required|confirmed',
        ];
    }
}
