@extends('admin.layouts.app')
@section('title', 'Teslimat Şekli')
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
                    <li class="breadcrumb-item active" aria-current="page">Teslimat Şekli</li>
                </ol>
            </nav>
        </div>
        <div class="ms-auto">
            <div class="btn-group">
                <a href="{{ route('admin.delivery.create') }}" class="btn btn-primary">Teslimat Şekli Ekle</a>
            </div>
        </div>
    </div>
    <hr>

    <div class="card">

        <div class="card-body">
            <div class="table-responsive">
                <table class="table align-middle">
                    <thead>
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">Teslimat Adı</th>
                        <th scope="col">Teslimat Kodu</th>
                        <th scope="col">İşlemler</th>
                    </thead>
                    <tbody>
                    @foreach($deliveries as $delivery)
                        <tr>

                            <td><span>{{ $delivery->id }}</span></td>
                            <td>
                                <span>
                                    {{ $delivery->name }}
                                </span>
                            </td>
                            <td>
                                <span>
                                    {{ $delivery->code }}
                                </span>
                            </td>
                            <td>
                                <div class="d-flex align-items-center gap-3 fs-6">
                                    <a href="{{ route('admin.delivery.edit', ['delivery' => $delivery]) }}" class="text-warning" data-bs-toggle="tooltip" data-bs-placement="bottom" title="" data-bs-original-title="Düzenle" aria-label="Düzenle"><i class="bi bi-pencil-fill"></i></a>
                                    <a href="javascript:;" data-url="{{ route('admin.delivery.destroy', ['delivery' => $delivery]) }}" class="text-danger removedelivery" data-bs-toggle="tooltip" data-bs-placement="bottom" title="" data-bs-original-title="Sil" aria-label="Sil"><i class="bi bi-trash-fill"></i></a>
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
            $('.removedelivery').click(function () {
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
