@extends('admin.layouts.app')
@section('title', isset($offer) ? 'Teklif Düzenle' : 'Teklif Ekle' )
@section('css')
    <script src="https://cdn.ckeditor.com/4.10.0/standard/ckeditor.js"></script>
    <meta name="getCustomer" content="{{ route('admin.offer.getCustomer') }}">
    <meta name="getProduct" content="{{ route('admin.offer.getProduct') }}">
@endsection
@section('content')
    <div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
        <div class="breadcrumb-title pe-3">Ekle</div>
        <div class="ps-3">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb mb-0 p-0">
                    <li class="breadcrumb-item"><a href="javascript:;"><i class="bx bx-home-alt"></i></a>
                    </li>
                    <li class="breadcrumb-item active" aria-current="page">{{ isset($offer) ? 'Teslimat Şekli Düzenle' : 'Teslimat Şekli Ekle' }}</li>
                </ol>
            </nav>
        </div>
    </div>
    <div class="row">
        <div class="col-xl-9 mx-auto">
            <div class="card">
                <div class="card-body">
                    <form action="{{ route('admin.offer.store') }}" method="post">
                        @csrf
                        <div class="row mt-3">
                            <label class="col-sm-4 col-form-label">Teklif Türü</label>
                            <div class="col-sm-8">
                                <select class="form-select @error('offer_type') is-invalid @enderror" name="offer_type" id="offer_type">
                                    <option name="" id="">SEÇİNİZ</option>
                                    <option value="{{ \App\Enum\Offer\OfferTypeEnum::DOMESTIC }}">YURT İÇİ</option>
                                    <option value="{{ \App\Enum\Offer\OfferTypeEnum::INTERNATIONAL }}">YURTDIŞI</option>
                                </select>
                                @error('offer_type')
                                 <div class="invalid-feedback">
                                        {{ $message }}
                                 </div>
                                @enderror
                            </div>
                        </div>
                        <div class="row mt-3 customers" style="visibility: hidden;">
                            <label class="col-sm-4 col-form-label">Müşteriler</label>
                            <div class="col-sm-8">
                                <select class="form-select @error('customer_id') is-invalid @enderror" name="customer_id" id="costumer_id">
                                </select>

                                @error('customer_id')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                                @enderror
                            </div>
                        </div>

                        <div class="row mt-3">
                            <label class="col-sm-4 col-form-label">Ürün Etiketi</label>
                            <div class="col-sm-8">
                                <select class="form-select @error('product_tag_id') is-invalid @enderror" id="product_tag" name="product_tag_id">
                                    <option >SEÇİNİZ</option>
                                    @foreach($productTags as $productTag)
                                        <option value="{{ $productTag->id }}">{{ $productTag->name }}</option>
                                    @endforeach
                                </select>

                                @error('product_tag_id')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                                @enderror
                            </div>
                        </div>
                        <div class="row mt-5 productTable" style="visibility: ">
                            <div class="col-md-2 mb-4">
                                <input type="text" id="myInput" onkeyup="myFunction()" class="form-control" placeholder="Ürün Adına Göre Ara">
                            </div>
                            <table id="myTable" class="display" >
                                <thead>
                                    <tr>
                                        <th></th>
                                        <th>#</th>
                                        <th>KATEGORİ</th>
                                        <th>ÜRÜN ADI</th>
                                        <th>ÜRÜN EBADI</th>
                                        <th>TİP</th>
                                        <th>ÜRÜN MALZEME</th>
                                        <th>ÜRÜN RENGİ</th>
                                        <th>ÜRÜN DETAY</th>
                                        <th>FİYAT</th>
                                        <th>PARA BİRİMİ</th>
                                    </tr>
                                </thead>
                                <tbody>
                                </tbody>
                            </table>
                        </div>
                        <div class="row mt-5 productSelects">
                            <div class="col-sm-4 col-form-label">Seçilen Ürünler</div>
                            <div class="col-sm-12">
                                <table class="table">
                                    <thead>
                                        <tr>
                                        <tr>
                                            <th>#</th>
                                            <th>KATEGORİ</th>
                                            <th>ÜRÜN ADI</th>
                                            <th>ÜRÜN EBADI</th>
                                            <th>TİP</th>
                                            <th>ÜRÜN MALZEME</th>
                                            <th>ÜRÜN RENGİ</th>
                                            <th>ÜRÜN DETAY</th>
                                            <th>ADET</th>
                                            <th>FİYAT</th>
                                            <th>PARA BİRİMİ</th>
                                            <th></th>
                                        </tr>
                                        </tr>
                                    </thead>
                                    <tbody >
                                    </tbody>
                                </table>


                                @error('products')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                                @enderror
                            </div>
                        </div>
                        <div class="row mt-5">
                            <label class="col-sm-2 col-form-label">Toplam Ürün Fiyatı</label>
                            <div class="col-sm-8">
                                <input type="text" class="form-control-plaintext @error('total') is-invalid @enderror" name="total" id="">
                            </div>
                        </div>
                        <div class="row mt-5">
                            <label class="col-sm-2 col-form-label">İskonto</label>

                            <div class="col-md-3">
                                <div class="input-group">
                                    <input type="number" class="form-control @error('discount') is-invalid @enderror" name="discount" value="0" min="0">
                                    <span class="input-group-text" id="basic-addon2">%</span>
                                    @error('discount')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-3">
                                <button type="button" id="discount" class="btn btn-primary btn-sm">Hesapla</button>
                            </div>
                            <label class="col-sm-2 col-form-label" id="discountValue"></label>
                        </div>
                        <div class="row mt-5">
                            <label class="col-sm-2 col-form-label">KDV</label>

                            <div class="col-md-3">
                                <div class="input-group">
                                    <input type="number" class="form-control @error('tax') is-invalid @enderror" name="tax" value="0" min="0">
                                    <span class="input-group-text" id="basic-addon2">%</span>
                                    @error('tax')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-3">
                                <button type="button" id="tax" class="btn btn-primary btn-sm">Hesapla</button>
                            </div>
                            <label class="col-sm-2 col-form-label" id="taxValue"></label>
                        </div>


                        <div class="row mt-5">
                            <label class="col-sm-2 col-form-label">Teslimat Şekli</label>
                            <div class="col-sm-8">
                                <select name="delivery_id" class="form-select @error('delivery_id') is-invalid @enderror" id="delivery_id">
                                    <option value="">SEÇİNİZ</option>
                                    @foreach($deliveries as $delivery)
                                        <option value="{{ $delivery->id }}">{{ $delivery->name }}</option>
                                    @endforeach
                                </select>
                                @error('delivery_id')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                                @enderror
                            </div>
                        </div>
                        <div class="row mt-5">
                            <label class="col-sm-2 col-form-label">Teklif Şartı</label>
                            <div class="col-sm-8">
                                <select name="" class="form-select @error('term_of_offer') is-invalid @enderror" id="term_of_offer">
                                    <option value="">SEÇİNİZ</option>
                                    @foreach($term_of_offers as $term_of_offer)
                                        <option data-desc="{{ $term_of_offer->description }}" value="{{ $term_of_offer->id }}">{{ $term_of_offer->name }}</option>
                                    @endforeach
                                </select>
                                @error('term_of_offer')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                                @enderror
                            </div>
                            <div class="col-sm-12 mt-5 " id="textarea" style="visibility: hidden">
                                <textarea name="term_of_offer" class="form-control ckeditor1" id="offerDesc" cols="30" rows="10"></textarea>
                                @error('term_of_offer')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                                @enderror
                            </div>
                        </div>

                        <div class="row mt-3">
                            <label class="col-sm-2 col-form-label"></label>
                            <div class="col-sm-10">
                                <button type="submit" class="btn btn-primary px-5">Kaydet</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('js')
    <script>
        $(document).ready(function(){
            $('name=[delivery_id]').val()
            console.log($('name=["delivery_id"]').val())
        })
    </script>
    <script>
        $(document).ready(function (){
            $('#offer_type').on('change', function (){
                let offer_type = $(this).val();
                let url = $("meta[name='getCustomer']").attr("content");
                $.ajax({
                    url: url,
                    type: "POST",
                    data: {
                        _token: "{{ csrf_token() }}",
                        offer_type: offer_type
                    },
                    success: function (response){
                        $('.customers').css('visibility', 'visible');
                        $('#costumer_id').empty();
                        $.each(response,function (index, value){
                            $('#costumer_id').append('<option value="'+value.id+'">'+value.name+'</option>');
                        })
                    },
                    error: function (response){
                        $('.customers').css('visibility', 'hidden');
                        $('#costumer_id').empty();
                        alert(response.message)
                    }
                })
            })
        })

        $(document).ready(function () {
            $('#product_tag').change(function () {
                let product_tag = $(this).val();
                let url = $("meta[name='getProduct']").attr("content");
                $.ajax({
                    url: url,
                    type: "POST",
                    data: {
                        _token: "{{ csrf_token() }}",
                        product_tag: product_tag
                    },
                    success: function (response){
                        $('.productTable').css('visibility', 'visible');
                        $('#myTable tbody').empty();
                        $.each(response, function (key, value) {
                            console.log(value.type)
                            $('#myTable tbody').append('<tr class="product">' +
                                //'<td><input type="checkbox" class="form-check productSelect" name="product_select"></td>' +
                                '<td><button type="button" class="btn btn-success btn-sm productSelect">+</button></td>' +
                                '<td>'+value.id+'</td>' +
                                '<td>'+value.category.name+'</td>' +
                                '<td>'+value.name+'</td>' +
                                '<td>'+value.product_size+'</td>' +
                                '<td>'+ value.type +'</td>' +
                                '<td>'+value.material+'</td>' +
                                '<td>'+value.color+'</td>' +
                                '<td>'+value.detail+'</td>' +
                                '<td>'+value.price+'</td>' +
                                '<td>'+value.currency.symbol+'</td>' +
                                '<td style="visibility: hidden">'+value.product_tag_id+'</td>' +
                                '</tr>');
                                // '<input type="hidden" name="product_tag_id" value="'+ value.product_tag_id +'">'
                        })
                    },
                    error: function (response){
                        $('.productTable').css('visibility', 'hidden');
                        $('#myTable tbody').empty();
                        alert(response.message)
                    }
                })
            })
        })

        $('#myTable tbody').on('click', '.productSelect', function (){

                let id = $(this).closest('tr').find('td:eq(1)').text();
                let category = $(this).closest('tr').find('td:eq(2)').text();
                let name = $(this).closest('tr').find('td:eq(3)').text();
            let product_size = $(this).closest('tr').find('td:eq(4)').text();
                let type = $(this).closest('tr').find('td:eq(5)').text();
                let metarial = $(this).closest('tr').find('td:eq(6)').text();
                let color = $(this).closest('tr').find('td:eq(7)').text();
            let detail = $(this).closest('tr').find('td:eq(8)').text();
            let price = $(this).closest('tr').find('td:eq(9)').text();
            let currency_id = $(this).closest('tr').find('td:eq(10)').text();
            let product_tag_id = $(this).closest('tr').find('td:eq(11)').text();
                let total = 0;
                $('.productSelects tbody').append('<tr class="productSelectsBody">' +
                    '<td><input type="text" name="products[product_id][]" class="form-control-plaintext form-select-sm" readonly value="'+id+'"</td>' +
                    '<td><input type="text" name="products[category][]" class="form-control-plaintext form-select-sm" readonly value="'+category+'"</td>' +
                    '<td><input type="text" name="products[name][]" class="form-control-plaintext form-select-sm readonly" value="'+name+'"</td>' +
                    '<td><input type="text" name="products[product_size][]" class="form-control-plaintext form-select-sm" readonly value="'+product_size+'"</td>' +
                    '<td><input type="text" name="products[type][]" class="form-control-plaintext form-select-sm" readonly value="'+type+'"</td>' +
                    '<td><input type="text" name="products[material][]" class="form-control-plaintext form-select-sm" readonly value="'+metarial+'"</td>' +
                    '<td><input type="text" name="products[color][]" class="form-control-plaintext form-select-sm" readonly value="'+color+'"</td>' +
                    '<td><input type="text" name="products[detail][]" class="form-control-plaintext form-select-sm" readonly value="'+detail+'"</td>' +
                    '<td><input type="text" name="products[quantity][]" class="form-control form-select-sm quantity" value="'+ 1 +'"</td>' +
                    '<td><input type="text" name="products[price][]" class="form-control form-select-sm prices" value="'+price+'"</td>' +
                    '<td><input type="text" name="products[currency][]" class="form-control-plaintext form-select-sm " readonly value="'+currency_id+'"</td>' +
                    '<td><input type="hidden" name="products[product_tag_id][]" class="form-control-plaintext form-select-sm " readonly value="'+product_tag_id+'"</td>' +
                    '<td><a type="button" class="btn btn-danger btn-sm removeProduct" >-</td>' +
                    '</tr>');
                    $('.productSelects tbody tr').each(function (){
                        let price = $(this).find('.prices').val();
                        total += parseInt(price);
                    })
                    $('input[name="total"]').val(total);
        });

        $('.productSelects tbody').on('click', '.removeProduct', function (){
            let price = $(this).closest('tr').find('.prices').val();
            let quantity = $(this).closest('tr').find('.quantity').val();
            let total = $('input[name="total"]').val();
            let id = $(this).closest('tr').find('td:eq(0)').text();
            let totalDiscount = parseInt(total - (price * quantity));
            $('input[name="total"]').val(totalDiscount);
            $('#myTable tbody').find('td:contains('+id+')').closest('tr').find('.productSelect').prop('checked', false);
            $(this).closest('tr').remove();
        })

        $('.productSelects tbody').on('change', '.quantity', function (){
            var total = 0;
            $('.productSelects tbody tr').each(function (){
                let price = $(this).find('.prices').val();
                let quantity = $(this).find('.quantity').val();
                total += parseInt(price) * parseInt(quantity);
            })
            $('input[name="total"]').val(total);
        })

        $('.productSelects tbody').on('change', '.prices', function (){
            var total = 0;
            $('.productSelects tbody tr').each(function (){
                let price = $(this).find('.prices').val();
                let quantity = $(this).find('.quantity').val();
                total += parseInt(price) * parseInt(quantity);
            })
            $('input[name="total"]').val(total);
        })

        $('#discount').click(function (){

            var total = 0;
            let discount = $('input[name="discount"]').val();
            if (discount > 100){
                alert('İskonto 100 den büyük olamaz');
                $(this).val('');
                return false;
            }
            if (discount < 0){
                alert('İskonto 0 dan küçük olamaz');
                $(this).val('');
                return false;
            }
            if (discount == '' || discount == null || discount == undefined || discount == 0){
                discount = 0;
            }
            $('.productSelects tbody tr').each(function (){
                let price = $(this).find('.prices').val();
                let quantity = $(this).find('.quantity').val();
                total += parseInt(price) * parseInt(quantity);
            })
            var totalDiscount = total - ((total * discount) / 100);
            $('#discountValue').text(totalDiscount);
        })

        $('#tax').click(function (){
            let discount = $('input[name="discount"]').val();
            var total = 0;
            let tax = $('input[name="tax"]').val();
            if (tax > 100){
                alert('KDV 100 den büyük olamaz');
                $(this).val('');
                return false;
            }
            if (tax < 0){
                alert('KDV 0 dan küçük olamaz');
                $(this).val('');
                return false;
            }
            if (tax == '' || tax == null || tax == undefined || tax == 0){
                tax = 0;
            }
            $('.productSelects tbody tr').each(function (){
                let price = $(this).find('.prices').val();
                let quantity = $(this).find('.quantity').val();
                total += parseInt(price) * parseInt(quantity);
            })
            total = total - ((total * discount) / 100);
            var totalDiscount = total + ((total * tax) / 100);
            $('#taxValue').text(totalDiscount);
        })


        $('#term_of_offer').change(function (){

            let desc = $(this).find(':selected').data('desc');
            $('#textarea').css('visibility', 'visible');
            let veri = $('#offerDesc').val(desc);
            // CKEditor'a veriyi yaz
            CKEDITOR.instances['offerDesc'].setData(desc);
        })
    </script>
    <script>
        // Replace the <textarea id="editor1"> with a CKEditor 4
        // instance, using default configuration.
        let ck = document.querySelectorAll('.ckeditor1');
        for (let i = 0; i < ck.length; i++) {
            CKEDITOR.replace(ck[i], {
                height: 650,
                filebrowserUploadUrl: "{{route('admin.upload', ['_token' => csrf_token() ])}}",
                filebrowserUploadMethod: 'form'
            });
        }
    </script>
    <script>
        function myFunction() {
            // Declare variables
            var input, filter, table, tr, td, i, txtValue;
            input = document.getElementById("myInput");
            filter = input.value.toUpperCase();
            table = document.getElementById("myTable");
            tr = table.getElementsByTagName("tr");

            // Loop through all table rows, and hide those who don't match the search query
            for (i = 0; i < tr.length; i++) {
                td = tr[i].getElementsByTagName("td")[3];
                if (td) {
                    txtValue = td.textContent || td.innerText;
                    if (txtValue.toUpperCase().indexOf(filter) > -1) {
                        tr[i].style.display = "";
                    } else {
                        tr[i].style.display = "none";
                    }
                }
            }
        }
    </script>
@endsection
