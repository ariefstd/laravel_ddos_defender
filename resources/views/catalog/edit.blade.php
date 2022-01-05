@extends('layouts.dashboard')

@section('content')
<section class="home-section">
    {{ Breadcrumbs::render('detail_catalog', $catalog) }}

    <div class="text">
        @section('title')
        Edit Catalog
        @endsection
        Edit Catalog
    </div>

    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <form action="{{ route('catalog.update', ['catalog' => $catalog]) }}" method="POST">
                    @method('PUT')
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
                                        <input id="input_banner_title" value="{{ old('catalog_name', $catalog->catalog_name) }}" name="catalog_name" type="text" class="form-control @error('catalog_name') is-invalid @enderror" placeholder="" />
                                        @error('catalog_name')
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
                                        <input id="input_banner_seq" value="{{ old('catalog_seq', $catalog->catalog_seq) }}" name="catalog_seq" type="number" class="form-control @error('catalog_seq') is-invalid @enderror" placeholder="" />
                                        @error('catalog_seq')
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
                                        <input id="input_banner_slug" name="catalog_slug" type="text" class="form-control @error('catalog_slug') is-invalid @enderror" value="{{ old('catalog_slug', $catalog->catalog_slug) }}" readonly />
                                        @error('catalog_slug')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                        @enderror
                                    </div>

                                    <!-- image -->
                                    <div class="form-group _form-group">
                                        <label for="input_banner_image" class="font-weight-bold">
                                            Upload File <span class="wajib">* </span>
                                        </label>
                                        <div class="input-group">
                                            <div class="input-group-prepend">
                                                <button id="button_banner_image" data-input="input_banner_image" class="btn btn-primary" type="button" style="padding: 0px 10px 0px 10px;">
                                                    Browse
                                                </button>
                                            </div>
                                            <input id="input_banner_image" name="catalog_file" value="{{ old('catalog_file', $catalog->catalog_file) }}" type="text" class="form-control @error('catalog_file') is-invalid @enderror" placeholder="" readonly />
                                            @error('catalog_file')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                            @enderror
                                        </div>
                                    </div>

                                    <!-- status -->
                                    <div class="form-group{{ $errors->has('is_active') ? ' has-error' : '' }} _form-group">
                                        <label for="input_banner_status" class="font-weight-bold">
                                            Status
                                        </label>

                                        <div class="form-group">
                                            <label class="switch">
                                                <input type="checkbox" name="is_active" {{ old('is_active', $catalog->is_active) == 1  ? 'checked'  : null }}>
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
                                    <div class="float-right">
                                        <a class="btn btn-outline-secondary _btn-secondary px-4" href="{{ route('catalog.index') }}">Back</a>
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

</section>
@endsection

@push('css-external')
<link rel="stylesheet" href="{{ asset('vendor/select2/css/select2.min.css') }}">
<link rel="stylesheet" href="{{ asset('vendor/select2/css/select2-bootstrap4.min.css') }}">
@endpush

@push('javascript-external')
<script src="{{ asset('vendor/laravel-filemanager/js/stand-alone-button.js') }}"></script>
<script src="{{ asset('vendor/tinymce5/jquery.tinymce.min.js') }}"></script>
<script src="{{ asset('vendor/tinymce5/tinymce.min.js') }}"></script>
<script src="{{ asset('vendor/select2/js/select2.min.js') }}"></script>
<script src="{{ asset('vendor/select2/js/' . app()->getLocale() . '.js') }}"></script>
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

        $('#button_banner_image').filemanager('file');

    });
</script>
@endpush