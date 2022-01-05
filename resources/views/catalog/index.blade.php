@extends('layouts.dashboard')

@section('content')
<section class="home-section">
    {{ Breadcrumbs::render('catalogs') }}

    <div class="text">
        @section('title')
        Catalog
        @endsection
        Catalog
    </div>

    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <div class="row">
                            <div class="col-md-6">
                                <form action="{{ route('catalog.index') }}" method="GET">
                                    <div class="input-group">
                                        <input name="keyword" value="{{ request()->get('keyword') }}" type="search" class="form-control" style="height: 40px;" placeholder="Search for catalog..">
                                        <div class="input-group-append">
                                            <button class="btn btn-primary" type="submit" style="height: 40px;">
                                                <i class="fas fa-search"></i>
                                            </button>
                                        </div>
                                    </div>
                                </form>
                            </div>

                            <div class="col-md-6">

                                <a href="{{ route('catalog.create') }}" class="btn btn-primary float-right" role="button">
                                    Add New

                                </a>

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
                                            <th class="pd-y-5 tx-center">Seq</th>
                                            <th class="pd-y-5 tx-left">Name</th>
                                            <th class="pd-y-5 tx-left">File</th>
                                            <th class="pd-y-5 tx-center">Status</th>
                                            <th class="pd-y-5 tx-center">Actions</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @forelse ($catalogs as $catalog)
                                        <tr>
                                            <td style="width: 10px;" class="valign-middle tx-center tx-medium tx-inverse tx-14">
                                                {{ $catalog->catalog_seq }}
                                            </td>

                                            <td style="width: 58%;" class="valign-middle tx-left tx-medium tx-inverse tx-14">
                                                {{ $catalog->catalog_name }}
                                            </td>

                                            <td style="width: 25%;" class="valign-middle tx-left tx-medium tx-inverse tx-14">
                                                {{ $catalog->catalog_file }}
                                            </td>

                                            <td style="width: 10%;" class=" valign-middle tx-center">@if ($catalog->is_active == 1)
                                                <span class="status-active">Active</span>
                                                @else
                                                <span class="status-nonactive">Non-Active</span>
                                                @endif
                                            </td>

                                            <td style="width: 7%;" class="valign-middle tx-center">
                                                <div class="row" style="margin-left: 0px; margin-right: 0px;">
                                                    <!-- <div class="col-md-4">
                                                        <a href="{{ route('catalog.show', ['catalog' => $catalog]) }}" class="btn btn-sm btn-primary" role="button">
                                                            <i class="fas fa-eye"></i>
                                                        </a>
                                                    </div> -->
                                                    <div class="col-md-6">

                                                        <a href="{{ route('catalog.edit', ['catalog' => $catalog]) }}" class="btn btn-sm btn-info" role="button">
                                                            <i class="fas fa-edit"></i>
                                                        </a>

                                                    </div>
                                                    <div class="col-md-6">

                                                        <form class="d-inline" role="alert" action="{{ route('catalog.destroy', ['catalog' => $catalog]) }}" method="POST">
                                                            @csrf
                                                            @method('DELETE')
                                                            <button type="submit" class="btn btn-sm btn-danger">
                                                                <i class="fas fa-trash"></i>
                                                            </button>
                                                        </form>

                                                    </div>
                                                </div>

                                            </td>
                                        </tr>
                                        @empty
                                        <table>

                                        </table>
                                        <p style="text-align: center; padding-top: 50px;">
                                            @if (request()->get('keyword'))
                                            <strong>Catalog not found</strong>

                                            @else
                                            <strong>No Catalog data yet</strong>
                                            @endif

                                        </p>
                                        @endforelse

                                    </tbody>
                                </table>
                            </div>
                        </ul>
                    </div>
                    <!-- table-responsive -->
                    @if ($catalogs->hasPages())
                    <div class="card-footer">
                        {{ $catalogs->links('vendor.pagination.bootstrap-4') }}
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
                title: 'Delete Catalog',
                text: 'Are you sure want to remove Catalog?',
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