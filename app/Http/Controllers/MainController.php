<?php

namespace App\Http\Controllers;

use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

use App\Enums\PeriodEnum;

use Carbon\Carbon;

class MainController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        auth()->user()->givePermissionTo('admin panel access');
        auth()->user()->assignRole('admin');
        auth()->user()->assignRole('student');
        /*
        auth()->user()->givePermissionTo('teacher panel access');
        auth()->user()->assignRole('teacher');

        auth()->user()->givePermissionTo('student panel access');
        auth()->user()->assignRole('student');

        $role = Role::findById(1);
        $permission = Permission::findById(1);
        $role->givePermissionTo($permission);

        $role = Role::findById(2);
        $permission2 = Permission::findById(2);
        $role->givePermissionTo($permission2);

        $role = Role::findById(3);
        $permission3 = Permission::findById(3);
        $role->givePermissionTo($permission3);
        */
        $firstPeriod = PeriodEnum::PERIODS[PeriodEnum::PERIOD_GUZ];
        $secondPeriod = PeriodEnum::PERIODS[PeriodEnum::PERIOD_BAHAR];
        $firstPeriodDates = PeriodEnum::PERIODS_DATES[PeriodEnum::PERIOD_GUZ];
        $secondPeriodDates = PeriodEnum::PERIODS_DATES[PeriodEnum::PERIOD_BAHAR];

        return view('home')->with([
          'firstPeriod' => $firstPeriod,
          'secondPeriod' => $secondPeriod,
          'firstPeriodDates' => $firstPeriodDates,
          'secondPeriodDates' => $secondPeriodDates,
        ]);
    }
}
