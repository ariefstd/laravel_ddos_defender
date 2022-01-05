@extends('layouts.dashboard')

@section('content')
<section class="home-section">
    {{ Breadcrumbs::render('detail_gallery', $gallery) }}

    <div class="text">
        @section('title')
        Gallery
        @endsection
        Gallery
    </div>

    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-body">
                        <!-- thumbnail -->
                        @if (file_exists(public_path($gallery->image_image)))
                        <div class="post-tumbnail" style="background-image: url('{{ asset($gallery->image_image) }}');">
                        </div>
                        @else
                        <svg class="img-fluid" width="100%" height="400" xmlns="http://www.w3.org/2000/svg" preserveAspectRatio="xMidYMid slice" focusable="false" role="img">
                            <rect width="100%" height="100%" fill="#868e96"></rect>
                            <text x="50%" y="50%" dominant-baseline="middle" text-anchor="middle" fill="#dee2e6" dy=".3em" font-size="24">
                                {{ $gallery->image_name }}
                            </text>
                        </svg>
                        @endif

                        <!-- title -->
                        <h1 style="padding-top: 70px;">
                            {{ $gallery->image_name }}
                        </h1>

                        <!-- Date & Created by-->
                        <p>{{date('D, M Y', strtotime($gallery->created_at )) }} | Created by: {{ $gallery->created_by }}</p>

                        <!-- description -->
                        {{ $gallery->image_desc }}


                        <br><br>
                        <!-- category -->
                        <b>Category:</b>
                        @foreach ($categories as $category)
                        <span class="badge badge-primary">{{ $category->cat_gallery_name }}</span>
                        @endforeach
                        <br>

                        <div class="d-flex justify-content-end">
                            <a href="{{ route('gallery.index') }}" class="btn btn-warning mx-1" role="button">
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
    .post-tumbnail {
        width: 100%;
        height: 400px;
        background-repeat: no-repeat;
        background-position: center;
        background-size: cover;
    }
</style>
@endpush