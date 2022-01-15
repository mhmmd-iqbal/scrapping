@extends('partials.master')

@section('title', 'SCRAPPING DATA')

@section('custom_styles')
    <style>
        .modal-body {
            height: 80vmin;
            overflow: auto;
        }

        th{
            text-align: center;
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
                                <strong class="card-title">1. Membaca Data Training P(H)</strong>
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
                                <strong class="card-title">2. Membaca Jumlah Kelas P(X)</strong>
                            </div>
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-md-12 m-b-20">
                                        <div class="row">
                                            <div class="col-4">
                                                <table class="table table-bordered">
                                                    <tr>
                                                        <th>No</th>
                                                        <th>Brand</th>
                                                        <th>Merek</th>
                                                    </tr>
                                                    @php
                                                        $total = 0;
                                                        $i = 1;
                                                    @endphp
                                                    @foreach ($brandsBrand as $index => $data)
                                                    <tr>
                                                        <td>{{$i++}}</td>
                                                        <td>{{ $data->name }}</td>
                                                        <td>{{ $data->data_trainings_count }}</td>
                                                    </tr>
                                                    @php
                                                        $total += $data->data_trainings_count;
                                                    @endphp
                                                    @endforeach
                                                    <tr>
                                                        <th colspan="2">TOTAL</th>
                                                        <th>{{ $total }}</th>
                                                    </tr>
                                                </table>
                                            </div>
                                            <div class="col-4">
                                                <table class="table table-bordered">
                                                    <tr>
                                                        <th>No</th>
                                                        <th>Brand</th>
                                                        <th>Ukuran</th>
                                                    </tr>
                                                    @php
                                                        $total = 0;
                                                        $i = 1;
                                                    @endphp
                                                    @foreach ($brandsSize as $index => $data)
                                                        <tr>
                                                            <td>{{$i++}}</td>
                                                            <td>{{ $data->name }}</td>
                                                            <td>{{ $data->data_trainings_count }}</td>
                                                        </tr>
                                                        @php
                                                            $total += $data->data_trainings_count;
                                                        @endphp
                                                    @endforeach
                                                    <tr>
                                                        <td>{{$i++}}</td>
                                                        <td>Tidak Ada Merek</td>
                                                        <td>{{$countSize - $total}}</td>
                                                    </tr>
                                                    <tr>
                                                        <th colspan="2">TOTAL</th>
                                                        <th>{{ $total + ($countSize - $total)}}</th>
                                                    </tr>
                                                </table>
                                            </div>
                                            <div class="col-4">
                                                <table class="table table-bordered">
                                                    <tr>
                                                        <th>No</th>
                                                        <th>Brand</th>
                                                        <th>Model</th>
                                                    </tr>
                                                    @php
                                                        $total = 0;
                                                        $i = 1;
                                                    @endphp
                                                    @foreach ($brandsModel as $index => $data)
                                                        <tr>
                                                            <td>{{$i++}}</td>
                                                            <td>{{ $data->name }}</td>
                                                            <td>{{ $data->data_trainings_count }}</td>
                                                        </tr>
                                                        @php
                                                            $total += $data->data_trainings_count;
                                                        @endphp
                                                    @endforeach
                                                    <tr>
                                                        <td>{{$i++}}</td>
                                                        <td>Tidak Ada Merek</td>
                                                        <td>{{$countModel - $total}}</td>
                                                    </tr>
                                                    <tr>
                                                        <th colspan="2">TOTAL</th>
                                                        <th>{{ $total + ($countModel - $total)}}</th>
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
                                <strong class="card-title">3. Jumlah Kasus Perkelas</strong>
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
                                                            $brandCases = [];
                                                            $sizeCases  = [];
                                                            $modelCases = [];
                                                        @endphp
                                                        @foreach ($brandsBrand as $index => $data)
                                                            <tr>
                                                                <td>{{ $data->name }}</td>
                                                                <td>{{ $data->data_trainings_count }}</td>
                                                                <td align="right">{{ $data->data_trainings_count }} /
                                                                    {{ $countBrand }}</td>
                                                                <td align="right">
                                                                    {{ number_format($data->data_trainings_count / $countBrand, 4, ',', '') }}
                                                                </td>
                                                            </tr>
                                                            @php
                                                                $total += $data->data_trainings_count;
                                                                $totalBrand += $data->data_trainings_count / $countBrand;
                                                                $brandCases[$index] = round($data->data_trainings_count / $countBrand, 4);
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
                                                        @foreach ($brandsSize as $index => $data)
                                                            <tr>
                                                                <td>{{ $data->name }}</td>
                                                                <td>{{ $data->data_trainings_count }}</td>
                                                                <td align="right">{{ $data->data_trainings_count }} /
                                                                    {{ $countSize }}</td>
                                                                <td align="right">
                                                                    {{ number_format($data->data_trainings_count / $countSize, 4, ',', '') }}
                                                                </td>
                                                            </tr>
                                                            @php
                                                                $total              += $data->data_trainings_count;
                                                                $totalSize          += $data->data_trainings_count / $countSize;
                                                                $sizeCases[$index]  = round($data->data_trainings_count / $countSize, 4);
                                                            @endphp
                                                        @endforeach
                                                        <tr>
                                                            <td>Tidak Ada Merek</td>
                                                            <td>{{$countSize - $total}}</td>
                                                            <td align="right">{{ $countSize - $total }} /
                                                                    {{ $countSize }}</td>
                                                            <td align="right">{{ number_format(($countSize - $total) / $countSize, 4, ',', '') }}</td>
                                                        </tr>
                                                        @php
                                                            $sizeCases[$index +1] =  round(($countSize - $total) / $countSize, 4);
                                                        @endphp
                                                    </tbody>
                                                    <tfoot>
                                                        <tr>
                                                            <th>TOTAL</th>
                                                            <th>{{ $total + ($countSize - $total) }}</th>
                                                            <th colspan="2" style="text-align: right">
                                                                {{ number_format($totalSize + (($countSize - $total) / $countSize), 2, ',', '') }}</th>
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
                                                        @foreach ($brandsModel as $index => $data)
                                                            <tr>
                                                                <td>{{ $data->name }}</td>
                                                                <td>{{ $data->data_trainings_count }}</td>
                                                                <td align="right">{{ $data->data_trainings_count }} /
                                                                    {{ $countModel }}</td>
                                                                <td align="right">
                                                                    {{ number_format($data->data_trainings_count / $countModel, 4, ',', '') }}
                                                                </td>
                                                            </tr>
                                                            @php
                                                                $total              += $data->data_trainings_count;
                                                                $totalModel         += $data->data_trainings_count / $countModel;
                                                                $modelCases[$index] =  round($data->data_trainings_count / $countModel, 4);
                                                            @endphp
                                                        @endforeach
                                                        <tr>
                                                            <td>Tidak Ada Merek</td>
                                                            <td>{{$countModel - $total}}</td>
                                                            <td align="right">{{ $countModel - $total }} /
                                                                    {{ $countModel }}</td>
                                                            <td align="right">{{ number_format(($countModel - $total) / $countModel, 4, ',', '') }}</td>
                                                        </tr>
                                                        @php
                                                            $modelCases[$index +1] =  round(($countModel - $total) / $countModel, 4);
                                                        @endphp
                                                    </tbody>
                                                    <tfoot>
                                                        <tr>
                                                            <th>TOTAL</th>
                                                            <th>{{ $total + ($countModel - $total) }}</th>
                                                            <th colspan="2" style="text-align: right">
                                                                {{ number_format($totalModel + (($countModel - $total) / $countModel), 2, ',', '') }}</th>
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
                    <div class="col-md-12 m-t-20">
                        <div class="card">
                            <div class="card-header">
                                <strong class="card-title">4. Pencarian Data X Berdasarkan Class</strong>
                            </div>
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-12 pl-5">
                                        <ol type="A">
                                            <li>
                                                <div class="row p-t-30">
                                                    <div class="col-2">MEREK</div>
                                                    <div class="col-10"> 
                                                    @php
                                                        $multiplyBrandCases = 1;
                                                    @endphp
                                                    (
                                                        @foreach ($brandCases as $index => $case)
                                                            {{$case}} {{sizeof($brandCases) !== $index + 1 ? '*' : ''}}
                                                            @php
                                                                $multiplyBrandCases *= $case
                                                            @endphp
                                                        @endforeach
                                                    ) * {{$classBrand}} = <b> {{ $multiplyBrandCases * $classBrand }} </b>
                                                    </div>
                                                </div>
                                            </li>
                                            <li>
                                                <div class="row p-t-30">
                                                    <div class="col-2">UKURAN</div>
                                                    <div class="col-10">
                                                    @php
                                                        $multiplySizeCases = 1;
                                                    @endphp
                                                    (
                                                        @foreach ($sizeCases as $index => $case)
                                                            {{$case}} {{sizeof($sizeCases) !== $index + 1 ? '*' : ''}}
                                                            @php
                                                                $multiplySizeCases *= $case
                                                            @endphp
                                                        @endforeach
                                                    ) * {{$classSize}} = <b> {{ $multiplySizeCases * $classSize }} </b>
                                                    </div>
                                                </div>
                                            </li>
                                            <li>
                                                <div class="row p-t-30">
                                                    <div class="col-2">MODEL</div>
                                                    <div class="col-10">
                                                    @php
                                                        $multiplyModelCases = 1;
                                                    @endphp
                                                    (
                                                        @foreach ($modelCases as $index => $case)
                                                            {{$case}} {{sizeof($modelCases) !== $index + 1 ? '*' : ''}}
                                                            @php
                                                                $multiplyModelCases *= $case
                                                            @endphp
                                                        @endforeach
                                                    ) * {{$classModel}} = <b> {{ $multiplyModelCases * $classModel }} </b>
                                                    </div>
                                                </div>
                                            </li>
                                        </ol>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-12 m-t-20">
                        <div class="card">
                            <div class="card-header">
                                <strong class="card-title">Table Pengujian Akurasi</strong>
                            </div>
                            {{-- <div class="card-body">
                                <div class="row">
                                    <div class="col-12 pl-5">
                                        <table class="table table-bordered">
                                            <tr>
                                                <th>Fitur</th>
                                                <th>Jumlah Data</th>
                                                <th>persentase</th>
                                            </tr>
                                            <tr>
                                                <td>Merek + ukuran + model</td>
                                                <td>{{$limitCountData['BrandSizeModel']}}</td>
                                                <td>{{$limitCountData['BrandSizeModel']/100*100}}%</td>
                                            </tr>
                                            <tr>
                                                <td>Merek + ukuran</td>
                                                <td>{{$limitCountData['BrandSize']}}</td>
                                                <td>{{$limitCountData['BrandSize']/100*100}}%</td>
                                            </tr>
                                            <tr>
                                                <td>Merek + model</td>
                                                <td>{{$limitCountData['BrandModel']}}</td>
                                                <td>{{$limitCountData['BrandModel']/100*100}}%</td>
                                            </tr>
                                            <tr>
                                                <td>Ukuran + model</td>
                                                <td>{{$limitCountData['SizeModel']}}</td>
                                                <td>{{$limitCountData['SizeModel']/100*100}}%</td>
                                            </tr>
                                            <tr>
                                                <td>Merek</td>
                                                <td>{{$limitCountData['Brand']}}</td>
                                                <td>{{$limitCountData['Brand']/100*100}}%</td>
                                            </tr>
                                            <tr>
                                                <td>Ukuran</td>
                                                <td>{{$limitCountData['Size']}}</td>
                                                <td>{{$limitCountData['Size']/100*100}}%</td>
                                            </tr>
                                            <tr>
                                                <td>Model</td>
                                                <td>{{$limitCountData['Model']}}</td>
                                                <td>{{$limitCountData['Model']/100*100}}%</td>
                                            </tr>
                                            <tr>
                                                <td>Tidak memiliki semua fitur</td>
                                                <td>{{$limitCountData['NoAll']}}</td>
                                                <td>{{$limitCountData['NoAll']/100*100}}%</td>
                                            </tr>
                                        </table>
                                    </div>
                                </div>
                            </div> --}}
                            <div class="card-body">
                                <div class="row">
                                   <div class="col-12 pl-5">
                                        <table class="table table-bordered">
                                            <tr>
                                                <th rowspan="2">No</th>
                                                <th rowspan="2">Fitur</th>
                                                <th colspan="4">Jumlah data</th>
                                            </tr>
                                            <tr>
                                                <th>T = F</th>
                                                <th>T = T</th>
                                                <th>F = F</th>
                                            </tr>
                                            <tr>
                                                <td>1</td>
                                                <td>Mr + U + Md</td>
                                                <td style="text-align:right;" valign="middle">{{$accurationTest['all']['TF']}}</td>
                                                <td style="text-align:right;" valign="middle">{{$accurationTest['all']['TT']}}</td>
                                                <td style="text-align: right">?</td>
                                            </tr>
                                            <tr>
                                                <td>2</td>
                                                <td>
                                                    <div>Mr + U</div>
                                                    <div>Mr + Md</div>
                                                    <div>U + Md</div>
                                                </td>
                                                <td style="text-align:right;" valign="middle">{{$accurationTest['part']['TF']}}</td>
                                                <td style="text-align:right;" valign="middle">{{$accurationTest['part']['TT']}}</td>
                                                <td style="text-align: right">?</td>
                                            </tr>
                                            <tr>
                                                <td>3</td>
                                                <td>
                                                    <div>Mr</div>
                                                    <div>Md</div>
                                                    <div>U</div>
                                                </td>
                                                <td style="text-align:right;" valign="middle">{{$accurationTest['single']['TF']}}</td>
                                                <td style="text-align:right;" valign="middle">{{$accurationTest['single']['TT']}}</td>
                                                <td style="text-align: right">?</td>
                                            </tr>
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
