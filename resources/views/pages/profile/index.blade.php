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
        const openModal = () => {
            $('#staticModal').modal('toggle')
        }

        const resetPassword = () => {
            const oldPassword = document.getElementById('old-password').value
            const newPassword = document.getElementById('new-password').value
            const retypeNewPassword = document.getElementById('retype-new-password').value

            if(oldPassword === '' || newPassword === ''){
                return notification('warning', 'Password Tidak Boleh Kosong!', 'Harap Periksa Kembali Password Anda')
            }
            if(newPassword !== retypeNewPassword){
                return notification('warning', 'Password Tidak Sesuai!', 'Harap Periksa Kembali Password Anda')
            }

            Swal.fire({
                title: 'Apakah anda yakin akan mengubah password ?',
                text: "",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                cancelButtonText: 'Batalkan',
                confirmButtonText: 'Lanjutkan !'
            }).then((result) => {
                if (result.isConfirmed) {
                    $.ajax({
                        type: "POST",
                        url: "{{route('profile')}}",
                        data: {
                            _token: "{{ csrf_token() }}",
                            oldPassword: oldPassword,
                            newPassword: newPassword,
                            type       : 'updatePassword'
                        },
                        dataType: "JSON",
                        beforeSend: function(){
                            loading('Loading', 'Sedang Mengubah Password')
                        },
                        success: function (response) {
                            if(response.status === 'error'){
                                return notification('error', response.message)
                            }else{
                                document.getElementById('old-password').value = ''
                                document.getElementById('new-password').value = ''
                                document.getElementById('retype-new-password').value = ''
                                $('#staticModal').modal('toggle')
                                return notification('success', response.message)
                            }
                        }
                    });
                }
            })
        }

        const updateData = () => {
            const name  = document.getElementById('name').value
            const email = document.getElementById('email').value

            if(name === '' || email === ''){
                return notification('warning', 'Field Tidak Boleh Kosong!', 'Harap Periksa Kembali Field Anda')
            }

            Swal.fire({
                title: 'Apakah anda yakin akan mengubah profile ?',
                text: "",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                cancelButtonText: 'Batalkan',
                confirmButtonText: 'Lanjutkan !'
            }).then((result) => {
                if (result.isConfirmed) {
                    $.ajax({
                        type: "POST",
                        url: "{{route('profile')}}",
                        data: {
                            _token  : "{{ csrf_token() }}",
                            name    : name,
                            email   : email,
                            type    : 'updateProfile'
                        },
                        dataType: "JSON",
                        beforeSend: function(){
                            loading('Loading', 'Sedang Memperbarui Profile')
                        },
                        success: function (response) {
                            document.getElementById('name').value = name
                            document.getElementById('email').value = email
                            return notification('success', response.message)
                        }
                    });
                }
            })
        }

        const resetData = () => {
            
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
                            <h2 class="title-1">My Account Profile</h2>
                        </div>
                    </div>
                </div>
                <div class="row m-t-25">
                    <div class="col-12 ">
                        <div class="card">
                            <div class="card-body">
                                <div class="m-t-20 m-b-20">
                                    <table class="table table-bordered">
                                        <tr>
                                            <th>Nama</th>
                                            <td>
                                                <input type="text" name="" id="name" value="{{$user->name}}" style="width: 100%" >
                                            </td>
                                        </tr>
                                        <tr>
                                            <th>Email</th>
                                            <td><input type="email" name="" id="email" value="{{$user->email}}" style="width: 100%"> </td>
                                        </tr>
                                        <tr>
                                            <th>Role</th>
                                            <td>{{$user->role->name}}</td>
                                        </tr>
                                        <tr>
                                            <th>Password</th>
                                            <td><a href="#" onclick="openModal()" class="text-danger"> Ganti Password</a></td>
                                        </tr>
                                    </table>
                                </div>
                            </div>
                            <div class="card-footer text-right">
                                {{-- <button class="btn btn-danger" onclick="resetData()">RESET</button> --}}
                                <button class="btn btn-primary" onclick="updateData()">SIMPAN PEMBARUAN</button>
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
    <div class="modal fade" id="staticModal" tabindex="-1" role="dialog" aria-labelledby="staticModalLabel" aria-hidden="true"
    data-backdrop="static">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="staticModalLabel">Ubah Password</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-12">
                            <div class="alert alert-warning">
                                <i class="fa fa-exclamation"></i> Harap hubungi ADMIN apabila bila anda lupa password
                            </div>
                        </div>
                        <div class="col-12 form-group">
                            <label for="">Masukkan Password Lama</label>
                            <input type="password" id="old-password" class="form-control">
                        </div>
                        <div class="col-12 form-group">
                            <label for="">Masukkan Password Baru</label>
                            <input type="password" id="new-password" class="form-control">
                        </div>
                        <div class="col-12 form-group">
                            <label for="">Masukkan Kembali Password Baru</label>
                            <input type="password" id="retype-new-password" class="form-control">
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Batal</button>
                    <button type="button" class="btn btn-danger"  onclick="resetPassword()">Ganti Password</button>
                </div>
            </div>
        </div>
    </div>
    <!-- end modal static -->
@endsection