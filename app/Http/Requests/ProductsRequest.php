<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;


class ProductsRequest extends FormRequest
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

        // ↓ここ直す
        'product_name' => 'required | max:255',
        'company_id' => 'required ',
        'price' => 'required |numeric|min:0',
        'stock' => 'required |numeric|min:0',
        'image' => 'nullable',
        'comment' => 'nullable | max:255',
          
          
    ];
    }

    public function attributes()
    {
        return [
            'product_name' => '商品名',
            'company_id' => 'メーカー名',
            'price' => '価格',
            'stock' => '在庫',
            'image' => '画像',
            'comment' => 'コメント',
        ];
    }
    public function messages() {
        return [
            'product_name.required' => ':attributeは必須項目です。',
            'products_name.max' => ':attributeは:max字以内で入力してください。',
            'company_id.required'=> ':attributeは必須項目です。',
            'price.required'=> ':attributeは必須項目です。',
            'price.max' => ':attributeは:max字以内で入力してください。',
            'stock.required'=> ':attributeは必須項目です。',
            'stock.max' => ':attributeは:max字以内で入力してください。',
            
            'comment.max' => ':attributeは:max字以内で入力してください。',
        ];
    }

    
}
