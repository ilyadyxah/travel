<?php

namespace App\Services;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class CommentValidationService
{
    private array $generalRules = [
        'message' => ['min:50', 'required', 'string', 'max:500'],
        'target_table_id' => ['required', 'integer'],
        'target_id' => ['required', 'integer'],
        'status_id' => ['required', 'integer'],
    ];

    /**
     * @throws \Illuminate\Validation\ValidationException
     */
    public function validate(Request $request) : array
    {
        $requestFields = array_keys($request->all());

        //проверяет только то, что есть в запросе

        $rules = array_filter($this->generalRules, function ($key) use ($requestFields) {
            return ( in_array($key, $requestFields));
        }, ARRAY_FILTER_USE_KEY);
        $validator = Validator::make($request->all($requestFields), $rules);

        return $validator->fails()  ? ['status' => 'errors', 'fields' => $validator->messages()]
            : ['status' => 'validated', 'fields' => $validator->validated()];
    }



}
