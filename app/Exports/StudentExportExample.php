<?php

namespace App\Exports;

use App\Models\User;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithStyles;
use Maatwebsite\Excel\Events\BeforeExport;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;

use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class StudentExportExample implements
    FromCollection,
    ShouldAutoSize,
    WithMapping,
    WithHeadings,
    WithStyles
{
    public function collection()
    {
        return User::role('student')->get();
    }

    public function map($user): array
    {
        return [
            'name',
            'email',
            'Yes/no'
        ];
    }

    public function headings(): array
    {
        return [
            'Name',
            'Email',
            'Is Graduated',
        ];
    }

    public function styles(Worksheet $sheet)
    {
        return [
          1 => ['font' => ['bold' => true]],
        ];
    }
}
