<?php

namespace App\Http\Controllers;

use App\Exports\BarangExport;
use App\Exports\SupplierExport;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Facades\Excel;

class LaporanController extends Controller
{
    // laporan supplier
    public function viewlaporansupplier(Request $request)
    {
        if ($request->ajax()) {
            $data = DB::table('supplier')->get();

            return datatables()->of($data)
                ->addIndexColumn()
                ->make(true);
        }
        return view('laporan_supplier');
    }
    public function downloadlaporansupplier()
    {
        return Excel::download(new SupplierExport, 'supplier.xlsx');
    }

    // LAPORAN BARANG
    public function viewlaporanbarang(Request $request)
    {
        if ($request->ajax()) {
            $data = DB::table('barang as b')
                    ->join('satuan as s','s.id','b.id_satuan')
                    ->join('jenis as j','j.id','b.id_jenis')
                    ->select('b.id as idbarang','b.*','s.*','j.*')
                    ->get();

            return datatables()->of($data)
                ->addIndexColumn()
                ->make(true);
        }
        return view('laporan_barang');
    }
    public function downloadlaporanbarang()
    {
        return Excel::download(new BarangExport, 'barang.xlsx');
    }

    // LAPORAN BARANG MASUK
    public function viewlaporanbarangmasuk(Request $request)
    {
        if ($request->ajax()) {
            if (!empty($request->tahun)) {
                $data = DB::table('barang_masuk as bm')
                ->join('barang as b', 'b.id', 'bm.id_barang')
                ->join('satuan as st', 'st.id', 'b.id_satuan')
                ->join('supplier as s', 's.id', 'bm.id_supplier')
                ->select('bm.id as idmasuk','bm.id_transaksi as kodetransaksi', 'st.satuan', 's.*','bm.jumlah','bm.tanggal','b.kode_barang','b.nama_barang')
                ->whereYear('bm.tanggal', '=', $request->tahun)
                ->get();
            }
            if (!empty($request->bulan)) {
                $data = DB::table('barang_masuk as bm')
                ->join('barang as b', 'b.id', 'bm.id_barang')
                ->join('satuan as st', 'st.id', 'b.id_satuan')
                ->join('supplier as s', 's.id', 'bm.id_supplier')
                ->select('bm.id as idmasuk','bm.id_transaksi as kodetransaksi', 'st.satuan', 's.*','bm.jumlah','bm.tanggal','b.kode_barang','b.nama_barang')
                ->whereMonth('bm.tanggal', '=', $request->bulan)
                ->get();
            }
            if (!empty($request->tahun || $request->bulan)) {
                $data = DB::table('barang_masuk as bm')
                ->join('barang as b', 'b.id', 'bm.id_barang')
                ->join('satuan as st', 'st.id', 'b.id_satuan')
                ->join('supplier as s', 's.id', 'bm.id_supplier')
                ->select('bm.id as idmasuk','bm.id_transaksi as kodetransaksi', 'st.satuan', 's.*','bm.jumlah','bm.tanggal','b.kode_barang','b.nama_barang')
                ->whereYear('bm.tanggal', '=', $request->tahun)
                ->whereMonth('bm.tanggal', '=', $request->bulan)
                ->get();
            }else{
                $data = DB::table('barang_masuk as bm')
                ->join('barang as b', 'b.id', 'bm.id_barang')
                ->join('satuan as st', 'st.id', 'b.id_satuan')
                ->join('supplier as s', 's.id', 'bm.id_supplier')
                ->select('bm.id as idmasuk','bm.id_transaksi as kodetransaksi', 'st.satuan', 's.*','bm.jumlah','bm.tanggal','b.kode_barang','b.nama_barang')
                ->get();
            }

            return datatables()->of($data)
                ->addIndexColumn()
                ->make(true);
        }
        return view('laporan_barangmasuk');
    }
    public function downloadlaporanbarangmasuk()
    {
        return Excel::download(new BarangExport, 'barang.xlsx');
    }

    // LAPORAN BARANG KELUAR
    public function viewlaporanbarangkeluar(Request $request)
    {
        if ($request->ajax()) {
            if (!empty($request->tahun)) {
                $data = DB::table('barang_keluar as bk')
                ->join('barang as b', 'b.id', 'bk.id_barang')
                ->join('satuan as st', 'st.id', 'b.id_satuan')
                ->select('bk.id as idkeluar', 'bk.id_transaksi as kodetransaksi', 'st.satuan', 'bk.jumlah', 'bk.tanggal', 'b.kode_barang', 'b.nama_barang', 'bk.tujuan')
                ->whereYear('bk.tanggal', '=', $request->tahun)
                ->get();
            }
            if (!empty($request->bulan)) {
                $data = DB::table('barang_keluar as bk')
                ->join('barang as b', 'b.id', 'bk.id_barang')
                ->join('satuan as st', 'st.id', 'b.id_satuan')
                ->select('bk.id as idkeluar', 'bk.id_transaksi as kodetransaksi', 'st.satuan', 'bk.jumlah', 'bk.tanggal', 'b.kode_barang', 'b.nama_barang', 'bk.tujuan')
                ->whereMonth('bm.tanggal', '=', $request->bulan)
                ->get();
            }
            if (!empty($request->tahun || $request->bulan)) {
                $data = DB::table('barang_keluar as bk')
                ->join('barang as b', 'b.id', 'bk.id_barang')
                ->join('satuan as st', 'st.id', 'b.id_satuan')
                ->select('bk.id as idkeluar', 'bk.id_transaksi as kodetransaksi', 'st.satuan', 'bk.jumlah', 'bk.tanggal', 'b.kode_barang', 'b.nama_barang', 'bk.tujuan')
                ->whereMonth('bm.tanggal', '=', $request->bulan)
                ->whereYear('bk.tanggal', '=', $request->tahun)
                ->get();
            }else{
                $data = DB::table('barang_keluar as bk')
                ->join('barang as b', 'b.id', 'bk.id_barang')
                ->join('satuan as st', 'st.id', 'b.id_satuan')
                ->select('bk.id as idkeluar', 'bk.id_transaksi as kodetransaksi', 'st.satuan', 'bk.jumlah', 'bk.tanggal', 'b.kode_barang', 'b.nama_barang', 'bk.tujuan')
                ->get();
            }


            return datatables()->of($data)
                ->addIndexColumn()
                ->make(true);
        }
        return view('laporan_barangkeluar');
    }
    public function downloadlaporanbarangkeluar()
    {
        return Excel::download(new BarangExport, 'barang.xlsx');
    }
    public function cobacetak(Request $request)
    {
        $tahun = $request->tahun;
        $bulan = $request->bulan;
        return Excel::download(new BarangExport($tahun,$bulan),'barang-' . time() .'.xlsx');
    }
}
