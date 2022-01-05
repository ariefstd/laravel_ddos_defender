@extends('layouts.dashboard')

@section('content')
<section class="home-section">
    {{ Breadcrumbs::render('detail_meta', $meta) }}

    <div class="text">
        @section('title')
        Meta
        @endsection
        Meta
    </div>

    <div class="container-fluid">
        <!-- content -->
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-6">
                                <!-- thumbnail -->
                                @if (file_exists(public_path($meta->meta_page)))
                                <div class="meta-tumbnail" style="background-image: url('{{ asset($meta->meta_page) }}');">
                                </div>
                                @else
                                <svg class="img-fluid" width="100%" height="400" xmlns="http://www.w3.org/2000/svg" preserveAspectRatio="xMidYMid slice" focusable="false" role="img">
                                    <rect width="100%" height="100%" fill="#868e96"></rect>
                                    <text x="50%" y="50%" dominant-baseline="middle" text-anchor="middle" fill="#dee2e6" dy=".3em" font-size="24">
                                        {{ $meta->meta_page }}
                                    </text>
                                </svg>
                                @endif
                            </div>

                            <div class="col-md-6">
                                <!-- name -->
                                <h2 style="padding-top: 70px;">
                                    {{ $meta->meta_title }}
                                </h2> <br>
                                <!-- description -->
                                <p class="text-justify" style="margin-bottom: 30px">
                                    <b>Description:</b> <br> {{ $meta->meta_description }}
                                </p>
                                <!-- keyword -->
                                <p class="text-justify" style="margin-bottom: 70px">
                                    <b>Keyword:</b> <br> {{ $meta->meta_keyword }}
                                </p>
                            </div>
                        </div>

                        <div class="d-flex justify-content-end">
                            <a href="{{ route('metas.index') }}" class="btn btn-warning mx-1" role="button">
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
    .meta-tumbnail {
        width: 100%;
        height: 400px;
        background-repeat: no-repeat;
        background-position: center;
        background-size: cover;
    }
</style>
@endpush