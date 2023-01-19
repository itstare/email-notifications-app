<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\ValidationException;

class AdminController extends Controller
{
    public function login() {
    	return view('admin.login');
    }

    public function createSession(Request $request) {
    	$rules = [
    		'password' => ['required', 'string', 'min:8']
    	];
    	$request->validate($rules);

    	$password = Hash::make('Pa$$w0rd');

    	if(Hash::check($request->password, $password)) {
    		session(['admin' => true]);
            return redirect()->route('flight.index');
    	} else {
    		throw ValidationException::withMessages(['password' => 'Incorrect password.']);
    	}
    }
}
