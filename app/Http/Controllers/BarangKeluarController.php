<?php

namespace App\Http\Controllers;

use App\Barang;
use App\BarangKeluar;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use RealRashid\SweetAlert\Facades\Alert;

class BarangKeluarController extends Controller
{
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $data = DB::table('barang_keluar as bk')
                ->join('barang as b', 'b.id', 'bk.id_barang')
                ->join('satuan as st', 'st.id', 'b.id_satuan')
                ->select('bk.id as idkeluar', 'bk.id_transaksi as kodetransaksi', 'st.satuan', 'bk.jumlah', 'bk.tanggal', 'b.kode_barang', 'b.nama_barang', 'bk.tujuan')
                ->get();

            return datatables()->of($data)
                ->addColumn('action', function ($data) {
                    $button = ' <a href="#" onclick="hapusKeluar(' . $data->idkeluar . ')" class="delete btn btn-danger btn-sm" id="btnHapus" data-toggle="modal" data-id="' . $data->idkeluar . '"><i class="fa fa-trash"></i></a>';
                    return $button;
                })
                ->rawColumns(['action'])
                ->addIndexColumn()
                ->make(true);
        }
        $data = [
            'barang' => DB::table('barang')->get(),
            'supplier' => DB::table('supplier')->get(),
        ];
        return view('kel_barangkeluar', $data);
    }
    public function tambahBarang(Request $request)
    {
        $barang  = Barang::where('id', $request->barang)->pluck('jumlah');
        $cek = $barang[0] - $request->jumlah;
        if ($cek < 0) {
            return response()->json(['pesan' => 'eror']);
        } else {
            $BarangM = new BarangKeluar();
            $BarangM->id_transaksi = "TR" . time();
            $BarangM->id_barang = $request->barang;
            $BarangM->tanggal = $request->tanggal;
            $BarangM->jumlah = $request->jumlah;
            $BarangM->tujuan = $request->tujuan;
            $BarangM->save();

            $barang = Barang::where('id', $request->barang);
            $barang->decrement('jumlah', $request->jumlah);
            return response()->json(['pesan' => 'sukses']);
        }
    }
    public function getProp($id)
    {
        $data = DB::table('barang as b')
            ->join('satuan as s', 's.id', 'b.id_satuan')
            ->select('b.id', 'b.nama_barang', 's.satuan')
            ->where('b.id', $id)
            ->first();
        return response()->json($data);
    }
    public function hapusBarang($id)
    {
        $barangmasuk = DB::table('barang_keluar')->where('id', $id)->first();
        $barang = Barang::where('id', $barangmasuk->id_barang);
        $barang->increment('jumlah', $barangmasuk->jumlah);
        DB::table('barang_keluar')->where('id', $id)->delete();

        Alert::success('Berhasil Hapus', 'Data Barang Berhasil dihapus!');
        return redirect()->route('admin.keluar');
    }
}
