<?php

namespace App\Http\Requests\Place;

use Illuminate\Foundation\Http\FormRequest;

class CreateRequest extends FormRequest
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
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'title'=>['min:5', 'required', 'string', 'unique:places'],
            'description' => ['min:30', 'required', 'string'],
//            'distance' => ['integer', 'nullable'],
            'complexity' => ['required', 'integer', 'max:10'],
            'cities' => ['required', 'string'],
            'transports' => ['required', 'array'],
            'groups' => ['nullable', 'array'],
            'types' => ['nullable', 'array'],
            'cost' => ['string', 'nullable'],
            'images.*' => ['image','max:2048'],
            'images' => ['required'],
            'latitude' => ['regex:/^([-+]?)([\d]{1,2})(((\.)(\d+)))$/', 'required'],
            'longitude' => ['regex:/^([-+]?)([\d]{1,3})(((\.)(\d+)))$/', 'required']

        ];
    }
}
