<?php

namespace App\Exports;

use App\Models\StudentForm;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithEvents;
use Maatwebsite\Excel\Events\AfterSheet;
use Maatwebsite\Excel\Events\BeforeExport;

class StudentFormExport implements
    FromCollection,
    ShouldAutoSize,
    WithMapping,
    WithHeadings,
    WithEvents
{
    public function collection()
    {
        return StudentForm::all();
    }

    public function map($studentForm): array
    {
        return [
            $studentForm->user_id,
            $studentForm->tc_kimlik_no,
            $studentForm->birth_date,
            $studentForm->email,
            $studentForm->student_no,
            $studentForm->is_parents_together,
            $studentForm->living_with_family,
            $studentForm->family_address,
            $studentForm->living_with,
            $studentForm->current_address,
            $studentForm->getting_school_with,
            $studentForm->working_status,
            $studentForm->had_any_surgery,
            $studentForm->did_have_any_sickness,
            $studentForm->how_many_siblings,
            $studentForm->height,
            $studentForm->weight,
            $studentForm->mother_name,
            $studentForm->mother_job,
            $studentForm->mother_job_address,
            $studentForm->mother_birth_date,
            $studentForm->is_mother_alive,
            $studentForm->mother_email,
            $studentForm->mother_phone_number,
            $studentForm->father_name,
            $studentForm->father_job,
            $studentForm->father_job_address,
            $studentForm->father_birth_date,
            $studentForm->is_father_alive,
            $studentForm->father_email,
            $studentForm->father_phone_number,
        ];
    }

    public function headings(): array
    {
        return [
            'User id',
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

    public function registerEvents(): array
    {
        return [
          AfterSheet::class => function (AfterSheet $event) {
            $event->sheet->getStyle('A1:AE1')->applyFromArray([
              'font' => [
                'bold' => true
              ]
            ]);
          }
        ];
    }
}
