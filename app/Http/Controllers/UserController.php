<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use RealRashid\SweetAlert\Facades\Alert;

class UserController extends Controller
{
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $data = DB::table('users as u')->get();

            return datatables()->of($data)
                ->addColumn('action', function ($data) {
                    $button = '<a href="#" onclick="editUser(' . $data->id . ')" class="edit btn btn-info btn-sm"><i class="fa fa-pencil"></i></a>';
                    $button .= '&nbsp;&nbsp;';
                    $button .= ' <a href="#" onclick="hapusUser(' . $data->id . ')" class="delete btn btn-danger btn-sm" id="btnHapus" data-toggle="modal" data-id="' . $data->id . '"><i class="fa fa-trash"></i></a>';
                    return $button;
                })
                ->rawColumns(['action'])
                ->addIndexColumn()
                ->make(true);
        }
        return view('admin.kel_user');
    }

    public function tambahUser(Request $request)
    {
        $nama = time().'.'.request()->foto->getClientOriginalExtension();
        $request->foto->move(public_path('foto'), $nama);

        $user = new User();
        $user->username = $request->username;
        $user->nik = $request->nik;
        $user->nama = $request->nama;
        $user->alamat = $request->alamat;
        $user->telepon = $request->telpon;
        $user->level = 1;
        $user->foto = $nama;
        $user->password = bcrypt($request->password);
        $user->save();

        Alert::success('Berhasil Menambahkan User', 'Data Use Berhasil ditambahkan!');
        return redirect()->route('admin.user');
    }

    public function editUser($id)
    {
        $data = DB::table('users as u')->where('u.id', $id)->first();
        return response()->json(['user' => $data]);
    }
    public function updateUser(Request $request, $id)
    {
        $data = DB::table('users as u')->where('id', $id)->update([
            'u.username' => $request->username,
            'u.nik' => $request->nik,
            'u.nama' => $request->nama,
            'u.alamat' => $request->alamat,
            'u.telepon' => $request->telpon,
        ]);

        return response()->json(['dosen' => $data]);
    }

    public function hapusUser($id)
    {
        DB::table('users')->where('id', $id)->delete();
        Alert::success('Berhasil Hapus', 'Data User Berhasil dihapus!');
        return redirect()->route('admin.user');
    }
}
