@extends('layouts.dashboard')

@section('content')
<section class="home-section">
    {{ Breadcrumbs::render('detail_stall', $stall) }}

    <div class="text">
        @section('title')
        Stall
        @endsection
        Stall
    </div>

    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-7">
                                <!-- thumbnail -->
                                @if (file_exists(public_path($stall->stall_cover)))
                                <div class="stall-tumbnail" style="background-image: url('{{ asset($stall->stall_cover) }}');">
                                </div>
                                @else
                                <svg class="img-fluid" width="100%" height="400" xmlns="http://www.w3.org/2000/svg" preserveAspectRatio="xMidYMid slice" focusable="false" role="img">
                                    <rect width="100%" height="100%" fill="#868e96"></rect>
                                    <text x="50%" y="50%" dominant-baseline="middle" text-anchor="middle" fill="#dee2e6" dy=".3em" font-size="24">
                                        {{ $stall->stall_name }}
                                    </text>
                                </svg>
                                @endif
                            </div>
                            <div class="col-md-5">
                                <!-- title -->
                                <h1 style="padding-top: 20px;">
                                    {{ $stall->stall_name }}
                                </h1>

                                <!-- Date & Created by-->
                                <p>{{ $stall->market->market_name }}</p>

                                <!-- Date & Created by-->
                                <p>{{date('D, M Y', strtotime($stall->created_at )) }} | Created by: {{ $stall->created_by }}</p>

                                <!-- description -->
                                <b>Address:</b><br>
                                {{ $stall->stall_address }}
                                <br><br>

                                <b>Description:</b><br>
                                <!-- description -->
                                {!! $stall->stall_desc !!}


                                <!-- address -->
                                <b>Phone | Whatsapp:</b>
                                {{ $stall->stall_phone }} | +62 {{ $stall->stall_wa }}
                                <br><br>
                                <!-- description -->
                                <b>Gmap:</b>
                                <a href="{{ $stall->stall_gmap }}">{{ $stall->stall_gmap }}</a>
                            </div>
                        </div>

                        <div class="d-flex justify-content-end">
                            <a href="{{ route('stall.index') }}" class="btn btn-warning mx-1" role="button">
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
    .stall-tumbnail {
        width: 100%;
        height: 400px;
        background-repeat: no-repeat;
        background-position: center;
        background-size: cover;
    }
</style>
@endpush