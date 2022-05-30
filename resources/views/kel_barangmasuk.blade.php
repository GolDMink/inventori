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
            <h4 class="mt-2 mb-2">Halaman Kelola Barang Masuk</h4>
        </div>
        <div class="data-table">
            <div class="row">
                <div class="col-lg-12 col-sm-12">
                    <div class="card m-b-30">
                        <div class="card-body table-responsive">

                            <div id="formtambahmasuk" class="my-4" hidden>
                                <h5 class="mb-3">Tambah Barang Masuk</h5>
                                <form action="" id="formtambahbarangmasuk" method="POST" >
                                    @csrf
                                    <input type="hidden" name="id" id="id">
                                    <div class="row">
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label for="">Kode Barang</label>
                                                <select name="barang" id="barang" class="form-control">
                                                    @foreach ($barang as $item)
                                                        <option value="{{$item->id}}">{{$item->kode_barang}}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label for="">Nama Barang</label>
                                                <input type="text" class="form-control" name="nama" id="nama" readonly>
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label for="">Satuan</label>
                                                <input type="nik" class="form-control" name="satuan" id="satuan" readonly>
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label for="">Pengirim Barang</label>
                                                <select name="supplier" id="supplier" class="form-control">
                                                    @foreach ($supplier as $item)
                                                        <option value="{{$item->id}}">{{$item->nama_supplier}}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label for="">Jumlah</label>
                                                <input type="number" class="form-control" name="jumlah" id="jumlah">
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label for="">Tanggal</label>
                                                <input type="date" class="form-control" name="tanggal" id="tanggal">
                                            </div>
                                        </div>
                                    </div>
                                    <button type="button" class="btn btn-secondary tutup">Close</button>
                                    <button type="button" id="simpanbarangmasuk" class="btn btn-primary">Tambah Barang Masuk</button>
                                </form>
                                <hr>
                            </div>
                            <button class="btn btn-tambah btn-primary btn-md float-right"><i
                                    class="fa fa-plus"></i><span>Tambah Barang Masuk </span></button>
                            <h5 class="header-title">Data Barang Masuk</h5>
                            <div class="table-odd">
                                <table id="tabelbarang" class="table table-bordered">
                                    <thead>
                                        <tr>
                                            <th>#</th>
                                            <th>Kode Transaksi</th>
                                            <th>Tanggal Masuk</th>
                                            <th>Kode Barang</th>
                                            <th>Nama Barang</th>
                                            <th>Jumlah Masuk</th>
                                            <th>Satuan</th>
                                            <th>Pengirim</th>
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
                    url: "{{ route('admin.masuk') }}",
                    type: 'GET'
                },
                columns: [{
                        data: 'DT_RowIndex',
                        name: 'DT_RowIndex'
                    },
                    {
                        data: 'kodetransaksi',
                        name: 'kodetransaksi'
                    },
                    {
                        data: 'tanggal',
                        name: 'tanggal'
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
                        data: 'jumlah',
                        name: 'jumlah'
                    },
                    {
                        data: 'satuan',
                        name: 'satuan'
                    },
                    {
                        data: 'nama_supplier',
                        name: 'nama_supplier'
                    },
                    {
                        data: 'action',
                        name: 'action'
                    },
                ],

            });

            $(".btn-tambah").on('click', function() {
                $('#formtambahmasuk').removeAttr('hidden');
                $(".btn-tambah").hide();
                $(".tutup").on("click",function(){
                    $('#formtambahmasuk').prop('hidden',true);
                    $(".btn-tambah").show();
                })
            })

            $("#simpanbarangmasuk").on("click", function() {
                var formData = $("#formtambahbarangmasuk").serialize();
                $.ajax({
                    type: 'POST',
                    url: "{{ route('admin.tambahbarangmasuk') }}",
                    data: formData,
                    // dataType: 'JSON',
                    success: function(response) {
                        // console.log(response)
                        Swal.fire(
                            'SUKSES MENAMBAHKAN',
                            'Barang Berhasil Ditambahkan!',
                            'success')
                        $('#tabelbarang').DataTable().draw(false)
                        $("#formtambahbarangmasuk")[0].reset();
                        $('#formtambahmasuk').prop('hidden',true);
                        $(".btn-tambah").show();
                    }
                })
            })
        });
        $("#barang").on("change",function(){
            var id = $(this).val()
            $.ajax({
                type: 'GET',
                url: '{{ url('admin/getdatabarang') }}/' + id,
                dataType: 'JSON',
                success: function(data) {
                    console.log(data)
                    $("#nama").val(data.nama_barang);
                    $("#satuan").val(data.satuan);
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

        function hapusMasuk($id) {
            Swal.fire({
                title: 'Apakah Anda Yakin Akan Menghapus Data Ini?',
                // text: "Silahkan periksa kembali data progress kegiatan, apakah data yang anda masukkan sudah benar?!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Ya',
                cancelButtonText: 'Batal'
            }).then((result) => {
                if (result.value) {
                    window.location.href = "{{ url('admin/hapus/masuk') }}/" + $id;
                }
            })
        }

    </script>
@endsection
