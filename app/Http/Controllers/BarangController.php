<?php

namespace App\Http\Controllers;

use App\Barang;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use RealRashid\SweetAlert\Facades\Alert;

class BarangController extends Controller
{
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $data = DB::table('barang as b')
                    ->join('satuan as s','s.id','b.id_satuan')
                    ->join('jenis as j','j.id','b.id_jenis')
                    ->select('b.id as idbarang','b.*','s.*','j.*')
                    ->get();

            return datatables()->of($data)
                ->addColumn('action', function ($data) {
                    $button = '<a href="#" onclick="editBarang(' . $data->idbarang . ')" class="edit btn btn-info btn-sm"><i class="fa fa-pencil"></i></a>';
                    $button .= '&nbsp;&nbsp;';
                    $button .= ' <a href="#" onclick="hapusBarang(' . $data->idbarang . ')" class="delete btn btn-danger btn-sm" id="btnHapus" data-toggle="modal" data-id="' . $data->id . '"><i class="fa fa-trash"></i></a>';
                    return $button;
                })
                ->rawColumns(['action'])
                ->addIndexColumn()
                ->make(true);
        }
        $jenis = DB::table('jenis')->get();
        $satuan = DB::table('satuan')->get();
        $data = [
            'jenis'=>$jenis,
            'satuan'=>$satuan
        ];
        return view('admin.kel_barang',$data);
    }

    public function tambahBarang(Request $request)
    {
        $Barang = new Barang();
        $Barang->id_jenis = $request->jenis;
        $Barang->id_satuan = $request->satuan;
        $Barang->kode_barang = $request->kode;
        $Barang->nama_barang = $request->nama;
        $Barang->jumlah = $request->jumlah;
        $Barang->save();

        Alert::success('Berhasil Menambahkan Barang', 'Data Use Berhasil ditambahkan!');
        return redirect()->route('admin.barang');
    }

    public function editBarang($id)
    {
        $data = DB::table('barang as b')
                ->join('jenis as j','j.id','b.id_jenis')
                ->join('satuan as s','s.id','b.id_satuan')
                ->select('b.id as idbarang','b.*','s.*','j.*')
                ->where('b.id', $id)
                ->first();
        return response()->json(['barang' => $data]);
    }
    public function updateBarang(Request $request, $id)
    {
        $data = DB::table('barang as b')->where('b.id', $id)->update([
            'b.kode_barang' => $request->kode,
            'b.nama_barang' => $request->nama,
            'b.id_satuan' => $request->satuan,
            'b.id_jenis' => $request->jenis,
            'b.jumlah' => $request->jumlah,
        ]);

        return response()->json(['barang' => $data]);
    }

    public function hapusBarang($id)
    {
        $barang = DB::table('barang')->where('id', $id)->first();
        DB::table('barang')->where('id', $id)->delete();

        Alert::success('Berhasil Hapus', 'Data Barang Berhasil dihapus!');
        return redirect()->route('admin.barang');
    }
}
