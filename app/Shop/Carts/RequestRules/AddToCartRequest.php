<?php
/**
 * Created by PhpStorm.
 * User: monsajj
 * Date: 31.10.18
 * Time: 13:55
 */

namespace App\Shop\Carts\RequestRules;


use Illuminate\Foundation\Http\FormRequest;

class AddToCartRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'product' => ['required', 'integer'],
            'quantity' => ['required', ' min:0 ', 'numeric']
        ];
    }

    public function messages()
    {
        return [
            'quantity.required' => 'A quantity is required',
            'quantity.min:1' => 'Quantity must be at least 1 item',
        ];
    }
}
