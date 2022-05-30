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
            <h4 class="mt-2 mb-2">Halaman Laporan Barang</h4>
        </div>
        <div class="data-table">
            <div class="row">
                <div class="col-lg-12 col-sm-12">
                    <div class="card m-b-30">
                        <div class="card-body table-responsive">
                            <button class="btn btn-export btn-success btn-md float-right"><i
                                    class="fa fa-plus"></i><span> Export excel </span></button>
                            <h5 class="header-title">Data Barang</h5>
                            <div class="table-odd">
                                <table id="tabelbarang" class="table table-bordered">
                                    <thead>
                                        <tr>
                                            <th>#</th>
                                            <th>Kode barang</th>
                                            <th>Nama barang</th>
                                            <th>Jenis Barang</th>
                                            <th>Jumlah Barang</th>
                                            <th>Satuan Barang</th>
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
                    url: "{{ route('admin.laporanbarang') }}",
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
                        data: 'jenis_barang',
                        name: 'jenis_barang'
                    },
                    {
                        data: 'jumlah',
                        name: 'jumlah'
                    },
                    {
                        data: 'satuan',
                        name: 'satuan'
                    },
                ],

            });
        })
        $(".btn-export").on("click",function(){
            window.location.href = "{{ url('admin/index/export/laporanbarang') }}/";
        })
    </script>
@endsection
