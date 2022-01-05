@extends('layouts.dashboard')

@section('content')
<section class="home-section">
    {{ Breadcrumbs::render('regions') }}

    <div class="text">
        @section('title')
        Region
        @endsection
        Region
    </div>

    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        {{-- filter:start --}}
                        <form class="row" method="GET">
                            <div class="col-md-2">
                                <select name="city" class="form-control">
                                    <option value="" selected>All City</option>
                                    @foreach ($cities as $city)
                                    <option value="{{ $city->city_name }}" {{ request('city') === $city->city_name ? 'selected' : null }}>
                                        {{ $city->city_name }}
                                    </option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-md-4">
                                <input name="keyword" value="{{ request('keyword') }}" type="search" style="height: 43px" class="form-control" placeholder="Search for region..">
                            </div>
                            <div class="col-md-2">
                                <button type="submit" class="btn btn-primary mb-3">Search</button>
                            </div>
                            <div class="col-md-4">

                                @can('Region Create')
                                <a href="{{ route('region.create') }}" class="btn btn-primary float-right" role="button">
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
                                            <th class="pd-y-5">Name</th>
                                            <th class="pd-y-5">City</th>
                                            <th class="pd-y-5 tx-center">Status</th>
                                            <th class="pd-y-5 tx-center">Actions</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @forelse ($regions as $region)
                                        <tr>
                                            <td style="width: 22%;" class="valign-middle tx-medium tx-inverse tx-14">
                                                {{ $region->region_name }}
                                            </td>

                                            <td style="width: 61%;" class="valign-middle tx-medium tx-inverse tx-14">
                                                {{ $region->city->city_name }}
                                            </td>

                                            <td style="width: 10%;" class=" valign-middle tx-center">@if ($region->is_active == 1)
                                                <span class="status-active">Active</span>
                                                @else
                                                <span class="status-nonactive">Non-Active</span>
                                                @endif
                                            </td>

                                            <td style="width: 7%;" class="valign-middle tx-center">
                                                <div class="row" style="margin-left: 0px; margin-right: 0px;">
                                                    <!-- <div class="col-md-4">
                                                        <a href="{{ route('region.show', ['region' => $region]) }}" class="btn btn-sm btn-primary" role="button">
                                                            <i class="fas fa-eye"></i>
                                                        </a>
                                                    </div> -->
                                                    <div class="col-md-6">
                                                        @can('Region Update')
                                                        <a href="{{ route('region.edit', ['region' => $region]) }}" class="btn btn-sm btn-info" role="button">
                                                            <i class="fas fa-edit"></i>
                                                        </a>
                                                        @endcan
                                                    </div>
                                                    <div class="col-md-6">
                                                        @can('Region Delete')
                                                        <form class="d-inline" role="alert" action="{{ route('region.destroy', ['region' => $region]) }}" method="POST">
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
                                            <strong>Region not found</strong>

                                            @else
                                            <strong>No Region data yet</strong>
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
                    @if ($regions->hasPages())
                    <div class="card-footer">
                        {{ $regions->links('vendor.pagination.bootstrap-4') }}
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
                title: 'Delete Region',
                text: 'Are you sure want to remove Region?',
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