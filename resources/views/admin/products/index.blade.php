@extends('admin.layouts.app')
@section('title', 'Ürünler')
@section('css')
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.6/css/jquery.dataTables.css" />

@endsection
@section('content')

    <div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
        <div class="ps-3">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb mb-0 p-0">
                    <li class="breadcrumb-item"><a href="javascript:;"><i class="bx bx-home-alt"></i></a>
                    </li>
                    <li class="breadcrumb-item active" aria-current="page">Ürünler</li>
                </ol>
            </nav>
        </div>
        <div class="ms-auto">
            <div class="btn-group">
                <a href="{{ route('admin.product.create') }}" class="btn btn-primary">Ürün Ekle</a>
                <!-- Grids in modals -->
                <button type="button" class="btn btn-success ms-2" data-bs-toggle="modal" data-bs-target="#exampleModalgrid">
                    <i class="bi bi-cloud-upload"></i>
                </button>
                <div class="modal fade" id="exampleModalgrid" tabindex="-1" aria-labelledby="exampleModalgridLabel" aria-modal="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="exampleModalgridLabel">Ürün Yükle</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                <form action="{{ route('admin.product.importExcel') }}" enctype="multipart/form-data" method="POST">
                                    @csrf
                                    <div class="row g-3">
                                        <div class="col-xxl-12">
                                            <div>
                                                <label for="importExcel" class="form-label">Excel Dosyası</label>
                                                <input type="file" class="form-control" name="file" id="importExcel">
                                            </div>
                                        </div><!--end col-->
                                        <div class="col-lg-12">
                                            <div class="hstack gap-2 justify-content-end">
                                                <button type="button" class="btn btn-danger" data-bs-dismiss="modal">İptal Et</button>
                                                <button type="submit" class="btn btn-primary">Kaydet</button>
                                            </div>
                                        </div><!--end col-->
                                    </div><!--end row-->
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <hr>
    <div class="card">
        <div class="card-body">
            <div class="table-responsive">
                <div id="example_wrapper" class="dataTables_wrapper dt-bootstrap5">

                    <div class="row">
                        <div class="col-sm-12">
                            <table id="myTable" class="display" >
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>ÜRÜN GÖRSEL</th>
                                        <th>ÜRÜN ADI</th>
                                        <th>ÜRÜN KATEGORİ</th>
                                        <th>ÜRÜN ETİKET</th>
                                        <th>ÜRÜN KODU</th>
                                        <th>FİYAT</th>
                                        <th>İŞLEMLER</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($products as $product)
                                    <tr>
                                        <td>{{ $product->id }}</td>
                                        <td>
                                            <a href="{{ asset($product->image) }}" target="_blank">
                                                <img src="{{ asset($product->image) }}" alt="{{ $product->name }}" width="50">
                                            </a>
                                        </td>
                                        <td>{{ $product->name }}</td>
                                        <td>{{ $product->category->name }}</td>
                                        <td>{{ $product->productTag->name }}</td>
                                        <td>{{ $product->code }}</td>
                                        <td>{{ $product->price }}</td>
                                        <td>
                                            <div class="btn-group">
                                                <a href="{{ route('admin.product.edit', ['product' => $product]) }}" class="btn btn-success"><i class="lni lni-pencil-alt"></i></a>
                                                <button type="button" class="btn btn-danger removeProduct" data-url="{{ route('admin.product.destroy', ['product' => $product]) }}"><i class="lni lni-trash"></i></button>
                                            </div>
                                        </td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('js')
    <script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.js"></script>
    <script>
        $(document).ready( function () {
            $('#myTable').DataTable({

            });
        } );
    </script>
    <script>
        $(document).ready(function (){
            $('.removeProduct').click(function () {
                let url = $(this).data('url')

                let id = url.split('/')[5]
                $.ajax({
                    url: url,
                    type: 'DELETE',
                    data: {
                        id: id,
                        _token: '{{ csrf_token() }}',
                    },
                    success: function (response){
                        if (response.success === true){
                            alert(response.message)
                            window.location.reload()
                        }

                        if (response.success === false){
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
