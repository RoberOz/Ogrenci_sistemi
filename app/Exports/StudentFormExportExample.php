<?php

namespace App\Exports;

use App\Models\StudentForm;

use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithEvents;
use Maatwebsite\Excel\Concerns\WithStyles;
use Maatwebsite\Excel\Events\BeforeExport;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;

class StudentFormExportExample implements
    FromCollection,
    ShouldAutoSize,
    WithMapping,
    Withstyles,
    WithHeadings
{
    public function collection()
    {
        return StudentForm::all();
    }

    public function map($studentForm): array
    {
        return [
          'unique',
          'name',
          'number',
          'dd/mm/yy',
          'email',
          'number',
          'Yes/no',
          'Yes/no',
          'address',
          'names',
          'address',
          'vehicle',
          'status',
          'info',
          'info',
          'number',
          'cm',
          'kg',
          'name',
          'work',
          'address',
          'dd/mm/yy',
          'Yes/no',
          'email',
          'number',
          'name',
          'work',
          'address',
          'dd/mm/yy',
          'Yes/no',
          'email',
          'number',
        ];
    }

    public function headings(): array
    {
        return [
            'User id',
            'User name',
            'Tc kimlik no',
            'Birth date',
            'Email',
            'Student no',
            'Is parents together',
            'Living with family',
            'Family address',
            'Living with',
            'Current address',
            'Getting school with',
            'Working status',
            'Had any surgery',
            'Did have any sickness',
            'How many siblings',
            'Height',
            'Weight',
            'Mother name',
            'Mother job',
            'Mother job address',
            'Mother birth date',
            'Is mother alive',
            'Mother email',
            'Mother phone number',
            'Father name',
            'Father job',
            'Father job address',
            'Father birth date',
            'Is father alive',
            'Father email',
            'Father phone number',
        ];
    }

    public function styles(Worksheet $sheet)
    {
        return [
          1 => ['font' => ['bold' => true]],
        ];
    }
}
