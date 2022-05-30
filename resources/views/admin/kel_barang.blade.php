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
            <h4 class="mt-2 mb-2">Halaman Kelola Barang</h4>
        </div>
        <div class="data-table">
            <div class="row">
                <div class="col-lg-12 col-sm-12">
                    <div class="card m-b-30">
                        <div class="card-body table-responsive">
                            <button class="btn btn-tambah btn-primary btn-md float-right"><i
                                    class="fa fa-plus"></i><span>Tambah Barang </span></button>
                            <h5 class="header-title">Data Barang</h5>
                            <div class="table-odd">
                                <table id="tabelbarang" class="table table-bordered">
                                    <thead>
                                        <tr>
                                            <th>#</th>
                                            <th>Kode Barang</th>
                                            <th>Nama Barang</th>
                                            <th>Satuan</th>
                                            <th>Jenis</th>
                                            <th>Jumlah</th>
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
                        <h5 class="modal-title">Tambah Barang</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <form action="" id="formtambahbarang" method="POST">
                            @csrf
                            <input type="hidden" name="id" id="id">
                            <div class="form-group">
                                <label for="">Kode Barang</label>
                                <input type="text" class="form-control" name="kode" id="kode" >
                            </div>
                            <div class="form-group">
                                <label for="">Nama Barang</label>
                                <input type="nik" class="form-control" name="nama" id="nama">
                            </div>
                            <div class="form-group">
                                <label for="">Jenis</label>
                                <select name="jenis" id="jenis" class="form-control">
                                    @foreach ($jenis as $item)
                                        <option value="{{$item->id}}">{{$item->jenis_barang}}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="">Satuan</label>
                                <select name="satuan" id="satuan" class="form-control">
                                    @foreach ($satuan as $item)
                                        <option value="{{$item->id}}">{{$item->satuan}}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="">Jumlah</label>
                                <input type="number" class="form-control" name="jumlah" id="jumlah">
                            </div>

                        </div>
                        <div class="modal-footer">
                            <button type="button" id="simpanbarang" class="btn btn-primary">Save changes</button>
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
                        <h5 class="modal-title">Edit Barang</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <form action="" id="formeditbarang" method="POST">
                            @csrf
                            <input type="hidden" name="id" id="id">
                            <div class="form-group">
                                <label for="">Kode Barang</label>
                                <input type="text" class="form-control" name="kode" id="kode1" >
                            </div>
                            <div class="form-group">
                                <label for="">Nama Barang</label>
                                <input type="nik" class="form-control" name="nama" id="nama1">
                            </div>
                            <div class="form-group">
                                <label for="">Jenis</label>
                                <select name="jenis" id="jenis1" class="form-control">
                                    @foreach ($jenis as $item)
                                        <option value="{{$item->id}}">{{$item->jenis_barang}}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="">Satuan</label>
                                <select name="satuan" id="satuan1" class="form-control">
                                    @foreach ($satuan as $item)
                                        <option value="{{$item->id}}">{{$item->satuan}}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="">Jumlah</label>
                                <input type="number" class="form-control" name="jumlah" id="jumlah1">
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" id="updatebarang" class="btn btn-primary">Save changes</button>
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
            $('#tabelbarang').DataTable({
                processing: true,
                serverSide: true, //aktifkan server-side
                autoWidth: false,
                ajax: {
                    url: "{{ route('admin.barang') }}",
                    type: 'GET'
                },
                columns: [{
                        data: 'DT_RowIndex',
                        name: 'DT_RowIndex'
                    },
                    {
                        data: 'kode_barang',
                        name: 'kode_barang'
                    },
                    {
                        data: 'nama_barang',
                        name: 'nama_barang'
                    },
                    {
                        data: 'satuan',
                        name: 'satuan'
                    },
                    {
                        data: 'jenis_barang',
                        name: 'jenis_barang'
                    },
                    {
                        data: 'jumlah',
                        name: 'jumlah'
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

            $("#simpanbarang").on("click", function() {
                var formData = $("#formtambahbarang").serialize();
                $.ajax({
                    type: 'POST',
                    url: "{{ route('admin.tambahbarang') }}",
                    data: formData,
                    // dataType: 'JSON',
                    success: function(response) {
                        // console.log(response)
                        Swal.fire(
                            'SUKSES MENAMBAHKAN',
                            'Barang Berhasil Ditambahkan!',
                            'success')
                        $('#tabelbarang').DataTable().draw(false)
                        $('#modal-tambah').modal('hide')
                        $('#modal-tambah').on('hidden.bs.modal', function() {
                            $(this).find('form').trigger('reset');
                        })
                    }
                })
            })
        });
        $("#updatebarang").click(function() {
            var id = $("#id").val();
            var data = $('#formeditbarang').serialize();
            $.ajax({
                type: 'POST',
                url: '{{ url('admin/update/barang') }}/' + id,
                data: data,
                // dataType: 'JSON',
                success: function(response) {
                    console.log(response)
                    $('#modal-edit').modal('hide')
                    Swal.fire(
                        'Update Barang Berhasil!',
                        'Terima Kasih!',
                        'success')
                    var table = $('#tabelbarang').DataTable();
                    table.ajax.reload();
                }
            })
        })

        function editBarang(id) {
            $("#modal-edit").modal('show')
            $.ajax({
                type: 'GET',
                url: '{{ url('admin/edit/barang') }}/' + id,
                dataType: 'JSON',
                success: function(response) {
                    console.log(response)
                    barang = response.barang;
                    $("#id").val(barang.idbarang);
                    $("#kode1").val(barang.kode_barang);
                    $("#nama1").val(barang.nama_barang);
                    $("#jenis1").val(barang.id_jenis);
                    $("#satuan1").val(barang.id_satuan);
                    $("#jumlah1").val(barang.jumlah);
                }
            })
        }

        function hapusBarang($id) {
            Swal.fire({
                title: 'Apakah Anda Yakin Akan Menghapus Data Barang Ini?',
                // text: "Silahkan periksa kembali data progress kegiatan, apakah data yang anda masukkan sudah benar?!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Ya',
                cancelButtonText: 'Batal'
            }).then((result) => {
                if (result.value) {
                    window.location.href = "{{ url('admin/hapus/barang') }}/" + $id;
                }
            })
        }
    </script>
@endsection
