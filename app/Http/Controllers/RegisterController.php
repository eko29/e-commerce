<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;

class RegisterController extends Controller
{
    /**
     * Handle the incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    // use PasswordValidationRules;
    public function register(Request $request){
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => [
                'required',
                'string',
                'email',
                'max:255',
                Rule::unique(User::class),
            ],
            'password' => ['required'],
            'retype_password' => ['required'],
        ],
        [
            'name.required'             => 'Nama Tidak boleh kosong',
            'email.required'            => 'Email Tidak boleh kosong',
            'password.required'         => 'Password Tidak boleh kosong',
            'retype_password.required'  => 'Retype Tidak boleh kosong',
        ]);
        $new_user = new User;
        $new_user->name      = $request->name;
        $new_user->email     = $request->email;
        $new_user->password  = Hash::make($request->password);
        $new_user->save();
        // Validator::make($input, [
        //     'name' => ['required', 'string', 'max:255'],
        //     'email' => [
        //         'required',
        //         'string',
        //         'email',
        //         'max:255',
        //         Rule::unique(User::class),
        //     ],
        //     'password' => $this->passwordRules(),
        //     'retype_password' => ['required'],
        // ])->validate();
        return redirect()->route('login');
    }
}
