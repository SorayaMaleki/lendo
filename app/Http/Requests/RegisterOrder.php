<?php

namespace App\Http\Requests;

use App\Traits\Response\ApiResponse;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Validation\Rule;
use Illuminate\Validation\ValidationException;

class RegisterOrder extends FormRequest
{
    use ApiResponse;
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
            "customer_id" => ["required", Rule::exists('customers', 'id')
                ->where('status', 'normal'),],
            "amount" => ["required", "in:10000000,12000000,15000000,20000000"],
            "invoice_count" => ["required", "in:6,9,12"],
        ];
    }
}
