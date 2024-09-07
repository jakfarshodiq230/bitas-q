<?php

namespace App\Exports;

use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

use App\Models\Admin\RaporKegiatanModel;

class NILAIBpi implements FromCollection, WithHeadings
{
    /**
    * @return \Illuminate\Support\Collection
    */
    protected $idPeriode;
    protected $IdKelas;

    public function __construct($idPeriode, $IdKelas)
    {
        $this->idPeriode = $idPeriode;
        $this->IdKelas = $IdKelas;
    }

    public function collection()
    {
        return RaporKegiatanModel::dataExcelBpi($this->idPeriode, $this->IdKelas);
    }

    public function headings(): array
    {
        return [
            'PERIODE',
            'NAMA',
            'KELAS',
            'PEMBIMBING',
            'NILAI AL-QURAN',
            'NILAI AQIDAH',
            'NILAI IBADAH',
            'NILAI HADITS',
            'NILAI SIRAH',
            'NILAI TAZKIYATUN',
            'NILAI FIKRUL',
            'NILAI AQDH',
            'NILAI IBDH',
            'NILAI AKHLAK',
            'NILAI PRBD',
            'NILAI AQR',
            'NILAI WWSN',
            'NILAI SHOLAT WAJIB',
            'NILAI TILAWAH',
            'NILAI TAHAJUD',
            'NILAI DUHA',
            'NILAI RAWATIB',
            'NILAI DZIKRI',
            'NILAI PUASA',
            'NILAI INFAQ',
        ];
    }
}
