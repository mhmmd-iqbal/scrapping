@extends('partials.master')

@section('title', 'SCRAPPING DATA')

@section('custom_styles')

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
                                            <div class="col-4">
                                                <table class="table">
                                                    <tr>
                                                        <th>P|H "Merek"</th>
                                                        <td>{{$countBrand}} / 100</td>         
                                                        <td>{{$classBrand}}</td>         
                                                    </tr>
                                                    <tr>
                                                        <th>P|H "Ukuran"</th>         
                                                        <td>{{$countSize}} / 100</td>         
                                                        <td>{{$classSize}}</td>         
                                                    </tr>
                                                    <tr>
                                                        <th>P|H "Model"</th>         
                                                        <td>{{$countModel}} / 100</td>         
                                                        <td>{{$classModel}}</td> 
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
                                                            $total      = 0;
                                                            $totalBrand = 0;
                                                        @endphp
                                                        @foreach ($brandsBrand as $data)
                                                            <tr>
                                                                <td>{{$data->name}}</td>
                                                                <td>{{$data->data_trainings_count}}</td>
                                                                <td align="right">{{$data->data_trainings_count}} / {{$countBrand}}</td>
                                                                <td align="right">{{number_format($data->data_trainings_count / $countBrand, 2, ',', '')}}</td>
                                                            </tr>
                                                            @php
                                                                $total += $data->data_trainings_count;
                                                                $totalBrand += ($data->data_trainings_count / $countBrand);
                                                            @endphp
                                                        @endforeach
                                                    </tbody>
                                                    <tfoot>
                                                        <tr>
                                                            <th>TOTAL</th>
                                                            <th>{{$total}}</th>
                                                            <th colspan="2" style="text-align: right">{{number_format($totalBrand, 2, ',', '')}}</th>
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
                                                            $total      = 0;
                                                            $totalSize  = 0;
                                                        @endphp
                                                        @foreach ($brandsSize as $data)
                                                            <tr>
                                                                <td>{{$data->name}}</td>
                                                                <td>{{$data->data_trainings_count}}</td>
                                                                <td align="right">{{$data->data_trainings_count}} / {{$countSize}}</td>
                                                                <td align="right">{{number_format($data->data_trainings_count / $countSize, 2, ',', '')}}</td>
                                                            </tr>
                                                            @php
                                                                $total += $data->data_trainings_count;
                                                                $totalSize += ($data->data_trainings_count / $countSize);
                                                            @endphp
                                                        @endforeach
                                                    </tbody>
                                                    <tfoot>
                                                        <tr>
                                                            <th>TOTAL</th>
                                                            <th>{{$total}}</th>
                                                            <th colspan="2" style="text-align: right">{{number_format($totalSize, 2, ',', '')}}</th>
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
                                                            $total      = 0;
                                                            $totalModel = 0;
                                                        @endphp
                                                        @foreach ($brandsModel as $data)
                                                            <tr>
                                                                <td>{{$data->name}}</td>
                                                                <td>{{$data->data_trainings_count}}</td>
                                                                <td align="right">{{$data->data_trainings_count}} / {{$countModel}}</td>
                                                                <td align="right">{{number_format($data->data_trainings_count / $countModel, 2, ',', '')}}</td>
                                                            </tr>
                                                            @php
                                                                $total += $data->data_trainings_count;
                                                                $totalModel += ($data->data_trainings_count / $countModel);
                                                            @endphp
                                                        @endforeach
                                                    </tbody>
                                                    <tfoot>
                                                        <tr>
                                                            <th>TOTAL</th>
                                                            <th>{{$total}}</th>
                                                            <th colspan="2" style="text-align: right">{{number_format($totalModel, 2, ',', '')}}</th>
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

@section('javascript')

<script>

</script>
@endsection