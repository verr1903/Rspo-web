<?php

namespace App\Exports;

use App\Models\Pks;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\WithDrawings;
use PhpOffice\PhpSpreadsheet\Worksheet\Drawing;
use Maatwebsite\Excel\Concerns\WithEvents;
use Maatwebsite\Excel\Events\AfterSheet;

class RekapPksExport implements FromCollection, WithHeadings, WithMapping, WithDrawings, WithEvents
{
    private $rows;
    private $index = 0;

    public function __construct($rows)
    {
        $this->rows = $rows;
    }

    public function collection()
    {
        return $this->rows;
    }

    // Header di Excel
    public function headings(): array
    {
        return [
            'No',
            'Tanggal Pengiriman',
            'Nama Pks',
            'Tujuan Pengiriman',
            'Nomor Blanko PB 33',
            'Nopol Mobil',
            'Nama Supir',
            'Foto Keseluruhan',
            'Foto Sebelum',
            'Foto Sesudah'
        ];
    }
    // Data per baris (exclude created_at & updated_at)
    public function map($pks): array
    {
        $this->index++; // tiap kali dipanggil tambah 1
        return [
            $this->index, // nomor urut
            $pks->tanggal_pengiriman,
            $pks->nama_pks,
            $pks->tujuan_pengiriman,
            $pks->nomor_blanko_pb33,
            $pks->nopol_mobil,
            $pks->nama_supir,
            '', // gambar isi di drawings()
            '', // gambar isi di drawings()
            '', // gambar isi di drawings()
        ];
    }

    // Masukkan gambar ke Excel
    public function drawings()
    {
        $drawings = [];
        $rowIndex = 2; // baris data mulai di row ke-2 (karena row 1 header)

        foreach ($this->rows as $row) {
            // Foto keseluruhan
            if ($row->foto_keseluruhan_pks && file_exists(public_path('storage/' . $row->foto_keseluruhan_pks))) {
                $drawing = new Drawing();
                $drawing->setPath(public_path('storage/' . $row->foto_keseluruhan_pks));
                $drawing->setHeight(80);
                $drawing->setCoordinates('H' . $rowIndex); // Kolom H
                $drawings[] = $drawing;
            }

            // Foto sebelum
            if ($row->foto_sebelum_pks && file_exists(public_path('storage/' . $row->foto_sebelum_pks))) {
                $drawing = new Drawing();
                $drawing->setPath(public_path('storage/' . $row->foto_sebelum_pks));
                $drawing->setHeight(80);
                $drawing->setCoordinates('I' . $rowIndex); // Kolom I
                $drawings[] = $drawing;
            }

            // Foto sesudah
            if ($row->foto_sesudah_pks && file_exists(public_path('storage/' . $row->foto_sesudah_pks))) {
                $drawing = new Drawing();
                $drawing->setPath(public_path('storage/' . $row->foto_sesudah_pks));
                $drawing->setHeight(80);
                $drawing->setCoordinates('J' . $rowIndex); // Kolom J
                $drawings[] = $drawing;
            }

            $rowIndex++;
        }

        return $drawings;
    }
    public function registerEvents(): array
    {
        return [
            AfterSheet::class => function (AfterSheet $event) {
                // Sesuaikan tinggi baris agar gambar muat
                $rowCount = count($this->rows) + 1; // +1 untuk header
                for ($i = 2; $i <= $rowCount; $i++) {
                    $event->sheet->getDelegate()->getRowDimension($i)->setRowHeight(80);
                }

                $event->sheet->getDelegate()->getColumnDimension('A')->setWidth(5);
                $event->sheet->getDelegate()->getColumnDimension('B')->setWidth(18);
                $event->sheet->getDelegate()->getColumnDimension('C')->setWidth(15);
                $event->sheet->getDelegate()->getColumnDimension('C')->setWidth(15);
                $event->sheet->getDelegate()->getColumnDimension('D')->setWidth(15);
                $event->sheet->getDelegate()->getColumnDimension('E')->setWidth(20);
                $event->sheet->getDelegate()->getColumnDimension('F')->setWidth(13);
                $event->sheet->getDelegate()->getColumnDimension('G')->setWidth(25);
                $event->sheet->getDelegate()->getColumnDimension('H')->setWidth(30);
                $event->sheet->getDelegate()->getColumnDimension('I')->setWidth(30);
                $event->sheet->getDelegate()->getColumnDimension('J')->setWidth(30);
            },
        ];
    }
}
