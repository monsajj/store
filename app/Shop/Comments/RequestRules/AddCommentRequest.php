<?php
/**
 * Created by PhpStorm.
 * User: monsajj
 * Date: 03.11.18
 * Time: 9:50
 */

namespace App\Shop\Comments\RequestRules;

use Illuminate\Foundation\Http\FormRequest;

class AddCommentRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'user_name' => ['required', 'string'],
            'email' => ['nullable','email'],
            'text' => ['required'],
            'product_id' => ['required']
        ];
    }

    public function messages()
    {
        return [
            'user_name.required' => 'Name is required',
            'text.required' => 'Text is required',
            'product_id.required' => 'Product_id is required',
            'email.email' => 'Email is incorrect',
        ];
    }
}
