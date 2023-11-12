@extends('admin.layouts.app')
@section('title', isset($term_of_offer) ? 'Teklif Şartı Düzenle' : 'Teklif Şartı Ekle' )
@section('css')
    <script src="https://cdn.ckeditor.com/4.10.0/standard/ckeditor.js"></script>
@endsection
@section('content')
    <div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
        <div class="breadcrumb-title pe-3">Ekle</div>
        <div class="ps-3">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb mb-0 p-0">
                    <li class="breadcrumb-item"><a href="javascript:;"><i class="bx bx-home-alt"></i></a>
                    </li>
                    <li class="breadcrumb-item active" aria-current="page">{{ isset($term_of_offer) ? 'Teklif Şartı Düzenle' : 'Teklif Şartı Ekle' }}</li>
                </ol>
            </nav>
        </div>
    </div>
    <div class="row">
        <div class="col-xl-8 mx-auto">
            <div class="card">
                <div class="card-body">
                    <form action="{{ isset($term_of_offer) ? route('admin.term_of_offer.update', ['term_of_offer' => $term_of_offer]) : route('admin.term_of_offer.store') }}" method="post">
                        @isset($term_of_offer)
                            @method('PUT')
                        @endisset
                        @csrf
                        <div class="border p-4 rounded">
                            <div class="card-title d-flex align-items-center">
                                <h5 class="mb-0">{{ isset($term_of_offer) ? 'Teklif Şartı Düzenle' : 'Teklif Şartı Ekle' }}</h5>
                            </div>
                            <hr>


                            <div class="row  mt-3">
                                <label class="col-sm-4 col-form-label">Teklif Şartı Adı</label>
                                <div class="col-sm-8">
                                    <input type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ isset($term_of_offer) ? $term_of_offer->name : old('name') }}" placeholder="Teklif Şartı Adı">
                                    @error('name')
                                    <div class="invalid-feedback">
                                        {{$message}}
                                    </div>
                                    @enderror
                                </div>
                            </div>

                            <div class="row  mt-3">
                                <label class="col-sm-4 col-form-label">Teklif Şartı Açıklaması</label>
                                <div class="col-sm-12">
                                    <textarea name="description" class="form-control ckeditor1" id="" cols="30" rows="10">{{ isset($term_of_offer) ? $term_of_offer->description : old('description') }}</textarea>
                                </div>
                            </div>
                            <div class="row mt-3">
                                <label class="col-sm-2 col-form-label"></label>
                                <div class="col-sm-10">
                                    <button type="submit" class="btn btn-primary px-5">Kaydet</button>
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
        // Replace the <textarea id="editor1"> with a CKEditor 4
        // instance, using default configuration.
        let ck = document.querySelectorAll('.ckeditor1');
        for (let i = 0; i < ck.length; i++) {
            CKEDITOR.replace(ck[i], {
                height: 650,
                filebrowserUploadUrl: "{{route('admin.upload', ['_token' => csrf_token() ])}}",
                filebrowserUploadMethod: 'form'
            });
        }
    </script>
    @endsection
