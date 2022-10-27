<?php

namespace App\Http\Requests\Api;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class CreateCityRequest extends FormRequest
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
     */
    public function rules(): array
    {
        return [
            'name' => 'required',
            'latitude' => [
                'required',
                'numeric',
                'between:-90,90',
                Rule::unique('cities')
                    ->where(function ($query) {
                        return $query->where('latitude', $this->get('latitude'))
                            ->where('longitude', $this->get('longitude'));
                    })],
            'longitude' => 'required|numeric|between:-180,180'
        ];
    }

    public function messages(): array
    {
        return [
            'latitude.unique' => 'The city with given data is already created!'
        ];
    }
}
