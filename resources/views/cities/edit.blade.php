@extends('layouts.dashboard')

@section('content')
<section class="home-section">
    {{ Breadcrumbs::render('detail_city', $city) }}

    <div class="text">
        @section('title')
        Edit City
        @endsection
        Edit City
    </div>

    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <form action="{{ route('city.update', ['city' => $city]) }}" method="POST">
                    @method('PUT')
                    @csrf
                    <div class="card">
                        <div class="card-body _card-body">
                            <div class="row d-flex align-items-stretch">
                                <div class="col-md-3"></div>
                                <div class="col-md-6">
                                    <!-- title -->
                                    <div class="form-group _form-group">
                                        <label for="input_category_title" class="font-weight-bold">
                                            Name <span class="wajib">* </span>
                                        </label>
                                        <input id="input_category_title" value="{{ old('city_name', $city->city_name) }}" name="city_name" type="text" class="form-control @error('city_name') is-invalid @enderror" placeholder="" />
                                        @error('city_name')
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
                                        <input id="input_category_slug" name="city_slug" type="text" class="form-control @error('city_slug') is-invalid @enderror" value="{{ old('city_slug', $city->city_slug) }}" readonly />
                                        @error('city_slug')
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
                                                <input type="checkbox" name="is_active" {{ old('is_active', $city->is_active) == 1  ? 'checked'  : null }}>
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
                                        <a class="btn btn-outline-secondary _btn-secondary px-4" href="{{ route('city.index') }}">Back</a>
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
@endpush