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
    
@endsection

@section('content')
    <!-- MAIN CONTENT-->
    <div class="main-content">
        <div class="section__content section__content--p30">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-md-12">
                        <div class="overview-wrap">
                            <h2 class="title-1">Tentang</h2>
                        </div>
                    </div>
                </div>
                <div class="row m-t-25">
                    <div class="col-6">
                        <div class="card">
                            <div class="card-header">
                                <h4 class="text-center text-uppercase">
                                    Profile Developer
                                </h4>
                            </div>
                            <div class="card-body">
                                <table class="table">
                                    <tr>
                                        <th>Nama</th>
                                        <td>Siti Aisyah</td>
                                    </tr>
                                    <tr>
                                        <th>NIM</th>
                                        <td>160170094</td>
                                    </tr>
                                    <tr>
                                        <th>Jurusan</th>
                                        <td>Teknik Informatika Universitas Malikussaleh</td>
                                    </tr>
                                </table>
                                    
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
@endsection