<?php

namespace App\Providers;

use App\Models\User;
use App\Models\Customer;
use App\Actions\Fortify\CreateNewUser;
use App\Actions\Fortify\ResetUserPassword;
use App\Actions\Fortify\UpdateUserPassword;
use App\Actions\Fortify\UpdateUserProfileInformation;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\ServiceProvider;
use Laravel\Fortify\Fortify;
use Illuminate\Http\Request;

class FortifyServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        /*if (request()->isAdmin()) {
            config(['fortify.domain' => adminUrl()]);
            config(['fortify.guard' => 'user']);
        }*/
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        Fortify::createUsersUsing(CreateNewUser::class);
        Fortify::updateUserProfileInformationUsing(UpdateUserProfileInformation::class);
        Fortify::updateUserPasswordsUsing(UpdateUserPassword::class);
        Fortify::resetUserPasswordsUsing(ResetUserPassword::class);
        /*Fortify::authenticateUsing(function (Request $request) {
            $user = User::where('email', $request->email)->first();
            return $user;
            if($user === null)
            {
                $user = Customer::where('email', $request->email)->first();
            }

            if (Hash::check($request->password, $user->password)) {
                return $user;
            }
        });*/

         /*Fortify::loginView(function () {
            if (request()->isAdmin()) {
                return view('auth.login');
            }

            return view('auth.login');
        });*/
    }
}
