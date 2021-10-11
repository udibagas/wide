<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class SiteRequest extends FormRequest
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
            'name' => 'required',
            'address' => 'required',
            // 'position' => '',
            'modem_sn' => 'required',
            'public_ip_address' => 'required|ipv4',
            'vpn_ip_address' => 'required|ipv4',
            'port' => 'requirer|numeric',
            'username' => 'required',
            'password' => 'required',
        ];
    }
}
