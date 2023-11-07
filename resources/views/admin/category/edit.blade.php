@extends('admin.layouts.app')
@section('title', 'Kategori Düzenle')
@section('content')
    <div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
        <div class="breadcrumb-title pe-3">Ekle</div>
        <div class="ps-3">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb mb-0 p-0">
                    <li class="breadcrumb-item"><a href="javascript:;"><i class="bx bx-home-alt"></i></a>
                    </li>
                    <li class="breadcrumb-item active" aria-current="page">Kategori Düzenle</li>
                </ol>
            </nav>
        </div>
    </div>
    <div class="row">
        <div class="col-xl-8 mx-auto">
            <div class="card">
                <div class="card-body">
                    <form action="{{ route('admin.category.update', ['category' => $category]) }}" method="post">
                        @csrf
                        <div class="border p-4 rounded">
                            <div class="card-title d-flex align-items-center">
                                <h5 class="mb-0">Kategori Düzenle</h5>
                            </div>
                            <hr>

                            <div class="row mt-3">
                                <label class="col-sm-4 col-form-label">Kategori Etiketi</label>
                                <div class="col-sm-8">
                                    <select name="tag_id" id="tag" class="form-select @error('tag_id') is-invalid @enderror">
                                        @foreach($categoryTags as $categoryTag)
                                            <option value="{{ $categoryTag->id }}" @if($categoryTag->id == $category->tag_id) selected @endif>{{ $categoryTag->name }}</option>
                                        @endforeach
                                    </select>
                                    @error('tag_id')
                                        <div class="invalid-feedback">
                                            {{$message}}
                                        </div>
                                    @enderror
                                </div>
                            </div>
                            <div class="row mt-3">
                                <label class="col-sm-4 col-form-label">Kategori Tipi</label>
                                <div class="col-sm-8">
                                    <select name="type" id="type" class="form-select">
                                        <option value="{{ \App\Enum\Category\CategoryTypeEnum::TR_CATEGORY }}" @if($category->type == \App\Enum\Category\CategoryTypeEnum::TR_CATEGORY) selected @endif>YURTİÇİ KATEGORİ</option>
                                        <option value="{{ \App\Enum\Category\CategoryTypeEnum::OTHER_CATEGORY }}" @if($category->type == \App\Enum\Category\CategoryTypeEnum::OTHER_CATEGORY) selected @endif>YURTDIŞI KATEGORİ</option>
                                    </select>
                                </div>

                                @error('type')
                                <div class="invalid-feedback">
                                    {{$message}}
                                </div>
                                @enderror
                            </div>
                            <div class="row mt-3">
                                <label class="col-sm-4 col-form-label">Kategori Türü</label>
                                <div class="col-sm-8">
                                    <select name="category" id="categorySelect" class="form-select">
                                        <option value="main" @if($category->parent_id == 0 ) selected @endif>ANA KATEGORİ</option>
                                        <option value="down" @if($category->parent_id != 0) selected @endif>ALT KATEGORİ KATEGORİ</option>
                                    </select>
                                </div>
                            </div>

                            <div class="row mt-3" id="getCategory" style="visibility: {{ $category->parent_id != 0 ? 'visible' : 'hidden' }} ">
                                <label class="col-sm-4 col-form-label">Kategoriler</label>
                                <div class="col-sm-8">
                                    <select name="parent_id" id="subCategories" class="form-select @error('parent_id') is-invalid @enderror">
                                        @if($category->parent_id != 0)
                                            @foreach($categories as $c)
                                                <option value="{{ $c->id }}" @if($category->parent_id == $c->id) selected @endif>{{ $c->name }}</option>
                                            @endforeach
                                        @endif
                                    </select>
                                </div>
                                @error('parent_id')
                                <div class="invalid-feedback">
                                    {{$message}}
                                </div>
                                @enderror
                            </div>

                            <div class="row  mt-3">
                                <label class="col-sm-4 col-form-label">Kategori Adı</label>
                                <div class="col-sm-8">
                                    <input type="text" class="form-control @error('name') is-invalid @enderror" value="{{ $category->name }}" name="name" placeholder="Kategori Adı">
                                    @error('name')
                                    <div class="invalid-feedback">
                                        {{$message}}
                                    </div>
                                    @enderror
                                </div>
                            </div>
                            <div class="row mt-3">
                                <label class="col-sm-2 col-form-label"></label>
                                <div class="col-sm-10">
                                    <button type="submit" class="btn btn-primary px-5">Güncelle</button>
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
    <script >
        $(document).ready(function (){
            $('#categorySelect').change(function (){
                if ($(this).val() == 'down'){
                    let type = $('#type').val()
                    let tag = $('#tag').val()
                    $.ajax({
                        url: '{{route('admin.category.getCategory')}}',
                        type: 'GET',
                        data: {
                          type: type,
                            tag_id:tag
                        },
                        success: function (response){
                            if (response.status === false)
                            {
                                alert(response.message);
                                $('#categorySelect').val('main');
                                $('#getCategory').css('visibility', 'hidden');
                                return false;
                            }
                            $('#getCategory').css('visibility', 'visible');
                            $('#subCategories').empty();
                            $.each(response, function (key, value){
                                $('#subCategories').append('<option value="'+value.id+'">'+value.name+'</option>');
                            })
                        },
                        error: function (error){
                            console.log(error);
                        }
                    })
                }else{
                    $('#getCategory').css('visibility', 'hidden');
                    $('#subCategories').empty();
                }
            })
        })
        $('#type').change(function () {
            if($('#categorySelect').val() == 'down')
            {
                let type = $('#type').val()
                let tag = $('#tag').val()
                $.ajax({
                    url: '{{route('admin.category.getCategory')}}',
                    type: 'GET',
                    data: {
                        type: type,
                        tag_id:tag
                    },
                    success: function (response){
                        if (response.status === false)
                        {
                            alert(response.message);
                            $('#categorySelect').val('main');
                            $('#getCategory').css('visibility', 'hidden');
                            return false;
                        }
                        $('#getCategory').css('visibility', 'visible');
                        $('#subCategories').empty();
                        $.each(response, function (key, value){
                            $('#subCategories').append('<option value="'+value.id+'">'+value.name+'</option>');
                        })
                    },
                    error: function (error){
                        console.log(error);
                    }
                })
            }

        })

        $(document).ready(function () {
            $('#tag').change(function () {
                {
                    let type = $('#type').val()
                    let tag = $('#tag').val()
                    if($('#categorySelect').val() == 'down')
                    {

                        $.ajax({
                            url: '{{route('admin.category.getCategory')}}',
                            type: 'GET',
                            data: {
                                type: type,
                                tag_id: tag
                            },
                            success: function (response){
                                if (response.status === false)
                                {
                                    alert(response.message);
                                    $('#categorySelect').val('main');
                                    $('#getCategory').css('visibility', 'hidden');
                                    return false;
                                }
                                $('#getCategory').css('visibility', 'visible');
                                $('#subCategories').empty();
                                $.each(response, function (key, value){
                                    $('#subCategories').append('<option value="'+value.id+'">'+value.name+'</option>');
                                })
                            },
                            error: function (error){
                                console.log(error);
                            }
                        })
                    }
                }
            });
        })
    </script>
@endsection
