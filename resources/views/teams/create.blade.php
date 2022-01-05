@extends('layouts.dashboard')

@section('content')
<section class="home-section">
    {{ Breadcrumbs::render('add_team') }}

    <div class="text">
        @section('title')
        Add Team
        @endsection
        Add Team
    </div>

    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <form action="{{ route('team.store') }}" method="POST">
                    @csrf
                    <div class="card">
                        <div class="card-body _card-body">
                            <div class="row d-flex align-items-stretch">
                                <div class="col-md-6">

                                    <!-- title -->
                                    <div class="form-group _form-group">
                                        <label for="input_banner_title" class="font-weight-bold">
                                            Name <span class="wajib">* </span>
                                        </label>
                                        <input id="input_banner_title" value="{{ old('team_name') }}" name="team_name" type="text" class="form-control @error('team_name') is-invalid @enderror" placeholder="Write name here.." />
                                        @error('team_name')
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
                                        <input id="input_banner_seq" value="{{ old('team_seq') }}" name="team_seq" type="number" class="form-control @error('team_seq') is-invalid @enderror" placeholder="Only number, example: 1" />
                                        @error('team_seq')
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
                                        <input id="input_banner_slug" value="{{ old('team_slug') }}" name="team_slug" type="text" class="form-control @error('team_slug') is-invalid @enderror" placeholder="Auto Generate" readonly />
                                        @error('team_slug')
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
                                            <input id="input_banner_image" name="team_image" value="{{ old('team_image') }}" type="text" class="form-control @error('team_image') is-invalid @enderror" placeholder="Choose Image" readonly />
                                            @error('team_image')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                            @enderror
                                        </div>
                                        <div id="holder" style="margin-top: 20px;">
                                        </div>
                                    </div>

                                </div>

                                <div class="col-md-6">
                                    <div class="row">
                                        <div class="col-md-6">
                                            <!-- position -->
                                            <div class="form-group _form-group">
                                                <label for="input_banner_title" class="font-weight-bold">
                                                    Position <span class="wajib">* </span>
                                                </label>
                                                <input id="input_banner_title" value="{{ old('team_position') }}" name="team_position" type="text" class="form-control @error('team_position') is-invalid @enderror" placeholder="Write position here.." />
                                                @error('team_position')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <!-- role -->
                                            <div class="form-group _form-group">
                                                <label for="select_user_role" class="font-weight-bold">
                                                    Category <span class="wajib">* </span>
                                                </label>
                                                <select id="select_user_role" name="category" data-placeholder="Pilih Kategori" class="custom-select w-100 @error('category') is-invalid @enderror">

                                                </select>
                                                @error('category')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                                @enderror
                                                <!-- error message -->
                                            </div>
                                        </div>
                                    </div>

                                    <!-- description -->
                                    <div class="form-group _form-group">
                                        <label for="input_post_caption" class="font-weight-bold">
                                            Description <span class="wajib">*</span>
                                        </label>
                                        <textarea id="input_post_caption" name="team_desc" placeholder="Write description here.. | Max: 255 Word" class="form-control @error('team_desc') is-invalid @enderror" rows="3">{{ old('team_desc') }}</textarea>
                                        @error('team_desc')
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
                            </div>
                            <div class="row">

                                <div class="col-md-12">
                                    <div class="float-right">
                                        <a class="btn btn-outline-secondary _btn-secondary px-4" href="{{ route('team.index') }}">Back</a>
                                        <button type="submit" class="btn btn-primary _btn-primary px-4">
                                            Save
                                        </button>
                                    </div>
                                </div>

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
                url: "{{ route('categoriesteam.select') }}",
                dataType: 'json',
                delay: 250,
                processResults: function(data) {
                    return {
                        results: $.map(data, function(item) {
                            return {
                                text: item.category_name,
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