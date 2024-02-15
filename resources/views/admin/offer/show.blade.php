<!doctype html>
<html lang="tr" class="light-theme">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="author" content="Tuğran Demirel">
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <link href="{{ asset('assets/admin/css/bootstrap.min.css') }}" rel="stylesheet"/>
</head>

<body>


<div class="wrapper">

    <main class="" style="margin: 50px;">



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
                </div>
            </div>
            <div class="row" id="printContent">
                <div class="card-header py-2 bg-light">
                    <div class="row row-cols-1 row-cols-lg-3">
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
                                    <strong class="text-inverse">
                                        {{ $offer->customer->name }}
                                    </strong><br>
                                    @foreach($offer->customer->address as $address) {{ $address }} @endforeach <br>
                                     {{ $offer->customer->post_code ?? '' }}/ {{ $offer->customer->district ?? '' }}/ {{ $offer->customer->province ?? '' }}/ {{ $offer->customer->country }}<br>
                                    <br>
                                    @if($offer->offer_type == \App\Enum\Offer\OfferTypeEnum::INTERNATIONAL)
                                        Phone
                                    @else
                                        Telefon
                                    @endif
                                    : {{ $offer->customer->phone }}<br>
                                    Email: {{ $offer->customer->email }}
                                </address>
                            </div>
                        </div>
                        <div class="col">
                            <div class="">

                            </div>
                        </div>
                        <div class="col">

                            <div class="row">
                                <div class="col-md-9">
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
                                <div class="col-md-3">
                                    <img src="{{ asset('images/bluverde-logo.png') }}" alt=""  style="margin-top: -50px; margin-left: -35px;" class="fluid">
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
                                        Product
                                    @else
                                        Ürün
                                    @endif
                                </th>
                                <th>
                                    @if($offer->offer_type == \App\Enum\Offer\OfferTypeEnum::INTERNATIONAL)
                                        Size
                                    @else
                                        Ebat
                                    @endif
                                </th>
                                <th>
                                    @if($offer->offer_type == \App\Enum\Offer\OfferTypeEnum::INTERNATIONAL)
                                        Features
                                    @else
                                        Özellikler
                                    @endif
                                </th>
                                <th class="text-center" width="10%">
                                    @if($offer->offer_type == \App\Enum\Offer\OfferTypeEnum::INTERNATIONAL)
                                        Quantity
                                    @else
                                        Adet
                                    @endif
                                </th>
                                <th class="text-right" width="20%">
                                    @if($offer->offer_type == \App\Enum\Offer\OfferTypeEnum::INTERNATIONAL)
                                        Unit Price
                                    @else
                                        Birim Fiyat
                                    @endif
                                </th>
                                <th class="text-right" width="20%">
                                    @if($offer->offer_type == \App\Enum\Offer\OfferTypeEnum::INTERNATIONAL)
                                        Total
                                    @else
                                        Toplam
                                    @endif
                                </th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($offer->productOffers as $product)
                                <tr>
                                    <td>
                                        <span class="text-inverse">{{ $product->name }}</span><br>
                                    </td>
                                    <td>
                                        <span class="text-inverse">{{ $product->product_size }}</span><br>
                                    </td>
                                    <td>
                                        <span class="text-inverse">{{ $product->material }}</span>
                                        <span class="text-inverse">{{ $product->color }}</span>

                                        <span class="text-inverse">
                                            {{ $product->type }}
                                        </span><br>
                                    </td>
                                    <td style="text-align: center">{{ $product->quantity }}</td>
                                    <td class="text-right">{{ $product->price }}</td>
                                    <td class="text-right">{{ $product->quantity * $product->price.' '. $product->currency }} </td>
                                </tr>
                            @endforeach
                            </tbody>
                            <tfoot>
                                <tr class="table-active">
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td class="col-1 text-right">
                                        @if($offer->offer_type == \App\Enum\Offer\OfferTypeEnum::INTERNATIONAL)
                                            Products Total
                                        @else
                                            Ürünler Toplamı
                                        @endif
                                    </td>
                                    <td class="col-1 text-right">

                                        @php
                                            $total = 0;
                                        @endphp
                                        @php
                                            foreach ($offer->productOffers as $product){
                                                $total += $product->quantity * $product->price;
                                            }
                                        @endphp
                                        {{ $total }}
                                    </td>
                                </tr>
                                <tr>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td class="col-1 text-right">
                                        @if($offer->offer_type == \App\Enum\Offer\OfferTypeEnum::INTERNATIONAL)
                                             %{{ $offer->tax }} Tax
                                        @else
                                             %{{ $offer->tax }} KDV
                                        @endif
                                    </td>
                                    <td class="col-1 text-right">
                                        @php
                                            $total = 0;
                                        @endphp
                                        @php
                                            foreach ($offer->productOffers as $product){
                                                $total += $product->quantity * $product->price;
                                            }
                                        @endphp
                                        {{ $total * $offer->tax / 100 }}
                                    </td>
                                </tr>
                                @if(isset($offer->discount))
                                <tr>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td class="col-1 text-right">
                                        @if($offer->offer_type == \App\Enum\Offer\OfferTypeEnum::INTERNATIONAL)
                                             %{{ $offer->discount }} Discount
                                        @else
                                             %{{ $offer->discount }} İskonto
                                        @endif
                                    </td>
                                    <td class="col-1 text-right">
                                        @php
                                            $total = 0;
                                        @endphp
                                        @php
                                            foreach ($offer->productOffers as $product){
                                                $total += $product->quantity * $product->price;
                                            }
                                        @endphp
                                        {{ $total * $offer->discount / 100 }}
                                    </td>
                                </tr>
                                @endif
                                <tr class="table-active">
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td class="col-1 text-right">
                                        @if($offer->offer_type == \App\Enum\Offer\OfferTypeEnum::INTERNATIONAL)
                                            Total
                                        @else
                                            Toplam
                                        @endif
                                    </td>
                                    <td class="col-1 text-right">
                                        @php
                                            $total = 0;
                                        @endphp
                                        @php
                                            foreach ($offer->productOffers as $product){
                                                $total += $product->quantity * $product->price;
                                            }
                                        @endphp
                                        {{ $total + ($total * $offer->tax / 100) - ($total * $offer->discount / 100) }}
                                    </td>
                                </tr>
                            </tfoot>
                        </table>
                    </div>

                    <hr>
                    <div class="my-3">
                        {!! $offer->term_of_offer !!}
                    </div>
                </div>
            </div>
            <div class="card-footer py-3">

                <p class="text-center mb-2">
                    @if($offer->offer_type == \App\Enum\Offer\OfferTypeEnum::INTERNATIONAL)
                        BV TEKSTİL TİCARET LTD ŞTİ
                        <br>
                        Orta Bayır Mahallesi Şair Çelebi Sokak No 1/3 Kağıthane İstanbul
                        <br>
                        V D : ZİNCİRLİKUYU           V NO : 19 50 84 66 05
                    @else
                        BV TEKSTİL TİCARET LTD ŞTİ
                        <br>
                        Orta Bayır Mahallesi Şair Çelebi Sokak No 1/3 Kağıthane İstanbul
                        <br>
                        V.D : ZİNCİRLİKUYU  &nbsp &nbsp &nbsp         V.NO : 19 50 84 66 05
                    @endif

                </p>
                  <p class="text-center d-flex align-items-center gap-3 justify-content-center mb-0">
                      <span class=""><i class="bi bi-globe"></i> www.blu-verde.com</span>
                      <span class=""><i class="bi bi-telephone-fill"></i> T:+90(533)-244-9428</span>
                      <span class=""><i class="bi bi-envelope-fill"></i> info@blu-verde.com</span>
                  </p>
            </div>
        </div>

    </main>


</div>


</body>
<script>
    document.addEventListener("DOMContentLoaded", (event) => {
       window.print()
    });z
</script>
</html>
