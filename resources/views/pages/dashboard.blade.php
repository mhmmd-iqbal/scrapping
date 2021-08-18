@extends('partials.master')
@section('title', 'DASHBOARD')

@section('custom_styles')
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
    <style>
        .select2-container {
            width: 100% !important;
        }

    </style>
@endsection

@section('custom_scripts')
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
    <script>
        $('#title').select2({
            placeholder: "Pilih Nama Produk...",
            allowClear: true,
            ajax: {
                url: '',
                data: function(params) {
                    var query = {
                        search: params.term,
                    }

                    // Query parameters will be ?search=[term]&type=public
                    return query;
                },
                processResults: function(response) {
                    return {
                        results: response
                    };
                },
            }
        });

        const showDetail = () => {
            const val = $('#title').find(':selected').val();
            $.ajax({
                type: "GET",
                url: "{{ route('crawling.show', 'scrapId') }}".replace('scrapId', val),
                dataType: "JSON",
                success: function(response) {
                    if (response.data.brand != null) {
                        $('#showBrand').html(response.data.brand)
                    } else {
                        $('#showBrand').html('-')
                    }
                    if (response.data.size != null) {
                        $('#showSize').html(response.data.size + ' INC')
                    } else {
                        $('#showSize').html('-')
                    }
                    if (response.data.model != null) {
                        $('#showModel').html(response.data.model)
                    } else {
                        $('#showModel').html('-')
                    }
                }
            });
        }

        const openModal = () => {
            $('#staticModal').modal({
                'show': true
            })
        }
    </script>
@endsection

@section('content')
    <!-- MAIN CONTENT-->
    <div class="main-content">
        <div class="section__content section__content--p30">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-md-12">
                        <div class="overview-wrap">
                            <h2 class="title-1">Dashboard</h2>
                        </div>
                    </div>
                </div>
                <div class="row m-t-25">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-header">
                                <h4 class="text-center text-uppercase">
                                    Penerapan NER untuk mengenali fitur produk pada ecommerce
                                </h4>
                            </div>
                            <div class="card-body">
                                <div class="d-flex justify-content-center m-t-100 m-b-100">
                                    <a href="{{ route('brands.index') }}" class="btn btn-primary m-r-10 m-l-10">
                                        DATA BRAND
                                    </a>
                                    <a href="{{ route('crawling.index') }}" class="btn btn-primary m-r-10 m-l-10">
                                        CRAWLING DATA
                                    </a>
                                    <button class="btn btn-primary m-r-10 m-l-10" onclick="openModal()">
                                        <i class="fa fa-search"></i> UJI TITLE
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- END MAIN CONTENT-->
@endsection

@section('modal')
    <!-- modal static -->
    <div class="modal fade" id="staticModal" tabindex="-1" role="dialog" aria-labelledby="staticModalLabel"
        aria-hidden="true" data-backdrop="static">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                {{-- <div class="modal-header">
                    <h5 class="modal-title" id="staticModalLabel">Uji Judul</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div> --}}
                <div class="modal-body">
                    <div class="card">
                        <div class="card-header">
                            <div class="row">
                                <div class="col-md-12 m-t-20 m-b-20 form-group">
                                    <select name="" id="title" class="select2" onchange="showDetail()"></select>
                                </div>
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-12 m-b-20">
                                    <div class="table-responsive">
                                        <table class="table table-bordered">
                                            <tr>
                                                <th style="width: 20%">Merek</th>
                                                <td id="showBrand"></td>
                                            </tr>
                                            <tr>
                                                <th>Ukuran</th>
                                                <td id="showSize"></td>
                                            </tr>
                                            <tr>
                                                <th>Model</th>
                                                <td id="showModel"></td>
                                            </tr>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-danger" data-dismiss="modal">Tutup</button>
                </div>
            </div>
        </div>
    </div>
    <!-- end modal static -->
@endsection
