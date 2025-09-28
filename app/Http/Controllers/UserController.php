<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Role;
use Illuminate\Support\Facades\Hash;
use App\Traits\HasPermissions;

class UserController extends Controller
{
    use HasPermissions;

    public function index(){
        if(!$this->hasPermission('view')) return redirect('/users')->with('error','Access denied');
        $users = User::with('role')->get();
        return view('users.index', compact('users'));
    }

    public function create(){
        if(!$this->hasPermission('create')) return redirect('/users')->with('error','Access denied');
        $roles = Role::all();
        return view('users.create', compact('roles'));
    }

    public function store(Request $request){
        if(!$this->hasPermission('create')) return redirect('/users')->with('error','Access denied');
        $request->validate([
            'name'=>'required|string|max:255',
            'email'=>'required|email|unique:users',
            'password'=>'required|string|min:6',
            'role_id'=>'required|exists:roles,id'
        ]);
        User::create([
            'name'=>$request->name,
            'email'=>$request->email,
            'password'=>Hash::make($request->password),
            'role_id'=>$request->role_id
        ]);
        return redirect()->route('users.index')->with('success','User created');
    }

    public function edit(User $user){
        if(!$this->hasPermission('update')) return redirect('/users')->with('error','Access denied');
        $roles = Role::all();
        return view('users.edit', compact('user','roles'));
    }

    public function update(Request $request, User $user){
        if(!$this->hasPermission('update')) return redirect('/users')->with('error','Access denied');
        $request->validate([
            'name'=>'required|string|max:255',
            'email'=>"required|email|unique:users,email,{$user->id}",
            'role_id'=>'required|exists:roles,id'
        ]);
        $user->update($request->only('name','email','role_id'));
        return redirect()->route('users.index')->with('success','User updated');
    }

    public function destroy(User $user){
        if(!$this->hasPermission('delete')) return redirect('/users')->with('error','Access denied');
        $user->delete();
        return redirect()->route('users.index')->with('success','User deleted');
    }
}
