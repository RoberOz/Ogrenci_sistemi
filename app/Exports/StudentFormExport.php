<?php

namespace App\Exports;

use App\Models\StudentForm;
use App\Models\User;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithEvents;
use Maatwebsite\Excel\Concerns\WithStyles;
use Maatwebsite\Excel\Events\BeforeExport;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;

class StudentFormExport implements
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
            $studentForm->user_id,
            User::where('id',$studentForm->user_id)->first()->name,
            $studentForm->tc_kimlik_no,
            $studentForm->birth_date,
            $studentForm->email,
            $studentForm->student_no,
            $studentForm->is_parents_together ? 'Yes' : 'No',
            $studentForm->living_with_family ? 'Yes' : 'No',
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
            $studentForm->is_mother_alive ? 'Yes' : 'No',
            $studentForm->mother_email,
            $studentForm->mother_phone_number,
            $studentForm->father_name,
            $studentForm->father_job,
            $studentForm->father_job_address,
            $studentForm->father_birth_date,
            $studentForm->is_father_alive ? 'Yes' : 'No',
            $studentForm->father_email,
            $studentForm->father_phone_number,
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
