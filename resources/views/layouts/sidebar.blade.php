<div class="sidebar-left">
    <div class="sidebar-left-info">

        <div class="user-box">
            <div class="d-flex justify-content-center">
                <img src="{{ asset('foto/' . Auth::user()->foto) }}" alt="" class="img-fluid rounded-circle">
            </div>
            <div class="text-center text-white mt-2">
                <h6>{{ Auth::user()->nama }}</h6>
                <p class="text-muted m-0">
                    @if (Auth::user()->level == 1)
                        Admin
                    @else
                        Petugas
                    @endif
                </p>
            </div>
        </div>

        <!--sidebar nav start-->
        <ul class="side-navigation">
            <li>
                <h3 class="navigation-title">Menu</h3>
            </li>
            <li class="active">
                <a href="index.html"><i class="mdi mdi-gauge"></i> <span>Dashboard</span></a>
            </li>
            <li>
                <a href="index.html"><i class="mdi mdi-gauge"></i> <span>Data Pengguna</span></a>
            </li>
            <li class="menu-list">
                <li class="menu-list {{ (request()->is('admin/index/*')) ? 'active menu-open' : '' }}">
                <a href=""><i class="mdi mdi-buffer"></i> <span>Data Master</span></a>
                <ul class="child-list">
                    <li class="{{ request()->is('admin/index/barang') ? 'active' : '' }}">
                        <a href="{{ route('admin.barang') }}"> Data Barang</a>
                    </li>
                    <li class="{{ request()->is('admin/index/jenis') ? 'active' : '' }}">
                        <a href="{{ route('admin.jenis') }}"> Jenis Barang</a>
                    </li>
                    <li class="{{ (request()->is('admin/index/satuan')) ? 'active' : '' }}">
                        <a href="{{ route('admin.satuan') }}"> Satuan Barang</a>
                    </li>
                    <li class="{{ (request()->is('admin/index/supplier')) ? 'active' : '' }}">
                        <a href="{{ route('admin.supplier') }}"> Data Suplier</a>
                    </li>
                </ul>
            </li>
            <li class="menu-list"><a href=""><i class="mdi mdi-buffer"></i> <span>Transaksi</span></a>
                <ul class="child-list">
                    <li><a href="{{route('admin.masuk')}}"> Barang Masuk</a></li>
                    <li><a href="{{route('admin.keluar')}}"> Barang Keluar</a></li>
                </ul>
            </li>
            <li class="menu-list"><a href=""><i class="mdi mdi-buffer"></i> <span>Laporan</span></a>
                <ul class="child-list">
                    <li><a href="{{route('admin.laporansupplier')}}"> Laporan Data Suplier</a></li>
                    <li><a href="{{route('admin.laporanbarang')}}"> Laporan Data Barang</a></li>
                    <li><a href="{{route('admin.laporanbarangmasuk')}}"> Laporan Data Masuk</a></li>
                    <li><a href="{{route('admin.laporanbarangkeluar')}}"> Laporan Data Keluar</a></li>
                </ul>
            </li>

        </ul>
        <!--sidebar nav end-->
    </div>
</div>
