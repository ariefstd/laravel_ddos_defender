@extends('layouts.dashboard')

@section('content')
<section class="home-section">
    {{ Breadcrumbs::render('market') }}

    <div class="text">
        @section('title')
        Pasar
        @endsection
        Pasar
    </div>

    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">

                        {{-- FILTER:start --}}
                        <form action="{{ route('market.index') }}" method="GET" class="row">
                            <div class="col-2">
                                <select id="select_city" name="city" data-placeholder="All City..." class="custom-select w-100">
                                    @if ($optionCity['value'])
                                    <option value="{{ $optionCity['value'] }}" selected>{{ $optionCity['label'] }}</option>
                                    @endif
                                </select>
                            </div>
                            <div class="col-2">
                                <select id="select_region" name="region" data-placeholder="All Region..." class="custom-select w-100">
                                    @if ($optionRegion['value'])
                                    <option value="{{ $optionRegion['value'] }}" selected>{{ $optionRegion['label'] }}</option>
                                    @endif
                                </select>
                            </div>

                            <div class="col-2">
                                <input type="search" name="keyword" value="{{ request('keyword') }}" placeholder="Search for pasar.." class="form-control" style="height: 40px">
                            </div>
                            <div class="col-2">
                                <button type="submit" class="btn btn-primary">Filter</button>
                                <a href="{{ route('market.index') }}" class="btn btn-info">Reset</a>
                            </div>

                            <div class="col-md-4">
                                @can('Market Create')
                                <a href="{{ route('market.create') }}" class="btn btn-primary float-right" role="button">
                                    Add New
                                </a>
                                @endcan
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
                                            <th class="pd-y-5 tx-center">City</th>
                                            <th class="pd-y-5 tx-center">Region</th>
                                            <th class="pd-y-5 tx-center">Status</th>
                                            <th class="pd-y-5 tx-center">Actions</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @forelse ($markets as $market)
                                        <tr>
                                            <td style="width: 20%;" class="valign-middle tx-medium tx-inverse tx-14">
                                                {{ $market->market_name }}
                                            </td>

                                            <td style="width: 43%;" class="valign-middle tx-medium tx-inverse tx-14">
                                                {{ $market->market_address }}
                                            </td>

                                            <td style="width: 10%;" class="valign-middle tx-center  tx-medium tx-inverse tx-14">
                                                {{ $market->city->city_name }}
                                            </td>

                                            <td style="width: 10%;" class="valign-middle tx-center tx-medium tx-inverse tx-14">
                                                {{ $market->region->region_name }}
                                            </td>

                                            <td style="width: 10%;" class=" valign-middle tx-center">@if ($market->is_active == 1)
                                                <span class="status-active">Active</span>
                                                @else
                                                <span class="status-nonactive">Non-Active</span>
                                                @endif
                                            </td>

                                            <td style="width: 7%;" class="valign-middle tx-center">
                                                <div class="row" style="margin-left: 0px; margin-right: 0px;">
                                                    <!-- <div class="col-md-4">
                                                        <a href="{{ route('market.show', ['market' => $market]) }}" class="btn btn-sm btn-primary" role="button">
                                                            <i class="fas fa-eye"></i>
                                                        </a>
                                                    </div> -->
                                                    <div class="col-md-6">
                                                        @can('Market Update')
                                                        <a href="{{ route('market.edit', ['market' => $market]) }}" class="btn btn-sm btn-info" role="button">
                                                            <i class="fas fa-edit"></i>
                                                        </a>
                                                        @endcan
                                                    </div>
                                                    <div class="col-md-6">
                                                        @can('Market Delete')
                                                        <form class="d-inline" role="alert" action="{{ route('market.destroy', ['market' => $market]) }}" method="POST">
                                                            @csrf
                                                            @method('DELETE')
                                                            <button type="submit" class="btn btn-sm btn-danger">
                                                                <i class="fas fa-trash"></i>
                                                            </button>
                                                        </form>
                                                        @endcan
                                                    </div>
                                                </div>

                                            </td>
                                        </tr>
                                        @empty
                                        <table>

                                        </table>
                                        <p style="text-align: center; padding-top: 50px;">
                                            @if (request()->get('keyword'))
                                            <strong>Pasar not found</strong>

                                            @else
                                            <strong>No Pasar data yet</strong>
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
                    @if ($markets->hasPages())
                    <div class="card-footer">
                        {{ $markets->links('vendor.pagination.bootstrap-4') }}
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
                title: 'Delete Market',
                text: 'Are you sure want to remove Market?',
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
        let districtID = $('#select_district').val();
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

        // EVENT ON CAHNGE
        //  Event on change select city:start
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
        //  Event on change select city:end


        // EVENT ON CLEAR
        $('#select_city').on('select2:clear', function(e) {
            $("#select_region").select2();
        });
    });
</script>

@endpush