@extends('admin.layouts.app')
@section('title', 'Ürün Ekle')
@section('css')
    <link href="{{ asset('assets/admin/plugins/select2/css/select2.min.css') }}" rel="stylesheet" />
    <link href="{{ asset('assets/admin/plugins/select2/css/select2-bootstrap4.css') }}" rel="stylesheet" />
    <link href="{{ asset('assets/admin/plugins/metismenu/css/metisMenu.min.css') }}" rel="stylesheet" />
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
                    <li class="breadcrumb-item active" aria-current="page">Ürün Ekle</li>
                </ol>
            </nav>
        </div>
    </div>
    <div class="row">
        <div class="col-xl-8 mx-auto">
            <div class="card">
                <div class="card-body">
                    <form action="{{ route('admin.product.store') }}" method="post" enctype="multipart/form-data">
                        @csrf
                        <ul class="nav nav-tabs nav-primary" role="tablist">
                            <li class="nav-item" role="presentation">
                                <a class="nav-link active" data-bs-toggle="tab" href="#primaryhome" role="tab" aria-selected="true">
                                    <div class="d-flex align-items-center">
                                        <div class="tab-icon"><i class="bx bx-home font-18 me-1"></i>
                                        </div>
                                        <div class="tab-title">Genel Özellikler</div>
                                    </div>
                                </a>
                            </li>
                            <li class="nav-item" role="presentation">
                                <a class="nav-link" data-bs-toggle="tab" href="#primaryprofile" role="tab" aria-selected="false">
                                    <div class="d-flex align-items-center">
                                        <div class="tab-icon"><i class="bx bx-user-pin font-18 me-1"></i>
                                        </div>
                                        <div class="tab-title">Resim Seçimi</div>
                                    </div>
                                </a>
                            </li>
                            <li class="nav-item" role="presentation">
                                <a class="nav-link" data-bs-toggle="tab" href="#primarycontact" role="tab" aria-selected="false">
                                    <div class="d-flex align-items-center">
                                        <div class="tab-icon"><i class="bx bx-text font-18 me-1"></i>
                                        </div>
                                        <div class="tab-title">SEO Ayarları</div>
                                    </div>
                                </a>
                            </li>
                        </ul>
                        <div class="tab-content py-3">
                            <div class="tab-pane fade active show" id="primaryhome" role="tabpanel">

                                @if($productTags->count() > 0)
                                    <div class="row  mt-3">
                                        <label class="col-sm-4 col-form-label">Etiket</label>
                                        <div class="col-sm-6">
                                            <select class="form-select @error('product_tag_id') is-invalid @enderror" name="product_tag_id">
                                                <option selected>Ürün Etiketi Seçiniz</option>
                                                @foreach($productTags as $tag)
                                                    <option value="{{ $tag->id }}" @if(old('product_tag_id') == $tag->id) selected @endif>{{ $tag->name }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                @else
                                    <div class="row  mt-3">
                                        <label class="col-sm-4 col-form-label">Etiket</label>
                                        <div class="col-sm-6">
                                            <div class="alert alert-warning">
                                                Lütfen <strong>Ürün Etiketi</strong> Ekleyiniz.
                                            </div>
                                        </div>
                                    </div>
                                @endif
                                @if($categoryTags->count() > 0)
                                    <div class="row  mt-3">
                                        <label class="col-sm-4 col-form-label">Kategori Etiketi</label>
                                        <div class="col-sm-6">
                                            <select name="" id="categoryTag" class="form-control">
                                                <option value="" selected>Kategori Etiketi Seçiniz</option>
                                                @foreach($categoryTags as $tag)
                                                    <option value="{{ $tag->id }}">{{ $tag->name }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                    <div class="row  mt-3" id="category-result" style="display: none;">
                                        <label class="col-sm-4 col-form-label">Kategoriler</label>
                                        <div class="col-sm-6">
                                            <select name="category_id" id="category-results" class="form-control">
                                            </select>

                                        </div>
                                    </div>

                                @else
                                    <div class="row  mt-3">
                                        <label class="col-sm-4 col-form-label">Kategori Etiketi</label>
                                        <div class="col-sm-6">
                                            <div class="alert alert-warning">
                                                Lütfen <strong>Kategori Etiketi</strong> Ekleyiniz.
                                            </div>
                                        </div>
                                    </div>
                                @endif
                                <div class="row  mt-3">
                                    <label class="col-sm-4 col-form-label">Ürün Adı</label>
                                    <div class="col-sm-6">
                                        <input type="text" class="form-control @error('name') is-invalid @enderror" value="{{ old('name') }}" name="name" placeholder="Ürün Adı Giriniz">
                                        @error('name')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="row  mt-3">
                                    <label class="col-sm-4 col-form-label">Ürün Kodu</label>
                                    <div class="col-sm-6">
                                        <input type="text" class="form-control @error('code') is-invalid @enderror" value="{{ old('code') }}" name="code" placeholder="Ürün Kodu Giriniz">
                                        @error('code')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="row  mt-3">
                                    <label class="col-sm-4 col-form-label">Ürün Ana Resmi</label>
                                    <div class="col-sm-6">
                                        <input type="file" class="form-control @error('image') is-invalid @enderror" value="{{ old('image') }}" name="image" >
                                        @error('image')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="row  mt-3">
                                    <label class="col-sm-4 col-form-label">Ürün Fiyatı</label>
                                    <div class="col-sm-3">
                                        <input type="number" class="form-control @error('price') is-invalid @enderror" value="{{ old('price') }}" name="price" placeholder="Ürün Fiyatı Giriniz">
                                        @error('price')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <div class="col-sm-3">
                                        <div class="input-group">
                                            <select name="system_currency_id" id="" class="form-select">
                                                @foreach($currencies as $currency)
                                                    <option value="{{ $currency->id }}">{{ $currency->name }}</option>
                                                @endforeach
                                            </select>
                                            @error('system_currency_id')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>
                                </div>

                                <div class="row  mt-3">
                                    <label class="col-sm-4 col-form-label">Ürün Ebatı/Boyutu</label>
                                    <div class="col-sm-8">
                                        <input type="text" class="form-control @error('product_size') is-invalid @enderror" value="{{ old('product_size') }}" name="product_size" placeholder="Ürün Ebatı/Boyutu Giriniz">
                                        @error('product_size')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>

                                </div>
                                <div class="row  mt-3" id="types">
                                    <label class="col-sm-4 col-form-label">Tip</label>
                                    <div class="col-sm-4">
                                        <input type="text" class="form-control @error('type') is-invalid @enderror" name="type[]" placeholder="Ürün Tipi Giriniz">
                                        @error('type')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <div class="col-sm-4">
                                        <div class="btn-group">
                                            <button type="button" class="btn btn-success addType" data-url=""><i class="lni lni-circle-plus"></i></button>
                                        </div>
                                    </div>
                                </div>
                                <div class="row  mt-3">
                                    <label class="col-sm-4 col-form-label">Ürün Malzeme</label>
                                    <div class="col-sm-6">
                                        <input type="text" class="form-control @error('material') is-invalid @enderror" value="{{ old('material') }}" name="material"  placeholder="Ürün Malzeme Giriniz">
                                        @error('material')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="row  mt-3">
                                    <label class="col-sm-4 col-form-label">Ürün Rengi</label>
                                    <div class="col-sm-6">
                                        <input type="text" class="form-control @error('color') is-invalid @enderror" value="{{ old('color') }}" name="color"  placeholder="Ürün Rengi Giriniz">
                                        @error('color')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="row  mt-3">
                                    <div class="col-sm-12 ">
                                        <label for="">Ürün Detay</label>
                                        <textarea class="form-control ckeditor1 @error('detail') is-invalid @enderror" name="detail" rows="4" placeholder="Ürün Açıklaması Giriniz">{{ old('detail') }}</textarea>
                                        @error('detail')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="row  mt-3">
                                    <div class="col-sm-12 ">
                                        <label for="">Ürün Açıklaması</label>
                                        <textarea class="form-control ckeditor1 @error('description') is-invalid @enderror" name="description" rows="4" placeholder="Ürün Açıklaması Giriniz">{{ old('description') }}</textarea>

                                        @error('description')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                            <div class="tab-pane fade" id="primaryprofile" role="tabpanel">

                                <div class="row  mt-3" id="images">

                                    <div class="col-sm-1">
                                        <div class="btn-group">
                                            <button type="button" class="btn btn-success addProduct" data-url=""><i class="lni lni-circle-plus"></i></button>
                                        </div>
                                    </div>
                                    <div class="row mt-3">
                                        <label class="col-sm-2 col-form-label">Ürün Alt Resim</label>
                                        <div class="col-sm-4">
                                            <input type="file" class="form-control @error('images[]') is-invalid @enderror" value="{{ old('images[]') }}" name="images[]" placeholder="Ürün Fiyatı Giriniz">
                                        </div>
                                        <div class="col-sm-4">
                                            <img src="" alt="" class="img-fluid" width="50">
                                        </div>
                                        {{--<div class="col-sm-1">
                                            <div class="btn-group">
                                                <button type="button" class="btn btn-danger removeProduct" data-url=""><i class="lni lni-trash"></i></button>
                                            </div>
                                        </div>--}}
                                    </div>
                                </div>
                            </div>
                            <div class="tab-pane fade" id="primarycontact" role="tabpanel">

                                <div class="row  mt-3">
                                    <label class="col-sm-4 col-form-label">Ürün SEO Açıklaması</label>
                                    <div class="col-sm-6 ">
                                        <textarea class="form-control @error('meta_description') is-invalid @enderror" name="meta_description" rows="4" placeholder="Ürün SEO Açıklaması Giriniz">{{ old('meta_description') }}</textarea>
                                    </div>
                                </div>

                            <div class="row mt-3">
                                <label class="col-sm-4 col-form-label">Ürün SEO Anahtar Kelimeleri</label>
                                <div class="col-sm-6 ">
                                    <input type="text" class="form-control @error('meta_keywords') is-invalid @enderror" name="meta_keywords" value="{{ old('meta_keywords') }}" placeholder="Ürün SEO Anahtar Kelimeleri Giriniz">
                                    <span>Kelimeleri <strong>,</strong> ile ayırınız. </span>
                                </div>
                            </div>
                        </div>
                        <div class="row mt-3">
                            <label class="col-sm-2 col-form-label"></label>
                            <div class="col-sm-10">
                                <button type="submit" class="btn btn-primary px-5">Kaydet</button>
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
            $('.addProduct').click(function () {
                if($('#images .imagesItem').length >= 4) {
                    alert('En fazla 5 adet resim ekleyebilirsiniz.');
                    return false;
                }
                html = `
                <div class="row mt-3 imagesItem">
                    <label class="col-sm-2 col-form-label">Ürün Alt Resim</label>
                    <div class="col-sm-4">
                        <input type="file" class="form-control @error('images[]') is-invalid @enderror" value="{{ old('images[]') }}" name="images[]" placeholder="Ürün Fiyatı Giriniz">
                    </div>
                    <div class="col-sm-4">
                        <img src="" alt="" class="img-fluid" width="50">
                    </div>
                    <div class="col-sm-1">
                        <div class="btn-group">
                            <button type="button" class="btn btn-danger removeProduct" data-url=""><i class="lni lni-trash"></i></button>
                        </div>
                    </div>
                </div>
                `
                $('#images').append(html);
            })
        })
        $('#images').on('click','.removeProduct', function () {
            $(this).closest('.imagesItem').remove();
        })
    </script>
    <script>
        $(document).ready(function(){
            $('.addType').click(function () {
                html = `
                <div class="row mt-3">
                    <label class="col-sm-4 col-form-label" style="margin-left: 7px;">Tip</label>
                    <div class="col-sm-4">
                        <input type="text" class="form-control @error('type[]') is-invalid @enderror" value="{{ old('type[]') }}" name="type[]" placeholder="Ürün Tipi Giriniz">
                    </div>
                    <div class="col-sm-1">
                        <div class="btn-group">
                            <button type="button" class="btn btn-danger removeType" data-url=""><i class="lni lni-trash"></i></button>
                        </div>
                    </div>
                </div>
                `
                $('#types').append(html);
                i++;
            })
        })
        $('#types').on('click','.removeType', function () {
            $(this).closest('.row').remove();
        })
    </script>
    <script>
            $(document).ready(function() {
                $('#categoryTag').change(function () {
                    let id = $(this).val();
                    $.ajax({
                        url: '{{ route('admin.category.getCategoryId') }}', // AJAX isteğini yönlendireceğiniz route'unuzu belirtin
                        method: 'GET',
                        data: { tag_id: id },
                        success: function (response) {
                            $('#category-result').css('display', '')
                            $('#category-results').empty();
                            $.each(response, function (key, value) {
                                $('#category-results').append('<option value="' + value.id + '">' + value.name + '</option>');
                            });
                        },
                        error: function (response) {
                            console.log(response);
                        }
                    });
                })
            });
    </script>
    <script>
        // Replace the <textarea id="editor1"> with a CKEditor 4
        // instance, using default configuration.
        let ck = document.querySelectorAll('.ckeditor1');
        for (let i = 0; i < ck.length; i++) {
            CKEDITOR.replace(ck[i], {
                height: 450,
                filebrowserUploadUrl: "{{route('admin.upload', ['_token' => csrf_token() ])}}",
                filebrowserUploadMethod: 'form'
            });
        }
    </script>
 {{--   <script>
        $(document).ready(function () {
            $('#category').on('input', function () {
                let keyword = $(this).val();

                if (keyword.length >= 3) { // 3 karakterden sonra arama yap
                    $.ajax({
                        url: '{{ route('admin.category.searchCategories') }}', // AJAX isteğini yönlendireceğiniz route'unuzu belirtin
                        method: 'GET',
                        data: { keyword: keyword },
                        success: function (response) {
                            $('#category-results').html(response);
                        }
                    });
                } else {
                    $('#category-results').html(''); // Arama terimi 3 karakterden kısa ise sonuçları temizle
                }
            });
        });
    </script>--}}
@endsection
