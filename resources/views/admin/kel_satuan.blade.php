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
            <h4 class="mt-2 mb-2">Halaman Kelola Satuan</h4>
        </div>
        <div class="data-table">
            <div class="row">
                <div class="col-lg-12 col-sm-12">
                    <div class="card m-b-30">
                        <div class="card-body table-responsive">
                            <button class="btn btn-tambah btn-primary btn-md float-right"><i
                                    class="fa fa-plus"></i><span>Tambah Satuan </span></button>
                            <h5 class="header-title my-3">Data Satuan</h5>
                            <div class="table-odd">
                                <table id="tabelsatuan" class="table table-bordered">
                                    <thead>
                                        <tr>
                                            <th>#</th>
                                            <th>Nama</th>
                                            <th>Aksi</th>
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
                        <form action="" id="formtambahsatuan" method="POST">
                            @csrf
                            <div class="form-group">
                                <label for="">Nama Satuan</label>
                                <input type="text" class="form-control" name="nama">
                            </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" id="simpansatuan" class="btn btn-primary">Save changes</button>
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
                        <h5 class="modal-title">Edit Satuan</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <form action="" id="formupdatesatuan" method="POST">
                            @csrf
                            <input type="hidden" name="id" id="id">
                            <div class="form-group">
                                <label for="">Nama Satuan</label>
                                <input type="text" class="form-control" name="nama" id="nama1">
                            </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" id="updatesatuan" class="btn btn-primary">Save changes</button>
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
            $('#tabelsatuan').DataTable({
                processing: true,
                serverSide: true, //aktifkan server-side
                autoWidth: false,
                ajax: {
                    url: "{{ route('admin.satuan') }}",
                    type: 'GET'
                },
                columns: [{
                        data: 'DT_RowIndex',
                        name: 'DT_RowIndex'
                    },
                    {
                        data: 'satuan',
                        name: 'satuan'
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
            $("#simpansatuan").on("click", function() {
                var formData = $("#formtambahsatuan").serialize();
                $.ajax({
                    type: 'POST',
                    url: "{{ route('admin.tambahsatuan') }}",
                    data: formData,
                    // dataType: 'JSON',
                    success: function(response) {
                        // console.log(response)
                        Swal.fire(
                            'SUKSES MENAMBAHKAN',
                            'Satuan Berhasil Ditambahkan!',
                            'success')
                        $('#tabelsatuan').DataTable().draw(false)
                        $('#modal-tambah').modal('hide')
                        $('#modal-tambah').on('hidden.bs.modal', function() {
                            $(this).find('form').trigger('reset');
                        })
                    }
                })
            })
        })


        $("#updatesatuan").click(function() {
            var id = $("#id").val();
            var data = $('#formupdatesatuan').serialize();
            $.ajax({
                type: 'POST',
                url: '{{ url('admin/update/satuan') }}/' + id,
                data: data,
                // dataType: 'JSON',
                success: function(response) {
                    console.log(response)
                    $('#modal-edit').modal('hide')
                    Swal.fire(
                        'Update Satuan Berhasil!',
                        'Terima Kasih!',
                        'success')
                    var table = $('#tabelsatuan').DataTable();
                    table.ajax.reload();
                }
            })
        })

        function editSatuan(id) {
            $("#modal-edit").modal('show')
            $.ajax({
                type: 'GET',
                url: '{{ url('admin/edit/satuan') }}/' + id,
                dataType: 'JSON',
                success: function(response) {
                    console.log(response)
                    satuan = response.satuan;
                    $("#id").val(satuan.id);
                    $("#nama1").val(satuan.satuan);
                }
            })
        }

        function hapusSatuan($id) {
            Swal.fire({
                title: 'Apakah Anda Yakin Akan Menghapus Data Satuan Ini?',
                // text: "Silahkan periksa kembali data progress kegiatan, apakah data yang anda masukkan sudah benar?!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Ya',
                cancelButtonText: 'Batal'
            }).then((result) => {
                if (result.value) {
                    window.location.href = "{{ url('admin/hapus/satuan') }}/" + $id;
                }
            })
        }
    </script>
@endsection
