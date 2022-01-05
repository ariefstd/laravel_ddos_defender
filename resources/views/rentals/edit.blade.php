@extends('layouts.dashboard')

@section('content')
<section class="home-section">
    {{ Breadcrumbs::render('detail_rental', $rental) }}

    <div class="text">
        @section('title')
        Edit Rental Kios
        @endsection
        Edit Rental Kios
    </div>

    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <form action="{{ route('rental.update', ['rental' => $rental]) }}" enctype="multipart/form-data" method="POST">
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
                                        <input id="input_post_title" value="{{ old('rental_name', $rental->rental_name) }}" name="rental_name" type="text" class="form-control @error('rental_name') is-invalid @enderror" placeholder="" />
                                        @error('rental_name')
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
                                        <input id="input_post_slug" name="rental_slug" type="text" class="form-control @error('rental_slug') is-invalid @enderror" value="{{ old('rental_slug', $rental->rental_slug) }}" readonly />
                                        @error('rental_slug')
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
                                                <button id="button_post_thumbnail" data-input="input_post_thumbnail" class="btn btn-primary" type="button" style="padding: 0px 10px 0px 10px;">
                                                    Browse
                                                </button>
                                            </div>
                                            <input id="input_post_thumbnail" name="rental_cover" value="{{ old('rental_cover', $rental->rental_cover) }}" type="text" class="form-control @error('rental_cover') is-invalid @enderror" placeholder="" readonly />
                                            @error('rental_cover')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                            @enderror
                                        </div>
                                    </div>

                                    <!-- gallery -->
                                    <div class="form-group _form-group">
                                        <label for="input_post_thumbnail" class="font-weight-bold">
                                            Gallery
                                        </label>
                                        <div class="input-group">
                                            <input id="input_post_thumbnail" multiple="multiple" name="photos[]" type="file" style="height: 50px;" class="form-control @error('rental_cover') is-invalid @enderror" placeholder="Choose Image" value="{{ old('photos') }}">
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
                                        <textarea id="input_post_description" name="rental_desc" placeholder="" class="form-control @error('rental_desc') is-invalid @enderror" rows="20">{{ old('rental_desc', $rental->rental_desc) }}</textarea>
                                        @error('rental_desc')
                                        <span class=" invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                        @enderror
                                    </div>



                                </div>


                                <div class="col-md-6">
                                    <div class="row">
                                        <div class="col-md-4">
                                            <!-- City -->
                                            <div class="form-group _form-group">
                                                <label for="select_user_role" class="font-weight-bold">
                                                    City <span class="wajib">*</span>
                                                </label>
                                                <select id="select_city" name="city" data-placeholder="Choose City" class="custom-select w-100 @error('city') is-invalid @enderror">
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
                                        <div class="col-md-4">
                                            <!-- Region -->
                                            <div class="form-group _form-group">
                                                <label for="select_user_role" class="font-weight-bold">
                                                    Region <span class="wajib">*</span>
                                                </label>
                                                <select id="select_region" name="region" data-placeholder="Choose Region" class="custom-select w-100 @error('region') is-invalid @enderror">
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
                                        <div class="col-md-4">
                                            <!-- Market -->
                                            <div class="form-group _form-group">
                                                <label for="select_user_role" class="font-weight-bold">
                                                    Pasar <span class="wajib">*</span>
                                                </label>
                                                <select id="select_market" name="market" data-placeholder="Choose Pasar" class="custom-select w-100 @error('market') is-invalid @enderror">
                                                    @if (old('market', $marketSelected))
                                                    <option value="{{ old('market', $marketSelected)->id }}" selected>
                                                        {{ old('market', $marketSelected)->market_name }}
                                                    </option>
                                                    @endif
                                                </select>
                                                @error('market')
                                                <span class="invalid-feedback">
                                                    {{ $message }}
                                                </span>
                                                @enderror
                                                <!-- error message -->
                                            </div>
                                        </div>
                                    </div>


                                    <div class="form-group _form-group">
                                        <label for="input_post_caption" class="font-weight-bold">
                                            Address <span class="wajib">*</span>
                                        </label>
                                        <textarea id="input_post_caption" name="rental_address" placeholder="" class="form-control @error('rental_address') is-invalid @enderror" rows="3">{{ old('rental_address', $rental->rental_address) }}</textarea>
                                        @error('rental_address')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                        @enderror
                                    </div>

                                    <div class="row">
                                        <div class="col-md-4">
                                            <!-- Posisi -->
                                            <div class="form-group _form-group">
                                                <label for="input_post_description" class="font-weight-bold">
                                                    Posisi <span class="wajib">*</span>
                                                </label>
                                                <select class="form-control" name="rental_posisi" id="rental_posisi">

                                                    @foreach ($positions as $key => $value)
                                                    <option value="{{ $key }}" {{ old('rental_posisi', $rental->rental_posisi) == $key ? 'selected' : null }}> {{ $value }}</option>
                                                    @endforeach
                                                </select>
                                                @error('rental_posisi')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                                @enderror
                                            </div>
                                        </div>

                                        <div class="col-md-4">
                                            <!-- Ukuran Kios -->
                                            <div class="form-group _form-group">
                                                <label for="input_post_description" class="font-weight-bold">
                                                    Ukuran Kios <span class="wajib">*</span>
                                                </label>
                                                <div class="input-group flex-nowrap">
                                                    <input type="number" name="rental_size" value="{{ old('rental_size', $rental->rental_size) }}" class="form-control @error('rental_size') is-invalid @enderror" placeholder="Example: 10" aria-label="Harga" aria-describedby="addon-wrapping" style="height: 42px;">
                                                    <span class="input-group-text" id="addon-wrapping" style="height: 42px; border-top-right-radius: 5px; border-bottom-right-radius: 5px;">&#13221;</span>
                                                </div>
                                                @error('rental_size')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                                @enderror
                                            </div>
                                        </div>

                                        <div class="col-md-4">
                                            <!-- harga Kios -->
                                            <div class="form-group _form-group">
                                                <label for="input_post_description" class="font-weight-bold">
                                                    Harga <span class="wajib">*</span>
                                                </label>
                                                <div class="input-group flex-nowrap">
                                                    <span class="input-group-text" id="addon-wrapping" style="height: 42px; border-top-left-radius: 5px; border-bottom-left-radius: 5px;">Rp</span>
                                                    <input id="rupiah" type="text" name="rental_price" value="{{ old('rental_price', $rental->rental_price) }}" class="form-control @error('rental_price') is-invalid @enderror" placeholder="Example: 500.000" aria-label="Harga" aria-describedby="addon-wrapping" style="height: 42px;">
                                                </div>
                                                @error('rental_price')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                                @enderror
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
                                                <input id="input_post_long" value="{{ old('rental_phone', $rental->rental_phone) }}" name="rental_phone" type="number" step="any" class="form-control @error('rental_phone') is-invalid @enderror" placeholder="Example: 08123467891" />
                                                @error('rental_phone')
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
                                                    <input id="input_post_lat" value="{{ old('rental_wa', $rental->rental_wa) }}" name="rental_wa" type="number" step="any" class="form-control @error('rental_wa') is-invalid @enderror" placeholder="Example: 8123456789" />
                                                </div>
                                                @error('rental_wa')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                                @enderror
                                            </div>
                                        </div>
                                    </div>

                                    <div class="form-group _form-group">
                                        <label for="input_post_caption" class="font-weight-bold">
                                            GMap iFrame <span class="wajib">*</span>
                                        </label>
                                        <textarea id="input_post_caption" name="rental_iframe" placeholder="" class="form-control @error('rental_iframe') is-invalid @enderror" rows="3">{{ old('rental_iframe', $rental->rental_iframe) }}</textarea>
                                        @error('rental_iframe')
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
                                        <input id="input_post_gmap" value="{{ old('rental_gmap', $rental->rental_gmap) }}" name="rental_gmap" type="text" class="form-control @error('rental_gmap') is-invalid @enderror" placeholder="" />
                                        @error('rental_gmap')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                        @enderror
                                    </div>

                                    <div class="row">
                                        <div class="col-md-6">
                                            <!-- status -->
                                            <div class="form-group _form-group{{ $errors->has('is_recommended') ? ' has-error' : '' }}">
                                                <label for="input_post_status" class="font-weight-bold">
                                                    Featured
                                                </label>
                                                <div class="form-group">
                                                    <label class="switch">
                                                        <input type="checkbox" name="is_recommended" {{ old('is_recommended', $rental->is_recommended) == 1  ? 'checked'  : null }}>
                                                        <span class="slider round"></span>
                                                    </label>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <!-- status -->
                                            <div class="form-group _form-group{{ $errors->has('is_active') ? ' has-error' : '' }}">
                                                <label for="input_post_status" class="font-weight-bold">
                                                    Status
                                                </label>
                                                <div class="form-group">
                                                    <label class="switch">
                                                        <input type="checkbox" name="is_active" {{ old('is_active', $rental->is_active) == 1  ? 'checked'  : null }}>
                                                        <span class="slider round"></span>
                                                    </label>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="float-right">
                                        <a class="btn btn-outline-secondary _btn-secondary px-4" href="{{ route('rental.index') }}">Back</a>
                                        <button type="submit" class="btn btn-primary _btn-primary px-4">
                                            Update
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </form>

                <div class="card">
                    <div class="card-body _card-body d-inline">
                        <div class="row" style="margin-bottom: 50px;">
                            <div class="col-md-12">
                                <h4>Gallery</h4>
                            </div>
                        </div>
                        <center>
                            <div class="row">
                                @foreach ($photos as $photo)
                                <div class="col-md-2" style="margin-bottom: 50px;">
                                    <img src="{{asset('images/'.$photo->filename)}}" alt="" width="200" height="200">
                                    <form class="d-inline" role="alert" action="{{ route('rental.deleteimage', $photo->id) }}" method="POST">
                                        @csrf
                                        @method('DELETE')

                                        <button type="submit" class="btn btn-sm btn-danger" style="margin-top: 20px;">
                                            <!-- <i class='bx bx-x'></i> -->
                                            Remove File
                                        </button>
                                    </form>
                                </div>


                                @endforeach

                            </div>
                        </center>
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

        let cityID = $('#select_city').val();
        let regionID = $('#select_region').val();
        let marketID = $('#select_market').val();

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

        //  select district:start
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
        //  select district:end

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
            $('#select_market').empty();
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