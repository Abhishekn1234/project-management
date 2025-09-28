<?php



namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Auth;
class AuthController extends Controller
{
    public function loginForm(){
        return view('auth.login');
    }

  public function login(Request $request)
{
    $email = $request->email;
    $password = $request->password;

  
    if ($email === 'admin@gmail.com' && $password === 'password123') {
        session([
            'user_id' => 1,
            'role' => 'admin',
            'permissions' => ['create', 'update', 'view', 'delete']
        ]);
        return redirect('/users'); 
    }

   
    $user = \App\Models\User::where('email', $email)->first();

    if (!$user) {
       
        $employeeRole = \App\Models\Role::where('name', 'employee')->first();

        $user = \App\Models\User::create([
            'email' => $email,
            'password' => Hash::make($password), 
            'name' => explode('@', $email)[0], 
            'role_id' => $employeeRole->id ?? null,
        ]);
    
        
        
    }

   
    session([
        'user_id' => $user->id,
        'role' => $user->role->name ?? 'employee',
        'permissions' => $user->role->permissions ?? []
    ]);

    return redirect('/dashboard')->with('success', 'Logged in successfully');
}

    public function logout(){
        session()->flush();
        return redirect('/login');
    }
}
