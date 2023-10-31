@extends('admin.layouts.app')
@section('title', 'Yurtiçi Müşteriler')
@section('css')
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.6/css/jquery.dataTables.css" />

    <script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.js"></script>
@endsection
@section('content')

    <div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
        <div class="breadcrumb-title pe-3">Tables</div>
        <div class="ps-3">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb mb-0 p-0">
                    <li class="breadcrumb-item"><a href="javascript:;"><i class="bx bx-home-alt"></i></a>
                    </li>
                    <li class="breadcrumb-item active" aria-current="page">Yurtiçi Müşteriler</li>
                </ol>
            </nav>
        </div>
        <div class="ms-auto">
            <div class="btn-group">
                <a href="{{ route('admin.tr_customer.create', ['personal_type' => \App\Enum\Customer\CustomerPersonalTypeEnum::DOMESTIC_CUSTOMER->value]) }}" class="btn btn-primary">Yurtiçi Müşteri Ekle</a>
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
                                    <th>İŞLEMLER</th>
                                </tr>
                                </thead>
                                <tbody>
                                <tr>
                                    <td>Row 2 Data 2</td>
                                    <td>Row 2 Data 2</td>
                                    <td>Row 2 Data 2</td>
                                    <td>Row 2 Data 2</td>
                                    <td>Row 2 Data 2</td>
                                </tr>
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
                responsive: true
            });
        } );
    </script>
@endsection