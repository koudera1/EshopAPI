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
            config(['auth.defaults.guard' => 'user']);
            return Auth::guard('user')->user();
            $user = $details['original'];
            return $user;
            //return redirect('');
        }

        return 'auth fail';
    }
}
