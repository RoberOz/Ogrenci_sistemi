<?php

namespace App\Imports;

use App\Models\User;
use Maatwebsite\Excel\Concerns\ToCollection;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Hash;

use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class StudentImport implements ToCollection
{
    public function collection(Collection $rows)
    {
        foreach ($rows as $row)
        {
          if (($row[0] !== null && $row[1] !== null))
          {
            if ($row[2] == null)
            {
              $row[2] = false;
            }
            User::create([
                'name' => $row[0],
                'email' => $row[1],
                'is_graduated' => $row[2],
                'password' => Hash::make('password'),
            ])->assignRole('student');
          }
        }
    }
}
