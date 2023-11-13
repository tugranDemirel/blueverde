@extends('admin.layouts.app')
@section('title', 'Teklifler')
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
                    <li class="breadcrumb-item active" aria-current="page">Teklifler</li>
                </ol>
            </nav>
        </div>
        <div class="ms-auto">
            <div class="btn-group">
                <a href="{{ route('admin.offer.create') }}" class="btn btn-primary">Teklif Ekle</a>
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
                                        <th>TEKLİF TÜRÜ </th>
                                        <th>MÜŞTERİ ADI/UNVANI</th>
                                        <th>KDV ORANI</th>
                                        <th>İSKONTO ORANI</th>
                                        <th>ÜRÜN TOPLAM FİYAT</th>
                                        <th>GENEL TOPLAM</th>
                                        <th>TESLİMAT ŞEKLİ</th>

                                        <th>İŞLEMLER</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($offers as $offer)
                                    <tr>
                                        <td>{{ $offer->id }}</td>
                                        <td>
                                            @if($offer->offer_type == \App\Enum\Offer\OfferTypeEnum::DOMESTIC)
                                                <span class="badge rounded-pill alert-success">YURT İÇİ</span>
                                            @endif
                                            @if($offer->offer_type == \App\Enum\Offer\OfferTypeEnum::INTERNATIONAL)
                                                <span class="badge rounded-pill alert-success">YURT DIŞI</span>
                                            @endif
                                        </td>
                                        <td>{{ $offer->customer->name }}</td>
                                        <td>{{ $offer->tax }}</td>
                                        <td>{{ $offer->discount }}</td>
                                        <td>{{ $offer->total }}</td>
                                        <td>
                                            @if($offer->offer_type == \App\Enum\Offer\OfferTypeEnum::DOMESTIC)
                                                {{ $offer->total + ($offer->total * $offer->tax / 100) - ($offer->total * $offer->discount / 100) }}
                                            @endif
                                            @if($offer->offer_type == \App\Enum\Offer\OfferTypeEnum::INTERNATIONAL)
                                                {{ $offer->total + ($offer->total * $offer->tax / 100) - ($offer->total * $offer->discount / 100) + $offer->delivery->price }}
                                            @endif
                                        </td>
                                        <td>{{ $offer->delivery->code }}</td>
                                        <td>
                                            <div class="btn-group">
                                                <a href="{{ route('admin.offer.edit', ['offer' => $offer]) }}" class="btn btn-success"><i class="lni lni-pencil-alt"></i></a>
                                                <button type="button" class="btn btn-danger removeoffer" data-url="{{ route('admin.offer.destroy', ['offer' => $offer]) }}"><i class="lni lni-trash"></i></button>
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
            $('.removeoffer').click(function () {
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
