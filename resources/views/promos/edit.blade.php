@extends('layouts.dashboard')

@section('content')
<section class="home-section">
    {{ Breadcrumbs::render('detail_promo', $promo) }}

    <div class="text">
        @section('title')
        Promo
        @endsection
        Promo
    </div>

    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <form action="{{ route('promo.update', ['promo' => $promo]) }}" method="POST">
                    @method('PUT')
                    @csrf
                    <div class="card">
                        <div class="card-body _card-body">
                            <div class="row d-flex align-items-stretch">
                                <div class="col-md-6">
                                    <!-- title -->
                                    <div class="form-group _form-group">
                                        <label for="input_post_title" class="font-weight-bold">
                                            Title <span class="wajib">*</span>
                                        </label>
                                        <input id="input_post_title" value="{{ old('promo_title', $promo->promo_title) }}" name="promo_title" type="text" class="form-control @error('promo_title') is-invalid @enderror" placeholder="" />
                                        @error('promo_title')
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
                                        <input id="input_post_slug" name="promo_slug" type="text" class="form-control @error('promo_slug') is-invalid @enderror" value="{{ old('promo_slug', $promo->promo_slug) }}" readonly />
                                        @error('promo_slug')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                        @enderror
                                    </div>

                                    <!-- caption -->
                                    <div class="form-group _form-group">
                                        <label for="input_post_caption" class="font-weight-bold">
                                            Short Description <span class="wajib">*</span>
                                        </label>
                                        <textarea id="input_post_caption" name="promo_excerpt" placeholder="" class="form-control @error('promo_excerpt') is-invalid @enderror" rows="3">{{ old('promo_excerpt', $promo->promo_excerpt) }}</textarea>
                                        @error('promo_excerpt')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                        @enderror
                                    </div>
                                    <!-- description -->
                                    <div class="form-group _form-group">
                                        <label for="input_post_description" class="font-weight-bold">
                                            Description <span class="wajib">*</span>
                                        </label>
                                        <textarea id="input_post_description" name="promo_description" placeholder="" class="form-control @error('promo_description') is-invalid @enderror" rows="20">{{ old('promo_description', $promo->promo_description) }}</textarea>
                                        @error('promo_description')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                        @enderror
                                    </div>

                                </div>


                                <div class="col-md-6">
                                    <!-- thumbnail -->
                                    <div class="form-group _form-group">
                                        <label for="input_post_thumbnail" class="font-weight-bold">
                                            Upload Image <span class="wajib">*</span>
                                        </label>
                                        <div class="input-group">
                                            <div class="input-group-prepend">
                                                <button id="button_post_thumbnail" data-input="input_post_thumbnail" class="btn btn-primary" type="button" style="padding: 0px 10px 0px 10px;">
                                                    Browse
                                                </button>
                                            </div>
                                            <input id="input_post_thumbnail" name="promo_thumbnail" value="{{ old('promo_thumbnail', $promo->promo_thumbnail) }}" type="text" class="form-control @error('promo_thumbnail') is-invalid @enderror" placeholder="" readonly />
                                            @error('promo_thumbnail')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                            @enderror
                                        </div>
                                    </div>

                                    <!-- status -->
                                    <div class="form-group{{ $errors->has('is_active') ? ' has-error' : '' }} _form-group">
                                        <label for="input_post_status" class="font-weight-bold">
                                            Status
                                        </label>
                                        <div class="form-group">
                                            <label class="switch">
                                                <input type="checkbox" name="is_active" {{ old('is_active', $promo->is_active) == 1  ? 'checked'  : null }}>
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
                                        <input id="input_post_meta_title" value="{{ old('promo_meta_title', $promo->promo_meta_title) }}" name="promo_meta_title" type="text" class="form-control @error('promo_meta_title') is-invalid @enderror" placeholder="Write meta title here.." />
                                        @error('promo_meta_title')
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
                                        <textarea id="input_post_meta_description" name="promo_meta_description" placeholder="Max 150 Words | Write meta description here.." class="form-control @error('promo_meta_description') is-invalid @enderror" rows="3">{{ old('promo_meta_description', $promo->promo_meta_description) }}</textarea>
                                        @error('promo_meta_description')
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
                                        <textarea id="input_post_meta_keyword" name="promo_meta_keyword" value="{{ old('promo_meta_keyword', $promo->promo_meta_keyword) }}" placeholder="Example: jasa, perusahaan, digital marketing, programming" class="form-control @error('promo_meta_keyword') is-invalid @enderror" rows="3">{{ old('promo_meta_keyword', $promo->promo_meta_keyword) }}</textarea>
                                        @error('promo_meta_keyword')
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
                                        <a class="btn btn-outline-secondary _btn-secondary px-4" href="{{ route('promo.index') }}">Back</a>
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
    });
</script>
@endpush