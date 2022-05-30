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
            <h4 class="mt-2 mb-2">Halaman Kelola Barang Keluar</h4>
        </div>
        <div class="data-table">
            <div class="row">
                <div class="col-lg-12 col-sm-12">
                    <div class="card m-b-30">
                        <div class="card-body table-responsive">

                            <div id="formtambahkeluar" class="my-4" hidden>
                                <h5 class="mb-3">Tambah Barang Keluar</h5>
                                <form action="" id="formtambahbarangkeluar" method="POST" >
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
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label for="">Tujuan</label>
                                                <input type="text" class="form-control" name="tujuan" id="tujuan">
                                            </div>
                                        </div>
                                    </div>
                                    <button type="button" class="btn btn-secondary tutup">Close</button>
                                    <button type="button" id="simpanbarangkeluar" class="btn btn-primary">Tambah Barang Keluar</button>
                                </form>
                                <hr>
                            </div>
                            <button class="btn btn-tambah btn-primary btn-md float-right"><i
                                    class="fa fa-plus"></i><span>Tambah Barang Keluar </span></button>
                            <h5 class="header-title">Data Barang Keluar</h5>
                            <div class="table-odd">
                                <table id="tabelbarangkeluar" class="table table-bordered">
                                    <thead>
                                        <tr>
                                            <th>#</th>
                                            <th>Kode Transaksi</th>
                                            <th>Tanggal Keluar</th>
                                            <th>Kode Barang</th>
                                            <th>Nama Barang</th>
                                            <th>Jumlah Keluar</th>
                                            <th>Satuan</th>
                                            <th>Tujuan</th>
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
            $('#tabelbarangkeluar').DataTable({
                processing: true,
                serverSide: true, //aktifkan server-side
                autoWidth: false,
                ajax: {
                    url: "{{ route('admin.keluar') }}",
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
                        data: 'tujuan',
                        name: 'tujuan'
                    },
                    {
                        data: 'action',
                        name: 'action'
                    },
                ],

            });

            $(".btn-tambah").on('click', function() {
                $('#formtambahkeluar').removeAttr('hidden');
                $(".btn-tambah").hide();
                $(".tutup").on("click",function(){
                    $('#formtambahkeluar').prop('hidden',true);
                    $(".btn-tambah").show();
                })
            })

            $("#simpanbarangkeluar").on("click", function() {
                var formData = $("#formtambahbarangkeluar").serialize();
                $.ajax({
                    type: 'POST',
                    url: "{{ route('admin.tambahbarangkeluar') }}",
                    data: formData,
                    // dataType: 'JSON',
                    success: function(response) {
                        if(response.pesan == 'sukses')
                        {
                            Swal.fire(
                                'SUKSES MENAMBAHKAN',
                                'Barang Berhasil Ditambahkan!',
                                'success')
                            $('#tabelbarangkeluar').DataTable().draw(false)
                            $("#formtambahbarangkeluar")[0].reset();
                            $('#formtambahkeluar').prop('hidden',true);
                            $(".btn-tambah").show();
                        }else{
                            Swal.fire(
                                'GAGAL MENAMBAHKAN',
                                'Barang Gagal Ditambahkan!',
                                'error')
                        }
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

        function hapusKeluar($id) {
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
                    window.location.href = "{{ url('admin/hapus/keluar') }}/" + $id;
                }
            })
        }

    </script>
@endsection
