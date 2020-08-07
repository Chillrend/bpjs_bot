<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ColosseumRequest extends FormRequest
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
            'rival' => 'required',
            'outcome' => 'required',
            'lifeforce_our' => 'sometimes|integer',
            'lifeforce_theirs' => 'sometimes|integer',
            'colosseum_date' => 'sometimes',
            'colosseum_type' => 'sometimes'
        ];
    }
}
