@extends('layouts.dashboard')

@section('content')
<section class="home-section">
    {{ Breadcrumbs::render('edit_new_user', $user) }}

    <div class="text">
        @section('title')
        Edit User
        @endsection
        Edit User
    </div>

    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <form action="{{ route('users.update', ['user' => $user]) }}" method="POST">
                    @method('PUT')
                    @csrf
                    <div class="card">
                        <div class="card-body _card-body">
                            <div class="row d-flex align-items-stretch">
                                <div class="col-md-3"></div>
                                <div class="col-md-6">
                                    <!-- name -->
                                    <div class="form-group">
                                        <label for="input_user_name" class="font-weight-bold">
                                            Name
                                        </label>
                                        <input id="input_user_name" value="{{ $user->name }}" name="name" type="text" class="form-control" readonly />

                                        <!-- error message -->
                                    </div>
                                    <!-- role -->
                                    <div class="form-group">
                                        <label for="select_user_role" class="font-weight-bold">
                                            Role
                                        </label>
                                        <select id="select_user_role" name="role" data-placeholder="Choose Role" class="custom-select w-100 @error('role') is-invalid @enderror">
                                            @if (old('role', $roleSelected))
                                            <option value="{{ old('role', $roleSelected)->id }}" selected>
                                                {{ old('role', $roleSelected)->name }}
                                            </option>
                                            @endif
                                        </select>
                                        @error('role')
                                        <span class="invalid-feedback">
                                            {{ $message }}
                                        </span>
                                        @enderror
                                        <!-- error message -->
                                    </div>
                                    <!-- email -->
                                    <div class="form-group">
                                        <label for="input_user_email" class="font-weight-bold">
                                            Email
                                        </label>
                                        <input id="input_user_email" value="{{ $user->email }}" name="email" type="email" class="form-control" placeholder="Write email here.." autocomplete="email" readonly />

                                        <!-- error message -->
                                    </div>
                                </div>
                                <div class="col-md-3"></div>
                            </div>

                            <div class="row">
                                <div class="col-md-3"></div>
                                <div class="col-md-6">
                                    <div class="float-right">
                                        <a class="btn btn-outline-secondary _btn-secondary px-4" href="{{ route('users.index') }}">Back</a>
                                        <button type="submit" class="btn btn-primary _btn-primary px-4">
                                            Update
                                        </button>
                                    </div>
                                </div>
                                <div class="col-md-3"></div>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
    </div>
    </div>
</section>
@endsection

@push('css-external')
<link rel="stylesheet" href="{{ asset('vendor/select2/css/select2.min.css') }}">
<link rel="stylesheet" href="{{ asset('vendor/select2/css/select2-bootstrap4.min.css') }}">
@endpush

@push('javascript-external')
<script src="{{ asset('vendor/select2/js/select2.min.js') }}"></script>
<script src="{{ asset('vendor/select2/js/' . app()->getLocale() . '.js') }}"></script>
<script src="{{ asset('vendor/laravel-filemanager/js/stand-alone-button.js') }}"></script>
@endpush

@push('javascript-internal')
<script>
    $(function() {
        //parent category
        $('#select_user_role').select2({
            theme: 'bootstrap4',
            language: "{{ app()->getLocale() }}",
            allowClear: true,
            ajax: {
                url: "{{ route('roles.select') }}",
                dataType: 'json',
                delay: 250,
                processResults: function(data) {
                    return {
                        results: $.map(data, function(item) {
                            return {
                                text: item.name,
                                id: item.id
                            }
                        })
                    };
                }
            }
        });
    });
</script>
@endpush