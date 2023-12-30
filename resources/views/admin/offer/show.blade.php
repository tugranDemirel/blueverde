<!doctype html>
<html lang="tr" class="light-theme">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="author" content="Tuğran Demirel">
    <link rel="icon" href="{{ asset('assets/admin/images/favicon-32x32.png') }}" type="image/png"/>
    <!--plugins-->
    <link href="{{ asset('assets/admin/plugins/simplebar/css/simplebar.css') }}" rel="stylesheet"/>
    <link href="{{ asset('assets/admin/plugins/perfect-scrollbar/css/perfect-scrollbar.css') }}" rel="stylesheet"/>
    <link href="{{ asset('assets/admin/plugins/metismenu/css/metisMenu.min.css') }}" rel="stylesheet"/>
    <link href="{{ asset('assets/admin/plugins/vectormap/jquery-jvectormap-2.0.2.css') }}" rel="stylesheet"/>
    <link href="{{ asset('assets/admin/plugins/datatable/css/dataTables.bootstrap5.min.css') }}" rel="stylesheet"/>
    <!-- Bootstrap CSS -->
    <link href="{{ asset('assets/admin/css/bootstrap.min.css') }}" rel="stylesheet"/>
    <link href="{{ asset('assets/admin/css/bootstrap-extended.css') }}" rel="stylesheet"/>
    <link href="{{ asset('assets/admin/css/style.css') }}" rel="stylesheet"/>
    <link href="{{ asset('assets/admin/css/icons.css') }}" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;500&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.5.0/font/bootstrap-icons.css">

    <!-- loader-->
    <link href="{{ asset('assets/admin/css/pace.min.css') }}" rel="stylesheet"/>

    <!--Theme Styles-->
    <link href="{{ asset('assets/admin/css/dark-theme.css') }}" rel="stylesheet"/>
    <link href="{{ asset('assets/admin/css/light-theme.css') }}" rel="stylesheet"/>
    <link href="{{ asset('assets/admin/css/semi-dark.css') }}" rel="stylesheet"/>
    <link href="{{ asset('assets/admin/css/header-colors.css') }}" rel="stylesheet"/>
</head>

<body>


