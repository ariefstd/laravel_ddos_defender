@extends('layouts.dashboard')

@section('content')
<section class="home-section">
    {{ Breadcrumbs::render('add_stall') }}

    <div class="text">
        @section('title')
        Add Kios
        @endsection
        Add Kios
    </div>

    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <form action="{{ route('stall.store') }}" enctype="multipart/form-data" method="POST">
                    @csrf
                    <div class="card">
                        <div class="card-body _card-body">
                            <div class="row d-flex align-items-stretch">
                                <div class="col-md-6">
                                    <!-- title -->
                                    <div class="form-group _form-group">
                                        <label for="input_post_title" class="font-weight-bold">
                                            Name <span class="wajib">*</span>
                                        </label>
                                        <input id="input_post_title" value="{{ old('stall_name') }}" name="stall_name" type="text" class="form-control @error('stall_name') is-invalid @enderror" placeholder="Write title here.." />
                                        @error('stall_name')
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
                                        <input id="input_post_slug" value="{{ old('stall_slug') }}" name="stall_slug" type="text" class="form-control @error('stall_slug') is-invalid @enderror" placeholder="Auto Generate" readonly />
                                        @error('stall_slug')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                        @enderror
                                    </div>
                                    <!-- thumbnail -->
                                    <div class="form-group _form-group">
                                        <label for="input_post_thumbnail" class="font-weight-bold">
                                            Image Cover <span class="wajib">*</span>
                                        </label>
                                        <div class="input-group">
                                            <div class="input-group-prepend">
                                                <button id="button_post_thumbnail" data-preview="holder" data-input="input_post_thumbnail" class="btn btn-primary" type="button" style="padding: 0px 10px 0px 10px;">
                                                    Browse
                                                </button>
                                            </div>
                                            <input id="input_post_thumbnail" name="stall_cover" value="{{ old('stall_cover') }}" type="text" class="form-control @error('stall_cover') is-invalid @enderror" placeholder="Choose Image" readonly />
                                            @error('stall_cover')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                            @enderror
                                        </div>
                                        <div id="holder" style="margin-top: 20px;">
                                        </div>
                                    </div>

                                    <!-- gallery -->
                                    <div class="form-group _form-group">
                                        <label for="input_post_thumbnail" class="font-weight-bold">
                                            Gallery
                                        </label>
                                        <div class="input-group">
                                            <input id="input_post_thumbnail" multiple="multiple" name="photos[]" value="{{ old('photos') }}" type="file" style="height: 50px;" class="form-control @error('photos') is-invalid @enderror" placeholder="Choose Image" value="{{ old('photos') }}">
                                            @error('photos')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                            @enderror
                                        </div>

                                    </div>

                                    <!-- description -->
                                    <div class="form-group _form-group">
                                        <label for="input_post_description" class="font-weight-bold">
                                            Description <span class="wajib">*</span>
                                        </label>
                                        <textarea id="input_post_description" name="stall_desc" placeholder="Write description here.." class="form-control @error('stall_desc') is-invalid @enderror" rows="20">{{ old('stall_desc') }}</textarea>
                                        @error('stall_desc')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                        @enderror
                                    </div>
                                </div>



                                <div class="col-md-6">
                                    <div class="row">
                                        <div class="col-md-4">
                                            <!-- role -->
                                            <div class="form-group _form-group">
                                                <label for="select_user_role" class="font-weight-bold">
                                                    City <span class="wajib">*</span>
                                                </label>
                                                <select id="select_city" name="city" data-placeholder="Choose City" value="{{ old('city_id') }}" class="custom-select w-100 @error('city') is-invalid @enderror">

                                                </select>
                                                @error('city')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                                @enderror
                                                <!-- error message -->
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <!-- role -->
                                            <div class="form-group _form-group">
                                                <label for="select_user_role" class="font-weight-bold">
                                                    Region <span class="wajib">*</span>
                                                </label>
                                                <select id="select_region" name="region" value="{{ old('region_id') }}" data-placeholder="Choose Region" class="custom-select w-100 @error('region') is-invalid @enderror">
                                                </select>
                                                @error('region')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                                @enderror
                                                <!-- error message -->
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <!-- role -->
                                            <div class="form-group _form-group">
                                                <label for="select_user_role" class="font-weight-bold">
                                                    Pasar <span class="wajib">*</span>
                                                </label>
                                                <select id="select_market" name="market" value="{{ old('market_id') }}" data-placeholder="Choose Pasar" class="custom-select w-100 @error('market') is-invalid @enderror">

                                                </select>
                                                @error('market_id')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                                @enderror
                                                <!-- error message -->
                                            </div>
                                        </div>
                                    </div>


                                    <!-- address -->
                                    <div class="form-group _form-group">
                                        <label for="input_post_caption" class="font-weight-bold">
                                            Address <span class="wajib">*</span>
                                        </label>
                                        <textarea id="input_post_caption" name="stall_address" placeholder="Write stall address here.." class="form-control @error('stall_address') is-invalid @enderror" rows="3">{{ old('stall_address') }}</textarea>
                                        @error('stall_address')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                        @enderror
                                    </div>
                                    <div class="row">
                                        <div class="col-md-6">
                                            <!-- Operatinal Hour -->
                                            <div class="form-group _form-group">
                                                <label for="input_post_description" class="font-weight-bold">
                                                    Operational Hour <span class="wajib">*</span>
                                                </label>
                                                <textarea id="input_post_operational" name="stall_operational" value="{{ old('stall_operational') }}" placeholder="Write operational schedule here.." class="form-control @error('stall_operational') is-invalid @enderror" rows="20">{{ old('stall_operational') }}</textarea>
                                                @error('stall_operational')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <!-- catgeory -->
                                            <div class="form-group _form-group">
                                                <label for="input_post_description" class="font-weight-bold">
                                                    Category
                                                </label>
                                                <div class="form-control overflow-auto" style="height: 440px">
                                                    <!-- List category -->
                                                    <ul class="pl-1 my-1" style="list-style: none;">
                                                        @foreach ($categories as $category)
                                                        <li class="form-group form-check my-1">
                                                            @if (old('category') && in_array($category->id, old('category')))
                                                            <input class="form-check-input" value="{{ $category->id }}" type="checkbox" name="category[]" checked>
                                                            @else
                                                            <input class="form-check-input" value="{{ $category->id }}" type="checkbox" name="category[]">
                                                            @endif
                                                            <label class="form-check-label">{{ $category->food_name}}</label>
                                                        </li>
                                                        @endforeach

                                                    </ul>
                                                    <!-- List category -->
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col-md-6">
                                            <!-- phone -->
                                            <div class="form-group _form-group">
                                                <label for="input_post_long" class="font-weight-bold">
                                                    Phone Number <span class="wajib">*</span>
                                                </label>
                                                <input id="input_post_long" value="{{ old('stall_phone') }}" name="stall_phone" type="number" step="any" class="form-control @error('stall_phone') is-invalid @enderror" placeholder="Example: 081234567812" />
                                                @error('stall_phone')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <!-- lat -->
                                            <div class="form-group _form-group">
                                                <label for="input_post_lat" class="font-weight-bold">
                                                    Whatsapp Number <span class="wajib">*</span>
                                                </label>

                                                <div class="input-group mb-2">
                                                    <div class="input-group-prepend">
                                                        <div class="input-group-text" style="height: 35px">+62</div>
                                                    </div>
                                                    <input id="input_post_lat" value="{{ old('stall_wa') }}" name="stall_wa" type="number" step="any" class="form-control @error('stall_wa') is-invalid @enderror" placeholder="Example: 81234567812">
                                                </div>
                                                @error('stall_wa')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                                @enderror
                                            </div>
                                        </div>
                                    </div>

                                    <!-- iframe -->
                                    <div class="form-group _form-group">
                                        <label for="input_post_caption" class="font-weight-bold">
                                            GMap iFrame <span class="wajib">*</span>
                                        </label>
                                        <textarea id="input_post_caption" name="stall_iframe" placeholder="Write gmap iframe here.." class="form-control @error('stall_iframe') is-invalid @enderror" rows="3">{{ old('stall_iframe') }}</textarea>
                                        @error('stall_iframe')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                        @enderror
                                    </div>

                                    <!-- gmap -->
                                    <div class="form-group _form-group">
                                        <label for="input_post_gmap" class="font-weight-bold">
                                            GMap Link <span class="wajib">*</span>
                                        </label>
                                        <input id="input_post_gmap" value="{{ old('stall_gmap') }}" name="stall_gmap" type="text" class="form-control @error('stall_gmap') is-invalid @enderror" placeholder="Input gmap link here.." />
                                        @error('stall_gmap')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                        @enderror
                                    </div>
                                    <!-- status -->
                                    <div class="form-group _form-group{{ $errors->has('is_active') ? ' has-error' : '' }}">
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
                                        <a class="btn btn-outline-secondary _btn-secondary px-4" href="{{ route('stall.index') }}">Back</a>
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
{{-- CSS assets in head section --}}
<link href="https://cdnjs.cloudflare.com/ajax/libs/dropzone/5.5.1/min/dropzone.min.css" rel="stylesheet" />
<link rel="stylesheet" href="{{ asset('vendor/select2/css/select2.min.css') }}">
<link rel="stylesheet" href="{{ asset('vendor/select2/css/select2-bootstrap4.min.css') }}">
@endpush

