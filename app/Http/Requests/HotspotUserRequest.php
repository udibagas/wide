<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class HotspotUserRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return auth()->check();
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'router_id' => 'required',
            'profile' => 'required',
            'qty' => 'required',
            'comment' => 'required'
        ];
    }
}
