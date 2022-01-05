@extends('layouts.dashboard')

@section('content')
<section class="home-section">
    {{ Breadcrumbs::render('add_tag') }}

    <div class="text">
        @section('title')
        Add Tag Category
        @endsection
        Add Tag Category
    </div>

    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-body _card-body">
                        <form action="{{ route('tags.store') }}" method="POST">
                            @csrf
                            <div class="row">
                                <div class="col-md-3"></div>
                                <div class="col-md-6">
                                    <!-- title -->
                                    <div class="form-group _form-group">
                                        <label for="input_tag_title" class="font-weight-bold">
                                            Name <span class="wajib">*</span>
                                        </label>
                                        <input id="input_tag_title" value="{{ old('tag_title') }}" name="tag_title" type="text" class="form-control @error('tag_title') is-invalid @enderror" placeholder="Write name here.." />
                                        @error('tag_title')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                        @enderror
                                    </div>
                                    <!-- slug -->
                                    <div class="form-group _form-group">
                                        <label for="input_tag_slug" class="font-weight-bold">
                                            Slug
                                        </label>
                                        <input id="input_tag_slug" value="{{ old('tag_slug') }}" name="tag_slug" type="text" class="form-control @error('tag_slug') is-invalid @enderror" placeholder="Auto Generate" readonly />
                                        @error('tag_slug')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                        @enderror
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
                                <div class="col-md-3"></div>
                                <div class="col-md-6">
                                    <button type="submit" class="btn btn-primary _btn-primary float-right px-4">
                                        Save
                                    </button>
                                    <div class="float-right">
                                        <a class="btn btn-outline-secondary _btn-secondary px-4 mx-2" href="{{ route('tags.index') }}">
                                            Back
                                        </a>
                                    </div>
                                </div>
                                <div class="col-md-3"></div>
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
    $(document).ready(function() {
        $("#input_tag_title").change(function(event) {
            $("#input_tag_slug").val(
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