@extends('layouts.dashboard')

@section('content')
<section class="home-section">
    {{ Breadcrumbs::render('detail_partner', $partner) }}

    <div class="text">
        @section('title')
        Partner
        @endsection
        Partner
    </div>

    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-body">
                        <!-- partner Logo -->
                        @if (file_exists(public_path($partner->partner_logo)))
                        <div class="partner-tumbnail" style="background-image: url('{{ asset($partner->partner_logo) }}');">
                        </div>
                        @else
                        <svg class="img-fluid" width="100%" height="400" xmlns="http://www.w3.org/2000/svg" preserveAspectRatio="xMidYMid slice" focusable="false" role="img">
                            <rect width="100%" height="100%" fill="#868e96"></rect>
                            <text x="50%" y="50%" dominant-baseline="middle" text-anchor="middle" fill="#dee2e6" dy=".3em" font-size="24">
                                {{ $partner->partner_name}}
                            </text>
                        </svg>
                        @endif

                        <!-- name-->
                        <h2 style="padding-top: 70px; margin-bottom: 30px">
                            {{ $partner->partner_name}}
                        </h2>

                        <!--Link-->
                        <p><strong>Link: &nbsp;</strong> {{ $partner->partner_link }}</p>
                        <div class="d-flex justify-content-end">
                            <a href="{{ route('partner.index') }}" class="btn btn-warning mx-1" role="button">
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
    .partner-tumbnail {
        width: 100%;
        height: 400px;
        background-repeat: no-repeat;
        background-position: center;
        background-size: cover;
    }
</style>
@endpush