@extends('layouts.dashboard')

@section('content')
<section class="home-section">
    {{ Breadcrumbs::render('detail_post', $post) }}

    <div class="text">
        @section('title')
        Post
        @endsection
        Post
    </div>

    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-body">
                        <!-- thumbnail -->
                        @if (file_exists(public_path($post->post_thumbnail)))
                        <div class="post-tumbnail" style="background-image: url('{{ asset($post->post_thumbnail) }}');">
                        </div>
                        @else
                        <svg class="img-fluid" width="100%" height="400" xmlns="http://www.w3.org/2000/svg" preserveAspectRatio="xMidYMid slice" focusable="false" role="img">
                            <rect width="100%" height="100%" fill="#868e96"></rect>
                            <text x="50%" y="50%" dominant-baseline="middle" text-anchor="middle" fill="#dee2e6" dy=".3em" font-size="24">
                                {{ $post->post_title }}
                            </text>
                        </svg>
                        @endif

                        <!-- title -->
                        <h1 style="padding-top: 70px;">
                            {{ $post->post_title }}
                        </h1>

                        <!-- Date & Created by-->
                        <p>{{date('D, M Y', strtotime($post->created_at )) }} | Created by: {{ $post->created_by }}</p>

                        <!-- description -->
                        {!! $post->post_desc !!}

                        <!-- category -->
                        <b>Category:</b>
                        @foreach ($categories as $category)
                        <span class="badge badge-primary">{{ $category->category_title }}</span>
                        @endforeach
                        <br>

                        <!-- tags -->
                        <b>Tags:</b>
                        @foreach ($tags as $tag)
                        <span class="badge badge-info">#{{ $tag->tag_title }}</span>
                        @endforeach



                        <div class="d-flex justify-content-end">
                            <a href="{{ route('posts.index') }}" class="btn btn-warning mx-1" role="button">
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