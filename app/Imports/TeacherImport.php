<?php

namespace App\Imports;

use App\Models\User;

use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Hash;

use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\WithValidation;

use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class TeacherImport implements
    ToCollection,
    WithHeadingRow,
    WithValidation
{
    public function collection(Collection $rows)
    {
        foreach ($rows as $row)
        {
          if (($row['name'] !== null) && ($row['email'] !== null))
          {
            User::create([
                'name' => $row['name'],
                'email' => $row['email'],
                'password' => Hash::make('password'),
            ])->assignRole('teacher');
          }
        }
    }

    public function rules(): array
    {
        return [
          '*.name' => ['required'],
          '*.email' => ['email', 'unique:users,email', 'required']
        ];
    }
}
