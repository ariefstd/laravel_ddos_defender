@extends('layouts.dashboard')

@section('content')
<section class="home-section">
    {{ Breadcrumbs::render('posts') }}

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
                    <div class="card-header">

                        {{-- filter:start --}}
                        <form class="row" method="GET">
                            <div class="col-md-2">
                                <select name="category" class="form-control">
                                    <option value="" selected>All Category</option>
                                    @foreach ($categoriesPosts as $category)
                                    <option value="{{ $category->category_title }}" {{ request('category') === $category->category_title ? 'selected' : null }}>
                                        {{ $category->category_title }}
                                    </option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-md-4">
                                <input name="keyword" value="{{ request('keyword') }}" type="search" class="form-control" style="height: 43px;" placeholder="Search for post..">
                            </div>
                            <div class="col-md-2">
                                <button type="submit" class="btn btn-primary mb-3">Search</button>
                            </div>
                            <div class="col-md-4">

                                @can('Post Create')
                                <a href="{{ route('posts.create') }}" class="btn btn-primary float-right" role="button">
                                    Add New

                                </a>
                                @endcan

                            </div>
                        </form>
                        {{-- filter:end --}}

                    </div>
                    <div class="card-body">
                        <ul class="list-group list-group-flush">
                            <!-- card-header -->
                            <div class="table-responsive table-striped">
                                <table class="table mg-b-0 tx-13">
                                    <thead>
                                        <tr class="tx-10">
                                            <th class="pd-y-5">Title</th>
                                            <th class="pd-y-5">Description</th>
                                            <th class="pd-y-5 tx-center">Category</th>
                                            <th class="pd-y-5 tx-center">Date</th>
                                            <th class="pd-y-5 tx-center">Status</th>
                                            <th class="pd-y-5 tx-center">Actions</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @forelse ($posts as $post)
                                        <tr>
                                            <td style="width: 23%;" class="valign-middle tx-medium tx-inverse tx-14">
                                                {{ $post->post_title }}

                                            <td style="width: 40%;" class="valign-middle tx-medium tx-inverse tx-14">
                                                {!! $post->post_excerpt !!}
                                            </td>

                                            <td style="width: 10%;" class=" tx-center valign-middle tx-medium tx-inverse tx-14">
                                                {{ $post->category->category_title }}
                                            </td>

                                            <td style="width: 10%;" class="tx-center valign-middle tx-medium tx-inverse tx-14">
                                                {{date('d, M Y', strtotime($post->created_at )) }}
                                            </td>

                                            <td style="width: 10%;" class=" valign-middle tx-center">@if ($post->is_active == 1)
                                                <span class="status-active">Active</span>
                                                @else
                                                <span class="status-nonactive">Non-Active</span>
                                                @endif
                                            </td>

                                            <td style="width: 7%;" class="valign-middle tx-center">
                                                <div class="row" style="margin-left: 0px; margin-right: 0px;">
                                                    <!-- <div class="col-md-4">
                                                        <a href="{{ route('posts.show', ['post' => $post]) }}" class="btn btn-sm btn-primary" role="button">
                                                            <i class="fas fa-eye"></i>
                                                        </a>
                                                    </div> -->
                                                    <div class="col-md-6">
                                                        @can('Post Update')
                                                        <a href="{{ route('posts.edit', ['post' => $post]) }}" class="btn btn-sm btn-info" role="button">
                                                            <i class="fas fa-edit"></i>
                                                        </a>
                                                        @endcan
                                                    </div>
                                                    <div class="col-md-6">
                                                        @can('Post Delete')
                                                        <form class="d-inline" role="alert" action="{{ route('posts.destroy', ['post' => $post]) }}" method="POST">
                                                            @csrf
                                                            @method('DELETE')
                                                            <button type="submit" class="btn btn-sm btn-danger">
                                                                <i class="fas fa-trash"></i>
                                                            </button>
                                                        </form>
                                                        @endcan
                                                    </div>
                                                </div>

                                            </td>
                                        </tr>
                                        @empty
                                        <table>

                                        </table>
                                        <p style="text-align: center; padding-top: 50px;">
                                            @if (request()->get('keyword'))
                                            <strong>Post not found</strong>

                                            @else
                                            <strong>No Post data yet</strong>
                                            @endif

                                        </p>
                                        @endforelse

                                    </tbody>
                                </table>
                            </div>
                            <!-- table-responsive -->

                        </ul>
                    </div>
                    <!-- table-responsive -->
                    @if ($posts->hasPages())
                    <div class="card-footer">
                        {{ $posts->links('vendor.pagination.bootstrap-4') }}
                    </div>
                    @endif
                </div>
            </div>
        </div>
    </div>

</section>
@endsection

@push('javascript-internal')
<script>
    $(document).ready(function() {
        $("form[role='alert']").submit(function(event) {
            event.preventDefault();
            Swal.fire({
                title: 'Delete Post',
                text: 'Are you sure want to remove Post?',
                icon: 'warning',
                allowOutsideClick: false,
                showCancelButton: true,
                cancelButtonText: "Cancel",
                reverseButtons: true,
                confirmButtonText: "Yes",
            }).then((result) => {
                if (result.isConfirmed) {
                    // todo: process of deleting categories
                    event.target.submit();
                }
            });
        });
    });
</script>
@endpush