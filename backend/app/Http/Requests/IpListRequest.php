<?php

namespace App\Http\Requests;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Http\Response;

class IpListRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array|string>
     */
    public function rules()
    {
        if( $this->isMethod('post') ) {
            return $this->storeRules();
        } elseif ( $this->isMethod('put') ) {
            return $this->updateRules();
        }
    }
    public function storeRules():array
    {
        return [
            'ip_address' => 'required|ip|max:64|unique:ip_lists',
            'label' => 'required|max:100|unique:ip_lists',

        ];
    }
    public function updateRules():array
    {
        return [
            'ip_address' => 'required|ip|max:64',
            'label' => 'required|max:100',
        ];
    }
    public function failedValidation(Validator $validator)
    {
        throw new HttpResponseException(response()->json([
            'success'   => false,
            'message'   => 'Validation errors',
            'data'      => $validator->errors()

        ],Response::HTTP_BAD_REQUEST));
    }

}
