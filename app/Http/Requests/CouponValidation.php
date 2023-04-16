<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CouponValidation extends FormRequest
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
            'coupon' => 'required|unique:discounts,coupon|max:10',
            'type' => 'required',
            'percentage' => 'required|numeric|max:99|min:1',
            'max_amount' => 'required',
            'start_date' => 'required',
            'end_date' => 'required',
        ];
    }
    public function messages()
    {
        return [
            //
        ];
    }
}
