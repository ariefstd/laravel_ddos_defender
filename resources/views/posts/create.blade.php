@extends('layouts.dashboard')


@section('content')
<section class="home-section">
    {{ Breadcrumbs::render('add_post') }}

    <div class="text">
        @section('title')
        Add Post
        @endsection
        Add Post
    </div>

    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <form action="{{ route('posts.store') }}" method="POST">
                    @csrf
                    <div class="card">
                        <div class="card-body _card-body">
                            <div class="row d-flex align-items-stretch">
                                <div class="col-md-6">
                                    <!-- title -->
                                    <div class="form-group _form-group">
                                        <label for="input_post_title" class="font-weight-bold">
                                            Title <span class="wajib">* </span>
                                        </label>
                                        <input id="input_post_title" value="{{ old('post_title') }}" name="post_title" type="text" class="form-control @error('post_title') is-invalid @enderror" placeholder="Write title here.." />
                                        @error('post_title')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                        @enderror
                                    </div>

                                    <!-- slug -->
                                    <div class="form-group _form-group">
                                        <label for="input_post_slug" class="font-weight-bold">
                                            Slug
                                        </label>
                                        <input id="input_post_slug" value="{{ old('post_slug') }}" name="post_slug" type="text" class="form-control @error('post_slug') is-invalid @enderror" placeholder="Auto Generate" readonly />
                                        @error('post_slug')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                        @enderror
                                    </div>
                                    <!-- thumbnail -->
                                    <div class="form-group _form-group">
                                        <label for="input_post_thumbnail" class="font-weight-bold">
                                            Image Cover <span class="wajib">* </span>
                                        </label>
                                        <div class="input-group">
                                            <div class="input-group-prepend">
                                                <button id="button_post_thumbnail" data-preview="holder" data-input="input_post_thumbnail" class="btn btn-primary" type="button" style="padding: 0px 10px 0px 10px;">
                                                    Browse
                                                </button>
                                            </div>
                                            <input id="input_post_thumbnail" name="post_thumbnail" value="{{ old('post_thumbnail') }}" type="text" class="form-control @error('post_thumbnail') is-invalid @enderror" placeholder="Choose Image" readonly />
                                            @error('post_thumbnail')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                            @enderror
                                        </div>
                                        <div id="holder" style="margin-top: 20px;">
                                        </div>
                                    </div>
                                    <!-- caption -->
                                    <div class="form-group _form-group">
                                        <label for="input_post_caption" class="font-weight-bold">
                                            Short Description <span class="wajib">* </span>
                                        </label>
                                        <textarea id="input_post_caption" name="post_excerpt" placeholder="Write short description here.." class="form-control @error('post_excerpt') is-invalid @enderror" rows="3">{{ old('post_excerpt') }}</textarea>
                                        @error('post_excerpt')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                        @enderror
                                    </div>
                                    <!-- description -->
                                    <div class="form-group _form-group">
                                        <label for="input_post_description" class="font-weight-bold">
                                            Description <span class="wajib">* </span>
                                        </label>
                                        <textarea id="input_post_description" name="post_desc" placeholder="Write description here.." class="form-control @error('post_desc') is-invalid @enderror" rows="20">{{ old('post_desc') }}</textarea>
                                        @error('post_desc')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                        @enderror
                                    </div>


                                </div>
                                <div class="col-md-6">

                                    <!-- catgeory -->
                                    <div class="form-group  _form-group">
                                        <label for="select_user_role" class="font-weight-bold">
                                            Category <span class="wajib">* </span>
                                        </label>
                                        <select id="select_user_role" name="category" data-placeholder="Pilih Kategori" class="custom-select @error('category') is-invalid @enderror">

                                        </select>
                                        @error('category')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                        @enderror
                                        <!-- error message -->
                                    </div>
                                    <!-- tag -->
                                    <div class="form-group  _form-group">
                                        <label for="select_post_tag" class="font-weight-bold">
                                            Tag
                                        </label>
                                        <select id="select_post_tag" name="tag[]" data-placeholder="Select tag.." class="custom-select" multiple>

                                        </select>
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

                                    <hr>

                                    <!-- meta_title -->
                                    <div class="form-group _form-group">
                                        <label for="input_post_meta_title" class="font-weight-bold">
                                            Meta Title (SEO)
                                        </label>
                                        <input id="input_post_meta_title" value="{{ old('post_meta_title') }}" name="post_meta_title" type="text" class="form-control @error('post_meta_title') is-invalid @enderror" placeholder="Write meta title here.." />
                                        @error('post_meta_title')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                        @enderror
                                    </div>
                                    <!-- meta_description -->
                                    <div class="form-group _form-group">
                                        <label for="input_post_meta_description" class="font-weight-bold">
                                            Meta Description (SEO)
                                        </label>
                                        <textarea id="input_post_meta_description" name="post_meta_description" value="" placeholder="Max 150 Words | Write meta description here.." class="form-control @error('post_meta_description') is-invalid @enderror" rows="3">{{ old('post_meta_description') }}</textarea>
                                        @error('post_meta_description')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                        @enderror
                                    </div>
                                    <!-- meta_keyword -->
                                    <div class="form-group _form-group">
                                        <label for="input_post_meta_keyword" class="font-weight-bold">
                                            Meta Keyword (SEO)
                                        </label>
                                        <textarea id="input_post_meta_keyword" name="post_meta_keyword" value="{{ old('post_meta_keyword') }}" placeholder="Example: jasa, perusahaan, digital marketing, programming" class="form-control @error('post_meta_keyword') is-invalid @enderror" rows="3">{{ old('post_meta_keyword') }}</textarea>
                                        @error('post_meta_keyword')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                        @enderror
                                    </div>


                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="float-right">
                                        <a class="btn btn-outline-secondary _btn-secondary px-4" href="{{ route('posts.index') }}">Back</a>
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
<script src="{{ asset('vendor/laravel-filemanager/js/stand-alone-button.js') }}"></script>
<script src="{{ asset('vendor/tinymce5/jquery.tinymce.min.js') }}"></script>
<script src="{{ asset('vendor/tinymce5/tinymce.min.js') }}"></script>
<script src="{{ asset('vendor/select2/js/select2.min.js') }}"></script>
<script src="{{ asset('vendor/select2/js/' . app()->getLocale() . '.js') }}"></script>
@endpush

