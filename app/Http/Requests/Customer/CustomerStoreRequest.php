<?php

namespace App\Http\Requests\Customer;

use Illuminate\Foundation\Http\FormRequest;

class CustomerStoreRequest extends FormRequest
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
            'email' => 'nullable|email|max:255',
            'phone' => 'nullable|string|max:20',
            'current_type' => 'nullable|string|in:0,1',
            'individual' => 'nullable|string|in:0,1',
            'personal_type' => 'nullable|string|in:0,1',
            'tax_authority' => 'nullable|string|max:50',
            'identity_number' => 'nullable|string|max:50',
            'authorized_person' => 'nullable|array',
            'address' => 'nullable|array',
            'bank_info' => 'nullable|string|max:255',
            'description' => 'nullable|string|max:255',
            'country' => 'nullable|string|max:50',
            'province' => 'nullable|string|max:50',
            'district' => 'nullable|string|max:50',
            'post_code' => 'nullable|string|max:50',
            'file' => 'nullable|file|max:2048|mimes:pdf,doc,docx,xls,xlsx',
            'eori_number' => 'nullable|string|max:50',
        ];
    }

    public function messages()
    {
            return [
                'name.required' => 'Alan/Unvan alanı zorunludur.',
                'email.email' => 'Geçerli bir e-posta adresi giriniz.',
                'current_type.in' => 'Cari tipi alanı geçerli bir değer olmalıdır.',
                'individual.in' => 'Şahıs alanı geçerli bir değer olmalıdır.',
                'file.mimes' => 'Dosya türü geçerli değildir. Doya türleri: pdf,doc,docx,xls,xlsx',
                'file.max' => 'Dosya boyutu 2MB dan büyük olamaz.',
                'bank_info' => 'Banka bilgisi alanı en fazla 255 karakter olabilir.',
                'description' => 'Açıklama alanı en fazla 255 karakter olabilir.',
                'country' => 'Ülke alanı en fazla 50 karakter olabilir.',
                'province' => 'İl alanı en fazla 50 karakter olabilir.',
                'district' => 'İlçe alanı en fazla 50 karakter olabilir.',
                'post_code' => 'Posta kodu alanı en fazla 50 karakter olabilir.',
                'phone' => 'Telefon alanı en fazla 20 karakter olabilir.',
                'tax_authority' => 'Vergi dairesi alanı en fazla 50 karakter olabilir.',
                'identity_number' => 'Vergi numarası alanı en fazla 50 karakter olabilir.',
                'eori_number' => 'Eori numarası alanı en fazla 50 karakter olabilir.',
            ];
    }
}
