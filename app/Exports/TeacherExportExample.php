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

class TeacherExportExample implements
    FromCollection,
    ShouldAutoSize,
    WithMapping,
    WithHeadings,
    Withstyles
{
    public function collection()
    {
        return User::role('teacher')->get();
    }

    public function map($user): array
    {
        return [
            'unique',
            'name',
            'email',
            'department name OR no'
        ];
    }

    public function headings(): array
    {
        return [
            'Teacher id',
            'Name',
            'Email',
            'Head of Department',
        ];
    }

    public function styles(Worksheet $sheet)
    {
        return [
          1 => ['font' => ['bold' => true]],
        ];
    }
}
