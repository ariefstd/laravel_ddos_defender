@extends('layouts.dashboard')

@section('content')
<section class="home-section">
    {{ Breadcrumbs::render('categories_gallery') }}

    <div class="text">
        @section('title')
        Gallery Category
        @endsection
        Gallery Category
    </div>

    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <div class="row">
                            <div class="col-md-6">
                                <form action="{{ route('categories-gallery.index') }}" method="GET">
                                    <div class="input-group">
                                        <input name="keyword" value="{{ request()->get('keyword') }}" type="search" class="form-control" style="height: 40px;" placeholder="Search for category..">
                                        <div class="input-group-append">
                                            <button class="btn btn-primary" type="submit" style="height: 40px;">
                                                <i class="fas fa-search"></i>
                                            </button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                            <div class="col-md-6">
                                @can('Gallery Category Create')
                                <a href="{{ route('categories-gallery.create') }}" class="btn btn-primary float-right" role="button">
                                    Add New

                                </a>
                                @endcan
                            </div>
                        </div>
                    </div>
                    <div class="card-body">
                        <ul class="list-group list-group-flush">
                            <!-- card-header -->
                            <div class="table-responsive table-striped">
                                <table class="table mg-b-0 tx-13">
                                    <thead>
                                        <tr class="tx-10">
                                            <!-- <th class="pd-y-5">Seq</th> -->
                                            <th class="pd-y-5">Name</th>
                                            <th class="pd-y-5 tx-center">Status</th>
                                            <th class="pd-y-5 tx-center">Actions</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @forelse ($categories as $category)
                                        <tr>
                                            <!-- <td style="width: 10px;" class="valign-middle tx-center tx-medium tx-inverse tx-14">
                                                {{ $category->cat_gallery_seq }}
                                            </td> -->
                                            <td style="width: 83%;" class="valign-middle tx-medium tx-inverse tx-14">
                                                {{ $category->cat_gallery_name }}
                                            </td>


                                            <td style="width: 10%;" class=" valign-middle tx-center">@if ($category->is_active == 1)
                                                <span class="status-active">Active</span>
                                                @else
                                                <span class="status-nonactive">Non-Active</span>
                                                @endif
                                            </td>

                                            <td style="width: 7%;" class="valign-middle tx-center">
                                                <div class="row" style="margin-left: 0px; margin-right: 0px;">
                                                    <!-- <div class="col-md-4">
                                                        <a href="{{ route('categories-gallery.show', ['categories_gallery' => $category]) }}" class="btn btn-sm btn-primary" role="button">
                                                            <i class="fas fa-eye"></i>
                                                        </a>
                                                    </div> -->
                                                    <div class="col-md-6">
                                                        @can('Gallery Category Update')
                                                        <a href="{{ route('categories-gallery.edit', ['categories_gallery' => $category]) }}" class="btn btn-sm btn-info" role="button">
                                                            <i class="fas fa-edit"></i>
                                                        </a>
                                                        @endcan
                                                    </div>
                                                    <div class="col-md-6">
                                                        @can('Gallery Category Delete')
                                                        <form class="d-inline" role="alert" action="{{ route('categories-gallery.destroy', ['categories_gallery' => $category]) }}" method="POST">
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
                                            <strong>Category not found</strong>

                                            @else
                                            <strong>No Category data yet</strong>
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
                    @if ($categories->hasPages())
                    <div class="card-footer">
                        {{ $categories->links('vendor.pagination.bootstrap-4') }}
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
                title: 'Delete Category',
                text: 'Are you sure want to remove Category?',
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