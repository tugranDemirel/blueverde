@extends('admin.layouts.app')
@section('title', 'Ürün Düzenle')
@section('css')
    <link href="{{ asset('assets/admin/plugins/select2/css/select2.min.css') }}" rel="stylesheet" />
    <link href="{{ asset('assets/admin/plugins/select2/css/select2-bootstrap4.css') }}" rel="stylesheet" />
    <link href="{{ asset('assets/admin/plugins/metismenu/css/metisMenu.min.css') }}" rel="stylesheet" />
    <script src="https://cdn.ckeditor.com/4.10.0/standard/ckeditor.js"></script>
@endsection
@section('content')
    <div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
        <div class="breadcrumb-title pe-3">Düzenle</div>
        <div class="ps-3">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb mb-0 p-0">
                    <li class="breadcrumb-item"><a href="javascript:;"><i class="bx bx-home-alt"></i></a>
                    </li>
                    <li class="breadcrumb-item active" aria-current="page">Ürün Düzenle</li>
                </ol>
            </nav>
        </div>
    </div>
    <div class="row">
        <div class="col-xl-8 mx-auto">
            <div class="card">
                <div class="card-body">
                    <form action="{{ route('admin.product.update', ['product' => $product]) }}" method="post" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')

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
                                                    <option value="{{ $tag->id }}" @if($product->product_tag_id == $tag->id) selected @endif>{{ $tag->name }}</option>
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
                                            <select id="categoryTag" class="form-control">
                                                <option  selected>Kategori Etiketi Seçiniz</option>
                                                @foreach($categoryTags as $tag)
                                                    <option value="{{ $tag->id }}" @if($tag->id == $product->category->categoryTag->id) selected @endif>{{ $tag->name }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                    <div class="row  mt-3" id="category-result">
                                        <label class="col-sm-4 col-form-label">Kategoriler</label>
                                        <div class="col-sm-6">
                                            <select name="category_id" id="category-results" class="form-control">
                                                @foreach($categories as $category)
                                                    <option value="{{ $category->id }}" @if($product->category_id == $category->id) selected @endif>{{ $category->name }}</option>
                                                @endforeach
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
                                {{--@if($categories->count() > 0)
                                   <div class="row  mt-3">
                                       <label class="col-sm-4 col-form-label">Kategoriler</label>
                                       <div class="col-sm-6">
                                           <select name="category_id" id="category" class="form-control">
                                               @foreach($categories as $category)
                                                   <option value="{{ $category->id }}" @if($product->category_id == $category->id) selected @endif>{{ $category->name }}</option>
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
                                        <input type="text" class="form-control @error('name') is-invalid @enderror" value="{{ $product->name }}" name="name" placeholder="Ürün Adı Giriniz">
                                    </div>
                                </div>
                                <div class="row  mt-3">
                                    <label class="col-sm-4 col-form-label">Ürün Kodu</label>
                                    <div class="col-sm-6">
                                        <input type="text" class="form-control @error('code') is-invalid @enderror" name="code" value="{{ $product->code }}" placeholder="Ürün Kodu Giriniz">
                                    </div>
                                </div>
                                <div class="row  mt-3">
                                    <label class="col-sm-4 col-form-label">Ürün Ana Resmi</label>
                                    <div class="col-sm-6">
                                        <input type="file" class="form-control @error('image') is-invalid @enderror" value="{{ old('image') }}" name="image" >
                                    </div>
                                    <div class="col-sm-2">
                                        <a href="{{ $product->image }}" target="_blank">
                                            <img src="{{ asset($product->image) }}" alt="{{ $product->name }}" width="50">
                                        </a>
                                    </div>
                                </div>
                                <div class="row  mt-3">
                                    <label class="col-sm-4 col-form-label">Ürün Fiyatı</label>
                                    <div class="col-sm-3">
                                        <input type="number" class="form-control @error('price') is-invalid @enderror" name="price" value="{{ $product->price }}" placeholder="Ürün Fiyatı Giriniz">
                                    </div>
                                    <div class="col-sm-3">
                                        <div class="input-group">
                                            <select name="system_currency_id" id="" class="form-select">
                                                @foreach($currencies as $currency)
                                                    <option value="{{ $currency->id }}" @if($product->system_currency_id == $currency->id) selected @endif>{{ $currency->name }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <div class="row  mt-3">
                                    <div class="col-sm-12 ">
                                        <label for="">Ürün Açıklaması</label>
                                        <textarea class="form-control ckeditor1 @error('description') is-invalid @enderror" name="description" rows="4" placeholder="Ürün Açıklaması Giriniz">{{ $product->description }}</textarea>
                                    </div>
                                </div>
                            </div>
                            <div class="tab-pane fade" id="primaryprofile" role="tabpanel">

                                <div class="row  mt-3 " id="images">
                                        <div class="col-sm-1">
                                            <div class="btn-group">
                                                <button type="button" class="btn btn-success addProduct" data-url=""><i class="lni lni-circle-plus"></i></button>
                                            </div>
                                        </div>
                                    @foreach($product->medias as $media)

                                    <div class="row mt-3 imagesItem">
                                        <label class="col-sm-2 col-form-label">Ürün Alt Resim</label>
                                        <div class="col-sm-4">
                                            <img src="{{ asset($media->path) }}" data-path="{{ $media->id }}" alt="" class="img-fluid" width="50">
                                        </div>

                                        <div class="col-sm-1">
                                            <div class="btn-group">
                                                <button type="button" class="btn btn-danger removeProduct" data-url=""><i class="lni lni-trash"></i></button>
                                            </div>
                                        </div>
                                    </div>

                                    @endforeach
                                </div>
                            </div>
                            <div class="tab-pane fade" id="primarycontact" role="tabpanel">

                                <div class="row  mt-3">
                                    <label class="col-sm-4 col-form-label">Ürün SEO Açıklaması</label>
                                    <div class="col-sm-6 ">
                                        <textarea class="form-control @error('meta_description') is-invalid @enderror" name="meta_description" rows="4" placeholder="Ürün SEO Açıklaması Giriniz">{{ $product->meta_description }}</textarea>
                                    </div>
                                </div>

                                <div class="row mt-3">
                                    <label class="col-sm-4 col-form-label">Ürün SEO Anahtar Kelimeleri</label>
                                    <div class="col-sm-6 ">
                                        <input type="text" class="form-control @error('meta_keywords') is-invalid @enderror" name="meta_keywords" value="{{ $product->meta_keywords }}" placeholder="Ürün SEO Anahtar Kelimeleri Giriniz">
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
                if($('#images .imagesItem').length >= 5) {
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
            event.preventDefault();
            let path = $(this).closest('.imagesItem').find('img').data('path');
            if(path != undefined)
            {
                $.ajax({
                    url: '{{ route('admin.product.deleteImage') }}',
                    method: 'POST',
                    data: {
                        id: path,
                        _token: '{{ csrf_token() }}'
                    },
                    success: function (res) {
                        if(res.status == true)
                        {
                            alert(res.message);
                        }
                    },
                    error: function (res) {
                        console.log(res);
                    }
                })
            }
            $(this).closest('.imagesItem').remove();
            console.log(path)
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

        $(document).ready(function() {
            $('#categoryTag').change(function () {
                let id = $(this).val();
                $.ajax({
                    url: '{{ route('admin.category.getCategoryId') }}', // AJAX isteğini yönlendireceğiniz route'unuzu belirtin
                    method: 'GET',
                    data: { tag_id: id },
                    success: function (response) {
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
@endsection
