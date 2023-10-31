@extends('admin.layouts.app')
@section('title', 'Yurtiçi Müşteri Ekle')
@section('content')
    <div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
        <div class="breadcrumb-title pe-3">Ekle</div>
        <div class="ps-3">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb mb-0 p-0">
                    <li class="breadcrumb-item"><a href="javascript:;"><i class="bx bx-home-alt"></i></a>
                    </li>
                    <li class="breadcrumb-item active" aria-current="page">Yurtiçi Müşteri Ekle</li>
                </ol>
            </nav>
        </div>
    </div>
    <div class="row">
        <div class="col-xl-12 mx-auto">
            <div class="card">
                <div class="card-body">
                    <form action="{{ route('admin.tr_customer.store') }}" enctype="multipart/form-data">

                        <div class="border p-4 rounded">
                            <div class="card-title d-flex align-items-center">
                                <h5 class="mb-0">Yurtiçi Müşteri Ekle</h5>
                            </div>
                            <hr>
                            <input type="hidden" name="personal_type" value="{{ \App\Enum\Customer\CustomerPersonalTypeEnum::DOMESTIC_CUSTOMER }}">
                            <div class="row mb-3">
                                <label for="inputEnterYourName" class="col-sm-2 col-form-label">Ad/Unvan</label>
                                <div class="col-sm-2">
                                    <input type="text" class="form-control @error('name') is-invalid @enderror" name="name"
                                           value="{{ isset($customer) ? $customer->name :old('name') }}" required=""
                                           id="inputEnterYourName" placeholder="Ad/Unvan">
                                    @error('name')
                                    <div class="invalid-feedback">{{ $message }}</div> @enderror
                                </div>
                                <label for="inputEnterYourName" class="col-sm-2 col-form-label">Email</label>
                                <div class="col-sm-2">
                                    <input type="email" class="form-control @error('email') is-invalid @enderror"
                                           name="email" value="{{ isset($customer) ? $customer->email :old('email') }}"
                                           required="" id="inputEnterYourName" placeholder="Email Adresi">
                                    @error('email')
                                    <div class="invalid-feedback">{{ $message }}</div> @enderror
                                </div>
                                <label for="inputEnterYourName" class="col-sm-2 col-form-label">Telefon</label>
                                <div class="col-sm-2">
                                    <input type="text" class="form-control @error('phone') is-invalid @enderror"
                                           name="phone" value="{{ isset($customer) ? $customer->phone :old('phone') }}"
                                           required="" id="inputEnterYourName" placeholder="Telefon Numarası">
                                    @error('phone')
                                    <div class="invalid-feedback">{{ $message }}</div> @enderror
                                </div>
                            </div>
                            <div class="row mb-3 mt-3">
                                <label for="inputEnterYourName" class="col-sm-2 col-form-label">Cari/Cari Değil</label>
                                <div class="col-sm-4">
                                    <select name="" id="" class="form-select @error('current_type') is-invalid @enderror">
                                        <option
                                            value="{{ \App\Enum\Customer\CustomerCurrentTypeEnum::CURRENT }}" {{ isset($customer) && $customer->current_type == \App\Enum\Customer\CustomerCurrentTypeEnum::CURRENT ? 'selected' : '' }}>
                                            CARİ
                                        </option>
                                        <option
                                            value="{{ \App\Enum\Customer\CustomerCurrentTypeEnum::NOT_CURRENT }}" {{ isset($customer) && $customer->current_type == \App\Enum\Customer\CustomerCurrentTypeEnum::NOT_CURRENT ? 'selected' : '' }}>
                                            CARİ DEĞİL
                                        </option>
                                    </select>
                                    @error('current_type')
                                    <div class="invalid-feedback">{{ $message }}</div> @enderror
                                </div>
                                <label for="inputEnterYourName" class="col-sm-2 col-form-label">Bireysel/Kurumsal
                                    Müşteri</label>
                                <div class="col-sm-4">
                                    <select name="" id="" class="form-select @error('current_type') is-invalid @enderror">
                                        <option
                                            value="{{ \App\Enum\Customer\CustomerIndividualEnum::INVIDUAL }}" {{ isset($customer) && $customer->current_type == \App\Enum\Customer\CustomerIndividualEnum::INVIDUAL ? 'selected' : '' }}>
                                            BİREYSEL
                                        </option>
                                        <option
                                            value="{{ \App\Enum\Customer\CustomerIndividualEnum::INSTITUTIONAL }}" {{ isset($customer) && $customer->current_type == \App\Enum\Customer\CustomerIndividualEnum::INSTITUTIONAL ? 'selected' : '' }}>
                                            KURUMSAL
                                        </option>
                                    </select>
                                    @error('current_type')
                                    <div class="invalid-feedback">{{ $message }}</div> @enderror
                                </div>
                            </div>

                            <div class="row mb-3 mt-3">
                                <label for="inputEnterYourName" class="col-sm-2 col-form-label">Vergi Dairesi</label>
                                <div class="col-sm-4">
                                    <input type="text" class="form-control @error('tax_authority') is-invalid @enderror" name="tax_authority"
                                           value="{{ isset($customer) ? $customer->tax_authority :old('tax_authority') }}" required=""
                                           id="inputEnterYourName" placeholder="Vergi Dairesi">
                                    @error('tax_authority')
                                    <div class="invalid-feedback">{{ $message }}</div> @enderror
                                </div>
                                <label for="inputEnterYourName" class="col-sm-2 col-form-label">Veri No/ TC Kimlik No</label>
                                <div class="col-sm-4">
                                    <input type="text" class="form-control @error('identity_number') is-invalid @enderror"
                                           name="identity_number" value="{{ isset($customer) ? $customer->identity_number :old('identity_number') }}"
                                           required="" id="inputEnterYourName" placeholder="Veri No/ TC Kimlik No">
                                    @error('identity_number')
                                    <div class="invalid-feedback">{{ $message }}</div> @enderror
                                </div>
                            </div>
                            <div class="row mt-3 authorizedPerson">
                                <div class="row mb-3">
                                    <label for="inputEnterYourName" class="col-sm-2 col-form-label">Yetkili Kişi</label>
                                    <div class="col-sm-2">
                                        <input type="text"
                                               class="form-control @error('authorized_person[name]') is-invalid @enderror"
                                               name="authorized_person[name]"
                                               value="{{ isset($customer) ? $customer->authorized_person : old('authorized_person[name]') }}"
                                               required="" id="inputEnterYourName" placeholder="Ad/Unvan">
                                        @error('country')
                                        <div class="invalid-feedback">{{ $message }}</div> @enderror
                                    </div>
                                    <div class="col-sm-2">
                                        <input type="text"
                                               class="form-control @error('authorized_person[phone]') is-invalid @enderror"
                                               name="authorized_person[phone]"
                                               value="{{ isset($customer) ? $customer->authorized_person : old('authorized_person[phone]') }}"
                                               required="" id="inputEnterYourName" placeholder="Telefon">
                                        @error('authorized_person[phone]') <div class="invalid-feedback">{{ $message }}</div> @enderror
                                    </div>
                                    <div class="col-sm-2">
                                        <input type="email"
                                               class="form-control @error('authorized_person[email]') is-invalid @enderror"
                                               name="authorized_person[email]"
                                               value="{{ isset($customer) ? $customer->authorized_person : old('authorized_person[email]') }}"
                                               required="" id="inputEnterYourName" placeholder="Mail">
                                        @error('authorized_person[email]')
                                        <div class="invalid-feedback">{{ $message }}</div> @enderror
                                    </div>
                                    <div class="col-sm-2">
                                        <input type="text"
                                               class="form-control @error('authorized_person[gsm]') is-invalid @enderror"
                                               name="authorized_person[gsm]"
                                               value="{{ isset($customer) ? $customer->authorized_person : old('authorized_person[gsm]') }}"
                                               required="" id="inputEnterYourName" placeholder="GSM">
                                        @error('authorized_person[gsm]')
                                        <div class="invalid-feedback">{{ $message }}</div> @enderror
                                    </div>
                                    <div class="col-sm-2">
                                        <a href="#" id="addAuthorizedPerson" class="btn btn-success">+</a>
                                    </div>

                                </div>
                            </div>

                            <div class="row mb-3 mt-3">
                                <label for="inputEnterYourName" class="col-sm-2 col-form-label">Banka Bilgisi</label>
                                <div class="col-sm-4">
                                    <textarea name="bank_info" class="form-control" id="" cols="30" rows="10">{{ isset($customer) ? $customer->bank_info :old('bank_info') }}</textarea>
                                    @error('bank_info')
                                    <div class="invalid-feedback">{{ $message }}</div> @enderror
                                </div>
                                <label for="inputEnterYourName" class="col-sm-2 col-form-label">Açıklama</label>
                                <div class="col-sm-4">
                                    <textarea name="description" class="form-control" id="" cols="30" rows="10">{{ isset($customer) ? $customer->description :old('description') }}</textarea>
                                    @error('description')
                                    <div class="invalid-feedback">{{ $message }}</div> @enderror
                                </div>
                            </div>
                            <div class="row mt-3 mb-3">
                                <label for="inputEnterYourName" class="col-sm-2 col-form-label">Ülke</label>
                                <div class="col-sm-2">
                                    <input type="text" class="form-control @error('country') is-invalid @enderror"
                                           name="country"
                                           value="{{ isset($customer) ? $customer->country :old('country') }}" required=""
                                           id="inputEnterYourName" placeholder="Ülke">
                                    @error('country')
                                    <div class="invalid-feedback">{{ $message }}</div> @enderror
                                </div>
                                <label for="inputEnterYourName" class="col-sm-2 col-form-label">İl</label>
                                <div class="col-sm-2">
                                    <input type="text" class="form-control @error('province') is-invalid @enderror"
                                           name="province"
                                           value="{{ isset($customer) ? $customer->province :old('province') }}" required=""
                                           id="inputEnterYourName" placeholder="İl">
                                    @error('province')
                                    <div class="invalid-feedback">{{ $message }}</div> @enderror
                                </div>
                                <label for="inputEnterYourName" class="col-sm-2 col-form-label">İlçe</label>
                                <div class="col-sm-2">
                                    <input type="text" class="form-control @error('district') is-invalid @enderror"
                                           name="district"
                                           value="{{ isset($customer) ? $customer->district :old('district') }}" required=""
                                           id="inputEnterYourName" placeholder="İlçe">
                                    @error('district')
                                    <div class="invalid-feedback">{{ $message }}</div> @enderror
                                </div>
                            </div>
                            <div class="row addresses">
                                <div class="row mt-3 mb-3">
                                    <label for="inputAddress4" class="col-sm-2 col-form-label">Adres Satırı</label>
                                    <div class="col-sm-4">
                                        <input type="text"
                                               class="form-control @error('address[]') is-invalid @enderror"
                                               name="address[]"
                                               value="{{ isset($customer) ? $customer->address : old('address[]') }}"
                                               required="" id="inputEnterYourName" placeholder="Adres Satırı">
                                        @error('address[]')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <div class="col-sm-2">
                                        <input type="text"
                                               class="form-control @error('post_code') is-invalid @enderror"
                                               name="post_code"
                                               value="{{ isset($customer) ? $customer->post_code : old('post_code') }}"
                                               required="" id="inputEnterYourName" placeholder="Posta Kodu">
                                        @error('post_code')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <div class="col-sm-2">
                                        <a href="#" id="addAddressLine" class="btn btn-success">+</a>
                                    </div>
                                </div>
                            </div>
                            <div class="row mb-3 mt-3">
                                <label class="col-sm-2 col-form-label">Dosya</label>
                                <div class="col-sm-4">
                                    <input type="file" class="form- @error('file') is-invalid @enderror" name="file"
                                           value="{{ isset($customer) ? $customer->name :old('name') }}">
                                    @error('file')
                                    <div class="invalid-feedback">{{ $message }}</div> @enderror
                                </div>
                            </div>
                            <div class="row">
                                <label class="col-sm-2 col-form-label"></label>
                                <div class="col-sm-10">
                                    <button type="submit"
                                            class="btn btn-primary px-5">{{ isset($customer) ? 'Güncelle' :'Kaydet' }}</button>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('js')
    <script>
        $(document).ready(function () {
            $('#addAuthorizedPerson').click(function () {
                event.preventDefault()
                let html = `
                <div class="row mb-3 authorizedPersonItem">
                    <label for="inputEnterYourName" class="col-sm-2 col-form-label">Yetkili Kişi</label>
                    <div class="col-sm-2">
                        <input type="text" class="form-control @error('authorized_person[name]') is-invalid @enderror" name="authorized_person[name]" value="{{ isset($customer) ? $customer->authorized_person : old('authorized_person[name]') }}" required="" id="inputEnterYourName" placeholder="Ad/Unvan">
                        @error('country') <div class="invalid-feedback">{{ $message }}</div> @enderror
                    </div>
                    <div class="col-sm-2">
                        <input type="text" class="form-control @error('authorized_person[phone]') is-invalid @enderror" name="authorized_person[phone]" value="{{ isset($customer) ? $customer->authorized_person : old('authorized_person[phone]') }}" required="" id="inputEnterYourName" placeholder="Telefon">
                                        @error('authorized_person[phone]') <div class="invalid-feedback">{{ $message }}</div> @enderror
                    </div>
                    <div class="col-sm-2">
                        <input type="email" class="form-control @error('authorized_person[email]') is-invalid @enderror" name="authorized_person[email]" value="{{ isset($customer) ? $customer->authorized_person : old('authorized_person[email]') }}" required="" id="inputEnterYourName" placeholder="Mail">
                                        @error('authorized_person[email]') <div class="invalid-feedback">{{ $message }}</div> @enderror
                    </div>
                    <div class="col-sm-2">
                        <input type="text" class="form-control @error('authorized_person[gsm]') is-invalid @enderror" name="authorized_person[gsm]" value="{{ isset($customer) ? $customer->authorized_person : old('authorized_person[gsm]') }}" required="" id="inputEnterYourName" placeholder="GSM">
                                        @error('authorized_person[gsm]') <div class="invalid-feedback">{{ $message }}</div> @enderror
                    </div>
                    <div class="col-sm-2">
                        <a href="#" class="btn btn-danger removeAuthorizedPerson">-</a>
                    </div>
                </div>`
                $('.authorizedPerson').append(html)
            });
            $('#addAddressLine').click(function () {
                event.preventDefault()
                let html = `
                    <div class="row mt-3 mb-3 addressItem">
                        <label for="inputAddress4" class="col-sm-2 col-form-label">Adres Satırı</label>
                        <div class="col-sm-4">
                            <input type="text"
                                   class="form-control @error('address[]') is-invalid @enderror"
                                   name="address[]"
                                   value="{{ isset($customer) ? $customer->address : old('address[]') }}"
                                   required="" id="inputEnterYourName" placeholder="Adres Satırı">
                            @error('address[]')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="col-sm-2">
                            <a href="#" class="btn btn-danger removeAddressLine">-</a>
                        </div>
                    </div>`
                $('.addresses').append(html)
            })
        })
        $('.authorizedPerson').on('click', '.removeAuthorizedPerson', function () {
            event.preventDefault()
            $(this).closest('.authorizedPersonItem').remove();
        });
        $('.addresses').on('click', '.removeAddressLine', function () {
            event.preventDefault()
            $(this).closest('.addressItem').remove();
        });
    </script>
@endsection
