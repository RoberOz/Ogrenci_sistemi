<?php

namespace App\Http\Controllers;

use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

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


        return view('home');
    }
}
