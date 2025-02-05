<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ExhibitionRequest extends FormRequest
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
            'image' => ['required', 'mimes:jpeg, png'],
            'categories' => ['required'],
            'condition_id' => ['required'],
            'item_name' => ['required'],
            'detail' => ['required'],
            'price' => ['required', 'integer', 'gt:0']
        ];
    }

    public function messages()
    {
        return [
            'image.required' => '画像を選択してください',
            'image.mimes' => '画像はjpgもしくはpngファイルを選択してください',
            'categories.required' => 'カテゴリーを選択してください',
            'condition_id.required' => '商品の状態を選択してください',
            'item_name.required' => '商品名を入力してください',
            'detail.required' => '商品の説明を入力してください',
            'price.required' => '商品の販売価格を入力してください',
            'price.integer' => '商品の販売価格は数字で入力してください',
            'price.gt' => '商品の販売価格は0円以上で設定してください'
        ];
    }
}
