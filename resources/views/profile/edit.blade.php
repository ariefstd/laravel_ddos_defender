@extends('layouts.dashboard')

@section('content')
<section class="home-section">
    {{ Breadcrumbs::render('edit_profile') }}

    <div class="text">
        @section('title')
        Edit Profile
        @endsection
        Edit Profile
    </div>

    <div class="container-fluid">
        <div class="card" style="padding: 70px 0px;">
            <div class="row">
                <div class="col-md-4"></div>
                <div class="col-md-4">

                    <!-- <div class="card-header">
                            <strong>EDIT PROFILE</strong>
                        </div> -->


                    <form method="POST" action="{{ route('profile.update') }}">
                        @method('PATCH')
                        @csrf

                        <div class="form-group">
                            <label for="name" class="col-form-label text-md-left"><strong>{{ __('Name') }}</strong></label>


                            <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name', $user->name) }}" autocomplete="name" autofocus>

                            @error('name')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror

                        </div>

                        <div class="form-group">
                            <label for="email" class=" col-form-label text-md-left"><strong>{{ __('E-Mail Address') }}</strong></label>


                            <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email', $user->email) }}" autocomplete="email">

                            @error('email')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror

                        </div>

                        <div class="form-group row mb-0">
                            <div class="col-md-12 offset-md-12">
                                <button type="submit" class="btn btn-primary" style="width: 100%;">
                                    Edit Profile
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