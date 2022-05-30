@extends('layouts.master')
@section('css')
    <!-- Responsive and DataTables -->
    <link href="assets/plugins/datatables/dataTables.bootstrap4.min.css" rel="stylesheet" type="text/css" />
    <link href="assets/plugins/datatables/buttons.bootstrap4.min.css" rel="stylesheet" type="text/css" />
    <link href="assets/plugins/datatables/responsive.bootstrap4.min.css" rel="stylesheet" type="text/css" />
@endsection
@section('content')
    <div class="container-fluid">
        <div class="page-head">
            <h4 class="mt-2 mb-2">Halaman Kelola User</h4>
        </div>
        <div class="data-table">
            <div class="row">
                <div class="col-lg-12 col-sm-12">
                    <div class="card m-b-30">
                        <div class="card-body table-responsive">
                            <button class="btn btn-tambah btn-primary btn-md float-right"><i
                                    class="fa fa-plus"></i><span>Tambah User </span></button>
                            <h5 class="header-title">Data User</h5>
                            <div class="table-odd">
                                <table id="tabeluser" class="table table-bordered">
                                    <thead>
                                        <tr>
                                            <th>#</th>
                                            <th>Foto</th>
                                            <th>Nama</th>
                                            <th>Username</th>
                                            <th>NIK</th>
                                            <th>Telepon</th>
                                            <th>level</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody></tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!--end row-->
        </div>
        <div class="modal fade bd-example-modal-sm" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel"
            aria-hidden="true" id="modal-tambah">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Tambah User</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <form action="{{route('admin.tambahuser')}}" id="formtambahuser" enctype="multipart/form-data" method="POST">
                            @csrf
                            <div class="form-group">
                                <label for="">Username</label>
                                <input type="text" class="form-control" name="username" >
                            </div>
                            <div class="form-group">
                                <label for="">NIK</label>
                                <input type="nik" class="form-control" name="nik">
                            </div>
                            <div class="form-group">
                                <label for="">Nama Lengkap</label>
                                <input type="text" class="form-control" name="nama">
                            </div>
                            <div class="form-group">
                                <label for="">Telepon</label>
                                <input type="text" class="form-control" name="telpon">
                            </div>
                            <div class="form-group">
                                <label for="">Alamat</label>
                                <input type="text" class="form-control" name="alamat">
                            </div>
                            <div class="form-group">
                                <label for="">Foto</label>
                                <input type="file" class="form-control" name="foto">
                            </div>
                            <div class="form-group">
                                <label for="">Password</label>
                                <input type="password" class="form-control" name="password">
                            </div>

                        </div>
                        <div class="modal-footer">
                            <button type="submit" id="simpanuser" class="btn btn-primary">Save changes</button>
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <div class="modal fade bd-example-modal-sm" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel"
            aria-hidden="true" id="modal-edit">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Edit User</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <form action="" id="formedituser" enctype="multipart/form-data" method="POST">
                            @csrf
                            <input type="hidden" name="id" id="id">
                            <div class="form-group">
                                <label for="">Username</label>
                                <input type="text" class="form-control" name="username" id="username1" >
                            </div>
                            <div class="form-group">
                                <label for="">NIK</label>
                                <input type="nik" class="form-control" name="nik" id="nik1">
                            </div>
                            <div class="form-group">
                                <label for="">Nama Lengkap</label>
                                <input type="text" class="form-control" name="nama" id="nama1">
                            </div>
                            <div class="form-group">
                                <label for="">Telepon</label>
                                <input type="text" class="form-control" name="telpon" id="telpon1">
                            </div>
                            <div class="form-group">
                                <label for="">Alamat</label>
                                <input type="text" class="form-control" name="alamat" id="alamat1">
                            </div>
                            <div class="form-group">
                                <label for="">Foto</label>
                                <input type="file" class="form-control" name="foto" id="foto1">
                            </div>

                        </div>
                        <div class="modal-footer">
                            <button type="button" id="updateuser" class="btn btn-primary">Save changes</button>
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('plugin')
    <!-- Responsive and datatable js -->
    <script src="{{ asset('assets/plugins/datatables/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('assets/plugins/datatables/dataTables.bootstrap4.min.js') }}"></script>
    <script src="{{ asset('assets/plugins/datatables/dataTables.responsive.min.js') }}"></script>
    <script src="{{ asset('assets/plugins/datatables/responsive.bootstrap4.min.js') }}"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
        $(document).ready(function() {
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
        });
        $('body').ready(function() {
            $('#tabeluser').DataTable({
                processing: true,
                serverSide: true, //aktifkan server-side
                autoWidth: false,
                ajax: {
                    url: "{{ route('admin.user') }}",
                    type: 'GET'
                },
                columns: [{
                        data: 'DT_RowIndex',
                        name: 'DT_RowIndex'
                    },
                    {
                        data: 'foto',
                        name: 'foto'
                    },
                    {
                        data: 'nama',
                        name: 'nama'
                    },
                    {
                        data: 'username',
                        name: 'username'
                    },
                    {
                        data: 'nik',
                        name: 'nik'
                    },
                    {
                        data: 'telepon',
                        name: 'telepon'
                    },
                    {
                        data: 'level',
                        name: 'level',
                        render: function(data){
                            if(data == 1){
                                return "Admin";
                            }else{
                                return "Petugas";
                            }
                        }
                    },
                    {
                        data: 'action',
                        name: 'action'
                    },
                ],

            });

            $(".btn-tambah").on('click', function() {
                $("#modal-tambah").modal('show')
            })




            function hapusClient($id) {
                Swal.fire({
                    title: 'Apakah Anda Yakin Akan Menghapus Client Ini?',
                    // text: "Silahkan periksa kembali data progress kegiatan, apakah data yang anda masukkan sudah benar?!",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Ya',
                    cancelButtonText: 'Batal'
                }).then((result) => {
                    if (result.value) {
                        window.location.href = "{{ url('leader/hapusclient') }}/" + $id;
                    }
                })
            }
        });
        $("#updateuser").click(function() {
            var id = $("#id").val();
            var data = $('#formedituser').serialize();
            $.ajax({
                type: 'POST',
                url: '{{ url('admin/update/user') }}/' + id,
                data: data,
                // dataType: 'JSON',
                success: function(response) {
                    console.log(response)
                    $('#modal-edit').modal('hide')
                    Swal.fire(
                        'Update User Berhasil!',
                        'Terima Kasih!',
                        'success')
                    var table = $('#tabeluser').DataTable();
                    table.ajax.reload();
                }
            })
        })

        function editUser(id) {
            $("#modal-edit").modal('show')
            alert(id)
            $.ajax({
                type: 'GET',
                url: '{{ url('admin/edit/user') }}/' + id,
                dataType: 'JSON',
                success: function(response) {
                    console.log(response)
                    user = response.user;
                    $("#id").val(user.id);
                    $("#username1").val(user.username);
                    $("#nik1").val(user.nik);
                    $("#nama1").val(user.nama);
                    $("#telpon1").val(user.telepon);
                    $("#alamat1").val(user.alamat);
                }
            })
        }

        function hapusUser($id) {
            Swal.fire({
                title: 'Apakah Anda Yakin Akan Menghapus Data User Ini?',
                // text: "Silahkan periksa kembali data progress kegiatan, apakah data yang anda masukkan sudah benar?!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Ya',
                cancelButtonText: 'Batal'
            }).then((result) => {
                if (result.value) {
                    window.location.href = "{{ url('admin/hapus/user') }}/" + $id;
                }
            })
        }
    </script>
@endsection
