@extends('layouts.dashboard')

@section('content')
<section class="home-section">
    {{ Breadcrumbs::render('teams') }}

    <div class="text">
        @section('title')
        Team
        @endsection
        Team
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
                                    @foreach ($categories as $category)
                                    <option value="{{ $category->category_name }}" {{ request('category') === $category->category_name ? 'selected' : null }}>
                                        {{ $category->category_name }}
                                    </option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-md-4">
                                <input name="keyword" value="{{ request('keyword') }}" type="search" style="height: 43px" class="form-control" placeholder="Search for team..">
                            </div>
                            <div class="col-md-2">
                                <button type="submit" class="btn btn-primary mb-3">Search</button>
                            </div>
                            <div class="col-md-4">


                                <a href="{{ route('team.create') }}" class="btn btn-primary float-right" role="button">
                                    Add New
                                </a>


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
                                            <th class="pd-y-5">Category</th>
                                            <th class="pd-y-5 tx-center">Status</th>
                                            <th class="pd-y-5 tx-center">Actions</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @forelse ($teams as $team)
                                        <tr>
                                            <td style="width: 22%;" class="valign-middle tx-medium tx-inverse tx-14">
                                                {{ $team->team_name }}
                                            </td>

                                            <td style="width: 61%;" class="valign-middle tx-medium tx-inverse tx-14">
                                                {{ $team->category->category_name }}
                                            </td>

                                            <td style="width: 10%;" class=" valign-middle tx-center">@if ($team->is_active == 1)
                                                <span class="status-active">Active</span>
                                                @else
                                                <span class="status-nonactive">Non-Active</span>
                                                @endif
                                            </td>

                                            <td style="width: 7%;" class="valign-middle tx-center">
                                                <div class="row" style="margin-left: 0px; margin-right: 0px;">
                                                    <!-- <div class="col-md-4">
                                                        <a href="{{ route('team.show', ['team' => $team]) }}" class="btn btn-sm btn-primary" role="button">
                                                            <i class="fas fa-eye"></i>
                                                        </a>
                                                    </div> -->
                                                    <div class="col-md-6">

                                                        <a href="{{ route('team.edit', ['team' => $team]) }}" class="btn btn-sm btn-info" role="button">
                                                            <i class="fas fa-edit"></i>
                                                        </a>

                                                    </div>
                                                    <div class="col-md-6">

                                                        <form class="d-inline" role="alert" action="{{ route('team.destroy', ['team' => $team]) }}" method="POST">
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
                                            <strong>Team not found</strong>

                                            @else
                                            <strong>No Team data yet</strong>
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
                    @if ($teams->hasPages())
                    <div class="card-footer">
                        {{ $teams->links('vendor.pagination.bootstrap-4') }}
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
                title: 'Delete Team',
                text: 'Are you sure want to remove Team?',
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