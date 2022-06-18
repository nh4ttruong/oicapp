<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class HandleEventRequest extends FormRequest
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
            'name' => 'required|max:255',
            'introduction' => 'required|max:255',
            'location' => 'required',
            'start_time' => 'required'
        ];
    }

    public function message() {
        return [
            'name.required' => 'Event name is required!',
            'introduction.required' => 'Introduction is required!',
            'location.required' => 'Event location is required!',
            'start_time.required' => 'Starting time is required!',
        ];

    }
}
