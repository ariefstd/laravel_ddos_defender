@extends('layouts.dashboard')

@section('content')
<section class="home-section">
    {{ Breadcrumbs::render('rental') }}

    <div class="text">
        @section('title')
        Rental Kios
        @endsection
        Rental Kios
    </div>

    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">

                        {{-- FILTER:start --}}
                        <form action="{{ route('rental.index') }}" method="GET" class="row">
                            <div class="col-2">
                                <select id="select_city" name="city" data-placeholder="All City.." class="custom-select w-100">
                                    @if ($optionCity['value'])
                                    <option value="{{ $optionCity['value'] }}" selected>{{ $optionCity['label'] }}</option>
                                    @endif
                                </select>
                            </div>
                            <div class="col-2">
                                <select id="select_region" name="region" data-placeholder="All Region.." class="custom-select w-100">
                                    @if ($optionRegion['value'])
                                    <option value="{{ $optionRegion['value'] }}" selected>{{ $optionRegion['label'] }}</option>
                                    @endif
                                </select>
                            </div>

                            <div class="col-2">
                                <select id="select_market" name="market" data-placeholder="All Market.." class="custom-select w-100">
                                    @if ($optionMarket['value'])
                                    <option value="{{ $optionMarket['value'] }}" selected>{{ $optionMarket['label'] }}</option>
                                    @endif
                                </select>
                            </div>

                            <div class="col-2">
                                <input type="search" name="keyword" value="{{ request('keyword') }}" placeholder="Search for kios.." class="form-control" style="height: 40px">
                            </div>
                            <div class="col-2">
                                <button type="submit" class="btn btn-primary">Filter</button>
                                <a href="{{ route('rental.index') }}" class="btn btn-info">Reset</a>
                            </div>

                            <div class="col-md-2">

                                <a href="{{ route('rental.create') }}" class="btn btn-primary float-right" role="button">
                                    Add New
                                </a>

                            </div>
                        </form>
                        {{-- FILTER:end --}}




                    </div>
                    <div class="card-body">
                        <ul class="list-group list-group-flush">
                            <!-- card-header -->
                            <div class="table-responsive table-striped">
                                <table class="table mg-b-0 tx-13">
                                    <thead>
                                        <tr class="tx-10">
                                            <th class="pd-y-5">Name</th>
                                            <th class="pd-y-5">Address</th>
                                            <th class="pd-y-5 tx-center">Pasar</th>
                                            <th class="pd-y-5 tx-center">City</th>
                                            <th class="pd-y-5 tx-center">Region</th>
                                            <th class="pd-y-5 tx-center">Status</th>
                                            <th class="pd-y-5 tx-center">Actions</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @forelse ($rentals as $rental)
                                        <tr>
                                            <td style="width: 15%;" class="valign-middle tx-medium tx-inverse tx-14">
                                                {{ $rental->rental_name }}
                                            </td>

                                            <td style="width: 25%;" class="valign-middle tx-medium tx-inverse tx-14">
                                                {{ $rental->rental_address }}
                                            </td>

                                            <td style="width: 21%;" class="tx-center valign-middle tx-medium tx-inverse tx-14">
                                                {{ $rental->market->market_name }}
                                            </td>

                                            <td style="width: 10%;" class=" tx-center valign-middle tx-medium tx-inverse tx-14">
                                                {{ $rental->city->city_name }}
                                            </td>

                                            <td style="width: 10%;" class=" tx-center valign-middle tx-medium tx-inverse tx-14">
                                                {{ $rental->region->region_name }}
                                            </td>



                                            <td style="width: 10%;" class=" valign-middle tx-center">@if ($rental->is_active == 1)
                                                <span class="status-active">Active</span>
                                                @else
                                                <span class="status-nonactive">Non-Active</span>
                                                @endif
                                            </td>

                                            <td style="width: 7%;" class="valign-middle tx-center">
                                                <div class="row" style="margin-left: 0px; margin-right: 0px;">
                                                    <div class="col-md-6">
                                                        <a href="{{ route('rental.edit', ['rental' => $rental]) }}" class="btn btn-sm btn-info" role="button">
                                                            <i class="fas fa-edit"></i>
                                                        </a>
                                                    </div>
                                                    <div class="col-md-6">

                                                        <form class="d-inline" role="alert" action="{{ route('rental.destroy', ['rental' => $rental]) }}" method="POST">
                                                            @csrf
                                                            @method('DELETE')
                                                            <button type="submit" class="btn btn-sm btn-danger">
                                                                <i class="fas fa-trash"></i>
                                                            </button>
                                                        </form>

                                                    </div>
                                                </div>

                                            </td>
                                        </tr>
                                        @empty
                                        <table>

                                        </table>
                                        <p style="text-align: center; padding-top: 50px;">
                                            @if (request()->get('keyword'))
                                            <strong>Rental not found</strong>

                                            @else
                                            <strong>No Rental data yet</strong>
                                            @endif

                                        </p>
                                        @endforelse

                                    </tbody>
                                </table>
                            </div>
                            <!-- table-responsive -->

                        </ul>
                    </div>
                    <!-- table-responsive -->
                    @if ($rentals->hasPages())
                    <div class="card-footer">
                        {{ $rentals->links('vendor.pagination.bootstrap-4') }}
                    </div>
                    @endif
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
<script src="{{ asset('vendor/laravel-filemanager/js/stand-alone-button.js') }}"></script>
<script src="{{ asset('vendor/tinymce5/jquery.tinymce.min.js') }}"></script>
<script src="{{ asset('vendor/tinymce5/tinymce.min.js') }}"></script>
<script src="{{ asset('vendor/select2/js/select2.min.js') }}"></script>
<script src="{{ asset('vendor/select2/js/' . app()->getLocale() . '.js') }}"></script>
@endpush

@push('javascript-internal')
<script>
    $(document).ready(function() {
        $("form[role='alert']").submit(function(event) {
            event.preventDefault();
            Swal.fire({
                title: 'Delete Rental Kios',
                text: 'Are you sure want to remove Rental Kios?',
                icon: 'warning',
                allowOutsideClick: false,
                showCancelButton: true,
                cancelButtonText: "Cancel",
                reverseButtons: true,
                confirmButtonText: "Yes",
            }).then((result) => {
                if (result.isConfirmed) {
                    // todo: process of deleting categories
                    event.target.submit();
                }
            });
        });
    });
</script>

<script>
    $(document).ready(function() {

        // set var id
        let cityID = $('#select_city').val();
        let regionID = $('#select_region').val();
        let marketID = $('#select_market').val();
        // inital select2
        //  select city:start
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
        //  select city:end

        //  select region:start
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
        //  select region:end

        //  select market:start
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
        //  select market:end


        // EVENT ON CAHNGE
        //  Event on change select city:start
        $('#select_city').change(function() {
            //clear select
            $('#select_region').empty();
            $("#select_market").empty();
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
                $("#select_market").empty();
            }
        });
        //  Event on change select city:end

        //  Event on change select region:start
        $('#select_region').change(function() {
            //clear select
            $("#select_market").empty();
            //set id
            regionID = $(this).val();
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
                $("#select_market").empty();
            }
        });
        //  Event on change select region:end


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