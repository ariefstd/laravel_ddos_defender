@extends('layouts.dashboard')

@section('content')
<section class="home-section">
    {{ Breadcrumbs::render('users') }}

    <div class="text">
        @section('title')
        User
        @endsection
        User
    </div>

    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <div class="row">
                            <div class="col-md-6">
                                <form action="{{ route('users.index') }}" method="GET">
                                    <div class="input-group">
                                        <input name="keyword" value="{{ request()->get('keyword') }}" type="search" class="form-control" style="height: 40px;" placeholder="Search for users">
                                        <div class="input-group-append">
                                            <button class="btn btn-primary" type="submit" style="height: 40px;">
                                                <i class="fas fa-search"></i>
                                            </button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                            <div class="col-md-6">
                                @can('User Create')
                                <a href="{{ route('users.create') }}" class="btn btn-primary float-right" role="button">
                                    Add New
                                </a>
                                @endcan
                            </div>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            @forelse ($users as $user)
                            <div class="col-md-4">
                                <div class="card my-1">
                                    <div class="card-body">
                                        <div class="row">
                                            <div class="col-md-2">
                                                <i class="fas fa-id-badge fa-5x"></i>
                                            </div>
                                            <div class="col-md-10">
                                                <table>
                                                    <tr>
                                                        <th>
                                                            Name
                                                        </th>
                                                        <td>&nbsp;:&nbsp;&nbsp;</td>
                                                        <td>
                                                            {{ $user->name }}
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <th>
                                                            Email
                                                        </th>
                                                        <td>&nbsp;:&nbsp;&nbsp;</td>
                                                        <td>
                                                            {{ $user->email }}
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <th>
                                                            Role
                                                        </th>
                                                        <td>&nbsp;:&nbsp;&nbsp;</td>
                                                        <td>
                                                            {{ $user->roles->first()->name }}
                                                        </td>
                                                    </tr>
                                                </table>
                                            </div>
                                        </div>
                                        <div class="float-right">
                                            @can('User Update')
                                            <!-- edit -->
                                            <a href="{{ route('users.edit', ['user' => $user]) }}" class="btn btn-sm btn-info" role="button">
                                                <i class="fas fa-edit"></i>
                                            </a>
                                            @endcan

                                            <!-- delete -->
                                            @can('User Delete')
                                            <form class="d-inline" role="alert" action="{{ route('users.destroy', ['user' => $user]) }}" method="POST">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-sm btn-danger">
                                                    <i class="fas fa-trash"></i>
                                                </button>
                                            </form>
                                            @endcan
                                        </div>
                                    </div>
                                </div>
                            </div>
                            @empty
                            <table>

                            </table>
                            <p style="margin: auto; padding-top: 50px;">
                                @if (request()->get('keyword'))
                                <strong>Users not Found</strong>

                                @else
                                <strong>No users data yet</strong>
                                @endif

                            </p>
                            @endforelse
                        </div>
                        <!-- table-responsive -->
                        @if ($users->hasPages())
                        <div class="card-footer">
                            {{ $users->links('vendor.pagination.bootstrap-4') }}
                        </div>
                        @endif

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
                title: 'Delete User',
                text: 'Are you sure want to remove User?',
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