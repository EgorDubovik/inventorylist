<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\RegisterRequest;
use App\Models\Company;
use App\Models\User;
use Illuminate\Http\Request;

class RegisterController extends Controller
{

    public function create(Request $request){
        return view("auth.register");
    }

    public function store(RegisterRequest $request){

        $company = Company::create([
            'name' => $request->company_name,
            'mc' => $request->mc,
            'dot' => $request->dot,
        ]);
        $user = User::create([
            'name' => $request->user_name,
            'company_id' => $company->id,
            'email' => $request->email,
            'password' => password_hash($request->password, PASSWORD_BCRYPT),
        ]);

        return view('auth.register-done');
    }
}
