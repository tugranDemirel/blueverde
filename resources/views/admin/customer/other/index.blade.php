@extends('admin.layouts.app')
@section('title', 'Yurtdışı Müşteriler')
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
                    <li class="breadcrumb-item active" aria-current="page">Yurtdışı Müşteriler</li>
                </ol>
            </nav>
        </div>
        <div class="ms-auto">
            <div class="btn-group">
                <a href="{{ route('admin.other_customer.create', ['personal_type' => \App\Enum\Customer\CustomerPersonalTypeEnum::OVERSEAS_CUSTOMER->value]) }}" class="btn btn-primary">Yurtdışı Müşteri Ekle</a>
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
                                    <th>AD/UNVAN</th>
                                    <th>ÜLKE</th>
                                    <th>ŞEHİR</th>
                                    <th>İLÇE</th>
                                    <th>İŞLEMLER</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($customers as $customer)
                                <tr>
                                    <td>{{ $customer->id }}</td>
                                    <td>{{ $customer->name }}</td>
                                    <td>{{ $customer->country }}</td>
                                    <td>{{ $customer->province }}</td>
                                    <td>{{ $customer->district }}</td>
                                    <td>
                                        <div class="btn-group">
                                            <a href="{{ route('admin.other_customer.edit', ['customer' => $customer, 'personal_type' => $customer->personal_type]) }}" class="btn btn-success"><i class="lni lni-pencil-alt"></i></a>
                                            <button type="button" class="btn btn-danger removeCustomer" data-url="{{ route('admin.other_customer.destroy', ['customer' => $customer, 'personal_type' => $customer->personal_type]) }}"><i class="lni lni-trash"></i></button>
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
    <script>
        $(document).ready( function () {
            $('#myTable').DataTable({

            });
        } );
    </script>
    <script>
        $(document).ready(function (){
            $('.removeCustomer').click(function () {
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
