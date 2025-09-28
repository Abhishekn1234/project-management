<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Role;
use App\Traits\HasPermissions;

class RoleController extends Controller
{
    use HasPermissions;

    public function index(){
        if(!$this->hasPermission('view')) return redirect('/users')->with('error','Access denied');
        $roles = Role::all();
        return view('roles.index', compact('roles'));
    }

    public function create(){
        if(!$this->hasPermission('create')) return redirect('/users')->with('error','Access denied');
        return view('roles.create');
    }

    public function store(Request $request){
        if(!$this->hasPermission('create')) {
            return redirect('/users')->with('error','Access denied');
        }

        $request->validate([
            'name' => 'required|string|max:255',
            'permissions' => 'nullable'
        ]);

        $permissions = [];

        if (is_string($request->permissions)) {
            
            $permissions = array_map('trim', explode(',', $request->permissions));
        } elseif (is_array($request->permissions)) {
            
            $permissions = $request->permissions;
        }

        Role::create([
            'name' => $request->name,
            'permissions' => json_encode($permissions) 
        ]);

        return redirect()->route('roles.index')->with('success','Role created');
    }

    public function edit(Role $role){
        if(!$this->hasPermission('update')) return redirect('/users')->with('error','Access denied');
        return view('roles.edit', compact('role'));
    }

    public function update(Request $request, Role $role){
        if(!$this->hasPermission('update')) return redirect('/users')->with('error','Access denied');

        $request->validate([
            'name'=>'required|string|max:255',
            'permissions'=>'nullable|string'
        ]);

        $permissions = $request->permissions
            ? array_map('trim', explode(',', $request->permissions))
            : [];

        $role->update([
            'name'=>$request->name,
            'permissions'=>$permissions
        ]);

        return redirect()->route('roles.index')->with('success','Role updated');
    }

    public function destroy(Role $role){
        if(!$this->hasPermission('delete')) return redirect('/users')->with('error','Access denied');
        $role->delete();
        return redirect()->route('roles.index')->with('success','Role deleted');
    }
}
