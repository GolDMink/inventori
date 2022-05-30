<?php

namespace App\Http\Controllers;

use App\Satuan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use RealRashid\SweetAlert\Facades\Alert;

class SatuanController extends Controller
{
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $data = DB::table('satuan')->get();

            return datatables()->of($data)
                ->addColumn('action', function ($data) {
                    $button = '<a href="#" onclick="editSatuan(' . $data->id . ')" class="edit btn btn-info btn-sm"><i class="fa fa-pencil"></i></a>';
                    $button .= '&nbsp;&nbsp;';
                    $button .= ' <a href="#" onclick="hapusSatuan(' . $data->id . ')" class="delete btn btn-danger btn-sm" id="btnHapus" data-toggle="modal" data-id="' . $data->id . '"><i class="fa fa-trash"></i></a>';
                    return $button;
                })
                ->rawColumns(['action'])
                ->addIndexColumn()
                ->make(true);
        }
        return view('admin.kel_satuan');
    }

    public function tambahSatuan(Request $request)
    {
        $Barang = new Satuan();
        $Barang->satuan = $request->nama;
        $Barang->save();

        Alert::success('Berhasil Menambahkan Satuan', 'Data Satuan Berhasil ditambahkan!');
        return redirect()->route('admin.satuan');
    }

    public function editSatuan($id)
    {
        $data = DB::table('satuan')->where('id', $id)->first();
        return response()->json(['satuan' => $data]);
    }
    public function updateSatuan(Request $request, $id)
    {
        $data = DB::table('satuan')->where('id', $id)->update([
            'satuan' => $request->nama,
        ]);

        return response()->json(['satuan' => $data]);
    }

    public function hapusSatuan($id)
    {
        DB::table('satuan')->where('id', $id)->delete();
        Alert::success('Berhasil Hapus', 'Data Satuan Berhasil dihapus!');
        return redirect()->route('admin.satuan');
    }
}
