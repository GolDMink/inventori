<?php

namespace App\Http\Controllers;

use App\Barang;
use App\BarangMasuk;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use RealRashid\SweetAlert\Facades\Alert;

class BarangMasukController extends Controller
{
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $data = DB::table('barang_masuk as bm')
            ->join('barang as b', 'b.id', 'bm.id_barang')
            ->join('satuan as st', 'st.id', 'b.id_satuan')
            ->join('supplier as s', 's.id', 'bm.id_supplier')
            ->select('bm.id as idmasuk','bm.id_transaksi as kodetransaksi', 'st.satuan', 's.*','bm.jumlah','bm.tanggal','b.kode_barang','b.nama_barang')
            ->get();

            return datatables()->of($data)
                ->addColumn('action', function ($data) {
                    $button = ' <a href="#" onclick="hapusMasuk(' . $data->idmasuk . ')" class="delete btn btn-danger btn-sm" id="btnHapus" data-toggle="modal" data-id="' . $data->id . '"><i class="fa fa-trash"></i></a>';
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
        return view('kel_barangmasuk', $data);
    }
    public function tambahBarang(Request $request)
    {
        $BarangM = new BarangMasuk();
        $BarangM->id_transaksi = "TRM".time();
        $BarangM->id_barang = $request->barang;
        $BarangM->id_supplier = $request->supplier;
        $BarangM->tanggal = $request->tanggal;
        $BarangM->jumlah = $request->jumlah;
        $BarangM->save();

        $barang = Barang::where('id',$BarangM->id_barang);
        $barang->increment('jumlah',$BarangM->jumlah);



        Alert::success('Berhasil Menambahkan Barang Masuk', 'Data Use Berhasil ditambahkan!');
        return redirect()->route('admin.barang');
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
        $barangmasuk = DB::table('barang_masuk')->where('id', $id)->first();
        $barang = Barang::where('id',$barangmasuk->id_barang);
        $barang->decrement('jumlah',$barangmasuk->jumlah);
        DB::table('barang_masuk')->where('id', $id)->delete();

        Alert::success('Berhasil Hapus', 'Data Barang Berhasil dihapus!');
        return redirect()->route('admin.masuk');
    }
}
