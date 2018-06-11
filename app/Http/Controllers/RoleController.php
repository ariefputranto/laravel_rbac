<?php

namespace App\Http\Controllers;

use App\Role;
use App\Permission;
use Illuminate\Http\Request;

class RoleController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('permission');
    }

    public function index()
    {
        $roles = Role::all();
        return view('role.index',compact('roles'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $permissions = Permission::all();
        return view('role.create', compact('permissions'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|min:3',
            'permission' => 'required|array|min:1',
            'description' => 'string|nullable',
        ]);
        
        $role = Role::create([
            'name' => $request->name,
            'description' => $request->description,
        ]);

        foreach ($request->permission as $permission) {
            $role->Permission()->attach($permission);
        }

        return redirect('/role/'.$role->id);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Role  $role
     * @return \Illuminate\Http\Response
     */
    public function show(Role $role)
    {
        return view('role.show', compact('role'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Role  $role
     * @return \Illuminate\Http\Response
     */
    public function edit(Role $role)
    {
        $permissions = Permission::all();
        $role_permission = [];
        foreach ($role->Permission as $permission) {
            $role_permission []= $permission->id;
        }
        return view('role.edit', compact('role','permissions','role_permission'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Role  $role
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Role $role)
    {
        $request->validate([
            'name' => 'required|min:3|unique:roles,name,'.$role->id,
            'permission' => 'required|array|min:1',
            'description' => 'string|nullable'
        ]);

        $role->name = $request->name;
        $role->description = $request->description;
        $role->save();

        $role->Permission()->detach();
        foreach ($request->permission as $permission) {
            $role->Permission()->attach($permission);
        }

        $request->session()->flash('message','Successfully modified the role!');
        return redirect('role');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Role  $role
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, Role $role)
    {
        $role->Permission()->detach();
        $role->delete();
        $request->session()->flash('message', 'Successfully deleted the role!');
        return redirect('role');
    }
}
