@extends('layouts.dashboard')

@section('content')
<section class="home-section">
    {{ Breadcrumbs::render('detail_city', $city) }}

    <div class="text">
        @section('title')
        City
        @endsection
        City
    </div>

    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-body">
                        <!-- thumbnail -->

                        <svg class="img-fluid" width="100%" height="400" xmlns="http://www.w3.org/2000/svg" preserveAspectRatio="xMidYMid slice" focusable="false" role="img">
                            <rect width="100%" height="100%" fill="#868e96"></rect>
                            <text x="50%" y="50%" dominant-baseline="middle" text-anchor="middle" fill="#dee2e6" dy=".3em" font-size="24">
                                {{ $city->city_name }}
                            </text>
                        </svg>


                        <!-- name -->
                        <h2 style="padding-top: 30px;">
                            {{ $city->city_name }}
                        </h2>

                        <div class="d-flex justify-content-end">
                            <a href="{{ route('city.index') }}" class="btn btn-warning mx-1" role="button">
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
    .banner-tumbnail {
        width: 100%;
        height: 400px;
        background-repeat: no-repeat;
        background-position: center;
        background-size: cover;
    }
</style>
@endpush