<?php

namespace App\Imports;

use App\Models\User;

use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToCollection;
use Illuminate\Support\Facades\Hash;

use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\WithValidation;

use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class StudentImport implements ToCollection, WithHeadingRow, WithValidation
{
    public function collection(Collection $rows)
    {
        foreach ($rows as $row)
        {
          if (($row['name'] !== null && $row['email'] !== null))
          {
            if ($row['graduation_status'] == null)
            {
              $row['graduation_status'] = false;
            }
            User::create([
                'name' => $row['name'],
                'email' => $row['email'],
                'is_graduated' => $row['graduation_status'],
                'password' => Hash::make('password'),
            ])->assignRole('student');
          }
        }
    }

    public function rules(): array
    {
        return [
          '*.name' => ['required'],
          '*.email' => ['email', 'unique:users,email', 'required'],
          '*.is_graduated' => ['boolean']
        ];
    }
}
