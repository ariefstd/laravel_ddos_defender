@extends('layouts.dashboard')

@section('content')
<section class="home-section">
    {{ Breadcrumbs::render('detail_promo', $promo) }}

    <div class="text">
        @section('title')
        Promo
        @endsection
        Promo
    </div>

    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-body">
                        <!-- thumbnail -->
                        @if (file_exists(public_path($promo->promo_thumbnail)))
                        <div class="promo-tumbnail" style="background-image: url('{{ asset($promo->promo_thumbnail) }}');">
                        </div>
                        @else
                        <svg class="img-fluid" width="100%" height="400" xmlns="http://www.w3.org/2000/svg" preserveAspectRatio="xMidYMid slice" focusable="false" role="img">
                            <rect width="100%" height="100%" fill="#868e96"></rect>
                            <text x="50%" y="50%" dominant-baseline="middle" text-anchor="middle" fill="#dee2e6" dy=".3em" font-size="24">
                                {{ $promo->promo_title }}
                            </text>
                        </svg>
                        @endif

                        <!-- title -->
                        <h1 style="padding-top: 70px;">
                            {{ $promo->promo_title }}
                        </h1>

                        <!-- Date & Created by-->
                        <p>{{date('D, M Y', strtotime($promo->created_at )) }} | Created by: {{ $promo->created_by }}</p>

                        <!-- description -->
                        {!! $promo->promo_description !!}

                        <div class="d-flex justify-content-end">
                            <a href="{{ route('promo.index') }}" class="btn btn-warning mx-1" role="button">
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
    .promo-tumbnail {
        width: 100%;
        height: 400px;
        background-repeat: no-repeat;
        background-position: center;
        background-size: cover;
    }
</style>
@endpush