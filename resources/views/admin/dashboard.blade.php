@extends('layouts.master')
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
                                class="fa fa-plus"></i><span>Tambah Dosen</span></button>
                        <h5 class="header-title">Data User</h5>
                        <div class="table-odd">
                            <table id="datatable" class="table table-bordered">
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
                    <form action="" id="formtambahuser">
                        <div class="form-group">
                            <label for="">Username</label>
                            <input type="text" class="form-control" name="username" >
                        </div>
                        <div class="form-group">
                            <label for="">NIK</label>
                            <input type="nik" class="form-control" name="nik">
                        </div>
                        <div class="form-group">
                            <label for="">Email</label>
                            <input type="email" class="form-control" name="email">
                        </div>
                        <div class="form-group">
                            <label for="">Nama Lengkap</label>
                            <input type="text" class="form-control" name="nama">
                        </div>
                        <div class="form-group">
                            <label for=""></label>
                            <input type="text" class="form-control" name="nama">
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-primary">Save changes</button>
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
