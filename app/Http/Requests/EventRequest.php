<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class EventRequest extends FormRequest
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
            'event_title' => 'required',
            'event_description' => 'required',
            'mentions' => 'required',
            'time' => 'required',
            'remind_five_minutes_before' => 'sometimes',
            'event_image_url' => 'sometimes|active_url'
        ];
    }
}
