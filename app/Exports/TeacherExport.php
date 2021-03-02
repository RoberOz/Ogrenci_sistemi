<?php

namespace App\Exports;

use App\Models\User;
use Maatwebsite\Excel\Concerns\FromCollection;

use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class TeacherExport implements FromCollection
{
    public function collection()
    {
        return User::role('teacher')->get();
    }
}
