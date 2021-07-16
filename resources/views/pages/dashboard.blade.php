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
                data: function (params) {
                    var query = {
                        search: params.term,
                    }

                    // Query parameters will be ?search=[term]&type=public
                    return query;
                },
                processResults: function (response) {
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
                url: "{{route('scraps.show', 'scrapId')}}".replace('scrapId', val),
                dataType: "JSON",
                success: function (response) {
                    if(response.data.brand != null){
                        $('#showBrand').html(response.data.brand)
                    }else{
                        $('#showBrand').html('-')
                    }
                    if(response.data.size != null){
                        $('#showSize').html(response.data.size+' INC')
                    }else{
                        $('#showSize').html('-')
                    }
                    if(response.data.model != null){
                        $('#showModel').html(response.data.model)
                    }else{
                        $('#showModel').html('-')
                    }
                }
            });
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
                    <div class="col-10">
                        <div class="card">
                            <div class="card-header">
                                <div class="row">
                                    <div class="col-md-12 m-t-20 m-b-20 form-group">
                                        <select name="" id="title" class="select2" onchange="showDetail()" ></select>
                                    </div>
                                </div>
                            </div>
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-md-12 m-b-20">
                                        <div class="row">
                                            <div class="col-6">
                                                <div class="row m-b-20">
                                                    <div class="col-4">Merek </div>
                                                    <div class="col-8" id="showBrand"></div>
                                                </div>
                                                <div class="row m-b-20">
                                                    <div class="col-4">Ukuran </div>
                                                    <div class="col-8" id="showSize"></div>
                                                </div>
                                                <div class="row m-b-20">
                                                    <div class="col-4">Model </div>
                                                    <div class="col-8" id="showModel"></div>
                                                </div>
                                            </div>
                                            <div class="col-6 text-right">
                                            </div>
                                        </div>
                                    </div>
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
