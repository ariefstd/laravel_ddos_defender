@extends('layouts.dashboard')

@section('content')
<section class="home-section">
    {{ Breadcrumbs::render('roles') }}

    <div class="text">
        @section('title')
        Add Roles
        @endsection
        Add Roles
    </div>

    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <form action="{{ route('roles.store') }}" method="POST">
                        @csrf
                        <div class="card-body _card-body">
                            <div class="form-group _form-group">
                                <label for="input_role_name" class="font-weight-bold">
                                    Role name
                                </label>
                                <input id="input_role_name" value="{{ old('name') }}" name="name" type="text" class="form-control @error('name') is-invalid @enderror" />
                                @error('name')
                                <span class="invalid-feedback">
                                    {{ $message }}
                                </span>
                                @enderror
                            </div>
                            <!-- permission -->
                            <div class="form-group _form-group">
                                <label for="input_role_permission" class="font-weight-bold">
                                    Permission
                                </label>
                                <div class="form-control overflow-hidden h-100 @error('permissions') is-invalid @enderror" id="input_role_permission" style="padding: 30px;">
                                    <div class="row">
                                        <!-- list manage name:start -->
                                        @foreach ($authorities as $manageName => $permissions)
                                        <div class="col-md-2" style="margin-bottom: 30px;">
                                            <ul class="list-group mx-1">
                                                <li class="list-group-item bg-dark text-white">
                                                    {{ $manageName }}
                                                </li>
                                                <!-- list permission:start -->
                                                @foreach ($permissions as $permission)
                                                <li class="list-group-item">
                                                    <div class="form-check">
                                                        @if (old('permissions'))
                                                        <input id="{{ $permission }}" name="permissions[]" class="form-check-input" type="checkbox" value="{{ $permission }}" {{ in_array($permission, old('permissions')) ? "Checked" : null }}>
                                                        @else
                                                        <input id="{{ $permission }}" name="permissions[]" class="form-check-input" type="checkbox" value="{{ $permission }}">
                                                        @endif
                                                        <label for="{{ $permission }}" class="form-check-label">
                                                            {{ $permission }}
                                                        </label>
                                                    </div>
                                                </li>
                                                @endforeach
                                                <!-- list permission:end -->
                                            </ul>
                                        </div>

                                        <!-- list manage name:end  -->
                                        @endforeach
                                    </div>
                                </div>
                                @error('permissions')
                                <span class="invalid-feedback">
                                    {{ $message }}
                                </span>
                                @enderror
                            </div>
                            <div class="float-right mb-4">
                                <a class="btn btn-outline-secondary _btn-secondary px-4 mx-2" href="{{ route('roles.index') }}">
                                    Back
                                </a>
                                <button type="submit" class="btn btn-primary _btn-primary px-4">
                                    Save
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

</section>
@endsection