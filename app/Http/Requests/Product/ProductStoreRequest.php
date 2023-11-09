<?php

namespace App\Http\Requests\Product;

use Illuminate\Foundation\Http\FormRequest;

class ProductStoreRequest extends FormRequest
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
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'name' => 'required|string|max:255',
            'category_id' => 'required|exists:categories,id',
            'product_tag_id' => 'required|exists:product_tags,id',
            'code' => 'required|string|max:255',
            'description' => 'required|string',
            'price' => 'required|numeric',
            'image' => 'required|image|mimes:jpg,jpeg,png|max:2048',
            'images' => 'nullable|array|max:5',
            'meta_description' => 'nullable|string|max:160',
            'meta_keywords' => 'nullable|string|max:160',
            'system_currency_id' => 'required|exists:system_currencies,id',
        ];
    }

    public function messages()
    {
        return [
            'name.required' => 'Ürün adı alanı zorunludur.',
            'name.string' => 'Ürün adı alanı metin tipinde olmalıdır.',
            'name.max' => 'Ürün adı alanı en fazla 255 karakter olmalıdır.',
            'category_id.required' => 'Kategori alanı zorunludur.',
            'category_id.exists' => 'Kategori alanı geçerli bir kategori olmalıdır.',
            'product_tag_id.required' => 'Ürün etiketi alanı zorunludur.',
            'product_tag_id.exists' => 'Ürün etiketi alanı geçerli bir ürün etiketi olmalıdır.',
            'code.required' => 'Ürün kodu alanı zorunludur.',
            'code.string' => 'Ürün kodu alanı metin tipinde olmalıdır.',
            'code.max' => 'Ürün kodu alanı en fazla 255 karakter olmalıdır.',
            'description.required' => 'Ürün açıklaması alanı zorunludur.',
            'description.string' => 'Ürün açıklaması alanı metin tipinde olmalıdır.',
            'price.required' => 'Ürün fiyatı alanı zorunludur.',
            'price.numeric' => 'Ürün fiyatı alanı sayı tipinde olmalıdır.',
            'image' => 'Ürün resmi alanı zorunludur.',
            'image.image' => 'Ürün resmi alanı resim tipinde olmalıdır.',
            'image.mimes' => 'Ürün resmi alanı jpg, jpeg, png tipinde olmalıdır.',
            'image.max' => 'Ürün resmi alanı en fazla 2048 kb olmalıdır.',

        ];
    }
}
