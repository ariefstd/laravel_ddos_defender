@extends('layouts.dashboard')



@section('content')
<section class="home-section">
    {{ Breadcrumbs::render('dashboard_home') }}
    <div class="text">@section('title')Dashboard CMS
        @endsection
        Dashboard CMS: {{ Auth::user()->name }}</div>

    <div class="container-fluid">
        <div class="content-count">
            <div class="row">
                <div class="col-md-3">
                    <div class="card _card-dashboard">
                        <div class="card-body" style="background-color: #3379b8;">
                            <div class="row">
                                <div class="col-md-4">
                                    <i class='bx bx-store-alt' style="font-size: 100px; text-align: center;"></i>
                                </div>
                                <div class="col-md-8">
                                    <h1>{{ $market }}</h1>
                                    <h4>Pasar</h4>
                                </div>
                            </div>
                        </div>
                        <div class="card-footer" style="text-align: right;">
                            <a href="{{ route('market.index') }}" class="view-all">View all <i class='bx bxs-right-arrow-circle'></i></a>
                        </div>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="card _card-dashboard">
                        <div class="card-body" style="background-color: #5db75d;">
                            <div class="row">
                                <div class="col-md-4">
                                    <i class='bx bx-store' style="font-size: 100px; text-align: center;"></i>
                                </div>
                                <div class="col-md-8">

                                    <h1>{{ $stall }}</h1>
                                    <h4>Kios</h4>
                                </div>
                            </div>
                        </div>
                        <div class="card-footer" style="text-align: right;">
                            <a href="{{ route('stall.index') }}" class="view-all">View all <i class='bx bxs-right-arrow-circle'></i></a>
                        </div>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="card _card-dashboard">
                        <div class="card-body" style="background-color: #efad4e;">
                            <div class="row">
                                <div class="col-md-4">
                                    <i class='bx bx-news' style="font-size: 100px; text-align: center;"></i>
                                </div>
                                <div class="col-md-8">

                                    <h1>{{ $post }}</h1>
                                    <h4>Post</h4>
                                </div>
                            </div>
                        </div>
                        <div class="card-footer" style="text-align: right;">
                            <a href="{{ route('posts.index') }}" class="view-all">View all <i class='bx bxs-right-arrow-circle'></i></a>
                        </div>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="card _card-dashboard">
                        <div class="card-body" style="background-color: #d9544f;">
                            <div class="row">
                                <div class="col-md-4">
                                    <i class='bx bx-image' style="font-size: 100px; text-align: center;"></i>
                                </div>
                                <div class="col-md-8">

                                    <h1>{{ $gallery }}</h1>
                                    <h4>Gallery</h4>
                                </div>
                            </div>
                        </div>
                        <div class="card-footer" style="text-align: right;">
                            <a href="{{ route('gallery.index') }}" class="view-all">View all <i class='bx bxs-right-arrow-circle'></i></a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

</section>
@endsection