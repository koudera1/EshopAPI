<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller{
    public function authenticate(Request $request){
        $credentials = $request->only('email', 'password');

        if (Auth::guard('customer')->attempt($credentials)) {
            return redirect('dashboard');
        }
        if (Auth::guard('user')->attempt($credentials)) {
            return redirect('dashboard');
        }

        return 'auth fail';
    }
}
