
<!DOCTYPE html>
<html class="no-js" lang="en">


<meta http-equiv="content-type" content="text/html;charset=utf-8" />
<head>
    <!-- Meta Tags -->
    <meta charset="utf-8">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="author" content="Laralink">
    <!-- Site Title -->
    <title>
        @if($offer->offer_type == \App\Enum\Offer\OfferTypeEnum::INTERNATIONAL)
            B V TEXTILE LIMITED COMPANY
        @else
            B V TEKSTİL LİMİTED ŞİRKETİ
        @endif
    </title>
    <link rel="stylesheet" href="{{ asset('pdf/assets/css/style.css') }}">
</head>

<body>
<div class="tm_container">
    <div class="tm_invoice_wrap">
        <div class="tm_invoice tm_style1" id="tm_download_section">
            <div class="tm_invoice_in">
                <div class="tm_invoice_head tm_align_center tm_mb20">
                    <div class="tm_invoice_left">

                        <div class="tm_primary_color  tm_text_uppercase">
                            @if($offer->offer_type == \App\Enum\Offer\OfferTypeEnum::INTERNATIONAL)
                                B V TEXTILE LIMITED COMPANY
                            @else
                                B V TEKSTİL LİMİTED ŞİRKETİ
                            @endif
                        </div>
                    </div>
                    <div class="tm_invoice_right tm_text_right">
                    </div>
                </div>
                <div class="tm_invoice_info tm_mb20">
                    <div class="tm_invoice_seperator tm_gray_bg"></div>
                    <div class="tm_invoice_info_list">
                        <p class="tm_invoice_number tm_m0">
                            @if($offer->offer_type == \App\Enum\Offer\OfferTypeEnum::INTERNATIONAL)
                                Invoice No
                            @else
                                Fatura No
                            @endif:
                             <b class="tm_primary_color"> #{{ $offer->id }}</b></p>
                        <p class="tm_invoice_date tm_m0">
                            @if($offer->offer_type == \App\Enum\Offer\OfferTypeEnum::INTERNATIONAL)
                                Order Date
                            @else
                                Teklif Tarihi
                            @endif:
                            <b class="tm_primary_color">
                                {{
                                               \Carbon\Carbon::parse($offer->created_at)->format('d/m/Y')
                                           }}
                            </b></p>
                    </div>
                </div>
                <div class="tm_invoice_head tm_mb10">
                    <div class="tm_invoice_left">
                        <p class="tm_mb2"><b class="tm_primary_color">
                                @if($offer->offer_type == \App\Enum\Offer\OfferTypeEnum::INTERNATIONAL)
                                    To
                                @else
                                    Teklif Yapılan
                                @endif
                            </b></p>
                        <p>
                            {{ $offer->customer->name }} <br>
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
                        </p>
                    </div>
                    <div class="tm_invoice_right tm_text_right">

                        <div class=""><img src="{{ asset('images/bluverde-logo.png') }}" alt="Logo"></div>
                    </div>
                </div>
                <div class="tm_table tm_style1 tm_mb30">
                    <div class="tm_round_border">
                        <div class="tm_table_responsive">
                            <table>
                                <thead>
                                <tr>
                                    <th class="tm_width_3 tm_semi_bold tm_primary_color tm_gray_bg">
                                        @if($offer->offer_type == \App\Enum\Offer\OfferTypeEnum::INTERNATIONAL)
                                            Product
                                        @else
                                            Ürün
                                        @endif
                                    </th>
                                    <th class="tm_width_4 tm_semi_bold tm_primary_color tm_gray_bg">
                                        @if($offer->offer_type == \App\Enum\Offer\OfferTypeEnum::INTERNATIONAL)
                                            Size
                                        @else
                                            Ebat
                                        @endif
                                    </th>
                                    <th class="tm_width_2 tm_semi_bold tm_primary_color tm_gray_bg">
                                        @if($offer->offer_type == \App\Enum\Offer\OfferTypeEnum::INTERNATIONAL)
                                            Features
                                        @else
                                            Özellikler
                                        @endif
                                    </th>
                                    <th class="tm_width_1 tm_semi_bold tm_primary_color tm_gray_bg">
                                        @if($offer->offer_type == \App\Enum\Offer\OfferTypeEnum::INTERNATIONAL)
                                            Quantity
                                        @else
                                            Adet
                                        @endif
                                    </th>
                                    <th class="tm_width_1 tm_semi_bold tm_primary_color tm_gray_bg">
                                        @if($offer->offer_type == \App\Enum\Offer\OfferTypeEnum::INTERNATIONAL)
                                            Unit Price
                                        @else
                                            Birim Fiyat
                                        @endif
                                    </th>
                                    <th class="tm_width_2 tm_semi_bold tm_primary_color tm_gray_bg tm_text_right">
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
                                    <td class="tm_width_3">
                                        {{ $product->name }}
                                    </td>
                                    <td class="tm_width_4">
                                        {{ $product->product_size }}
                                    </td>
                                    <td class="tm_width_2">
                                        <span class="text-inverse">{{ $product->material }}</span>
                                        <span class="text-inverse">{{ $product->color }}</span>

                                        <span class="text-inverse">
                                            {{ $product->type }}
                                        </span><br>
                                    </td>
                                    <td class="tm_width_1">{{ $product->quantity }}</td>
                                    <td class="tm_width_1">{{ $product->price }}</td>
                                    <td class="tm_width_2 tm_text_right">{{ $product->quantity * $product->price.' '. $product->currency }}</td>
                                </tr>
                                @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <div class="tm_invoice_footer">
                        <div class="tm_left_footer">
                           {{-- <p class="tm_mb2"><b class="tm_primary_color">Payment info:</b></p>
                            <p class="tm_m0">Credit Card - 236***********928 <br>Amount: $1732</p>--}}
                        </div>
                        <div class="tm_right_footer tm_left_footer">
                            <table>
                                <tbody>
                                <tr>
                                    <td class="tm_width_3 tm_primary_color tm_border_none tm_bold">
                                        @if($offer->offer_type == \App\Enum\Offer\OfferTypeEnum::INTERNATIONAL)
                                            Products Total
                                        @else
                                            Ürünler Toplamı
                                        @endif
                                    </td>
                                    <td class="tm_width_3 tm_primary_color tm_text_right tm_border_none tm_bold">
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
                                    <td class="tm_width_3 tm_primary_color tm_border_none tm_pt0">@if($offer->offer_type == \App\Enum\Offer\OfferTypeEnum::INTERNATIONAL)
                                            Tax
                                        @else
                                            KDV
                                        @endif <span class="tm_ternary_color">({{ $offer->tax }}%)</span></td>
                                    <td class="tm_width_3 tm_primary_color tm_text_right tm_border_none tm_pt0">
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
                                    <td class="tm_width_3 tm_primary_color tm_border_none tm_pt0">@if($offer->offer_type == \App\Enum\Offer\OfferTypeEnum::INTERNATIONAL)
                                            Discount
                                        @else
                                            İskonto
                                        @endif <span class="tm_ternary_color">({{ $offer->discount }}%)</span></td>
                                    <td class="tm_width_3 tm_primary_color tm_text_right tm_border_none tm_pt0">
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
                                <tr class="tm_border_top tm_border_bottom">
                                    <td class="tm_width_3 tm_border_top_0 tm_bold tm_f16 tm_primary_color">
                                        @if($offer->offer_type == \App\Enum\Offer\OfferTypeEnum::INTERNATIONAL)
                                            Total
                                        @else
                                            Toplam
                                        @endif
                                    </td>
                                    <td class="tm_width_3 tm_border_top_0 tm_bold tm_f16 tm_primary_color tm_text_right">
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
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
                <div class="tm_padd_15_20 tm_round_border">

                    <ul class="tm_m0 tm_note_list"  style="list-style: none;">
                        <li>
                            {!! $offer->term_of_offer !!}
                        </li>
                    </ul>
                </div><!-- .tm_note -->
                <div class="tm_padd_15_20 ">
                    <ul class="tm_m0 tm_note_list" style="text-align: center; list-style: none">
                        <li>
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
                        </li>
                    </ul>
                </div><!-- .tm_note -->
                <div class="tm_padd_15_20 ">
                    <ul class="tm_m0 tm_note_list" style="text-align: center; list-style: none">
                        <li>
                            <span class="">
                                www.blu-verde.com</span>
                        </li>
                        <li>
                            <span class="">+90(533)-244-9428</span>
                        </li>
                        <li>
                            <span class="">
                                info@blu-verde.com
                            </span>

                        </li>
                    </ul>
                </div><!-- .tm_note -->
            </div>
        </div>
        <div class="tm_invoice_btns tm_hide_print">
            <a href="javascript:window.print()" class="tm_invoice_btn tm_color1">
          <span class="tm_btn_icon">
            <svg xmlns="http://www.w3.org/2000/svg" class="ionicon" viewBox="0 0 512 512"><path d="M384 368h24a40.12 40.12 0 0040-40V168a40.12 40.12 0 00-40-40H104a40.12 40.12 0 00-40 40v160a40.12 40.12 0 0040 40h24" fill="none" stroke="currentColor" stroke-linejoin="round" stroke-width="32"/><rect x="128" y="240" width="256" height="208" rx="24.32" ry="24.32" fill="none" stroke="currentColor" stroke-linejoin="round" stroke-width="32"/><path d="M384 128v-24a40.12 40.12 0 00-40-40H168a40.12 40.12 0 00-40 40v24" fill="none" stroke="currentColor" stroke-linejoin="round" stroke-width="32"/><circle cx="392" cy="184" r="24" fill='currentColor'/></svg>
          </span>
                <span class="tm_btn_text">Print</span>
            </a>
            <button id="tm_download_btn" class="tm_invoice_btn tm_color2">
          <span class="tm_btn_icon">
            <svg xmlns="http://www.w3.org/2000/svg" class="ionicon" viewBox="0 0 512 512"><path d="M320 336h76c55 0 100-21.21 100-75.6s-53-73.47-96-75.6C391.11 99.74 329 48 256 48c-69 0-113.44 45.79-128 91.2-60 5.7-112 35.88-112 98.4S70 336 136 336h56M192 400.1l64 63.9 64-63.9M256 224v224.03" fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="32"/></svg>
          </span>
                <span class="tm_btn_text">Download</span>
            </button>
        </div>
    </div>
</div>
<script src="{{ asset('pdf/assets/js/jquery.min.js') }}"></script>
<script src="{{ asset('pdf/assets/js/jspdf.min.js') }}"></script>
<script src="{{ asset('pdf/assets/js/html2canvas.min.js') }}"></script>
<script src="{{ asset('pdf/assets/js/main.js') }}"></script>
</body>

</html>
