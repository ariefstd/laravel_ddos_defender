@extends('layouts.dashboard')

@section('content')
<section class="home-section">
    {{ Breadcrumbs::render('detail_market', $market) }}

    <div class="text">
        @section('title')
        Edit Pasar
        @endsection
        Edit Pasar
    </div>

    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <form action="{{ route('market.update', ['market' => $market]) }}" method="POST">
                    @method('PUT')
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
                                        <input id="input_post_title" value="{{ old('market_name', $market->market_name) }}" name="market_name" type="text" class="form-control @error('market_name') is-invalid @enderror" placeholder="" />
                                        @error('market_name')
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
                                        <input id="input_post_slug" name="market_slug" type="text" class="form-control @error('market_slug') is-invalid @enderror" value="{{ old('market_slug', $market->market_slug) }}" readonly />
                                        @error('market_slug')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                        @enderror
                                    </div>

                                    <!-- thumbnail -->
                                    <div class="form-group _form-group">
                                        <label for="input_post_thumbnail" class="font-weight-bold">
                                            Upload Image <span class="wajib">*</span>
                                        </label>
                                        <div class="input-group">
                                            <div class="input-group-prepend">
                                                <button id="button_post_thumbnail" data-input="input_post_thumbnail" class="btn btn-primary" type="button" style="padding: 0px 10px 0px 10px;" data-preview="holder">
                                                    Browse
                                                </button>
                                            </div>
                                            <input id="input_post_thumbnail" name="market_thumbnail" value="{{ old('market_thumbnail', $market->market_thumbnail) }}" type="text" class="form-control @error('market_thumbnail') is-invalid @enderror" placeholder="" data-preview="holder" readonly />
                                            @error('market_thumbnail')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                            @enderror
                                        </div>
                                        <div class="pre-img" style="margin-top: 20px; display: flex; width: 100px;">
                                            @if (file_exists(public_path($market->market_thumbnail)))
                                            <div class="img-pre">
                                                <img src="{{ asset($market->market_thumbnail) }}" alt="" style="width: 200px; height:auto">
                                            </div>
                                            @else
                                            <div id="holder"></div>
                                            @endif
                                        </div>

                                    </div>

                                    <div class="form-group _form-group">
                                        <label for="input_post_caption" class="font-weight-bold">
                                            Address <span class="wajib">*</span>
                                        </label>
                                        <textarea id="input_post_caption" name="market_address" placeholder="" class="form-control @error('market_address') is-invalid @enderror" rows="3">{{ old('market_address', $market->market_address) }}</textarea>
                                        @error('market_address')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                        @enderror
                                    </div>

                                </div>


                                <div class="col-md-6">
                                    <div class="row">
                                        <div class="col-md-6">
                                            <!-- lat -->
                                            <div class="form-group _form-group">
                                                <label for="input_post_lat" class="font-weight-bold">
                                                    Latitude <span class="wajib">*</span>
                                                </label>
                                                <input id="input_post_lat" value="{{ old('market_lat', $market->market_lat) }}" name="market_lat" type="number" step="any" class="form-control @error('market_lat') is-invalid @enderror" placeholder="" />
                                                @error('market_lat')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <!-- long -->
                                            <div class="form-group _form-group">
                                                <label for="input_post_long" class="font-weight-bold">
                                                    Longitude <span class="wajib">*</span>
                                                </label>
                                                <input id="input_post_long" value="{{ old('market_long', $market->market_long) }}" name="market_long" type="number" step="any" class="form-control @error('market_long') is-invalid @enderror" placeholder="" />
                                                @error('market_long')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                                @enderror
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col-md-6">
                                            <!-- role -->
                                            <div class="form-group _form-group">
                                                <label for="select_user_role" class="font-weight-bold">
                                                    City <span class="wajib">*</span>
                                                </label>

                                                <select id="select_city" name="city" data-placeholder="Choose city" class="custom-select w-100 @error('city') is-invalid @enderror">
                                                    @if (old('city', $citySelected))
                                                    <option value="{{ old('city', $citySelected)->id }}" selected>
                                                        {{ old('city', $citySelected)->city_name }}
                                                    </option>
                                                    @endif
                                                </select>
                                                @error('city')
                                                <span class="invalid-feedback">
                                                    {{ $message }}
                                                </span>
                                                @enderror
                                                <!-- error message -->
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <!-- role -->
                                            <div class="form-group _form-group">
                                                <label for="select_user_role" class="font-weight-bold">
                                                    Region <span class="wajib">*</span>
                                                </label>

                                                <select id="select_region" name="region" data-placeholder="Choose region" class="custom-select w-100 @error('region') is-invalid @enderror">
                                                    @if (old('region', $regionSelected))
                                                    <option value="{{ old('region', $regionSelected)->id }}" selected>
                                                        {{ old('region', $regionSelected)->region_name }}
                                                    </option>
                                                    @endif
                                                </select>
                                                @error('region')
                                                <span class="invalid-feedback">
                                                    {{ $message }}
                                                </span>
                                                @enderror
                                                <!-- error message -->
                                            </div>
                                        </div>
                                    </div>


                                    <div class="row">
                                        <div class="col-md-6">
                                            <!-- long -->
                                            <div class="form-group _form-group">
                                                <label for="input_post_long" class="font-weight-bold">
                                                    Phone Number <span class="wajib">*</span>
                                                </label>
                                                <input id="input_post_long" value="{{ old('market_phone', $market->market_phone) }}" name="market_phone" type="number" step="any" class="form-control @error('market_phone') is-invalid @enderror" placeholder="" />
                                                @error('market_phone')
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
                                                    <input id="input_post_lat" value="{{ old('market_wa', $market->market_wa) }}" name="market_wa" type="number" step="any" class="form-control @error('market_wa') is-invalid @enderror" placeholder="" />
                                                </div>
                                                @error('market_wa')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                                @enderror
                                            </div>
                                        </div>
                                    </div>

                                    <!-- gmap -->
                                    <div class="form-group _form-group">
                                        <label for="input_post_gmap" class="font-weight-bold">
                                            GMap Link <span class="wajib">*</span>
                                        </label>
                                        <input id="input_post_gmap" value="{{ old('market_gmap', $market->market_gmap) }}" name="market_gmap" type="text" class="form-control @error('market_gmap') is-invalid @enderror" placeholder="" />
                                        @error('market_gmap')
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
                                                <input type="checkbox" name="is_active" {{ old('is_active', $market->is_active) == 1  ? 'checked'  : null }}>
                                                <span class="slider round"></span>
                                            </label>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="float-right">
                                        <a class="btn btn-outline-secondary _btn-secondary px-4" href="{{ route('market.index') }}">Back</a>
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

        $('#input_post_title').change(function() {
            let title = $(this).val();
            let parent_post = $('#select_post_parent').val() ?? "";
            $('#input_post_slug').val(generateSlug(title));
        });

        $('#select_post_parent').change(function() {
            let title = $('#input_post_title').val();
            let parent_post = $(this).val() ?? "";
            $('#input_post_slug').val(generateSlug(title));
        });

        $('#button_post_thumbnail').filemanager('image');

        $("#input_post_description").tinymce({
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
    $(document).ready(function() {

        let cityID = $('#select_city').val();
        let regionID = $('#select_region').val();

        $('#select_region').select2();
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

        //  select regency:start
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
        //  select regency:end

        //  Event on change select province:start
        $('#select_city').change(function() {
            //clear select
            $('#select_region').empty();
            //set id
            cityID = $(this).val();
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

        // EVENT ON CLEAR
        $('#select_city').on('select2:clear', function(e) {
            $("#select_region").select2();
        });

    });
</script>
@endpush