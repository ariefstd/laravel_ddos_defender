@extends('layouts.dashboard')

@section('content')
<section class="home-section">
    {{ Breadcrumbs::render('add_banner') }}

    <div class="text">
        @section('title')
        Add Banner
        @endsection
        Add Banner
    </div>

    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <form action="{{ route('banners.store') }}" method="POST">
                    @csrf
                    <div class="card">
                        <div class="card-body _card-body">
                            <div class="row d-flex align-items-stretch">
                                <div class="col-md-3"></div>
                                <div class="col-md-6">
                                    <!-- title -->
                                    <div class="form-group _form-group">
                                        <label for="input_banner_title" class="font-weight-bold">
                                            Name <span class="wajib">* </span>
                                        </label>
                                        <input id="input_banner_title" value="{{ old('banner_name') }}" name="banner_name" type="text" class="form-control @error('banner_name') is-invalid @enderror" placeholder="Write name here.." />
                                        @error('banner_name')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                        @enderror
                                    </div>
                                    <!-- seq -->
                                    <div class="form-group _form-group">
                                        <label for="input_banner_seq" class="font-weight-bold">
                                            Sequence <span class="wajib">* </span>
                                        </label>
                                        <input id="input_banner_seq" value="{{ old('banner_seq') }}" name="banner_seq" type="number" class="form-control @error('banner_seq') is-invalid @enderror" placeholder="Only number, example: 1" />
                                        @error('banner_seq')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                        @enderror
                                    </div>

                                    <!-- slug -->
                                    <div class="form-group _form-group">
                                        <label for="input_banner_slug" class="font-weight-bold">
                                            Slug
                                        </label>
                                        <input id="input_banner_slug" value="{{ old('banner_slug') }}" name="banner_slug" type="text" class="form-control @error('banner_slug') is-invalid @enderror" placeholder="Auto Generate" readonly />
                                        @error('banner_slug')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                        @enderror
                                    </div>

                                    <!-- image -->
                                    <div class="form-group _form-group">
                                        <label for="input_banner_image" class="font-weight-bold">
                                            Upload Image <span class="wajib">* </span>
                                        </label>
                                        <div class="input-group">
                                            <div class="input-group-prepend">
                                                <button id="button_banner_image" data-preview="holder" data-input="input_banner_image" class="btn btn-primary" type="button" style="padding: 0px 10px 0px 10px;">
                                                    Browse
                                                </button>
                                            </div>
                                            <input id="input_banner_image" name="banner_image" value="{{ old('banner_image') }}" type="text" class="form-control @error('banner_image') is-invalid @enderror" placeholder="Choose Image" readonly />
                                            @error('banner_image')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                            @enderror
                                        </div>
                                        <div id="holder" style="margin-top: 20px;">
                                        </div>
                                    </div>

                                    <!-- status -->
                                    <div class="form-group{{ $errors->has('is_active') ? ' has-error' : '' }} _form-group">
                                        <label for="input_post_status" class="font-weight-bold">
                                            Status
                                        </label>
                                        <div class="form-group">
                                            <label class="switch">
                                                <input type="checkbox" name="is_active" {{ old("is_active") == 1  ? "checked"  : null }}>
                                                <span class="slider round"></span>
                                            </label>
                                        </div>
                                    </div>

                                </div>
                                <div class="col-md-3"></div>
                            </div>
                            <div class="row">
                                <div class="col-md-3">
                                </div>
                                <div class="col-md-6">
                                    <div class="float-right">
                                        <a class="btn btn-outline-secondary _btn-secondary px-4" href="{{ route('banners.index') }}">Back</a>
                                        <button type="submit" class="btn btn-primary _btn-primary px-4">
                                            Save
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
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/switchery/0.8.2/switchery.min.css">
<script src="https://cdnjs.cloudflare.com/ajax/libs/switchery/0.8.2/switchery.min.js"></script>
@endpush

@push('javascript-internal')
<script>
    $(document).ready(function() {
        $("#input_banner_title").change(function(event) {
            $("#input_banner_slug").val(
                event.target.value
                .trim()
                .toLowerCase()
                .replace(/[^a-z\d-]/gi, "-")
                .replace(/-+/g, "-")
                .replace(/^-|-$/g, "")
            );
        });

        $('#button_banner_image').filemanager('image');

    });
</script>
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