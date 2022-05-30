<?php

namespace App\Exports;

use App\Barang;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class BarangExport implements FromCollection,WithHeadings
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        return DB::table('barang as b')
                ->join('satuan as s','s.id','b.id_satuan')
                ->join('jenis as j','j.id','b.id_jenis')
                ->select('b.kode_barang','b.nama_barang','b.jumlah','s.satuan','j.jenis_barang')
                ->get();
    }
    public function headings(): array
    {
        return [
            'Kode Barang',
            'Nama Barang',
            'Jumlah',
            'Satuan',
            'Jenis',
        ];
    }
}
