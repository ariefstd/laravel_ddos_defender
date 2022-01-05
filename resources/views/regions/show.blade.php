@extends('layouts.dashboard')

@section('content')
<section class="home-section">
    {{ Breadcrumbs::render('detail_region', $region) }}

    <div class="text">
        @section('title')
        Region
        @endsection
        Region
    </div>

    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-6">
                                <!-- thumbnail -->

                                <svg class="img-fluid" width="100%" height="100%" xmlns="http://www.w3.org/2000/svg" preserveAspectRatio="xMidYMid slice" focusable="false" role="img">
                                    <rect width="100%" height="100%" fill="#868e96"></rect>
                                    <text x="50%" y="50%" dominant-baseline="middle" text-anchor="middle" fill="#dee2e6" dy=".3em" font-size="24">
                                        {{ $region->region_name }}
                                    </text>
                                </svg>
                            </div>
                            <div class="col-md-6">
                                <!-- Region -->
                                <h2 style="padding-top: 30px;">
                                    {{ $region->region_name }}
                                </h2>

                                <p>
                                    {{ $region->city->city_name }}
                                </p>
                            </div>
                        </div>





                        <div class="d-flex justify-content-end">
                            <a href="{{ route('region.index') }}" class="btn btn-warning mx-1" role="button">
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