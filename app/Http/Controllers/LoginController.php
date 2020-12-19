<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller{
    public function authenticate(Request $request){
        $credentials = $request->only('email', 'password');

        config(['fortify.guard' => 'customer']);
        config(['defaults.guard' => 'customer']);
        if (Auth::guard('customer')->attempt($credentials)) {
            return redirect('dashboard');
        }

        config(['fortify.guard' => 'admin']);
        config(['defaults.guard' => 'admin']);
        if (Auth::guard('admin')->attempt($credentials)) {
            return redirect('dashboard');
        }

        return 'auth fail';
    }
}
