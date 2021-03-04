<?php

namespace App\Exports;

use App\Models\User;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithEvents;
use Maatwebsite\Excel\Events\AfterSheet;
use Maatwebsite\Excel\Events\BeforeExport;

use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class TeacherExport implements
    FromCollection,
    ShouldAutoSize,
    WithMapping,
    WithHeadings,
    WithEvents
{
    public function collection()
    {
        return User::role('teacher')->get();
    }

    public function map($user): array
    {
        return [
            $user->name,
            $user->email,
        ];
    }

    public function headings(): array
    {
        return [
            'Name',
            'Email',
        ];
    }

    public function registerEvents(): array
    {
        return [
          AfterSheet::class => function (AfterSheet $event) {
            $event->sheet->getStyle('A1:B1')->applyFromArray([
              'font' => [
                'bold' => true
              ]
            ]);
          }
        ];
    }
}
