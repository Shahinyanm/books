<?php

namespace App\Http\Requests\Player;

use App\Helpers\StatusCodeHelper;
use App\Models\Team;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Contracts\Validation\Validator;

class EditRequest extends FormRequest
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
            'first_name' => 'required|max:255',
            'last_name' => 'required|max:255',
            'team_id' => 'required|exists:' . (new Team())->getTable() . ',id',
        ];
    }

    /**
     * Handle a failed validation attempt
     *
     * @param Validator $validator
     */
    protected function failedValidation(Validator $validator)
    {
        $response = [
            'success' => false,
            'errors' => [
                'validation' => $validator->errors()
            ],
            'data' => []
        ];
        throw new HttpResponseException(response()->json($response, StatusCodeHelper::HTTP_UNPROCESSABLE_ENTITY));
    }
}
