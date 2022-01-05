@extends('layouts.dashboard')

@section('content')
<section class="home-section">
    {{ Breadcrumbs::render('detail_news', $flashNews) }}

    <div class="text">
        @section('title')
        Flash News
        @endsection
        Flash News
    </div>

    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-body">
                        <div class="row">

                            <div class="col-md-12">
                                <!-- Region -->
                                <h2 style="padding-top: 30px;">
                                    {{ $flashNews->news_name }}
                                </h2>


                            </div>
                        </div>

                        <div class="d-flex justify-content-end">
                            <a href="{{ route('flash-news.index') }}" class="btn btn-warning mx-1" role="button">
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
    .food-tumbnail {
        width: 100%;
        height: 400px;
        background-repeat: no-repeat;
        background-position: center;
        background-size: cover;
    }
</style>
@endpush