@push('javascript-internal')
<script>
    $(document).ready(function() {
        $("#input_post_title").change(function(event) {
            $("#input_post_slug").val(
                event.target.value
                .trim()
                .toLowerCase()
                .replace(/[^a-z\d-]/gi, "-")
                .replace(/-+/g, "-")
                .replace(/^-|-$/g, "")
            );
        });

        $('#button_post_thumbnail').filemanager('image');

        $("#input_post_description").tinymce({
            relative_urls: false,
            language: "en",
            plugins: [
                "advlist autolink lists link image charmap print preview hr anchor pagebreak",
                "searchreplace wordcount visualblocks visualchars code fullscreen",
                "insertdatetime media nonbreaking save table directionality",
                "emoticons template paste textpattern",
            ],
            toolbar1: "fullscreen preview",
            toolbar2: "insertfile undo redo | styleselect | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | link image media",

            file_picker_callback: function(callback, value, meta) {
                let x = window.innerWidth || document.documentElement.clientWidth || document
                    .getElementsByTagName('body')[0].clientWidth;
                let y = window.innerHeight || document.documentElement.clientHeight || document
                    .getElementsByTagName('body')[0].clientHeight;

                let cmsURL =
                    "{{ route('unisharp.lfm.show') }}" +
                    '?editor=' + meta.fieldname;
                if (meta.filetype == 'image') {
                    cmsURL = cmsURL + "&type=Images";
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
        //select2 tag
        $('#select_post_tag').select2({
            theme: 'bootstrap4',
            language: "",
            allowClear: true,
            ajax: {
                url: "{{ route('tags.select') }}",
                dataType: 'json',
                delay: 250,
                processResults: function(data) {
                    return {
                        results: $.map(data, function(item) {
                            return {
                                text: item.tag_title,
                                id: item.id
                            }
                        })
                    };
                }
            }
        });
        //select2 tag
        $('#select_user_role').select2({
            theme: 'bootstrap4',
            language: "",
            allowClear: true,
            ajax: {
                url: "{{ route('categoriespost.select') }}",
                dataType: 'json',
                delay: 250,
                processResults: function(data) {
                    return {
                        results: $.map(data, function(item) {
                            return {
                                text: item.category_title,
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