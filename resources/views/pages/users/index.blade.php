@extends('partials.master')

@section('title', 'USER MASTER DATA')

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
                            <h2 class="title-1 text-uppercase">User Data</h2>
                        </div>
                    </div>
                    
                    <div class="col-md-12 m-t-20">
                        <div class="card">
                            <div class="card-header">
                                <strong class="card-title text-uppercase">List Data User</strong>
                            </div>
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-md-12 m-b-20">
                                        <div class="form-inline">
                                            <div class="form-group">
                                                <button class="btn btn-primary" onclick="createData()">
                                                    Create User
                                                </button>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <div class="table-responsive  m-b-20">
                                            <table class="table table-bordered table-striped table-active" id="list-datatables">
                                                <thead>
                                                    <tr>
                                                        <th>No</th>
                                                        <th>Nama</th>
                                                        <th>Username</th>
                                                        <th>Email</th>
                                                        <th>Role</th>
                                                        <th>Dibuat Pada</th>
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
                   <div class="form-group col-12">
                        <label for="">Nama</label>
                        <input type="text" class="form-control" name="name" id="name">
                        <input type="hidden" readonly id="userId">
                   </div>
                   <div class="form-group col-12">
                        <label for="">Username</label>
                        <input type="text" class="form-control" name="username" id="username">
                   </div>
                   <div class="form-group col-6">
                       <button class="btn btn-success btn-sm btn-block" id="generateUsername" onclick="generateUsername()"><i class="fa fa-refresh"></i> Generate Username</button>
                   </div>
                   <div class="form-group col-12">
                        <label for="">Email</label>
                        <input type="text" class="form-control" name="email" id="email">
                   </div>
                   <div class="form-group col-6">
                        <label for="">Role</label>
                        <select class="form-control" name="role_id" id="role_id">
                            @foreach ($roles as $role)
                                <option value="{{$role->id}}">{{$role->name}}</option>
                            @endforeach
                        </select>
                   </div>
                   <div class="form-group col-12">
                       <div class="alert alert-info">
                           <p>
                               User yang baru dibuat akan memiliki password default sesuai <b>USERNAME</b>
                           </p>
                       </div>
                   </div>
               </div>
           </div>
           <div class="modal-footer">
               <button type="button" class="btn btn-success" hidden id="resetPassword" onclick="resetPassword()" ><i class="fa fa-refresh"></i> Reset Password</button>
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
    const generateUsername = () => {
        document.getElementById("username").value = Math.random().toString(36).substring(7)
    }

    const createData = () => {
        $('#submitData').attr('data-action', 'add')
        $('#modalData').modal('toggle')
        $('#generateUsername').attr('hidden', false)
        $('#username').attr('readonly', false)

        $('#resetPassword').attr('hidden', true)

        $('#userId').val(null)
    }

    const updateData = (e) => {
        const data  = $(e).data()
        console.table(data)

        $('#submitData').attr('data-action', 'update')
        $('#modalData').modal('toggle')
        $('#generateUsername').attr('hidden', true)

        $('#userId').val(data.id)
        $('#username').attr('readonly', true).val(data.username)
        $('#email').val(data.email)
        $('#role_id').val(data.role).change()
        $('#name').val(data.name)

        $('#resetPassword').attr('hidden', false)
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
                    url: "{{route('users.destroy', 'userId')}}".replace("userId", id),
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

    const submitData = (e) => {
        const action = $(e).attr('data-action')
        const name  = document.getElementById('name');
        const username  = document.getElementById('username');
        const email  = document.getElementById('email');
        const role_id  = document.getElementById('role_id');
        switch(action){
            case 'add':
                $.ajax({
                    type: "POST",
                    url: "",
                    data: {
                        _token: "{{ csrf_token() }}",
                        name: name.value,
                        username: username.value,
                        email: email.value,
                        role_id: role_id.value,
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
                        name.value = ''
                        username.value = ''
                        email.value = ''
                        listData.ajax.reload()
                    },error: function(XMLHttpRequest, textStatus, errorThrown) {
                        console.log(XMLHttpRequest, errorThrown)
                        notification(
                            'error',
                            'Gagal Menambah Data',
                            errorThrown
                        )
                        // $('#modalData').modal('toggle')
                        // name.value = ''
                        // username.value = ''
                        // email.value = ''
                    }
                });
            break;
            case 'update': 
                const userId = document.getElementById("userId").value
                $.ajax({
                    type: "PUT",
                    url: "{{route('users.update', 'userId')}}".replace("userId", userId),
                    data: {
                        _token: "{{ csrf_token() }}",
                        name: name.value,
                        username: username.value,
                        email: email.value,
                        role_id: role_id.value,
                        reset_password: 0
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
                        name.value = ''
                        username.value = ''
                        email.value = ''
                    },error: function(XMLHttpRequest, textStatus, errorThrown) {
                        notification(
                            'error',
                            'Gagal Memperbarui Data',
                            errorThrown
                        )
                        $('#modalData').modal('toggle')
                    }
                });
            break;
        }
    }

    const resetPassword = () => {
        const id = $('#userId').val()
        const name  = document.getElementById('name');
        const username  = document.getElementById('username');
        const email  = document.getElementById('email');
        const role_id  = document.getElementById('role_id');
        Swal.fire({
            title: 'Apakah anda yakin akan reset password data ini?',
            text: "Password akan direset sesuai Username!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            cancelButtonText: 'Batalkan',
            confirmButtonText: 'Ya, Lanjutkan!'
        }).then((result) => {
            if (result.isConfirmed) {
                $.ajax({
                    type: "PUT",
                    url: "{{route('users.update', 'userId')}}".replace("userId", id),
                    data: {
                        _token: "{{ csrf_token() }}",
                        name: name.value,
                        username: username.value,
                        email: email.value,
                        role_id: role_id.value,
                        reset_password: 1
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
                        listData.ajax.reload()
                        name.value = ''
                        username.value = ''
                        email.value = ''
                    },error: function(XMLHttpRequest, textStatus, errorThrown) {
                        notification(
                            'error',
                            'Gagal Memperbarui Data',
                            errorThrown
                        )
                    }
                });
            }
        })
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
            {data: 'username', name: 'username'},
            {data: 'email', name: 'email'},
            {data: 'role.name', name: 'role_name'},
            {data: 'created_at', name: 'created_at'},
            {data: 'action', name: 'action'},
        ]
    })
</script>
@endsection