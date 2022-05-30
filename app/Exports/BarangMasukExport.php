<?php

namespace App\Exports;

use App\BarangMasuk;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class BarangMasukExport implements FromCollection,WithHeadings
{


    protected $tahun;
    protected $bulan;

    function __construct($tahun, $bulan)
    {
        $this->tahun = $tahun;
        $this->bulan = $bulan;
    }

    public function collection()
    {
        return DB::table('barang_masuk as bm')
            // ->join('satuan as s','s.id','b.id_satuan')
            // ->join('jenis as j','j.id','b.id_jenis')
            ->select('bm.id_transaksi', 'bm.tanggal')
            ->whereYear('bm.tanggal', '=', $this->tahun)
            ->whereMonth('bm.tanggal', '=', $this->bulan)
            ->get();
    }
    public function headings(): array
    {
        return [
            'id transaksi',
            'tanggal',
        ];
    }
}
