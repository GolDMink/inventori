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
            <h4 class="mt-2 mb-2">Halaman Kelola Supplier</h4>
        </div>
        <div class="data-table">
            <div class="row">
                <div class="col-lg-12 col-sm-12">
                    <div class="card m-b-30">
                        <div class="card-body table-responsive">
                            <button class="btn btn-tambah btn-primary btn-md float-right"><i
                                    class="fa fa-plus"></i><span>Tambah Suplier </span></button>
                            <h5 class="header-title">Data Supplier</h5>
                            <div class="table-odd">
                                <table id="tabelsupplier" class="table table-bordered">
                                    <thead>
                                        <tr>
                                            <th>#</th>
                                            <th>Kode Supplier</th>
                                            <th>Nama Supplier</th>
                                            <th>Alamat</th>
                                            <th>Telepon</th>
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
                        <h5 class="modal-title">Tambah Supplier</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <form action="" id="formtambahsupplier" method="POST">
                            @csrf
                            <input type="hidden" name="id" id="id">
                            <div class="form-group">
                                <label for="">Kode Supplier</label>
                                <input type="text" class="form-control" name="kode" id="kode" >
                            </div>
                            <div class="form-group">
                                <label for="">Nama Supplier</label>
                                <input type="nik" class="form-control" name="nama" id="nama">
                            </div>
                            <div class="form-group">
                                <label for="">Telepon</label>
                                <input type="text" class="form-control" name="telepon" id="telepon">
                            </div>
                            <div class="form-group">
                                <label for="">Alamat</label>
                                <input type="text" class="form-control" name="alamat" id="alamat">
                            </div>

                        </div>
                        <div class="modal-footer">
                            <button type="button" id="simpansupplier" class="btn btn-primary">Save changes</button>
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
                        <h5 class="modal-title">Edit Supplier</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <form action="" id="formeditsupplier" enctype="multipart/form-data" method="POST">
                            @csrf
                            <input type="hidden" name="id" id="id">
                            <div class="form-group">
                                <label for="">Kode Supplier</label>
                                <input type="text" class="form-control" name="kode" id="kode1" >
                            </div>
                            <div class="form-group">
                                <label for="">Nama Supplier</label>
                                <input type="nik" class="form-control" name="nama" id="nama1">
                            </div>
                            <div class="form-group">
                                <label for="">Telepon</label>
                                <input type="text" class="form-control" name="telepon" id="telepon1">
                            </div>
                            <div class="form-group">
                                <label for="">Alamat</label>
                                <input type="text" class="form-control" name="alamat" id="alamat1">
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" id="updatesupplier" class="btn btn-primary">Save changes</button>
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
            $('#tabelsupplier').DataTable({
                processing: true,
                serverSide: true, //aktifkan server-side
                autoWidth: false,
                ajax: {
                    url: "{{ route('admin.supplier') }}",
                    type: 'GET'
                },
                columns: [{
                        data: 'DT_RowIndex',
                        name: 'DT_RowIndex'
                    },
                    {
                        data: 'kode_supplier',
                        name: 'kode_supplier'
                    },
                    {
                        data: 'nama_supplier',
                        name: 'nama_supplier'
                    },
                    {
                        data: 'alamat',
                        name: 'alamat'
                    },
                    {
                        data: 'telepon',
                        name: 'telepon'
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

            $("#simpansupplier").on("click", function() {
                var formData = $("#formtambahsupplier").serialize();
                $.ajax({
                    type: 'POST',
                    url: "{{ route('admin.tambahsupplier') }}",
                    data: formData,
                    // dataType: 'JSON',
                    success: function(response) {
                        // console.log(response)
                        Swal.fire(
                            'SUKSES MENAMBAHKAN',
                            'Supplier Berhasil Ditambahkan!',
                            'success')
                        $('#tabelsupplier').DataTable().draw(false)
                        $('#modal-tambah').modal('hide')
                        $('#modal-tambah').on('hidden.bs.modal', function() {
                            $(this).find('form').trigger('reset');
                        })
                    }
                })
            })


            function hapusSupplier($id) {
                Swal.fire({
                    title: 'Apakah Anda Yakin Akan Menghapus Supplier Ini?',
                    // text: "Silahkan periksa kembali data progress kegiatan, apakah data yang anda masukkan sudah benar?!",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Ya',
                    cancelButtonText: 'Batal'
                }).then((result) => {
                    if (result.value) {
                        window.location.href = "{{ url('admin/hapus/supplier') }}/" + $id;
                    }
                })
            }
        });
        $("#updatesupplier").click(function() {
            var id = $("#id").val();
            var data = $('#formeditsupplier').serialize();
            $.ajax({
                type: 'POST',
                url: '{{ url('admin/update/supplier') }}/' + id,
                data: data,
                // dataType: 'JSON',
                success: function(response) {
                    console.log(response)
                    $('#modal-edit').modal('hide')
                    Swal.fire(
                        'Update Supplier Berhasil!',
                        'Terima Kasih!',
                        'success')
                    var table = $('#tabelsupplier').DataTable();
                    table.ajax.reload();
                }
            })
        })

        function editSupplier(id) {
            $("#modal-edit").modal('show')
            $.ajax({
                type: 'GET',
                url: '{{ url('admin/edit/supplier') }}/' + id,
                dataType: 'JSON',
                success: function(response) {
                    console.log(response)
                    supplier = response.supplier;
                    $("#id").val(supplier.id);
                    $("#kode1").val(supplier.kode_supplier);
                    $("#nama1").val(supplier.nama_supplier);
                    $("#alamat1").val(supplier.alamat);
                    $("#telepon1").val(supplier.telepon);
                }
            })
        }

        function hapusSupplier($id) {
            Swal.fire({
                title: 'Apakah Anda Yakin Akan Menghapus Data Supplier Ini?',
                // text: "Silahkan periksa kembali data progress kegiatan, apakah data yang anda masukkan sudah benar?!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Ya',
                cancelButtonText: 'Batal'
            }).then((result) => {
                if (result.value) {
                    window.location.href = "{{ url('admin/hapus/supplier') }}/" + $id;
                }
            })
        }
    </script>
@endsection
