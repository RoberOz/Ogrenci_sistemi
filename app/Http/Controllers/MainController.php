<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class MainController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        /*
        Role::create(['name' => 'admin']);
        Permission::create(['name' => 'admin panel access']);
        */

        /*
        auth()->user()->givePermissionTo('admin panel access');
        auth()->user()->assignRole('admin');

        $role = Role::findById(1);
        $permission = Permission::findById(1);
        $role->givePermissionTo($permission);
        */

        return view('home');
    }
}
