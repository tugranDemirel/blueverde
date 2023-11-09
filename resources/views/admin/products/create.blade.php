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
                    <form action="{{ route('admin.product.store') }}" method="post">
                        @csrf
                        <div class="border p-4 rounded">
                            <div class="card-title d-flex align-items-center">
                                <h5 class="mb-0">Ürün Ekle</h5>
                            </div>
                            <hr>

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
                         {{--   @endif@if($categories->count() > 0)
                            <div class="row  mt-3">
                                <label class="col-sm-4 col-form-label">Kategori</label>
                                <div class="col-sm-6">
                                    <select name="category" id="category" class="form-control">
                                        <option value="">Ana Kategori</option>
                                        @foreach($categories as $category)
                                            <option value="{{ $category->id }}">{{ $category->name }}</option>
                                            @if($category->children)
                                                @include('admin.products.subcategories', ['subcategories' => $category->children, 'prefix' => '-'])
                                            @endif
                                        @endforeach
                                    </select>

                                </div>
                            </div>
                            @else
                                <div class="row  mt-3">
                                    <label class="col-sm-4 col-form-label">Kategori</label>
                                    <div class="col-sm-6">
                                        <div class="alert alert-warning">
                                            Lütfen <strong>Kategori</strong> Ekleyiniz.
                                        </div>
                                    </div>
                                </div>
                            @endif--}}
                            <div class="row  mt-3">
                                <label class="col-sm-4 col-form-label">Ürün Adı</label>
                                <div class="col-sm-6">
                                    <input type="text" class="form-control @error('name') is-invalid @enderror" value="{{ old('name') }}" name="name" placeholder="Ürün Adı Giriniz">
                                </div>
                            </div>
                            <div class="row  mt-3">
                                <label class="col-sm-4 col-form-label">Ürün Kodu</label>
                                <div class="col-sm-6">
                                    <input type="text" class="form-control @error('code') is-invalid @enderror" value="{{ old('code') }}" name="code" placeholder="Ürün Kodu Giriniz">
                                </div>
                            </div>
                            <div class="row  mt-3">
                                <label class="col-sm-4 col-form-label">Ürün Fiyatı</label>
                                <div class="col-sm-6">
                                    <input type="number" class="form-control @error('price') is-invalid @enderror" value="{{ old('price') }}" name="price" placeholder="Ürün Fiyatı Giriniz">
                                </div>
                            </div>
                            <div class="row  mt-3">
                                <div class="col-sm-12 ">
                                    <label for="">Ürün Açıklaması</label>
                                    <textarea class="form-control ckeditor1 @error('description') is-invalid @enderror" name="description" rows="4" placeholder="Ürün Açıklaması Giriniz">{{ old('description') }}</textarea>
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
                height: 650,
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
