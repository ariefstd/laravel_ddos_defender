@extends('layouts.dashboard')

@section('title')
Change Password
@endsection

@section('breadcrumbs')
{{ Breadcrumbs::render('edit_password') }}
@endsection

@section('content')
<section class="home-section">
    {{ Breadcrumbs::render('change_password') }}

    <div class="text">
        @section('title')
        Change Password
        @endsection
        Change Password
    </div>

    <div class="container-fluid">
        <div class="card" style="padding: 70px 0px;">
            <div class="row">
                <div class="col-md-4"></div>
                <div class="col-md-4">

                    <form method="POST" action="{{ route('password.updatePassword') }}">
                        @method('patch')
                        @csrf

                        <div class="form-group">
                            <label for="current_password" class=" text-md-left"><strong>{{ __('Current Password') }}</strong> <span class="wajib">*</span></label>


                            <input id="current_password" type="password" class="form-control @error('current_password') is-invalid @enderror" name="current_password" required autocomplete="current_password">

                            @error('current_password')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror

                        </div>

                        <div class="form-group">
                            <label for="password" class=" col-form-label text-md-left"><strong>New {{ __('Password') }}</strong> <span class="wajib">*</span></label>


                            <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="new-password">

                            @error('password')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror

                        </div>

                        <div class="form-group">
                            <label for="password-confirm" class=" col-form-label text-md-left"><strong>{{ __('Confirm Password') }}</strong> <span class="wajib">*</span></label>


                            <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required autocomplete="new-password">

                        </div>

                        <div class="form-group row mb-0">
                            <div class="col-md-12 offset-md-12">
                                <button type="submit" class="btn btn-primary" style="width: 100%;">
                                    Update Password
                                </button>
                            </div>
                        </div>
                    </form>

                </div>
                <div class="col-md-4"></div>
            </div>
        </div>

    </div>

</section>
@endsection