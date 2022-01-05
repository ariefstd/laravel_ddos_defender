@extends('layouts.dashboard')

@section('content')
<section class="home-section">
    {{ Breadcrumbs::render('add_meta') }}

    <div class="text">
        @section('title')
        Add Meta
        @endsection
        Add Meta
    </div>

    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <form action="{{ route('metas.store') }}" method="POST">
                    @csrf
                    <div class="card">
                        <div class="card-body _card-body">
                            <div class="row d-flex align-items-stretch">
                                <div class="col-md-6">
                                    <!-- page -->
                                    <div class="form-group _form-group">
                                        <label for="input_meta_page" class="font-weight-bold">
                                            Page <span class="wajib">*</span>
                                        </label>
                                        <input id="input_meta_page" value="{{ old('meta_page') }}" name="meta_page" type="text" class="form-control @error('meta_page') is-invalid @enderror" placeholder="Write page name here.." />
                                        @error('meta_page')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                        @enderror
                                    </div>

                                    <!-- slug -->
                                    <div class="form-group _form-group">
                                        <label for="input_meta_slug" class="font-weight-bold">
                                            Slug
                                        </label>
                                        <input id="input_meta_slug" value="{{ old('meta_slug') }}" name="meta_slug" type="text" class="form-control @error('meta_slug') is-invalid @enderror" placeholder="Auto Generate" readonly />
                                        @error('meta_slug')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                        @enderror
                                    </div>



                                </div>
                                <div class="col-md-6">
                                    <!-- title -->
                                    <div class="form-group _form-group">
                                        <label for="input_meta_title" class="font-weight-bold">
                                            Title <span class="wajib">*</span>
                                        </label>
                                        <input id="input_meta_title" value="{{ old('meta_title') }}" name="meta_title" type="text" class="form-control @error('meta_title') is-invalid @enderror" placeholder="Write title page here.." />
                                        @error('meta_title')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                        @enderror
                                    </div>
                                    <!-- caption -->
                                    <div class="form-group _form-group">
                                        <label for="input_meta_caption" class="font-weight-bold">
                                            Description <span class="wajib">*</span>
                                        </label>
                                        <textarea id="input_meta_caption" value="" name="meta_description" type="text" class="form-control @error('meta_description') is-invalid @enderror" placeholder="Max 150 Words | Write description here.." rows="5">{{ old('meta_description') }}</textarea>
                                        @error('meta_description')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                        @enderror
                                    </div>
                                    <!-- keyword -->
                                    <div class="form-group _form-group">
                                        <label for="input_meta_keyword" class="font-weight-bold">
                                            Keyword <span class="wajib">*</span>
                                        </label>
                                        <textarea id="input_meta_keyword" value="" name="meta_keyword" type="text" class="form-control @error('meta_keyword') is-invalid @enderror" placeholder="Example: jasa, perusahaan, digital marketing, programming">{{ old('meta_keyword') }}</textarea>
                                        @error('meta_keyword')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                        @enderror
                                    </div>
                                    <!-- status -->
                                    <div class="form-group _form-group{{ $errors->has('is_active') ? ' has-error' : '' }}" style="display: none;">
                                        <label for="input_meta_status" class="font-weight-bold">
                                            Status
                                        </label>
                                        <select class="form-control" name="is_active" id="is_active">
                                            <option value="1" style="font-weight: bold;" @if (old('is_active')==1) selected @endif><b>Published</b></option>
                                            <option value="0" style="font-weight: bold;" @if (old('is_active')==0) selected @endif><b>Draft</b></option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="float-right">
                                        <a class="btn btn-outline-secondary _btn-secondary px-4" href="{{ route('metas.index') }}">Back</a>
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
        $("#input_meta_page").change(function(event) {
            $("#input_meta_slug").val(
                event.target.value
                .trim()
                .toLowerCase()
                .replace(/[^a-z\d-]/gi, "-")
                .replace(/-+/g, "-")
                .replace(/^-|-$/g, "")
            );
        });

        $('#button_meta_image').filemanager('image');

        $("#input_meta_description").tinymce({
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

    });
</script>
@endpush