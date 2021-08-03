@extends('partials.master')

@section('title', 'CRAWLING DATA')

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
                            <h2 class="title-1 text-uppercase">Crawling Data</h2>
                        </div>
                    </div>
                    <div class="col-md-12 m-t-20">
                        <div class="card">
                            <div class="card-header">
                                <strong class="card-title">List Data Crawling</strong>
                            </div>
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-md-12 m-b-20">
                                        <div class="form-inline">
                                            <div class="form-group m-r-5">
                                                <input name="" id="keyword" value="TELEVISI" class="form-control" placeholder="Kata Kunci Data..."></input>
                                            </div>
                                            <div class="form-group m-r-5">
                                                <select name="" id="dataQuantity" class="form-control">
                                                    <option value="100">100 Data</option>
                                                    <option value="500">500 Data</option>
                                                    <option value="1000">1000 Data</option>
                                                </select>
                                            </div>
                                            <div class="form-group">
                                                <button class="btn btn-primary" onclick="updateData()">
                                                    Update Latest Data 
                                                </button>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <div class="alert alert-primary">
                                            <b>PERHATIAN</b>
                                            <p>Crawling data yang lebih banyak membutuhkan waktu lebih lama. Pastikan koneksi internet anda lancar</p>
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <div class="table-responsive  m-b-20">
                                            <table class="table table-borderless table-striped table-active" id="list-datatables">
                                                <thead>
                                                    <tr>
                                                        <th>No</th>
                                                        <th>Title Produk</th>
                                                        <th>Merek</th>
                                                        <th>Ukuran</th>
                                                        <th>Model</th>
                                                    </tr>
                                                </thead>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-12 m-t-20">
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- END MAIN CONTENT-->
@endsection

@section('javascript')

<script>

    const updateData = () => {
        const value = $('#dataQuantity').val()
        const keyword = $('#keyword').val()
        if(keyword === ''){
            return notification(
                'error',
                'Kata Kunci Tidak Boleh Kosong!'
            )
        }
        $.ajax({
            type: "POST",
            url: "{{route('crawling.store')}}",
            data: {
                _token: "{{ csrf_token() }}",
                value: value,
                keyword: keyword
            },
            dataType: "JSON",
            beforeSend: function(){
                loading('Harap Menunggu', 'Data Scrapping Sedang Di Proses...')
            },
            success: function (response) {
                if(response.status == 'success'){
                    notification(
                        'success',
                        'Data Berhasil Diperbarui'
                    )
                    listData.ajax.reload()
                }
            }
        });
    }

    const listData = $('#list-datatables').DataTable({
        processing: true,
        serverSide: true,
        searching: true,
        fixedColumns:   {
            heightMatch: 'none'
        },
        ajax: {
            url: '',
            data: (req) => {
               
            }
        },
        columns: [
            {data: 'DT_RowIndex', name: 'DT_RowIndex'},
            {data: 'title', name: 'title'},
            {data: 'brand', name: 'brand'},
            {data: 'size', name: 'size'},
            {data: 'model', name: 'model'},
        ]
    })

</script>
@endsection