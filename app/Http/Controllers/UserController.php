<?php

namespace App\Http\Controllers;

use App\Http\Requests\UserStoreRequest;
use App\Http\Requests\UserUpdateRequest;
use App\Models\Role;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    public function list(){
        $this->authorize('view-users-list');

        $users = User::where('company_id',Auth::user()->company_id)
            ->where('id','<>',Auth::user()->id)
            ->get();
        return view('users.index',['users' => $users]);
    }

    public function create() {
        $this->authorize('create-users');

        return view('users.create');
    }

    public function store(UserStoreRequest $request){

        $user = User::create([
            'name' => $request->user_name,
            'email' => $request->email,
            'password' => password_hash($request->password, PASSWORD_BCRYPT),
            'phone' => $request->phone,
            'company_id' => Auth::user()->company_id,
        ]);

        foreach ($request->role as $role){
            if(in_array($role, Role::ROLES_ID)){
                Role::create([
                    'user_id' => $user->id,
                    'role' => $role,
                ]);
            }
        }

        return redirect()->route('users')->with('successful','User has been added successful');
    }

    public function edit(User $user){

        $this->authorize('update-users', $user);
        $role_array = $user->roles->pluck('role')->toArray();

        return view('users.update', ['user'=>$user, 'role_array' => $role_array]);
    }
    public function update(UserUpdateRequest $request,User $user){

        $this->authorize('update-users', $user);

        $user->update([
           'name' => $request->user_name,
           'email' => $request->email,
           'phone' => $request->phone,
        ]);
        $user->roles()->delete();
        foreach ($request->role as $role){
            if(in_array($role, Role::ROLES_ID)){
                Role::create([
                    'user_id' => $user->id,
                    'role' => $role,
                ]);
            }
        }

        return redirect()->route('users')->with('successful', 'User has been update successful');
    }
}
