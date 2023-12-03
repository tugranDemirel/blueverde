<?php

namespace App\Http\Requests\Product;

use Illuminate\Foundation\Http\FormRequest;

class ProductUpdateRequest extends FormRequest
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
            'image' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
            'images' => 'nullable|array|max:5',
            'meta_description' => 'nullable|string|max:160',
            'meta_keywords' => 'nullable|string|max:160',
            'system_currency_id' => 'required|exists:system_currencies,id',
            'type.*' => 'nullable',
            'product_size' => 'required',
            'material' => 'required',
            'color' => 'required',
            'detail' => 'required',
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
            'image.image' => 'Ürün resmi alanı resim tipinde olmalıdır.',
            'image.mimes' => 'Ürün resmi alanı jpg, jpeg, png tipinde olmalıdır.',
            'image.max' => 'Ürün resmi alanı en fazla 2048 KB olmalıdır.',
            'images.array' => 'Ürün resimleri alanı dizi tipinde olmalıdır.',
            'images.max' => 'Ürün resimleri alanı en fazla 5 adet olmalıdır.',
            'meta_description.string' => 'Meta açıklama alanı metin tipinde olmalıdır.',
            'meta_description.max' => 'Meta açıklama alanı en fazla 160 karakter olmalıdır.',
            'meta_keywords.string' => 'Meta anahtar kelimeler alanı metin tipinde olmalıdır.',
            'meta_keywords.max' => 'Meta anahtar kelimeler alanı en fazla 160 karakter olmalıdır.',
            'system_currency_id.required' => 'Sistem para birimi alanı zorunludur.',
            'system_currency_id.exists' => 'Sistem para birimi alanı geçerli bir sistem para birimi olmalıdır.',
            'product_size.required' => 'Ürün boyutu alanı zorunludur.',
            'material.required' => 'Ürün malzemesi alanı zorunludur.',
            'color.required' => 'Ürün rengi alanı zorunludur.',
            'detail.required' => 'Ürün detayı alanı zorunludur.',
        ];
    }
}
