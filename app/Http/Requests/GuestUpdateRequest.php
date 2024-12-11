<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;
use Illuminate\Validation\Rules\Password;

class GuestUpdateRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
       // dd($this->user()->id, $this->guest->user->id);
        //return auth()->user()->id === $this->guest->user->id;
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'email' => ['required','email', Rule::unique('users')->ignore($this->user()->id)],
            'password' => ['nullable','string','min:8', 'confirmed', Password::min(8)->letters()->uncompromised()->numbers()->mixedCase()],
            'name' => 'required|string|min:3|max:255',
            'birthdate' => 'required|date|before:now',
            'cpf' => 'required_if:is_foreign,0|string|min:11|max:11',
            'rg' => 'required_if:is_foreign,0|string|min:9|max:9',
            'is_foreign' => 'required|boolean',
            'passport' => 'required_if:is_foreign,1|string|min:6|max:255',

        ];
    }
}
