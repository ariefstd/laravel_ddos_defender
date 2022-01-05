@extends('layouts.dashboard')

@section('content')
<section class="home-section">
    {{ Breadcrumbs::render('detail_market', $market) }}

    <div class="text">
        @section('title')
        Market
        @endsection
        Market
    </div>

    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-6">
                                <!-- thumbnail -->
                                @if (file_exists(public_path($market->market_thumbnail)))
                                <div class="market-tumbnail" style="background-image: url('{{ asset($market->market_thumbnail) }}');">
                                </div>
                                @else
                                <svg class="img-fluid" width="100%" height="400" xmlns="http://www.w3.org/2000/svg" preserveAspectRatio="xMidYMid slice" focusable="false" role="img">
                                    <rect width="100%" height="100%" fill="#868e96"></rect>
                                    <text x="50%" y="50%" dominant-baseline="middle" text-anchor="middle" fill="#dee2e6" dy=".3em" font-size="24">
                                        {{ $market->market_name }}
                                    </text>
                                </svg>
                                @endif
                            </div>


                            <div class="col-md-6">
                                <!-- title -->
                                <h1 style="padding-top: 70px;">
                                    {{ $market->market_name }}
                                </h1>

                                <!-- Date & Created by-->
                                <p>{{ $market->region->region_name }}</p>

                                <!-- Date & Created by-->
                                <p>{{date('D, M Y', strtotime($market->created_at )) }} | Created by: {{ $market->created_by }}</p>

                                <!-- description -->
                                <b>Address:</b><br>
                                {{ $market->market_address }}

                                <br><br>
                                <!-- address -->
                                <b>Phone | Whatsapp:</b>
                                {{ $market->market_phone }} | +62 {{ $market->market_wa }}
                                <br><br>
                                <!-- description -->
                                <b>Gmap:</b>
                                <a href="{{ $market->market_gmap }}">{{ $market->market_gmap }}</a>

                                <br>
                            </div>
                        </div>

                        <div class="d-flex justify-content-end">
                            <a href="{{ route('market.index') }}" class="btn btn-warning mx-1" role="button">
                                Back
                            </a>
                        </div>
                    </div>
                </div>
            </div>


        </div>
    </div>

</section>
@endsection

@push('css-internal')
<!-- style -->
<style>
    .market-tumbnail {
        width: 100%;
        height: 400px;
        background-repeat: no-repeat;
        background-position: center;
        background-size: cover;
    }
</style>
@endpush