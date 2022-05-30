<?php

namespace App\Http\Controllers;

use App\Supplier;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use RealRashid\SweetAlert\Facades\Alert;

class SupplierController extends Controller
{
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $data = DB::table('supplier')->get();

            return datatables()->of($data)
                ->addColumn('action', function ($data) {
                    $button = '<a href="#" onclick="editSupplier(' . $data->id . ')" class="edit btn btn-info btn-sm"><i class="fa fa-pencil"></i></a>';
                    $button .= '&nbsp;&nbsp;';
                    $button .= ' <a href="#" onclick="hapusSupplier(' . $data->id . ')" class="delete btn btn-danger btn-sm" id="btnHapus" data-toggle="modal" data-id="' . $data->id . '"><i class="fa fa-trash"></i></a>';
                    return $button;
                })
                ->rawColumns(['action'])
                ->addIndexColumn()
                ->make(true);
        }
        return view('admin.kel_supplier');
    }

    public function tambahSupplier(Request $request)
    {
        $Barang = new Supplier();
        $Barang->kode_supplier = $request->kode;
        $Barang->nama_supplier = $request->nama;
        $Barang->alamat = $request->alamat;
        $Barang->telepon = $request->telepon;
        $Barang->save();

        Alert::success('Berhasil Menambahkan Barang', 'Data Use Berhasil ditambahkan!');
        return redirect()->route('admin.supplier');
    }

    public function editSupplier($id)
    {
        $data = DB::table('supplier')->where('id', $id)->first();
        return response()->json(['supplier' => $data]);
    }
    public function updateSupplier(Request $request, $id)
    {
        $data = DB::table('supplier')->where('id',$id)->update([
            'kode_supplier' => $request->kode,
            'nama_supplier' => $request->nama,
            'alamat' => $request->alamat,
            'telepon' => $request->telepon,
        ]);

        return response()->json(['supplier' => $data]);
    }

    public function hapusSupplier($id)
    {
        DB::table('supplier')->where('id', $id)->delete();
        Alert::success('Berhasil Hapus', 'Data Supplier Berhasil dihapus!');
        return redirect()->route('admin.supplier');
    }
}
