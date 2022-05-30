<?php

namespace App\Http\Controllers;

use App\Jenis;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use RealRashid\SweetAlert\Facades\Alert;

class JenisController extends Controller
{
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $data = DB::table('jenis')->get();

            return datatables()->of($data)
                ->addColumn('action', function ($data) {
                    $button = '<a href="#" onclick="editJenis(' . $data->id . ')" class="edit btn btn-info btn-sm"><i class="fa fa-pencil"></i></a>';
                    $button .= '&nbsp;&nbsp;';
                    $button .= ' <a href="#" onclick="hapusJenis(' . $data->id . ')" class="delete btn btn-danger btn-sm" id="btnHapus" data-toggle="modal" data-id="' . $data->id . '"><i class="fa fa-trash"></i></a>';
                    return $button;
                })
                ->rawColumns(['action'])
                ->addIndexColumn()
                ->make(true);
        }
        return view('admin.kel_jenis');
    }

    public function tambahJenis(Request $request)
    {

        $user = new Jenis();
        $user->jenis_barang = $request->nama;
        $user->save();

        return response()->json(
            [
                'success' => true,
                'message' => 'Data inserted successfully'
            ]
        );
    }

    public function editJenis($id)
    {
        $data = DB::table('jenis')->where('id', $id)->first();
        return response()->json(['jenis' => $data]);
    }
    public function updateJenis(Request $request, $id)
    {
        $data = DB::table('jenis')->where('id', $id)->update([
            'jenis_barang' => $request->nama,
        ]);

        return response()->json(['dosen' => $data]);
    }

    public function hapusJenis($id)
    {
        DB::table('jenis')->where('id', $id)->delete();
        Alert::success('Berhasil Hapus', 'Data Jenis Berhasil dihapus!');
        return redirect()->route('admin.jenis');
    }
}
