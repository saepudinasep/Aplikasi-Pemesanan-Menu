<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class EmployeeCreateRequest extends FormRequest
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
            'name' => 'max:50|required',
            'email' => 'required',
            // 'email' => 'email:rfc,dns|required',
            'phone' => 'max:13|required',
            'role_id' => 'required'
        ];
    }


    public function messages()
    {
        return [
            'name.required' => 'Name wajib di isi',
            'name.max' => 'Name maksimal :max karakter',
            'email.required' => 'Email wajib di isi',
            // 'email.rfc,dns' => 'Email tidak valid',
            'phone.required' => 'Phone wajib di isi',
            'phone.max' => 'Phone maksimal :max karakter',
            'role_id.required' => 'Posisi wajib di isi'
        ];
    }
}
