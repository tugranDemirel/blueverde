@extends('admin.layouts.app')
@section('title', isset($currency) ? 'Para Birimi Düzenle' : 'Para Birimi Ekle' )
@section('css')
    <link href="{{ asset('assets/admin/plugins/select2/css/select2.min.css') }}" rel="stylesheet" />
    <link href="{{ asset('assets/admin/plugins/select2/css/select2-bootstrap4.css') }}" rel="stylesheet" />
    <link href="{{ asset('assets/admin/plugins/metismenu/css/metisMenu.min.css') }}" rel="stylesheet" />
@endsection
@section('content')
    <div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
        <div class="breadcrumb-title pe-3">Ekle</div>
        <div class="ps-3">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb mb-0 p-0">
                    <li class="breadcrumb-item"><a href="javascript:;"><i class="bx bx-home-alt"></i></a>
                    </li>
                    <li class="breadcrumb-item active" aria-current="page">{{ isset($currency) ? 'Para Birimi Düzenle' : 'Para Birimi Ekle' }}</li>
                </ol>
            </nav>
        </div>
    </div>
    <div class="row">
        <div class="col-xl-8 mx-auto">
            <div class="card">
                <div class="card-body">
                    <form action="{{ isset($currency) ? route('admin.currency.update', ['currency' => $currency]) : route('admin.currency.store') }}" method="post">
                        @isset($currency)
                            @method('PUT')
                        @endisset
                        @csrf
                        <div class="border p-4 rounded">
                            <div class="card-title d-flex align-items-center">
                                <h5 class="mb-0">{{ isset($currency) ? 'Para Birimi Düzenle' : 'Para Birimi Ekle' }}</h5>
                            </div>
                            <hr>


                            <div class="row  mt-3">
                                <label class="col-sm-4 col-form-label">Para Birimi Adı</label>
                                <div class="col-sm-8">
                                    <input type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ isset($currency) ? $currency->name : old('name') }}" placeholder="Para Birimi Adı">
                                    @error('name')
                                    <div class="invalid-feedback">
                                        {{$message}}
                                    </div>
                                    @enderror
                                </div>
                            </div>

                            <div class="row  mt-3">
                                <label class="col-sm-4 col-form-label">Para Birimi Kodu</label>
                                <div class="col-sm-8">
                                    <input type="text" class="form-control @error('code') is-invalid @enderror" name="code" value="{{ isset($currency) ? $currency->code : old('code') }}" placeholder="Para Birimi Kodu">
                                    @error('code')
                                    <div class="invalid-feedback">
                                        {{$message}}
                                    </div>
                                    @enderror
                                </div>
                            </div>
                            <div class="row  mt-3">
                                <label class="col-sm-4 col-form-label">Para Birimi Sembolü</label>
                                <div class="col-sm-8">
                                    <input type="text" class="form-control @error('symbol') is-invalid @enderror" name="symbol" value="{{ isset($currency) ? $currency->symbol : old('symbol') }}" placeholder="Para Birimi Sembolü">
                                    @error('symbol')
                                    <div class="invalid-feedback">
                                        {{$message}}
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
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