<!--start wrapper-->
<div class="wrapper">
    <!--start top header-->
    <!--end top header-->

    <!--start sidebar -->

    <!--start content-->
    <main class="" style="margin: 50px;">
        <!--breadcrumb-->
        <div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
            <div class="breadcrumb-title pe-3">Teklifler</div>
            <div class="ps-3">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb mb-0 p-0">
                        <li class="breadcrumb-item"><a href="javascript:;"><i class="bx bx-home-alt"></i></a>
                        </li>
                        <li class="breadcrumb-item active" aria-current="page">Teklif Detay</li>
                    </ol>
                </nav>
            </div>
        </div>
        <!--end breadcrumb-->


        <div class="card border shadow-none">
            <div class="card-header py-3">
                <div class="row align-items-center g-3">
                    <div class="col-12 col-lg-6">
                        <h5 class="mb-0">
                            @if($offer->offer_type == \App\Enum\Offer\OfferTypeEnum::INTERNATIONAL)
                                B V TEXTILE LIMITED COMPANY
                            @else
                                B V TEKSTİL LİMİTED ŞİRKETİ
                            @endif
                        </h5>
                    </div>
                    <div class="col-12 col-lg-6 text-md-end">
                        {{--                        <a href="javascript:;" class="btn btn-sm btn-danger me-2"><i class="bi bi-file-earmark-pdf-fill"></i> PDF</a>--}}
                        <a href="javascript:;"
                           onclick="document.getElementById('print').style.visibility = 'hidden'; window.print(); document.getElementById('print').style.visibility = 'visible'; "
                           id="print" class="btn btn-sm btn-secondary"><i class="bi bi-printer-fill"></i> Yazdır ya da
                            Kaydet</a>
                    </div>
                </div>
            </div>
            <div class="row" id="printContent">
                <div class="card-header py-2 bg-light">
                    <div class="row row-cols-1 row-cols-lg-3">
                        <div class="col">

                            <div class="row">
                                <div class="col-md-3">
                                    <img src="{{ asset('images/bluverde-logo.png') }}" alt=""  style="margin-top: -50px; margin-left: -25px;" class="fluid">
                                </div>
                                <div class="col-md-9">
                                    <small>
                                        @if($offer->offer_type == \App\Enum\Offer\OfferTypeEnum::INTERNATIONAL)
                                            From
                                        @else
                                            Teklif Yapan
                                        @endif
                                    </small>
                                    <address class="m-t-5 m-b-5">
                                        <strong class="text-inverse">
                                            @if($offer->offer_type == \App\Enum\Offer\OfferTypeEnum::INTERNATIONAL)
                                                B V TEXTILE LIMITED COMPANY
                                            @else
                                                B V TEKSTİL LİMİTED ŞİRKETİ
                                            @endif
                                        </strong><br>@if($offer->offer_type == \App\Enum\Offer\OfferTypeEnum::INTERNATIONAL)

                                            Ortabayır District <br> Şair Çelebi Street Number:1/3 <br>
                                            34413 Kagithane/Istanbul/Turkey
                                        @else
                                            Ortabayır Mahallesi <br> Şair Çelebi Sokak No:1/3 <br>
                                            34413 Kağıthane/İstanbul/Türkiye
                                        @endif

                                        <br>
                                        @if($offer->offer_type == \App\Enum\Offer\OfferTypeEnum::INTERNATIONAL)
                                            Phone
                                        @else
                                            Telefon
                                        @endif
                                        : +90(533)-244-9428<br>
                                        Email: info@blu-verde.com
                                    </address>
                                </div>

                            </div>
                        </div>
                        <div class="col">
                            <div class="">
                                <small>
                                    @if($offer->offer_type == \App\Enum\Offer\OfferTypeEnum::INTERNATIONAL)
                                        To
                                    @else
                                        Teklif Yapılan
                                    @endif
                                </small>
                                <address class="m-t-5 m-b-5">
                                    <strong class="text-inverse">{{ $offer->customer->name }}</strong><br>
                                    @foreach( $offer->customer->address as $address)
                                        {{ $address }}<br>
                                    @endforeach
                                    {{ $offer->customer->post_code }}
                                    {{ $offer->customer->district }}/{{ $offer->customer->province }}/{{ $offer->customer->country }}
                                    <br>
                                    @if($offer->offer_type == \App\Enum\Offer\OfferTypeEnum::INTERNATIONAL)
                                        Phone
                                    @else
                                        Telefon
                                    @endif : {{ $offer->customer->phone }}<br>
                                    Email: {{ $offer->customer->email }}
                                </address>
                            </div>
                        </div>
                        <div class="col">
                            <div class="">
                                <small>
                                    @if($offer->offer_type == \App\Enum\Offer\OfferTypeEnum::INTERNATIONAL)
                                        Order Date
                                    @else
                                        Teklif Tarihi
                                    @endif
                                </small>
                                <div class=""><b>
                                        {{
                                            \Carbon\Carbon::parse($offer->created_at)->format('d/m/Y')
                                        }}
                                    </b></div>
                                <div class="invoice-detail">
                                    #{{ $offer->id }}<br>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-invoice">
                            <thead>
                            <tr>
                                <th>
                                    @if($offer->offer_type == \App\Enum\Offer\OfferTypeEnum::INTERNATIONAL)
                                        Product Name
                                    @else
                                        Ürün Adı
                                    @endif
                                </th>
                                <th class="text-center" width="10%">
                                    @if($offer->offer_type == \App\Enum\Offer\OfferTypeEnum::INTERNATIONAL)
                                        Product Category
                                    @else
                                        Ürün Kategorisi
                                    @endif
                                </th>
                                <th class="text-center" width="10%">
                                    @if($offer->offer_type == \App\Enum\Offer\OfferTypeEnum::INTERNATIONAL)
                                        Product Code
                                    @else
                                        Ürün Kodu
                                    @endif
                                </th>
                                <th class="text-center" width="10%">
                                    @if($offer->offer_type == \App\Enum\Offer\OfferTypeEnum::INTERNATIONAL)
                                        Product Quantity
                                    @else
                                        Ürün Adet
                                    @endif
                                </th>
                                <th class="text-right" width="20%">
                                    @if($offer->offer_type == \App\Enum\Offer\OfferTypeEnum::INTERNATIONAL)
                                        Product Price
                                    @else
                                        Ürün Fiyatı
                                    @endif
                                </th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($offer->products as $product)
                                <tr>
                                    <td>
                                        <span class="text-inverse">{{ $product['name'] }}</span><br>
                                    </td>
                                    <td class="text-center">{{ $product['category'] }}</td>
                                    <td class="text-center">{{ $product['code'] }}</td>
                                    <td style="text-align: center">{{ $product['quantity'] }}</td>
                                    <td class="text-right">{{ $product['price'] }}</td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>

                    <div class="row bg-light align-items-center m-0">
                        <div class="col col-auto p-4">
                            <p class="mb-0">
                                @if($offer->offer_type == \App\Enum\Offer\OfferTypeEnum::INTERNATIONAL)
                                    Subtotal
                                @else
                                    Ara Toplam
                                @endif
                            </p>
                            <h4 class="mb-0">{{ $offer->total }}</h4>
                        </div>
                        <div class="col col-auto p-4">
                            <i class="bi bi-plus-lg text-muted"></i>
                        </div>
                        <div class="col col-auto p-4">
                            <p class="mb-0">
                                @if($offer->offer_type == \App\Enum\Offer\OfferTypeEnum::INTERNATIONAL)
                                    Discount
                                @else
                                    İskonto
                                @endif
                            </p>
                            <h4 class="mb-0">%{{ $offer->discount }}</h4>
                        </div>
                        <div class="col col-auto p-4">
                            <i class="bi bi-plus-lg text-muted"></i>
                        </div>
                        <div class="col col-auto me-auto p-4">
                            <p class="mb-0">
                                @if($offer->offer_type == \App\Enum\Offer\OfferTypeEnum::INTERNATIONAL)
                                    Tax
                                @else
                                    KDV
                                @endif
                            </p>
                            <h4 class="mb-0">%{{ $offer->tax }}</h4>
                        </div>
                        <div class="col bg-dark col-auto p-4">
                            <p class="mb-0 text-white">
                                @if($offer->offer_type == \App\Enum\Offer\OfferTypeEnum::INTERNATIONAL)
                                    Total
                                @else
                                    Toplam
                                @endif
                            </p>
                            <h4 class="mb-0 text-white">
                                {{ $offer->total + ($offer->total * $offer->tax / 100) - ($offer->total * $offer->discount / 100) }}
                            </h4>
                        </div>

                    </div><!--end row-->

                    <hr>
                    <!-- begin invoice-note -->
                    <div class="my-3">
                        {!! $offer->term_of_offer !!}
                    </div>
                    <!-- end invoice-note -->
                </div>
            </div>
            <div class="card-footer py-3">
                <p class="text-center mb-2">
                    @if($offer->offer_type == \App\Enum\Offer\OfferTypeEnum::INTERNATIONAL)
                        THANK YOU FOR CHOOSING US
                    @else
                        BİZİ TERCİH ETTİĞİNİZ İÇİN TEŞEKKÜR EDERİZ
                    @endif

                </p>
                {{--  <p class="text-center d-flex align-items-center gap-3 justify-content-center mb-0">
                      <span class=""><i class="bi bi-globe"></i> www.domain.com</span>
                      <span class=""><i class="bi bi-telephone-fill"></i> T:+11-0462879</span>
                      <span class=""><i class="bi bi-envelope-fill"></i> info@example.com</span>
                  </p>--}}
            </div>
        </div>

    </main>
    <!--end page main-->

    <!--end switcher-->

</div>
<!--end wrapper-->


<!-- Bootstrap bundle JS -->
<script src="{{ asset('assets/admin/js/bootstrap.bundle.min.js') }}"></script>
<!--plugins-->
<script src="{{ asset('assets/admin/js/jquery.min.js') }}"></script>
<script src="{{ asset('assets/admin/plugins/simplebar/js/simplebar.min.js') }}"></script>
<script src="{{ asset('assets/admin/plugins/metismenu/js/metisMenu.min.js') }}"></script>
<script src="{{ asset('assets/admin/plugins/easyPieChart/jquery.easypiechart.js') }}"></script>
<script src="{{ asset('assets/admin/plugins/peity/jquery.peity.min.js') }}"></script>
<script src="{{ asset('assets/admin/plugins/perfect-scrollbar/js/perfect-scrollbar.js') }}"></script>
<script src="{{ asset('assets/admin/js/pace.min.js') }}"></script>
<!--app-->
<script src="{{ asset('assets/admin/js/app.js') }}"></script>
<script src="{{ asset('assets/admin/js/index.js') }}"></script>

</body>
</html>
