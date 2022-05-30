@extends('layouts.master')
@section('css')
    <!-- Responsive and DataTables -->
    <link href="{{ asset('assets/plugins/datatables/dataTables.bootstrap4.min.css') }}" rel="stylesheet"
        type="text/css" />
    <link href="{{ asset('assets/plugins/datatables/buttons.bootstrap4.min.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('assets/plugins/datatables/responsive.bootstrap4.min.css') }}" rel="stylesheet"
        type="text/css" />
    <link href="https://cdn.datatables.net/buttons/2.2.3/css/buttons.dataTables.min.css" rel="stylesheet" type="text/css" />
@endsection
@section('content')
    <div class="container-fluid">
        <div class="page-head">
            <h4 class="mt-2 mb-2">Halaman Laporan Barang Masuk</h4>
        </div>
        <div class="data-table">
            <div class="row">
                <div class="col-lg-12 col-sm-12">
                    <div class="card m-b-30">
                        <div class="card-header bg-primary">
                            <h4 class="header-title text-white">Data Barang Masuk</h4>
                        </div>
                        <div class="card-body table-responsive">
                            <div class="formfilter my-4">
                                <h5>Filter Laporan Perbulan dan Pertahun</h5>
                                <form action="#" method="GET" class="form-group" id="formFilter">
                                    {{ csrf_field() }}

                                    <div class="row">
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <select name="tahun" id="tahun" class="form-control">
                                                    <option value="">Pilih Tahun</option>
                                                    <?php
                                                    $year = date('Y');
                                                    $min = $year - 60;
                                                    $max = $year;
                                                    for ($i = $max; $i >= $min; $i--) {
                                                        echo '<option value=' . $i . '>' . $i . '</option>';
                                                    }
                                                    ?>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <select name="bulan" id="bulan" class="form-control">
                                                    <option value="" selected> Pilih Bulan</option>
                                                    <option value="01"> Januari</option>
                                                    <option value="02"> Februari</option>
                                                    <option value="03"> Maret</option>
                                                    <option value="04"> April</option>
                                                    <option value="05"> Mei</option>
                                                    <option value="06"> Juni</option>
                                                    <option value="07"> Juli</option>
                                                    <option value="08"> Agustus</option>
                                                    <option value="09"> September</option>
                                                    <option value="10"> Oktober</option>
                                                    <option value="11"> November</option>
                                                    <option value="12"> Desember</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <button type="button" class="btn btn-primary" id="filter">Tampilkan</button>
                                            <button type="button" class="btn btn-danger" id="reset">Reset</button>
                                        </div>
                                    </div>
                                </form>
                            </div>

                            <div class="table-odd">
                                <table id="tabelbarangmasuk" class="table table-bordered">
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
    <script src="https://cdn.datatables.net/buttons/2.2.3/js/dataTables.buttons.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/pdfmake.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/vfs_fonts.js"></script>
    <script src="https://cdn.datatables.net/buttons/1.6.2/js/buttons.html5.min.js""></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
@endsection
@section('js')
    <script>
        $(document).ready(function() {
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

            fill_datatable()

            function fill_datatable(tahun = '', bulan = '') {
                var tabel = $('#tabelbarangmasuk').DataTable({
                    processing: true,
                    serverSide: true, //aktifkan server-side
                    autoWidth: false,
                    dom: '<"html5buttons">Bfrtip',
                    language: {
                        buttons: {
                            colvis: 'show / hide',
                            colvisRestore: "Reset Kolom"
                        }
                    },
                    buttons: [{
                        extend: 'pdf',
                        text:'<i class="fa fa-file-pdf-o"></i> PDF',
                        title: 'Contoh File PDF Datatables',
                        className: 'btn btn-danger text-white rounded-lg'
                    }, {
                        extend: 'excel',
                        text:      '<i class="fa fa-file-excel-o"></i> EXCEL',
                        title: 'Contoh File Excel Datatables',
                        className: 'btn btn-success text-white rounded-lg'
                    }, ],
                    ajax: {
                        url: "{{ route('admin.laporanbarangmasuk') }}",
                        type: 'GET',
                        data: {
                            tahun: tahun,
                            bulan: bulan
                        }
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
                    ],

                });
            }

            function exportExcel(tahun = '', bulan = '') {
                $.ajax({
                    type: 'GET',
                    url: "{{ route('admin.cobacetak') }}",
                    data: {
                        tahun: tahun,
                        bulan: bulan
                    },
                    success: function(response) {
                        window.location.href = response.url;
                    }
                })
            }

            $("#filter").click(function() {
                var tahun = $('#tahun').val();
                var bulan = $('#bulan').val();

                if (tahun != '' && tahun != '') {
                    $('#tabelbarangmasuk').DataTable().destroy();
                    fill_datatable(tahun, bulan);
                } else {
                    fill_datatable();
                }
            })
            $(".btn-export").on("click", function() {
                var tahun = $('#tahun').val();
                var bulan = $('#bulan').val();
                exportExcel(tahun, bulan)

            })

            $('#reset').click(function() {
                $('#tahun').val('');
                $('#bulan').val('');
                $('#tabelbarangmasuk').DataTable().clear();
                $('#tabelbarangmasuk').DataTable().destroy();
                fill_datatable();
            });
        });
    </script>
@endsection