@push('javascript-external')
<script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.3.7/js/bootstrap.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/dropzone/5.5.1/min/dropzone.min.js"></script>
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

        $("#input_post_operational").tinymce({
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
<script>
    $(document).ready(function() {
        $('#select_region').select2();
        $('#select_market').select2();
        //  select province:start
        $('#select_city').select2({
            allowClear: true,
            ajax: {
                url: "{{ route('city.select') }}",
                dataType: 'json',
                delay: 250,
                processResults: function(data) {
                    return {
                        results: $.map(data, function(item) {
                            return {
                                text: item.city_name,
                                id: item.id
                            }
                        })
                    };
                }
            }
        });
        //  select province:end

        //  Event on change select province:start
        $('#select_city').change(function() {
            //clear select
            $('#select_region').empty();
            $('#select_market').empty();
            //set id
            let cityID = $(this).val();
            if (cityID) {
                $('#select_region').select2({
                    allowClear: true,
                    ajax: {
                        url: "{{ route('region.select') }}?cityID=" + cityID,
                        dataType: 'json',
                        delay: 250,
                        processResults: function(data) {
                            return {
                                results: $.map(data, function(item) {
                                    return {
                                        text: item.region_name,
                                        id: item.id
                                    }
                                })
                            };
                        }
                    }
                });
            } else {
                $('#select_region').empty();
            }
        });
        //  Event on change select province:end

        //  Event on change select district:Start
        $('#select_region').change(function() {
            //set id
            let regionID = $(this).val();
            if (regionID) {
                $('#select_market').select2({
                    allowClear: true,
                    ajax: {
                        url: "{{ route('markets.select') }}?regionID=" + regionID,
                        dataType: 'json',
                        delay: 250,
                        processResults: function(data) {
                            return {
                                results: $.map(data, function(item) {
                                    return {
                                        text: item.market_name,
                                        id: item.id
                                    }
                                })
                            };
                        }
                    }
                });
            } else {
                $('#select_market').empty();
            }
        });
        //  Event on change select district:End

        // EVENT ON CLEAR
        $('#select_city').on('select2:clear', function(e) {
            $("#select_region").select2();
            $("#select_market").select2();
        });

        $('#select_region').on('select2:clear', function(e) {
            $("#select_market").select2();
        });

    });
</script>
@endpush