@extends('layouts.dashboard')

@section('content')
<section class="home-section">
    {{ Breadcrumbs::render('detail_team', $team) }}

    <div class="text">
        @section('title')
        Edit Team
        @endsection
        Edit Team
    </div>

    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <form action="{{ route('team.update', ['team' => $team]) }}" method="POST">
                    @method('PUT')
                    @csrf
                    <div class="card">
                        <div class="card-body _card-body">
                            <div class="row d-flex align-items-stretch">
                                <div class="col-md-6">
                                    <!-- title -->
                                    <div class="form-group _form-group">
                                        <label for="input_category_title" class="font-weight-bold">
                                            Name <span class="wajib">* </span>
                                        </label>
                                        <input id="input_category_title" value="{{ old('team_name', $team->team_name) }}" name="team_name" type="text" class="form-control @error('team_name') is-invalid @enderror" placeholder="" />
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
                                        <input id="input_banner_seq" value="{{ old('team_seq', $team->team_seq) }}" name="team_seq" type="number" class="form-control @error('team_seq') is-invalid @enderror" placeholder="" />
                                        @error('team_seq')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                        @enderror
                                    </div>

                                    <!-- slug -->
                                    <div class="form-group _form-group">
                                        <label for="input_category_slug" class="font-weight-bold">
                                            Slug
                                        </label>
                                        <input id="input_category_slug" name="team_slug" type="text" class="form-control @error('team_slug') is-invalid @enderror" value="{{ old('team_slug', $team->team_slug) }}" readonly />
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
                                                <button id="button_banner_image" data-input="input_banner_image" class="btn btn-primary" type="button" style="padding: 0px 10px 0px 10px;">
                                                    Browse
                                                </button>
                                            </div>
                                            <input id="input_banner_image" name="team_image" value="{{ old('team_image', $team->team_image) }}" type="text" class="form-control @error('team_image') is-invalid @enderror" placeholder="" readonly />
                                            @error('team_image')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="row">
                                        <div class="col-md-6">

                                            <!-- title -->
                                            <div class="form-group _form-group">
                                                <label for="input_category_title" class="font-weight-bold">
                                                    Position <span class="wajib">* </span>
                                                </label>
                                                <input id="input_category_title" value="{{ old('team_position', $team->team_position) }}" name="team_position" type="text" class="form-control @error('team_position') is-invalid @enderror" placeholder="" />
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
                                                    @if (old('category', $categorySelected))
                                                    <option value="{{ old('category', $categorySelected)->id }}" selected>
                                                        {{ old('category', $categorySelected)->category_name }}
                                                    </option>
                                                    @endif
                                                </select>

                                                @error('category')
                                                <span class="invalid-feedback">
                                                    {{ $message }}
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
                                        <textarea id="input_post_caption" name="team_desc" placeholder="" class="form-control @error('team_desc') is-invalid @enderror" rows="3">{{ old('team_desc', $team->team_desc) }}</textarea>
                                        @error('team_desc')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                        @enderror
                                    </div>

                                    <!-- status -->
                                    <div class="form-group{{ $errors->has('is_active') ? ' has-error' : '' }} _form-group">
                                        <label for="input_product_status" class="font-weight-bold">
                                            Status
                                        </label>
                                        <div class="form-group">
                                            <label class="switch">
                                                <input type="checkbox" name="is_active" {{ old('is_active', $team->is_active) == 1  ? 'checked'  : null }}>
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
                                            Update
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
<script src="{{ asset('vendor/laravel-filemanager/js/stand-alone-button.js') }}"></script>
<script src="{{ asset('vendor/tinymce5/jquery.tinymce.min.js') }}"></script>
<script src="{{ asset('vendor/tinymce5/tinymce.min.js') }}"></script>
<script src="{{ asset('vendor/select2/js/select2.min.js') }}"></script>
<script src="{{ asset('vendor/select2/js/' . app()->getLocale() . '.js') }}"></script>
@endpush

@push('javascript-internal')
<script>
    $(document).ready(function() {
        $("#input_category_title").change(function(event) {
            $("#input_category_slug").val(
                event.target.value
                .trim()
                .toLowerCase()
                .replace(/[^a-z\d-]/gi, "-")
                .replace(/-+/g, "-")
                .replace(/^-|-$/g, "")
            );
        });

        $('#input_category_title').change(function() {
            let title = $(this).val();
            let parent_category = $('#select_category_parent').val() ?? "";
            $('#input_category_slug').val(generateSlug(title));
        });

        $('#select_category_parent').change(function() {
            let title = $('#input_category_title').val();
            let parent_category = $(this).val() ?? "";
            $('#input_category_slug').val(generateSlug(title));
        });

        $('#button_category_thumbnail').filemanager('thumbnail');

        $("#input_category_description").tinymce({
            relative_urls: false,
            language: "en",
            plugins: [
                "advlist autolink lists link thumbnail charmap print preview hr anchor pagebreak",
                "searchreplace wordcount visualblocks visualchars code fullscreen",
                "insertdatetime media nonbreaking save table directionality",
                "emoticons template paste textpattern",
            ],
            toolbar1: "fullscreen preview",
            toolbar2: "insertfile undo redo | styleselect | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | link thumbnail media",

            file_picker_callback: function(callback, value, meta) {
                let x = window.innerWidth || document.documentElement.clientWidth || document
                    .getElementsByTagName('body')[0].clientWidth;
                let y = window.innerHeight || document.documentElement.clientHeight || document
                    .getElementsByTagName('body')[0].clientHeight;

                let cmsURL =
                    "{{ route('unisharp.lfm.show') }}" +
                    '?editor=' + meta.fieldname;
                if (meta.filetype == 'thumbnail') {
                    cmsURL = cmsURL + "&type=thumbnails";
                } else {
                    cmsURL = cmsURL + "&type=Files";
                }

                tinyMCE.activeEditor.windowManager.openUrl({
                    url: cmsURL,
                    title: 'Filemanager',
                    width: x * 0.8,
                    height: y * 0.8,
                    resizable: "yes",
                    close_previous: "no",
                    onMessage: (api, message) => {
                        callback(message.content);
                    }
                });
            }
        });

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