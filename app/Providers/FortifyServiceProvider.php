<?php

namespace App\Providers;

use App\Models\Admin;
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
        Fortify::authenticateUsing(function (Request $request) {
            $admin = Admin::where('email', $request->email)
                ->first();
            if ($admin != null and Hash::check($request->password, $admin->password))
            {
                config(['auth.guards.web.provider' => 'admins']);
                return $admin;
            }
            $customer = Customer::where('email', $request->email)
                ->first();
            if ($customer != null and Hash::check($request->password, $customer->password))
            {
                config(['auth.guards.web.provider' => 'customers']);
                return $customer;
            }
        });
    }
}
