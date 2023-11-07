@extends('admin.layouts.app')
@section('title', 'Kategoriler')
@section('css')
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.6/css/jquery.dataTables.css" />

    <script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.js"></script>
@endsection
@section('content')

    <div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
        <div class="ps-3">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb mb-0 p-0">
                    <li class="breadcrumb-item"><a href="javascript:;"><i class="bx bx-home-alt"></i></a>
                    </li>
                    <li class="breadcrumb-item active" aria-current="page">Kategoriler</li>
                </ol>
            </nav>
        </div>
        <div class="ms-auto">
            <div class="btn-group">
                <a href="{{ route('admin.category.create') }}" class="btn btn-primary">Kategori Ekle</a>
            </div>
        </div>
    </div>
    <hr>

    <div class="card">
        <div class="card-header">
            <div class="card-header py-3">
                <form action="{{ route('admin.category.index') }}">
                    <div class="row align-items-center m-0">
                        <div class="col-md-3 col-12 mb-md-0 mb-3">
                            <label for="">Kategori Etiketi</label>
                            <select name="tag" class="form-select">
                                <option value="all" {{ request()->has('type') && request()->type == 'all' ? 'selected' : '' }}>HEPSİ</option>
                                @foreach($categoryTags as $tag)
                                    <option value="{{ $tag->id }}" {{ request()->has('tag') && request()->tag == $tag->id ? 'selected' : '' }}>{{ $tag->name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-md-3 col-12 mb-md-0 mb-3">
                            <label for="">Kategori Tipi</label>
                            <select name="type" class="form-select">
                                <option value="all" {{ request()->has('type') && request()->type == 'all' ? 'selected' : '' }}>HEPSİ</option>
                                <option value="domestic" {{ request()->has('type') && request()->type == 'domestic' ? 'selected' : '' }}>YURTİÇİ</option>
                                <option value="overseas" {{ request()->has('type') && request()->type == 'overseas' ? 'selected' : '' }}>YURTDIŞI</option>
                            </select>
                        </div>
                        <div class="col-md-3 col-12 mb-md-0 mb-3">
                            <label for="">Kategori Türü</label>
                            <select name="parent" class="form-select">
                                <option value="all" {{ request()->has('parent') && request()->parent == 'all' ? 'selected' : '' }}>HEPSİ</option>
                                <option value="main" {{ request()->has('parent') && request()->parent == 'main' ? 'selected' : '' }}>ANA KATEGORİ</option>
                                <option value="sub" {{ request()->has('parent') && request()->parent == 'sub' ? 'selected' : '' }}>ALT KATEGORİ</option>
                            </select>
                        </div>
                        <div class="col-md-3 col-12 mb-md-0 mb-3">
                            <button class="btn btn-sm btn-primary" style="margin-top: 22px;">
                                <i class="lni lni-search-alt"></i>
                            </button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table align-middle">
                    <thead>
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">Kategori Adı</th>
                        <th scope="col">Kategori Tipi</th>
                        <th scope="col">Kategori Türü</th>
                        <th scope="col">İşlemler</th>
                    </thead>
                    <tbody>
                    @foreach($categories as $category)
                        <tr>

                            <td><span>{{ $category->id }}</span></td>
                            <td>
                                <span>
                                    <a href="{{ route('admin.category.index', ['category' => $category->id]) }}">{{ $category->name }}</a>
                                </span>
                            </td>
                            <td>
                                @if($category->type == \App\Enum\Category\CategoryTypeEnum::TR_CATEGORY )
                                    <span class="badge rounded-pill alert-success">YURTİÇİ</span>
                                @else
                                    <span class="badge rounded-pill alert-warning">YURTDIŞI</span>
                                @endif
                            </td>
                            <td>

                                @if($category->parent_id == 0 )
                                    <span class="badge rounded-pill alert-success">ANA KATEGORİ</span>
                                @else
                                    <span class="badge rounded-pill alert-warning">ALT KATEGORİ</span>
                                @endif
                            </td>
                            <td>
                                <div class="d-flex align-items-center gap-3 fs-6">
                                    <a href="{{ route('admin.category.edit', ['category' => $category]) }}" class="text-warning" data-bs-toggle="tooltip" data-bs-placement="bottom" title="" data-bs-original-title="Düzenle" aria-label="Düzenle"><i class="bi bi-pencil-fill"></i></a>
                                    <a href="javascript:;" data-url="{{ route('admin.category.destroy', ['category' => $category]) }}" class="text-danger removeCategory" data-bs-toggle="tooltip" data-bs-placement="bottom" title="" data-bs-original-title="Sil" aria-label="Sil"><i class="bi bi-trash-fill"></i></a>
                                </div>
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection

@section('js')
    <script>
        $(document).ready(function (){
            $('.removeCategory').click(function () {
                let url = $(this).data('url')

                let id = url.split('/')[6]
               $.ajax({
                    url: url,
                    type: 'POST',
                    data: {
                        id: id,
                        _token: '{{ csrf_token() }}',
                    },
                    success: function (response){
                        if (response.status === true){
                            alert(response.message)
                            window.location.reload()
                        }

                        if (response.status === false){
                            alert(response.message)
                            window.location.reload()
                        }

                    },
                    error: function (response){
                        alert(response.message)
                    }
                })

            })
        })
    </script>
@endsection
