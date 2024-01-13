<?php

namespace App\Http\Requests\Offer;

use App\Enum\Offer\OfferTypeEnum;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rules\Enum;

class OfferStoreRequest extends FormRequest
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
            'offer_type' => ['required',new Enum(OfferTypeEnum::class)],
            'customer_id' => ['required', 'exists:customers,id'],
            'product_tag_id' => ['required', 'exists:product_tags,id'],
            'products' => ['required', 'array'],
            'total' => ['required', 'numeric'],
            'discount' => ['required', 'numeric'],
            'tax' => ['required', 'numeric'],
            'delivery_id' => ['required', 'exists:system_delivery_methods,id'],
            'term_of_offer' => ['required', 'string']
        ];
    }

    public function messages()
    {
        return [
            'offer_type.required' => 'Teklif Türü alanı zorunludur.',
            'customer_id.required' => 'Müşteri alanı zorunludur.',
            'customer_id.exists' => 'Müşteri alanı geçerli değil.',
            'product_tag_id.required' => 'Ürün Etiketi alanı zorunludur.',
            'product_tag_id.exists' => 'Ürün Etiketi alanı geçerli değil.',
            'products.required' => 'Ürünler alanı zorunludur.',
            'products.array' => 'Ürünler alanı dizi olmalıdır.',
            'total.required' => 'Toplam alanı zorunludur.',
            'total.numeric' => 'Toplam alanı sayı olmalıdır.',
            'discount.required' => 'İndirim alanı zorunludur.',
            'discount.numeric' => 'İndirim alanı sayı olmalıdır.',
            'tax.required' => 'Vergi alanı zorunludur.',
            'tax.numeric' => 'Vergi alanı sayı olmalıdır.',
            'delivery_id.required' => 'Teslimat alanı zorunludur.',
            'delivery_id.exists' => 'Teslimat alanı geçerli değil.',
            'term_of_offer.required' => 'Teklif Süresi alanı zorunludur.',
            'term_of_offer.string' => 'Teklif Süresi alanı metin olmalıdır.',
        ];
    }
}
