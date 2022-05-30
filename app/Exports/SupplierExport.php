<?php

namespace App\Exports;

use App\Supplier;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class SupplierExport implements FromCollection , WithHeadings
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        return DB::table('supplier')->select('kode_supplier','nama_supplier','alamat','telepon')->get();
    }
    public function headings(): array
    {
        return [
            'Kode Supplier',
            'Nama Supplier',
            'Alamat',
            'Telepon',
        ];
    }
}
