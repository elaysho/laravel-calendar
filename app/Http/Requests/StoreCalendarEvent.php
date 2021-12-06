<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreCalendarEvent extends FormRequest
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
            'title'             => ['required', 'string'],
            'from'              => ['required', 'date', 'date_format:Y-m-d', 'before_or_equal:' . $this->to],
            'to'                => ['required', 'date', 'date_format:Y-m-d', 'after_or_equal:' . $this->from],
            'recurring_values'  => ['required', 'array']
        ];
    }

    /**
     * 
     */
    public function attributes() {
        return [
            'from' => 'start date',
            'to' => 'end date',
            'recurring_values' => 'days'
        ];
    }
}
