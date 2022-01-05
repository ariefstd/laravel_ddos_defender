@extends('layouts.dashboard')

@section('content')
<section class="home-section">
    {{ Breadcrumbs::render('metas') }}

    <div class="text">
        @section('title')
        Meta
        @endsection
        Meta
    </div>

    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <div class="row">
                            <div class="col-md-6">
                                <form action="" method="GET" class="form-inline form-row">
                                    <!-- <div class="col">
                                <div class="input-group mx-1">
                                    <label class="font-weight-bold mr-2">Status</label>
                                    <select name="status" class="custom-select">
                                        <option value="publish" selected>Publish</option>
                                        <option value="draft">Draft</option>
                                    </select>
                                    <div class="input-group-append">
                                        <button class="btn btn-primary" type="submit">Apply</button>
                                    </div>
                                </div>
                            </div> -->
                                    <div class="col">
                                        <form action="{{ route('metas.index') }}" method="GET">
                                            <div class="input-group">
                                                <input name="keyword" value="{{ request()->get('keyword') }}" type="search" class="form-control" style="height: 40px;" placeholder="Search for meta..">
                                                <div class="input-group-append">
                                                    <button class="btn btn-primary" type="submit" style="height: 40px;">
                                                        <i class="fas fa-search"></i>
                                                    </button>
                                                </div>
                                            </div>
                                        </form>
                                    </div>
                                </form>
                            </div>
                            <div class="col-md-6">
                                @can('Meta Create')
                                <a href="{{ route('metas.create') }}" class="btn btn-primary float-right" role="button">
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
                                            <th class="pd-y-5">Page</th>
                                            <th class="pd-y-5 tx-left">Title</th>
                                            <th class="pd-y-5 tx-left">Description</th>
                                            <th class="pd-y-5 tx-left">Keyword</th>
                                            <th class="pd-y-5 tx-center">Actions</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @if (count($metas))
                                        @forelse ($metas as $meta)
                                        <tr>
                                            <td style="width: 10%;" class="valign-middle tx-medium tx-inverse tx-14">{{ $meta->meta_page  }}</td>
                                            <td style="width: 18%;" class="valign-middle tx-medium tx-inverse tx-14">
                                                {{ $meta->meta_title }}
                                            </td>
                                            <td style="width: 35%;" class="valign-middle tx-medium tx-inverse tx-14">
                                                {{ Str::limit($meta->meta_description, 100) }}
                                            </td>
                                            <td style="width: 30%;" class=" valign-middle tx-medium tx-left">{{ Str::limit($meta->meta_keyword, 100) }}
                                            </td>

                                            <td style="width: 7%;" class="valign-middle tx-center">
                                                <div class="row" style="margin-left: 0px; margin-right: 0px;">
                                                    <!-- <div class="col-md-4">
                                                        <a href="{{ route('metas.show', ['meta' => $meta]) }}" class="btn btn-sm btn-primary" role="button">
                                                            <i class="fas fa-eye"></i>
                                                        </a>
                                                    </div> -->
                                                    <div class="col-md-6">
                                                        @can('Meta Update')
                                                        <a href="{{ route('metas.edit', ['meta' => $meta]) }}" class="btn btn-sm btn-info" role="button">
                                                            <i class="fas fa-edit"></i>
                                                        </a>
                                                        @endcan
                                                    </div>
                                                    <div class="col-md-6">
                                                        <!-- delete -->
                                                        @can('Meta Delete')
                                                        <form class="d-inline" role="alert" action="{{ route('metas.destroy', ['meta' => $meta]) }}" method="POST">
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
                                        @endforeach
                                        @else
                                        <table>

                                        </table>
                                        <p style="text-align: center; padding-top: 50px;">
                                            <strong>No Meta Page data yet</strong>
                                        </p>
                                        @endif
                                    </tbody>
                                </table>
                            </div>
                            <!-- table-responsive -->
                            @if ($metas->hasPages())
                            <div class="card-footer">
                                {{ $metas->links('vendor.pagination.bootstrap-4') }}
                            </div>
                            @endif
                        </ul>
                    </div>
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
                title: 'Delete Meta',
                text: 'Are you sure want to remove Meta?',
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