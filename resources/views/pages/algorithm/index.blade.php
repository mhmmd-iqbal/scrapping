@extends('partials.master')

@section('title', 'SCRAPPING DATA')

@section('custom_styles')
    <style>
        .modal-body {
            height: 80vmin;
            overflow: auto;
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
                            <h2 class="title-1 text-uppercase">Algoritma</h2>
                        </div>
                    </div>
                    <div class="col-md-12 m-t-20">
                        <div class="card">
                            <div class="card-header">
                                <strong class="card-title">Menghitung Jumlah Kelas/Label P|H</strong>
                            </div>
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-md-12 m-b-20">
                                        <div class="row">
                                            <div class="col-12">
                                                <table class="table">
                                                    <tr>
                                                        <th>P|H "Merek"</th>
                                                        <td>{{ $countBrand }} / {{ $countData }}</td>
                                                        <td>{{ $classBrand }}</td>
                                                        <td>
                                                            <button class="btn btn-info" onclick="detail('brand')">
                                                                Lihat Data</button>
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <th>P|H "Ukuran"</th>
                                                        <td>{{ $countSize }} / {{ $countData }}</td>
                                                        <td>{{ $classSize }}</td>
                                                        <td>
                                                            <button class="btn btn-info" onclick="detail('size')">
                                                                Lihat Data</button>
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <th>P|H "Model"</th>
                                                        <td>{{ $countModel }} / {{ $countData }}</td>
                                                        <td>{{ $classModel }}</td>
                                                        <td>
                                                            <button class="btn btn-info" onclick="detail('model')">
                                                                Lihat Data</button>
                                                        </td>
                                                    </tr>
                                                </table>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-12 m-t-20">
                        <div class="card">
                            <div class="card-header">
                                <strong class="card-title">Jumlah Kasus Perkelas</strong>
                            </div>
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-md-12 m-b-20">
                                        <div class="row">
                                            <div class="col-4">
                                                <table class="table table-bordered">
                                                    <thead>
                                                        <tr>
                                                            <th colspan="2">P(X) MEREK</th>
                                                            <th colspan="2">P(X|H = MEREK) </th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        @php
                                                            $total = 0;
                                                            $totalBrand = 0;
                                                        @endphp
                                                        @foreach ($brandsBrand as $data)
                                                            <tr>
                                                                <td>{{ $data->name }}</td>
                                                                <td>{{ $data->data_trainings_count }}</td>
                                                                <td align="right">{{ $data->data_trainings_count }} /
                                                                    {{ $countBrand }}</td>
                                                                <td align="right">
                                                                    {{ number_format($data->data_trainings_count / $countBrand, 2, ',', '') }}
                                                                </td>
                                                            </tr>
                                                            @php
                                                                $total += $data->data_trainings_count;
                                                                $totalBrand += $data->data_trainings_count / $countBrand;
                                                            @endphp
                                                        @endforeach
                                                    </tbody>
                                                    <tfoot>
                                                        <tr>
                                                            <th>TOTAL</th>
                                                            <th>{{ $total }}</th>
                                                            <th colspan="2" style="text-align: right">
                                                                {{ number_format($totalBrand, 2, ',', '') }}</th>
                                                        </tr>
                                                    </tfoot>
                                                </table>
                                            </div>
                                            <div class="col-4">
                                                <table class="table table-bordered">
                                                    <thead>
                                                        <tr>
                                                            <th colspan="2">P(X) UKURAN</th>
                                                            <th colspan="2">P(X|H = UKURAN) </th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        @php
                                                            $total = 0;
                                                            $totalSize = 0;
                                                        @endphp
                                                        @foreach ($brandsSize as $data)
                                                            <tr>
                                                                <td>{{ $data->name }}</td>
                                                                <td>{{ $data->data_trainings_count }}</td>
                                                                <td align="right">{{ $data->data_trainings_count }} /
                                                                    {{ $countSize }}</td>
                                                                <td align="right">
                                                                    {{ number_format($data->data_trainings_count / $countSize, 2, ',', '') }}
                                                                </td>
                                                            </tr>
                                                            @php
                                                                $total += $data->data_trainings_count;
                                                                $totalSize += $data->data_trainings_count / $countSize;
                                                            @endphp
                                                        @endforeach
                                                    </tbody>
                                                    <tfoot>
                                                        <tr>
                                                            <th>TOTAL</th>
                                                            <th>{{ $total }}</th>
                                                            <th colspan="2" style="text-align: right">
                                                                {{ number_format($totalSize, 2, ',', '') }}</th>
                                                        </tr>
                                                    </tfoot>
                                                </table>
                                            </div>
                                            <div class="col-4">
                                                <table class="table table-bordered">
                                                    <thead>
                                                        <tr>
                                                            <th colspan="2">P(X) MODEL</th>
                                                            <th colspan="2">P(X|H = MODEL) </th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        @php
                                                            $total = 0;
                                                            $totalModel = 0;
                                                        @endphp
                                                        @foreach ($brandsModel as $data)
                                                            <tr>
                                                                <td>{{ $data->name }}</td>
                                                                <td>{{ $data->data_trainings_count }}</td>
                                                                <td align="right">{{ $data->data_trainings_count }} /
                                                                    {{ $countModel }}</td>
                                                                <td align="right">
                                                                    {{ number_format($data->data_trainings_count / $countModel, 2, ',', '') }}
                                                                </td>
                                                            </tr>
                                                            @php
                                                                $total += $data->data_trainings_count;
                                                                $totalModel += $data->data_trainings_count / $countModel;
                                                            @endphp
                                                        @endforeach
                                                    </tbody>
                                                    <tfoot>
                                                        <tr>
                                                            <th>TOTAL</th>
                                                            <th>{{ $total }}</th>
                                                            <th colspan="2" style="text-align: right">
                                                                {{ number_format($totalModel, 2, ',', '') }}</th>
                                                        </tr>
                                                    </tfoot>
                                                </table>
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

@section('modal')
    <!-- modal static -->
    <div class="modal fade" id="staticModal" tabindex="-1" role="dialog" aria-labelledby="staticModalLabel"
        aria-hidden="true" data-backdrop="static">
        <div class="modal-dialog modal-dialog-scrollable modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="staticModalLabel">Data Crawling</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="card">
                        <div class="card-body">
                            <div class="row">
                                <div class="col-12 m-b-20">
                                    <div class="table-responsive">
                                        <table class="table" width="100%" id="list-datatables">
                                            <thead>
                                                <tr>
                                                    <th>No</th>
                                                    <th>Title</th>
                                                </tr>
                                            </thead>
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

@section('javascript')
    <script>
        let checkDetail = '';

        const detail = (e) => {
            checkDetail = e
            listData.ajax.reload()
            $('#staticModal').modal('toggle')
        }

        const listData = $('#list-datatables').DataTable({
            processing: true,
            serverSide: true,
            searching: true,
            fixedColumns: {
                heightMatch: 'none'
            },
            ajax: {
                url: '',
                data: (req) => {
                    req.params = checkDetail
                }
            },
            columns: [{
                    data: 'DT_RowIndex',
                    name: 'DT_RowIndex',
                    width: "10%"

                },
                {
                    data: 'title',
                    name: 'title',
                    width: "90%"
                },
            ]
        })
    </script>
@endsection
