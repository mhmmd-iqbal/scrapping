@extends('partials.master')

@section('title', 'BRAND MASTER DATA')

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
                            <h2 class="title-1 text-uppercase">Brand Data</h2>
                        </div>
                    </div>
                    
                    <div class="col-md-12 m-t-20">
                        <div class="card">
                            <div class="card-header">
                                <strong class="card-title text-uppercase">List Data Brands</strong>
                            </div>
                            <div class="card-body">
                                <div class="row">
                                    @can('isAdmin')
                                    <div class="col-md-12 m-b-20">
                                        <div class="form-inline">
                                            <div class="form-group">
                                                <button class="btn btn-primary" onclick="createData()">
                                                    Create Data 
                                                </button>
                                            </div>
                                        </div>
                                    </div>
                                    @endcan
                                    <div class="col-md-12">
                                        <div class="table-responsive  m-b-20">
                                            <table class="table table-bordered table-striped table-active" id="list-datatables">
                                                <thead>
                                                    <tr>
                                                        <th>No</th>
                                                        <th>Nama Brand</th>
                                                        <th>Aksi</th>
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

@section('modal')
<!-- modal static -->
<div class="modal fade" id="modalData" tabindex="-1" role="dialog" aria-labelledby="modalDataLabel" aria-hidden="true"
data-backdrop="static">
   <div class="modal-dialog" role="document">
       <div class="modal-content">
           <div class="modal-header">
               <h5 class="modal-title text-uppercase " id="modalDataLabel">Tambah Data</h5>
               <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                   <span aria-hidden="true">&times;</span>
               </button>
           </div>
           <div class="modal-body">
               <div class="row">
                   <div class="col-12">
                        <label for="">Nama Brand</label>
                        <input type="text" class="form-control" name="brand" id="brand">
                        <input type="hidden" readonly id="brandId">
                   </div>
               </div>
           </div>
           <div class="modal-footer">
               <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
               <button type="button" class="btn btn-primary" id="submitData" data-action="add" onclick="submitData(this)">Confirm</button>
           </div>
       </div>
   </div>
</div>
<!-- end modal static -->
@endsection

@section('javascript')
<script>

    const createData = () => {
        $('#submitData').attr('data-action', 'add')
        document.getElementById('brandId').value = ''
        $('#modalData').modal('toggle')
    }

    const submitData = (e) => {
        const action = $(e).attr('data-action')
        const brand  = document.getElementById('brand');
        if(brand.value === '' || brand.value === null){
            return  notification(
                'warning',
                'Nama Brand Tidak Boleh Kosong',
            )
        }
        switch(action){
            case 'add':
                $.ajax({
                    type: "POST",
                    url: "",
                    data: {
                        _token: "{{ csrf_token() }}",
                        brand: brand.value
                    },
                    dataType: "JSON",
                    beforeSend: function() {
                        loading('Harap Menunggu', 'Data Sedang Di Proses...')
                    },
                    success: function (res) {
                        notification(
                            res.status,
                            res.message
                        )
                        $('#modalData').modal('toggle')
                        brand.value = ''
                        listData.ajax.reload()
                    },error: function(XMLHttpRequest, textStatus, errorThrown) {
                        notification(
                            'error',
                            'Gagal Menambah Data',
                            errorThrown
                        )
                        $('#modalData').modal('toggle')
                        brand.value = ''
                    }
                });
            break;
            case 'update': 
                const brandId = document.getElementById("brandId").value
                $.ajax({
                    type: "PUT",
                    url: "{{route('brands.update', 'brandId')}}".replace("brandId", brandId),
                    data: {
                        _token: "{{ csrf_token() }}",
                        brand: brand.value
                    },
                    dataType: "JSON",
                    beforeSend: function() {
                        loading('Harap Menunggu', 'Data Sedang Di Proses...')
                    },
                    success: function (res) {
                        notification(
                            res.status,
                            res.message
                        )
                        listData.ajax.reload()
                        $('#modalData').modal('toggle')
                        brand.value = ''
                    },error: function(XMLHttpRequest, textStatus, errorThrown) {
                        notification(
                            'error',
                            'Gagal Memperbarui Data',
                            errorThrown
                        )
                        $('#modalData').modal('toggle')
                        brand.value = ''
                    }
                });
            break;
        }
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
            {data: 'name', name: 'name'},
            {data: 'action', name: 'action'},
        ]
    })

    const updateData = (e) => {
        $('#submitData').attr('data-action', 'update')
        document.getElementById('brand').value = $(e).data('name')
        document.getElementById('brandId').value = $(e).data('id')
        $('#modalData').modal('toggle')
    }

    const deleteData = (e) => {
        const id = $(e).data('id')
        Swal.fire({
            title: 'Apakah anda yakin akan menghapus data ini?',
            text: "Data yang telah dihapus tidak dapat dikembalikan!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            cancelButtonText: 'Batalkan',
            confirmButtonText: 'Ya, Hapus Data!'
        }).then((result) => {
            if (result.isConfirmed) {
                $.ajax({
                    type: "DELETE",
                    url: "{{route('brands.destroy', 'brandId')}}".replace("brandId", id),
                    data: {
                        _token: "{{ csrf_token() }}",
                    },
                    dataType: "JSON",
                    beforeSend: function() {
                        loading('Harap Menunggu', 'Data Sedang Di Proses...')
                    },
                    success: function (res) {
                        notification(
                            res.status,
                            res.message
                        )
                        listData.ajax.reload()
                    },error: function(XMLHttpRequest, textStatus, errorThrown) {
                        notification(
                            'error',
                            'Gagal Menghapus Data',
                            errorThrown
                        )
                    }
                });
            }
        })
    }
</script>
@endsection